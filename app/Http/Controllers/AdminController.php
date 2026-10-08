<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DamageReport;
use App\Models\WorkOrder;
use App\Models\Facility;
use App\Models\Verification;
use App\Models\TechnicianVendor;
use App\Models\BudgetProposal;
use App\Models\RabItem;
use App\Models\SchoolBudget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Tampilkan Dashboard Admin SarPras (Sesuai Layout Admin Principal / Kepala Sarpras).
     */
    public function dashboard()
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        // 1. Hitung Statistik Utama dari Real Database
        $totalActiveTickets = DamageReport::count();
        if ($totalActiveTickets === 0) $totalActiveTickets = 0;

        // Proposal RAB yang hanya berstatus 'menunggu_persetujuan'
        $proposals = BudgetProposal::with([
            'verification.damageReport.facility',
            'verification.damageReport.user',
            'items'
        ])->where('status_persetujuan', 'menunggu_persetujuan')
          ->latest()
          ->get();

        $pendingRabsCount = $proposals->count();

        // 1. Perhitungan Riil SLA Penyelesaian
        $allReports = DamageReport::all();
        $totalAllReports = $allReports->count();

        $onTimeCount = 0;
        $inProgressCount = 0;
        $overdueCount = 0;

        foreach ($allReports as $report) {
            $created = $report->created_at ?: now();
            $updated = $report->updated_at ?: now();

            if ($report->status_laporan === 'selesai') {
                $durationHours = $created->diffInHours($updated);
                if ($durationHours <= 72) {
                    $onTimeCount++;
                } else {
                    $overdueCount++;
                }
            } elseif (in_array($report->status_laporan, ['proses', 'proses_perbaikan', 'menunggu', 'menunggu_rab', 'darurat'])) {
                $elapsedHours = $created->diffInHours(now());
                if ($elapsedHours <= 48) {
                    $inProgressCount++;
                } else {
                    $overdueCount++;
                }
            } else {
                $inProgressCount++;
            }
        }

        if ($totalAllReports > 0) {
            $onTimePercent = round(($onTimeCount / $totalAllReports) * 100);
            $inProgressPercent = round(($inProgressCount / $totalAllReports) * 100);
            $overduePercent = max(0, 100 - $onTimePercent - $inProgressPercent);
        } else {
            $onTimePercent = 100;
            $inProgressPercent = 0;
            $overduePercent = 0;
        }

        $slaData = [
            'total_tickets'       => $totalAllReports,
            'on_time_count'       => $onTimeCount,
            'on_time_percent'     => $onTimePercent,
            'in_progress_count'   => $inProgressCount,
            'in_progress_percent' => $inProgressPercent,
            'overdue_count'       => $overdueCount,
            'overdue_percent'     => $overduePercent,
        ];

        $slaPercentage = $onTimePercent;

        // Hitung Serapan Anggaran dari Proposal yang Disetujui
        $budget = SchoolBudget::first();
        $totalBudget = $budget ? $budget->total_anggaran : 50000000;
        $totalDisetujui = BudgetProposal::where('status_persetujuan', 'disetujui')->sum('estimasi_biaya');
        $budgetAbsorptionPercentage = $totalBudget > 0 ? round(($totalDisetujui / $totalBudget) * 100, 1) : 0;

        $percentageChange = 12;

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        // 3. Data Fasilitas Sering Rusak Riil dari Database
        $categoriesList = Category::all();
        $technicians = User::where(function($q) {
            $q->where('role', 'petugas')->orWhere('status', 'petugas');
        })->get()->keyBy('category_id');

        $icons = [
            1 => '⚡', // Listrik
            2 => '🚰', // Air
            3 => '🏢', // Bangunan
            4 => '💻', // IT
            6 => '🌐', // Jaringan
            7 => '🚗', // Kendaraan
        ];

        $totalAllDamages = max(1, $totalAllReports);
        $fasilitasSeringRusak = [];

        foreach ($categoriesList as $cat) {
            $query = DamageReport::where(function($q) use ($cat) {
                $q->where('category_id', $cat->id)
                  ->orWhere(function($sub) use ($cat) {
                      $sub->whereNull('category_id')
                          ->whereHas('facility', function($fac) use ($cat) {
                              $fac->where('category_id', $cat->id);
                          });
                  });
            });

            $kasus = $query->count();
            $selesaiKasus = (clone $query)->where('status_laporan', 'selesai')->count();
            $prosesKasus = $kasus - $selesaiKasus;
            $persen = $totalAllDamages > 0 ? round(($kasus / $totalAllDamages) * 100) : 0;

            $tech = $technicians->get($cat->id);
            $techName = $tech ? $tech->nama : 'Petugas Sarpras';

            $fasilitasSeringRusak[] = [
                'id'           => $cat->id,
                'kategori'     => $cat->name,
                'icon'         => $icons[$cat->id] ?? '🔧',
                'kasus'        => $kasus,
                'persen'       => $persen,
                'selesai'      => $selesaiKasus,
                'dalam_proses' => $prosesKasus,
                'teknisi'      => $techName,
            ];
        }

        usort($fasilitasSeringRusak, fn($a, $b) => $b['kasus'] <=> $a['kasus']);

        $maxKasus = !empty($fasilitasSeringRusak) ? max(1, max(array_column($fasilitasSeringRusak, 'kasus'))) : 1;
        foreach ($fasilitasSeringRusak as &$item) {
            $item['bar_width'] = round(($item['kasus'] / $maxKasus) * 100);
        }
        unset($item);

        return view('admin.dashboard', compact(
            'user',
            'totalActiveTickets',
            'percentageChange',
            'pendingRabsCount',
            'slaPercentage',
            'slaData',
            'budgetAbsorptionPercentage',
            'hasEmergency',
            'proposals',
            'fasilitasSeringRusak'
        ));
    }

    /**
     * Setujui Proposal RAB oleh Admin Sarpras.
     */
    public function approveRab(Request $request, $id_rab)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard');
        }

        $proposal = BudgetProposal::with(['verification.damageReport', 'schoolBudget'])->findOrFail($id_rab);
        $proposal->status_persetujuan = 'disetujui';
        $proposal->save();

        // Update status laporan kerusakan menjadi 'proses' agar teknisi dapat mengeksekusi perbaikan
        if ($proposal->verification && $proposal->verification->damageReport) {
            $report = $proposal->verification->damageReport;
            $report->status_laporan = 'proses';
            $report->save();
        }

        if ($request->filled('catatan_keputusan') && $proposal->verification) {
            $proposal->verification->catatan_inspeksi = $request->catatan_keputusan;
            $proposal->verification->save();
        }

        if ($proposal->schoolBudget) {
            $proposal->schoolBudget->sisa_saldo = max(0, $proposal->schoolBudget->sisa_saldo - $proposal->estimasi_biaya);
            $proposal->schoolBudget->save();
        }

        return back()->with('success', 'RAB berhasil disetujui (Approved)! Teknisi dapat segera mengeksekusi perbaikan.');
    }

    /**
     * Tolak / Minta Revisi Proposal RAB.
     */
    public function rejectRab(Request $request, $id_rab)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard');
        }

        $proposal = BudgetProposal::with(['verification.damageReport'])->findOrFail($id_rab);
        $proposal->status_persetujuan = 'ditolak';
        $proposal->save();

        // Status laporan tetap 'menunggu_rab' agar teknisi mengajukan revisi
        if ($proposal->verification && $proposal->verification->damageReport) {
            $report = $proposal->verification->damageReport;
            $report->status_laporan = 'menunggu_rab';
            $report->save();
        }

        if ($request->filled('catatan_keputusan') && $proposal->verification) {
            $proposal->verification->catatan_inspeksi = 'Catatan Penolakan/Revisi: ' . $request->catatan_keputusan;
            $proposal->verification->save();
        }

        return back()->with('success', 'RAB telah ditolak / diminta revisi ke teknisi.');
    }

    /**
     * Tampilkan daftar semua work order / laporan kerusakan.
     */
    public function workOrdersIndex()
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        // 2. Metrik Work Order Riil dari Database
        $totalWo = DamageReport::count();
        $menungguPerbaikan = DamageReport::where('status_laporan', '!=', 'selesai')->count();
        $selesaiBulanIni = DamageReport::where('status_laporan', 'selesai')
            ->where(function($q) {
                $q->whereMonth('updated_at', now()->month)
                  ->whereYear('updated_at', now()->year)
                  ->orWhereNull('updated_at');
            })->count();

        // 3. Ambil SEMUA Laporan/WO untuk Tabel
        $allReports = DamageReport::with(['facility', 'user', 'verification.workOrder'])
            ->latest('tanggal_waktu')
            ->get();

        return view('admin.work_orders', compact(
            'user',
            'allReports',
            'hasEmergency',
            'totalWo',
            'menungguPerbaikan',
            'selesaiBulanIni'
        ));
    }

    /**
     * Tampilkan Laporan & Analitik Strategis Sarpras (Data Riil Database).
     */
    public function analyticsIndex(Request $request)
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $now = now();
        $period = $request->get('period', 'tahun');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($period === 'triwulan') {
            $periodStart = $now->copy()->subMonths(3)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Triwulan (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'semester') {
            $periodStart = $now->copy()->subMonths(6)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Semester (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'custom' && $startDate && $endDate) {
            $periodStart = \Carbon\Carbon::parse($startDate)->startOfDay();
            $periodEnd = \Carbon\Carbon::parse($endDate)->endOfDay();
            $periodLabel = $periodStart->format('d M Y') . ' - ' . $periodEnd->format('d M Y');
        } else {
            $period = 'tahun';
            $periodStart = $now->copy()->startOfYear();
            $periodEnd = $now->copy()->endOfYear();
            $periodLabel = 'Tahun Berjalan (' . $now->format('Y') . ')';
        }

        // 1. Data Finansial & Anggaran Riil
        $budget = SchoolBudget::first();
        if (!$budget) {
            $budget = SchoolBudget::create([
                'tahun_ajaran' => '2026/2027',
                'total_anggaran' => 50000000,
                'sisa_saldo' => 50000000,
            ]);
        }
        $totalAnggaran = (float) $budget->total_anggaran;
        $tahunAjaran = $budget->tahun_ajaran;

        // Query proposal RAB yang disetujui dengan filter periode
        $approvedProposals = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->where('status_persetujuan', 'disetujui')
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->get();

        // Hitung total pengeluaran terealisasi dari subtotal items RAB yang disetujui
        $pengeluaranTerealisasi = 0;
        foreach ($approvedProposals as $prop) {
            $sum = $prop->items->sum('subtotal');
            if ($sum == 0 && $prop->total_estimasi > 0) {
                $sum = $prop->total_estimasi;
            }
            $pengeluaranTerealisasi += $sum;
        }

        // Sisa saldo & persentase terpakai
        $sisaSaldo = max(0, $totalAnggaran - $pengeluaranTerealisasi);
        $persenTerpakai = $totalAnggaran > 0 ? round(($pengeluaranTerealisasi / $totalAnggaran) * 100, 1) : 0;

        // 2. Distribusi Pengeluaran Riil Berdasarkan Kategori
        $categoryTotals = [];
        $allCategories = Category::all();
        foreach ($allCategories as $c) {
            $categoryTotals[$c->name] = 0;
        }

        foreach ($approvedProposals as $prop) {
            $report = $prop->verification ? $prop->verification->damageReport : null;
            $catName = ($report && $report->category) ? $report->category->name : 'Umum & Lainnya';
            $sum = $prop->items->sum('subtotal');
            if ($sum == 0 && $prop->total_estimasi > 0) $sum = $prop->total_estimasi;

            if (!isset($categoryTotals[$catName])) {
                $categoryTotals[$catName] = 0;
            }
            $categoryTotals[$catName] += $sum;
        }

        // Urutkan pengeluaran dari terbesar
        arsort($categoryTotals);

        $colors = ['#1d4ed8', '#2563eb', '#3b82f6', '#0ea5e9', '#6366f1', '#8b5cf6'];
        $colorIdx = 0;
        $distribusiPengeluaran = [];

        foreach ($categoryTotals as $catName => $amount) {
            $pct = $pengeluaranTerealisasi > 0 ? round(($amount / $pengeluaranTerealisasi) * 100, 1) : 0;
            $distribusiPengeluaran[] = [
                'nama' => $catName,
                'nominal' => $amount,
                'persen' => $pct,
                'color' => $colors[$colorIdx % count($colors)],
            ];
            $colorIdx++;
        }

        // 3. Tren Biaya Pemeliharaan Riil (6 Bulan Terakhir)
        $trenBiaya = [];
        $maxTrenValue = 5000000; // baseline skala 5 juta
        for ($i = 5; $i >= 0; $i--) {
            $dt = now()->subMonths($i);
            $mKey = $dt->format('Y-m');
            $mName = $dt->format('M'); // Jan, Feb, Mar, etc.

            $mSum = 0;
            foreach ($approvedProposals as $prop) {
                if ($prop->created_at && $prop->created_at->format('Y-m') === $mKey) {
                    $sum = $prop->items->sum('subtotal');
                    if ($sum == 0) $sum = $prop->total_estimasi;
                    $mSum += $sum;
                }
            }

            if ($mSum > $maxTrenValue) {
                $maxTrenValue = $mSum;
            }

            $trenBiaya[] = [
                'bulan' => $mName,
                'key' => $mKey,
                'nominal' => $mSum,
                'label' => $mSum > 0 ? 'Rp ' . number_format($mSum, 0, ',', '.') : 'Rp 0',
            ];
        }

        // 4. Log Transaksi Utama Terkini dari Database
        // 4. Log Transaksi Riil dari Database Sesuai Periode Terpilih
        $proposalsWithReports = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->latest()
            ->get();

        $logTransaksi = [];
        foreach ($proposalsWithReports as $p) {
            $rep = $p->verification ? $p->verification->damageReport : null;
            $fac = $rep ? $rep->facility : null;
            $cat = ($rep && $rep->category) ? $rep->category->name : ($fac ? ($fac->kategori_area ?? 'Umum') : 'Umum');
            $sum = $p->items->sum('subtotal');
            if ($sum == 0) $sum = $p->total_estimasi;

            $catIcon = '🔧';
            if (stripos($cat, 'listrik') !== false) $catIcon = '⚡';
            elseif (stripos($cat, 'pipa') !== false || stripos($cat, 'air') !== false) $catIcon = '🚰';
            elseif (stripos($cat, 'ac') !== false) $catIcon = '❄️';
            elseif (stripos($cat, 'bangunan') !== false || stripos($cat, 'mebel') !== false) $catIcon = '🏢';
            elseif (stripos($cat, 'it') !== false || stripos($cat, 'elektronik') !== false) $catIcon = '💻';
            elseif (stripos($cat, 'jaringan') !== false) $catIcon = '🌐';
            elseif (stripos($cat, 'kendaraan') !== false || stripos($cat, 'mobil') !== false) $catIcon = '🚗';

            $statusLabel = 'Menunggu Persetujuan';
            if ($p->status_persetujuan === 'disetujui') $statusLabel = 'Terbayar';
            elseif ($p->status_persetujuan === 'ditolak') $statusLabel = 'Ditolak';

            $logTransaksi[] = [
                'tanggal' => $p->created_at ? $p->created_at->format('d M Y') : now()->format('d M Y'),
                'deskripsi' => $rep ? ($rep->deskripsi_laporan ?: ($fac ? $fac->nama_fasilitas : 'Perbaikan Fasilitas')) : 'Pengajuan Perbaikan Sarpras',
                'kategori' => $cat,
                'kategori_icon' => $catIcon,
                'status' => $statusLabel,
                'status_raw' => $p->status_persetujuan,
                'jumlah' => $sum,
            ];
        }

        return view('admin.analytics', compact(
            'user',
            'totalAnggaran',
            'tahunAjaran',
            'pengeluaranTerealisasi',
            'persenTerpakai',
            'sisaSaldo',
            'distribusiPengeluaran',
            'trenBiaya',
            'maxTrenValue',
            'logTransaksi',
            'period',
            'periodLabel',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Ekspor Laporan Pertanggungjawaban Realisasi Anggaran ke PDF Asli (DomPDF).
     */
    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $now = now();
        $period = $request->get('period', 'tahun');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($period === 'triwulan') {
            $periodStart = $now->copy()->subMonths(3)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Triwulan (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'semester') {
            $periodStart = $now->copy()->subMonths(6)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Semester (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'custom' && $startDate && $endDate) {
            $periodStart = \Carbon\Carbon::parse($startDate)->startOfDay();
            $periodEnd = \Carbon\Carbon::parse($endDate)->endOfDay();
            $periodLabel = $periodStart->format('d M Y') . ' - ' . $periodEnd->format('d M Y');
        } else {
            $period = 'tahun';
            $periodStart = $now->copy()->startOfYear();
            $periodEnd = $now->copy()->endOfYear();
            $periodLabel = 'Tahun Berjalan (' . $now->format('Y') . ')';
        }

        $budget = SchoolBudget::first();
        if (!$budget) {
            $budget = SchoolBudget::create([
                'tahun_ajaran' => '2026/2027',
                'total_anggaran' => 50000000,
                'sisa_saldo' => 50000000,
            ]);
        }
        $totalAnggaran = (float) $budget->total_anggaran;
        $tahunAjaran = $budget->tahun_ajaran;

        $approvedProposals = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->where('status_persetujuan', 'disetujui')
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->get();

        $pengeluaranTerealisasi = 0;
        foreach ($approvedProposals as $prop) {
            $sum = $prop->items->sum('subtotal');
            if ($sum == 0 && $prop->total_estimasi > 0) {
                $sum = $prop->total_estimasi;
            }
            $pengeluaranTerealisasi += $sum;
        }

        $sisaSaldo = max(0, $totalAnggaran - $pengeluaranTerealisasi);
        $persenTerpakai = $totalAnggaran > 0 ? round(($pengeluaranTerealisasi / $totalAnggaran) * 100, 1) : 0;

        $proposalsWithReports = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->latest()
            ->get();

        $transaksi = [];
        foreach ($proposalsWithReports as $p) {
            $rep = $p->verification ? $p->verification->damageReport : null;
            $fac = $rep ? $rep->facility : null;
            $cat = ($rep && $rep->category) ? $rep->category->name : ($fac ? ($fac->kategori_area ?? 'Umum') : 'Umum');
            $sum = $p->items->sum('subtotal');
            if ($sum == 0) $sum = $p->total_estimasi;

            $statusLabel = 'Menunggu Persetujuan';
            if ($p->status_persetujuan === 'disetujui') $statusLabel = 'Disetujui / Terbayar';
            elseif ($p->status_persetujuan === 'ditolak') $statusLabel = 'Ditolak';

            $transaksi[] = (object)[
                'tanggal' => $p->created_at ? $p->created_at->format('Y-m-d') : now()->format('Y-m-d'),
                'deskripsi' => $rep ? ($rep->deskripsi_laporan ?: ($fac ? $fac->nama_fasilitas : 'Perbaikan Fasilitas')) : 'Pengajuan Perbaikan Sarpras',
                'damageReport' => $rep,
                'kategori' => $cat,
                'status' => $statusLabel,
                'jumlah' => $sum,
            ];
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.analytics_pdf', compact(
            'totalAnggaran',
            'tahunAjaran',
            'pengeluaranTerealisasi',
            'sisaSaldo',
            'persenTerpakai',
            'periodLabel',
            'transaksi'
        ))->setPaper('a4', 'portrait');

        $filename = 'Laporan_Realisasi_Anggaran_Sarpras_' . str_replace([' ', '/', '\\'], '_', $tahunAjaran) . '_' . date('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Ekspor Laporan Pertanggungjawaban Realisasi Anggaran ke Excel (.xls) Rapi & Terstruktur.
     */
    public function exportExcel(Request $request)
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $now = now();
        $period = $request->get('period', 'tahun');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($period === 'triwulan') {
            $periodStart = $now->copy()->subMonths(3)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Triwulan (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'semester') {
            $periodStart = $now->copy()->subMonths(6)->startOfDay();
            $periodEnd = $now->copy()->endOfDay();
            $periodLabel = 'Semester (' . $periodStart->format('d M') . ' - ' . $periodEnd->format('d M Y') . ')';
        } elseif ($period === 'custom' && $startDate && $endDate) {
            $periodStart = \Carbon\Carbon::parse($startDate)->startOfDay();
            $periodEnd = \Carbon\Carbon::parse($endDate)->endOfDay();
            $periodLabel = $periodStart->format('d M Y') . ' - ' . $periodEnd->format('d M Y');
        } else {
            $period = 'tahun';
            $periodStart = $now->copy()->startOfYear();
            $periodEnd = $now->copy()->endOfYear();
            $periodLabel = 'Tahun Berjalan (' . $now->format('Y') . ')';
        }

        $budget = SchoolBudget::first();
        if (!$budget) {
            $budget = SchoolBudget::create([
                'tahun_ajaran' => '2026/2027',
                'total_anggaran' => 50000000,
                'sisa_saldo' => 50000000,
            ]);
        }
        $totalAnggaran = (float) $budget->total_anggaran;
        $tahunAjaran = $budget->tahun_ajaran;

        $approvedProposals = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->where('status_persetujuan', 'disetujui')
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->get();

        $pengeluaranTerealisasi = 0;
        foreach ($approvedProposals as $prop) {
            $sum = $prop->items->sum('subtotal');
            if ($sum == 0 && $prop->total_estimasi > 0) {
                $sum = $prop->total_estimasi;
            }
            $pengeluaranTerealisasi += $sum;
        }

        $sisaSaldo = max(0, $totalAnggaran - $pengeluaranTerealisasi);
        $persenTerpakai = $totalAnggaran > 0 ? round(($pengeluaranTerealisasi / $totalAnggaran) * 100, 1) : 0;

        $proposalsWithReports = BudgetProposal::with(['verification.damageReport.category', 'verification.damageReport.facility', 'items'])
            ->whereBetween('created_at', [$periodStart, $periodEnd])
            ->latest()
            ->get();

        $transaksi = [];
        foreach ($proposalsWithReports as $p) {
            $rep = $p->verification ? $p->verification->damageReport : null;
            $fac = $rep ? $rep->facility : null;
            $cat = ($rep && $rep->category) ? $rep->category->name : ($fac ? ($fac->kategori_area ?? 'Umum') : 'Umum');
            $sum = $p->items->sum('subtotal');
            if ($sum == 0) $sum = $p->total_estimasi;

            $statusLabel = 'Menunggu Persetujuan';
            if ($p->status_persetujuan === 'disetujui') $statusLabel = 'Terbayar';
            elseif ($p->status_persetujuan === 'ditolak') $statusLabel = 'Ditolak';

            $transaksi[] = (object)[
                'tanggal' => $p->created_at ? $p->created_at->format('Y-m-d') : now()->format('Y-m-d'),
                'deskripsi' => $rep ? ($rep->deskripsi_laporan ?: ($fac ? $fac->nama_fasilitas : 'Perbaikan Fasilitas')) : 'Pengajuan Perbaikan Sarpras',
                'damageReport' => $rep,
                'kategori' => $cat,
                'status' => $statusLabel,
                'jumlah' => $sum,
            ];
        }

        $html = view('admin.analytics_excel', compact(
            'totalAnggaran',
            'tahunAjaran',
            'pengeluaranTerealisasi',
            'sisaSaldo',
            'persenTerpakai',
            'periodLabel',
            'transaksi'
        ))->render();

        $filename = 'Laporan_Keuangan_Sarpras_' . str_replace([' ', '/', '\\'], '_', $tahunAjaran) . '_' . date('Ymd_His') . '.xls';

        return response("\xEF\xBB\xBF" . $html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0, no-cache, must-revalidate, proxy-revalidate'
        ]);
    }

    /**
     * Perbarui Alokasi Total Anggaran Sekolah.
     */
    public function updateBudget(Request $request)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $request->validate([
            'total_anggaran' => 'required',
            'tahun_ajaran'   => 'required|string|max:50',
        ], [
            'total_anggaran.required' => 'Nominal total anggaran wajib diisi.',
            'tahun_ajaran.required'   => 'Tahun ajaran wajib diisi.',
        ]);

        // Bersihkan formatting rupiah (misal: "Rp 100.000.000" -> 100000000)
        $cleanNominal = (float) preg_replace('/[^0-9]/', '', (string)$request->total_anggaran);
        if ($cleanNominal <= 0) {
            return back()->with('error', 'Nominal anggaran harus lebih dari 0.');
        }

        // Ambil total pengeluaran saat ini dari RAB yang disetujui
        $disetujuiTotal = 0;
        $approved = BudgetProposal::with('items')->where('status_persetujuan', 'disetujui')->get();
        foreach ($approved as $app) {
            $sum = $app->items->sum('subtotal');
            $disetujuiTotal += ($sum > 0 ? $sum : $app->total_estimasi);
        }

        $budget = SchoolBudget::first();
        if (!$budget) {
            $budget = new SchoolBudget();
        }

        $budget->tahun_ajaran = trim($request->tahun_ajaran);
        $budget->total_anggaran = $cleanNominal;
        $budget->sisa_saldo = max(0, $cleanNominal - $disetujuiTotal);
        $budget->save();

        return redirect()->route('admin.analytics.index')->with('success', 'Alokasi Total Anggaran Sekolah berhasil diperbarui menjadi Rp ' . number_format($cleanNominal, 0, ',', '.') . '!');
    }

    private function checkAdminAccess(): bool
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        return in_array($status, ['admin', 'sarpras', 'admin_sarpras']);
    }

    /**
     * Tampilkan detail laporan kerusakan dan form inspeksi.
     */
    public function showWorkOrder($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $user = Auth::user();
        $report = DamageReport::with(['facility', 'user', 'technician.category', 'verification.workOrder.technicianVendor'])->findOrFail($id);
        $technicians = TechnicianVendor::orderBy('nama_teknisi')->get();

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        return view('admin.detail', compact('user', 'report', 'technicians', 'hasEmergency'));
    }

    /**
     * Simpan hasil inspeksi dan perbarui work order.
     */
    public function updateWorkOrder(Request $request, $id)
    {
        $report = DamageReport::findOrFail($id);

        $request->validate([
            'tingkat_kerusakan' => 'required|in:Ringan,Sedang,Berat',
            'status_laporan'    => 'required|in:darurat,menunggu,proses,proses_perbaikan,menunggu_rab,selesai',
            'id_teknisi'        => [
                $request->status_laporan !== 'menunggu' && $request->tingkat_kerusakan !== 'Berat' ? 'required' : 'nullable',
                'exists:technician_vendors,id_teknisi'
            ],
            'foto_after'        => 'nullable|image|max:5120',
        ]);

        // 1. Buat atau perbarui Verification
        $verification = Verification::updateOrCreate(
            ['id_laporan' => $id],
            [
                'tanggal_verifikasi' => now(),
                'kategori_kerusakan' => $report->facility->kategori_area ?? 'Umum',
                'catatan_inspeksi' => 'Inspeksi tingkat kerusakan: ' . $request->tingkat_kerusakan,
            ]
        );

        // 2. Buat atau perbarui Work Order (Hanya jika status proses atau selesai)
        if (in_array($request->status_laporan, ['proses', 'selesai'])) {
            $fotoAfterPath = null;
            if ($request->hasFile('foto_after')) {
                $fotoAfterPath = $request->file('foto_after')->store('bukti-selesai', 'public');
            }

            // Fallback id_teknisi jika belum diisi di form tapi ada di teknisi laporan
            $techId = $request->id_teknisi;
            if (!$techId && $report->technician_id) {
                $tvMatch = TechnicianVendor::where('nama_teknisi', 'like', '%' . explode(' ', $report->technician->nama ?? '')[0] . '%')->first();
                if ($tvMatch) {
                    $techId = $tvMatch->id_teknisi;
                }
            }

            $workOrderData = [
                'id_teknisi' => $techId ?? TechnicianVendor::first()->id_teknisi,
                'prioritas'  => $request->tingkat_kerusakan,
            ];

            if ($fotoAfterPath) {
                $workOrderData['foto_after'] = $fotoAfterPath;
            }

            if ($request->status_laporan === 'selesai') {
                $workOrderData['tanggal_selesai'] = now();
            } else {
                $workOrderData['tanggal_selesai'] = null;
            }

            // Tanggal mulai
            $workOrder = WorkOrder::where('id_verifikasi', $verification->id_verifikasi)->first();
            if (!$workOrder) {
                $workOrderData['tanggal_mulai'] = now();
            }

            WorkOrder::updateOrCreate(
                ['id_verifikasi' => $verification->id_verifikasi],
                $workOrderData
            );
        } else {
            // Jika status dikembalikan ke 'menunggu', hapus WorkOrder (jika ada) agar konsisten
            WorkOrder::where('id_verifikasi', $verification->id_verifikasi)->delete();
        }

        // 3. Perbarui status dan sinkronkan technician_id di DamageReport
        if ($request->filled('id_teknisi')) {
            $selectedTv = TechnicianVendor::find($request->id_teknisi);
            if ($selectedTv) {
                $matchingUser = User::whereIn('status', ['petugas', 'teknisi'])
                    ->where(function($q) use ($selectedTv) {
                        $firstName = explode(' ', trim($selectedTv->nama_teknisi))[0];
                        $q->where('nama', 'like', "%{$firstName}%");
                    })->first();
                if ($matchingUser) {
                    $report->technician_id = $matchingUser->id_user;
                }
            }
        }
        $report->status_laporan = $request->status_laporan;
        $report->save();

        // 4. Sinkronisasi kondisi fasilitas
        if ($report->facility) {
            if ($request->status_laporan === 'selesai') {
                $report->facility->kondisi = 'Baik';
            } elseif ($request->status_laporan === 'proses') {
                $report->facility->kondisi = 'Dalam Perbaikan';
            } else {
                $report->facility->kondisi = 'Rusak';
            }
            $report->facility->save();
        }

        if ($request->tingkat_kerusakan === 'Berat') {
            return redirect()->route('admin.rab.create', $report->id_laporan)
                ->with('info', 'Silakan lengkapi Form Pengajuan RAB untuk kerusakan tingkat Berat.');
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Hasil inspeksi dan tindakan berhasil disimpan!');
    }
    public function inventoryIndex()
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? ''));
        if (!in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }
        
        // Dapatkan data inventaris dari Facility
        $inventory = Facility::with(['category', 'damageReports' => function($query) {
            $query->latest('tanggal_waktu');
        }])->get();

        $categories = Category::orderBy('id')->get();
        $facilityCategories = \App\Models\FacilityCategory::with('category')->orderBy('name')->get();

        // Hitung statistik secara dinamis
        $totalAset = $inventory->count();
        $kondisiBaik = 0;
        $perluPerhatian = 0;

        foreach ($inventory as $item) {
            $latestReport = $item->damageReports->first();
            $hasActiveProblem = $latestReport && in_array($latestReport->status_laporan, ['menunggu', 'darurat', 'proses']);
            
            if (!$hasActiveProblem && in_array(strtolower($item->kondisi), ['baik', 'normal'])) {
                $kondisiBaik++;
            } else {
                $perluPerhatian++;
            }
        }

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        return view('admin.inventory', compact('user', 'inventory', 'totalAset', 'kondisiBaik', 'perluPerhatian', 'hasEmergency', 'categories', 'facilityCategories'));
    }

    public function createRab($id_laporan)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $user = Auth::user();
        $report = DamageReport::with(['facility', 'verification'])->findOrFail($id_laporan);
        
        // Buat verifikasi jika belum ada
        if (!$report->verification) {
            $report->verification = Verification::create([
                'id_laporan' => $report->id_laporan,
                'tanggal_verifikasi' => now(),
                'kategori_kerusakan' => $report->facility->kategori_area ?? 'Umum',
                'catatan_inspeksi' => 'Pengajuan RAB tingkat Berat',
            ]);
        }

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        return view('admin.rab_form', compact('user', 'report', 'hasEmergency'));
    }

    public function storeRab(Request $request, $id_laporan)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $report = DamageReport::with('verification')->findOrFail($id_laporan);
        
        // Buat verifikasi jika belum ada
        $verification = $report->verification;
        if (!$verification) {
            $verification = Verification::create([
                'id_laporan' => $report->id_laporan,
                'tanggal_verifikasi' => now(),
                'kategori_kerusakan' => $report->facility->kategori_area ?? 'Umum',
                'catatan_inspeksi' => 'Pengajuan RAB tingkat Berat',
            ]);
        }

        $request->validate([
            'items'          => 'required|array|min:1|max:5',
            'items.*.nama'   => 'required|string',
            'items.*.qty'    => 'required|integer|min:1',
            'items.*.satuan' => 'required|string',
            'items.*.harga'  => 'required|numeric|min:1',
            'catatan'        => 'nullable|string',
        ], [
            'items.required' => 'Rincian item RAB wajib diisi.',
            'items.max'      => 'Batas maksimal pengajuan material RAB adalah 5 baris.',
            'items.*.harga.min' => 'Harga satuan tidak boleh 0 rupiah! Harap masukkan harga yang valid.',
            'items.*.harga.required' => 'Harga satuan wajib diisi dan tidak boleh 0 rupiah.',
        ]);

        DB::beginTransaction();
        try {
            // Kita butuh anggaran default jika belum ada
            $budget = SchoolBudget::firstOrCreate(
                ['tahun_ajaran' => date('Y') . '/' . (date('Y') + 1)],
                ['total_anggaran' => 100000000, 'sisa_saldo' => 100000000]
            );

            // Hitung total estimasi
            $totalEstimasi = 0;
            foreach ($request->items as $item) {
                $totalEstimasi += ($item['qty'] * $item['harga']);
            }

            // Simpan Proposal
            $proposal = BudgetProposal::updateOrCreate(
                ['id_verifikasi' => $verification->id_verifikasi],
                [
                    'id_anggaran' => $budget->id_anggaran,
                    'estimasi_biaya' => $totalEstimasi,
                    'rincian_kebutuhan' => $request->catatan ?? '-',
                    'status_persetujuan' => 'menunggu_persetujuan',
                ]
            );

            // Hapus item lama jika ada
            RabItem::where('id_rab', $proposal->id_rab)->delete();

            // Simpan item baru
            foreach ($request->items as $item) {
                RabItem::create([
                    'id_rab' => $proposal->id_rab,
                    'nama_sarana_jasa' => $item['nama'],
                    'qty' => $item['qty'],
                    'satuan' => $item['satuan'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['qty'] * $item['harga'],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'Pengajuan RAB berhasil dikirim dan tersimpan di database!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan RAB: ' . $e->getMessage());
        }
    }

    /**
     * Tambah Aset / Fasilitas Baru ke Database.
     */
    public function storeFacility(Request $request)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kategori_area'  => 'required|string|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'kondisi'        => 'required|in:Baik,Rusak,Dalam Perbaikan',
            'lokasi_detail'  => 'required|string|max:255',
        ]);

        $catId = $request->category_id;
        if (!$catId) {
            $fCat = \App\Models\FacilityCategory::where('name', $request->kategori_area)->first();
            $catId = $fCat ? $fCat->category_id : $this->determineCategoryId($request->nama_fasilitas, $request->kategori_area, $request->lokasi_detail);
        }

        // Pastikan kategori fasilitas ini otomatis terdaftar di facility_categories agar langsung muncul di dropdown filter & formulir
        if ($request->filled('kategori_area')) {
            \App\Models\FacilityCategory::firstOrCreate(
                ['name' => trim($request->kategori_area)],
                ['category_id' => $catId ?: 1]
            );
        }

        Facility::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'kategori_area'  => $request->kategori_area,
            'category_id'    => $catId,
            'kondisi'        => $request->kondisi,
            'lokasi_detail'  => $request->lokasi_detail,
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Aset baru berhasil ditambahkan ke database!');
    }

    /**
     * Tambah Kategori Fasilitas Baru Secara Dinamis.
     */
    public function storeFacilityCategory(Request $request)
    {
        if (!$this->checkAdminAccess()) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki hak akses ke halaman Admin.'], 403);
        }

        $request->validate([
            'name'        => 'required|string|max:100|unique:facility_categories,name',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required'        => 'Nama kategori fasilitas wajib diisi.',
            'name.unique'          => 'Kategori fasilitas ini sudah terdaftar.',
            'category_id.required' => 'Bidang teknisi wajib dipilih.',
        ]);

        $cat = \App\Models\FacilityCategory::create([
            'name'        => trim($request->name),
            'category_id' => $request->category_id,
        ]);

        $cat->load('category');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori fasilitas "' . $cat->name . '" berhasil ditambahkan!',
                'data' => [
                    'id'            => $cat->id,
                    'name'          => $cat->name,
                    'category_id'   => $cat->category_id,
                    'category_name' => $cat->category->name ?? 'Umum',
                ]
            ]);
        }

        return redirect()->route('admin.inventory.index')->with('success', 'Kategori fasilitas baru berhasil ditambahkan!');
    }

    /**
     * Perbarui Data Aset / Fasilitas di Database.
     */
    public function updateFacility(Request $request, $id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kategori_area'  => 'required|string|max:255',
            'category_id'    => 'nullable|exists:categories,id',
            'kondisi'        => 'required|in:Baik,Rusak,Dalam Perbaikan',
            'lokasi_detail'  => 'required|string|max:255',
        ]);

        $catId = $request->category_id;
        if (!$catId) {
            $fCat = \App\Models\FacilityCategory::where('name', $request->kategori_area)->first();
            $catId = $fCat ? $fCat->category_id : $this->determineCategoryId($request->nama_fasilitas, $request->kategori_area, $request->lokasi_detail);
        }

        // Pastikan kategori fasilitas ini otomatis terdaftar di facility_categories agar langsung muncul di dropdown filter & formulir
        if ($request->filled('kategori_area')) {
            \App\Models\FacilityCategory::firstOrCreate(
                ['name' => trim($request->kategori_area)],
                ['category_id' => $catId ?: 1]
            );
        }

        $facility = Facility::findOrFail($id);
        $facility->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'kategori_area'  => $request->kategori_area,
            'category_id'    => $catId,
            'kondisi'        => $request->kondisi,
            'lokasi_detail'  => $request->lokasi_detail,
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Data aset berhasil diperbarui di database!');
    }

    /**
     * Tentukan category_id otomatis berdasarkan nama fasilitas dan kategori area.
     */
    private function determineCategoryId($nama, $area, $lokasi)
    {
        $text = strtolower($nama . ' ' . $area . ' ' . $lokasi);

        if (preg_match('/(listrik|lampu|stop\s*kontak|saklar|ac|kabel|panel|sound|elektronik)/i', $text)) {
            return 1; // Listrik
        }
        if (preg_match('/(air|wastafel|pipa|sanitasi|toilet|keran|kran|wc|tandon)/i', $text)) {
            return 2; // Air
        }
        if (preg_match('/(bangunan|struktur|furnitur|pintu|meja|kursi|plafon|atap|lantai|dinding|kaca)/i', $text)) {
            return 3; // Bangunan
        }
        if (preg_match('/(komputer|pc|proyektor|laptop|server|layar|infocus|laboratorium|printer)/i', $text)) {
            return 4; // IT
        }
        if (preg_match('/(jaringan|wifi|internet|router|switch)/i', $text)) {
            return 6; // Jaringan
        }
        if (preg_match('/(kendaraan|motor|mobil|bus|sepeda|parkir)/i', $text)) {
            return 7; // Kendaraan
        }
        return 1; // Default to Listrik
    }

    /**
     * Hapus Aset / Fasilitas dari Database.
     */
    public function destroyFacility($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $facility = Facility::findOrFail($id);

        if ($facility->damageReports()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus aset ini karena memiliki riwayat laporan kerusakan terkait di database.');
        }

        $facility->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Aset berhasil dihapus dari database!');
    }

    /**
     * Tampilkan Halaman Data Petugas / Teknisi.
     */
    public function techniciansIndex(Request $request)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $user = Auth::user();
        $categories = Category::all();

        // Pastikan sinkronisasi 1-ke-1 antara technician_vendors dan users petugas
        $allTv = TechnicianVendor::all();
        foreach ($allTv as $tv) {
            $existingUser = User::where('nama', $tv->nama_teknisi)->first();
            if (!$existingUser) {
                // Tentukan kategori dari jenis_teknisi
                $catId = 1;
                $jLower = strtolower($tv->jenis_teknisi);
                if (str_contains($jLower, 'air') || str_contains($jLower, 'pipa') || str_contains($jLower, 'sanitasi')) $catId = 2;
                elseif (str_contains($jLower, 'bangunan') || str_contains($jLower, 'mebel') || str_contains($jLower, 'kayu')) $catId = 3;
                elseif (str_contains($jLower, 'it') || str_contains($jLower, 'komputer')) $catId = 4;
                elseif (str_contains($jLower, 'jaringan') || str_contains($jLower, 'wifi')) $catId = 6;
                elseif (str_contains($jLower, 'kendaraan') || str_contains($jLower, 'motor') || str_contains($jLower, 'mobil')) $catId = 7;

                $slugName = strtolower(preg_replace('/[^a-z0-9]/i', '', explode(' ', $tv->nama_teknisi)[0]));
                if (empty($slugName)) $slugName = 'teknisi' . $tv->id_teknisi;
                $email = $slugName . '.petugas@sekolah.com';
                $counter = 1;
                while (User::where('email', $email)->exists()) {
                    $email = $slugName . $counter . '.petugas@sekolah.com';
                    $counter++;
                }

                User::create([
                    'nama'        => $tv->nama_teknisi,
                    'email'       => $email,
                    'password'    => Hash::make('password123'),
                    'status'      => 'petugas',
                    'role'        => 'petugas',
                    'category_id' => $catId,
                ]);
            }
        }

        // Query teknisi
        $query = User::with(['category', 'assignedReports'])
            ->where(function($q) {
                $q->whereIn('status', ['petugas', 'teknisi'])
                  ->orWhere('role', 'petugas');
            });

        // Filter kategori jika ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter search jika ada
        if ($request->filled('search')) {
            $s = strtolower($request->search);
            $query->where(function($q) use ($s) {
                $q->where('nama', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $technicians = $query->latest('id_user')->get();

        // Statistik
        $totalTechnicians = $technicians->count();
        $activeTasksTotal = DamageReport::whereIn('status_laporan', ['proses', 'proses_perbaikan', 'menunggu', 'menunggu_rab', 'darurat'])->count();
        $completedTasksTotal = DamageReport::where('status_laporan', 'selesai')->count();

        // Hitung tugas per teknisi
        foreach ($technicians as $tech) {
            $tech->active_tasks_count = DamageReport::where('technician_id', $tech->id_user)
                ->whereIn('status_laporan', ['proses', 'proses_perbaikan', 'menunggu', 'menunggu_rab', 'darurat'])
                ->count();
            $tech->completed_tasks_count = DamageReport::where('technician_id', $tech->id_user)
                ->where('status_laporan', 'selesai')
                ->count();
        }

        // Sinyal darurat tidak dikirim ke admin, hanya ke petugas tertentu
        $hasEmergency = false;

        return view('admin.technicians', compact(
            'user',
            'technicians',
            'categories',
            'totalTechnicians',
            'activeTasksTotal',
            'completedTasksTotal',
            'hasEmergency'
        ));
    }

    /**
     * Simpan Data Teknisi Baru ke Database.
     */
    public function storeTechnician(Request $request)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'kategori'    => 'required|string|max:100',
        ], [
            'nama.required'     => 'Nama teknisi wajib diisi.',
            'email.required'    => 'Email login wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar untuk pengguna lain.',
            'password.required' => 'Password awal wajib diisi (minimal 6 karakter).',
            'password.min'      => 'Password minimal 6 karakter.',
            'kategori.required' => 'Kategori spesialisasi wajib diisi.',
        ]);

        $categoryName = trim($request->kategori);
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();
        if (!$category) {
            $category = Category::create([
                'name' => ucwords(strtolower($categoryName)),
            ]);
        }

        User::create([
            'nama'        => $request->nama,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'status'      => 'petugas',
            'role'        => 'petugas',
            'category_id' => $category->id,
        ]);

        $prefix = (stripos($category->name, 'teknisi') === 0) ? '' : 'Teknisi ';
        TechnicianVendor::updateOrCreate([
            'nama_teknisi' => $request->nama,
        ], [
            'jenis_teknisi' => $prefix . $category->name,
            'kontak' => '08' . rand(1000000000, 9999999999),
        ]);

        return redirect()->route('admin.technicians.index')->with('success', 'Petugas teknisi baru berhasil ditambahkan dengan spesialisasi ' . $category->name . '!');
    }

    /**
     * Perbarui Data Teknisi.
     */
    public function updateTechnician(Request $request, $id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $tech = User::findOrFail($id);
        $oldName = $tech->nama;

        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id . ',id_user',
            'kategori' => 'required|string|max:100',
            'password' => 'nullable|min:6',
        ], [
            'nama.required'     => 'Nama teknisi wajib diisi.',
            'email.required'    => 'Email login wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar untuk pengguna lain.',
            'kategori.required' => 'Kategori spesialisasi wajib diisi.',
            'password.min'      => 'Password baru minimal 6 karakter jika ingin diganti.',
        ]);

        $categoryName = trim($request->kategori);
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])->first();
        if (!$category) {
            $category = Category::create([
                'name' => ucwords(strtolower($categoryName)),
            ]);
        }

        $data = [
            'nama'        => $request->nama,
            'email'       => $request->email,
            'category_id' => $category->id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $tech->update($data);

        $prefix = (stripos($category->name, 'teknisi') === 0) ? '' : 'Teknisi ';
        $tv = TechnicianVendor::where('nama_teknisi', $oldName)->first();
        if ($tv) {
            $tv->update([
                'nama_teknisi'  => $request->nama,
                'jenis_teknisi' => $prefix . $category->name,
            ]);
        } else {
            TechnicianVendor::updateOrCreate(
                ['nama_teknisi' => $request->nama],
                ['jenis_teknisi' => $prefix . $category->name, 'kontak' => '08' . rand(1000000000, 9999999999)]
            );
        }

        return redirect()->route('admin.technicians.index')->with('success', 'Data teknisi berhasil diperbarui!');
    }

    /**
     * Hapus Data Teknisi.
     */
    public function destroyTechnician($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->route('pelapor.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }

        $tech = User::findOrFail($id);

        if (strtolower($tech->status) === 'admin' || strtolower($tech->role) === 'admin') {
            return back()->with('error', 'Akun Administrator tidak dapat dihapus melalui menu ini.');
        }

        // Cek jika ada tugas aktif yang sedang dikerjakan teknisi
        $activeReportsCount = DamageReport::where('technician_id', $id)
            ->whereIn('status_laporan', ['proses', 'proses_perbaikan', 'menunggu', 'menunggu_rab', 'darurat'])
            ->count();

        if ($activeReportsCount > 0) {
            return back()->with('error', "Tidak dapat menghapus teknisi ini karena sedang menangani {$activeReportsCount} tugas aktif. Selesaikan atau alihkan tugas terlebih dahulu.");
        }

        TechnicianVendor::where('nama_teknisi', $tech->nama)->delete();
        $tech->delete();

        return redirect()->route('admin.technicians.index')->with('success', 'Petugas teknisi berhasil dihapus dari sistem.');
    }
}
