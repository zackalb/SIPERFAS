<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DamageReport;
use App\Models\Facility;
use App\Models\Category;
use App\Models\User;

class PelaporController extends Controller
{
    /**
     * Tampilkan dashboard pelapor beserta form laporan & riwayat tiket.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? 'pelapor'));

        if (in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('admin.dashboard');
        } elseif (in_array($status, ['petugas', 'teknisi', 'staf'])) {
            return redirect()->route('petugas.dashboard');
        }

        // Hanya tampilkan fasilitas yang saat ini TIDAK memiliki laporan aktif (status_laporan != 'selesai')
        $facilities = Facility::whereDoesntHave('damageReports', function ($query) {
                $query->where('status_laporan', '!=', 'selesai');
            })
            ->orderBy('nama_fasilitas')
            ->get();

        $categories = Category::orderBy('name')->get();

        // Ambil daftar petugas teknisi untuk dropdown insiden darurat
        $emergencyTechnicians = User::where(function ($q) {
                $q->where('role', 'petugas')->orWhere('status', 'petugas');
            })
            ->with('category')
            ->orderBy('nama')
            ->get();

        $myReports = DamageReport::where(function ($q) use ($user) {
                $q->where('id_user', $user->id_user);
                if (in_array($user->email, ['siswa@sekolah.com', 'pelapor@sekolah.com'])) {
                    $q->orWhereIn('id_user', [1, 4]);
                }
            })
            ->with(['facility', 'category', 'technician', 'verification.workOrder', 'verification.budgetProposal.items'])
            ->latest()
            ->take(5)
            ->get();

        $ongoingCount = DamageReport::where(function ($q) use ($user) {
                $q->where('id_user', $user->id_user);
                if (in_array($user->email, ['siswa@sekolah.com', 'pelapor@sekolah.com'])) {
                    $q->orWhereIn('id_user', [1, 4]);
                }
            })
            ->whereIn('status_laporan', ['menunggu', 'menunggu_rab', 'proses', 'proses_perbaikan', 'darurat'])
            ->count();

        return view('pelapor.dashboard', compact('user', 'facilities', 'categories', 'myReports', 'emergencyTechnicians', 'ongoingCount'));
    }

    /**
     * Simpan laporan kerusakan baru ke database dengan auto-assign teknisi berdasarkan kategori.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_fasilitas'        => 'required|exists:facilities,id_fasilitas',
            'technician_id'       => 'nullable|exists:users,id_user',
            'category_id'         => 'nullable|exists:categories,id',
            'tingkat_urgensi'     => 'required|string|in:rendah,sedang,tinggi,darurat,Rendah,Sedang,Tinggi,Darurat',
            'deskripsi_kerusakan' => 'required|string|min:10',
            'catatan_tambahan'    => 'nullable|string|max:1000',
            'foto_bukti'          => 'required_without:foto_kamera_base64|file|mimes:jpg,jpeg,png|max:5120',
            'foto_kamera_base64'  => 'required_without:foto_bukti|nullable|string',
        ], [
            'id_fasilitas.required'               => 'Lokasi fasilitas harus dipilih.',
            'tingkat_urgensi.required'            => 'Tingkat urgensi harus dipilih.',
            'deskripsi_kerusakan.required'        => 'Deskripsi masalah wajib diisi.',
            'deskripsi_kerusakan.min'             => 'Deskripsi minimal 10 karakter.',
            'foto_bukti.required_without'         => 'Foto bukti kerusakan wajib dilampirkan (unggah foto atau ambil melalui kamera).',
            'foto_kamera_base64.required_without' => 'Foto bukti kerusakan wajib dilampirkan (unggah foto atau ambil melalui kamera).',
            'foto_bukti.mimes'                    => 'Format file tidak sesuai! Lampiran bukti harus berformat JPG atau PNG.',
            'foto_bukti.max'                      => 'Ukuran file lampiran maksimal 5MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')->store('bukti-laporan', 'public');
        } elseif ($request->filled('foto_kamera_base64')) {
            $base64 = $request->input('foto_kamera_base64');
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $data = substr($base64, strpos($base64, ',') + 1);
                $data = base64_decode($data);
                if ($data !== false) {
                    $ext = strtolower($type[1]);
                    $ext = ($ext === 'jpeg') ? 'jpg' : $ext;
                    if (in_array($ext, ['jpg', 'png'])) {
                        $filename = 'bukti-laporan/' . uniqid('cam_') . '.' . $ext;
                        Storage::disk('public')->put($filename, $data);
                        $fotoPath = $filename;
                    }
                }
            }
        }

        if (!$fotoPath) {
            return back()->withInput()->withErrors([
                'foto_bukti' => 'Foto bukti kerusakan wajib dilampirkan (unggah foto atau ambil melalui kamera).'
            ]);
        }

        // Validasi: Fasilitas tidak boleh dilaporkan jika sedang dalam penanganan aktif
        $activeReport = DamageReport::where('id_fasilitas', $request->id_fasilitas)
            ->where('status_laporan', '!=', 'selesai')
            ->first();

        if ($activeReport) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fasilitas atau ruangan ini sedang dalam penanganan perbaikan dan belum dapat dilaporkan kembali.');
        }

        $urgensi = strtolower(trim($request->tingkat_urgensi));

        // 1. Tentukan teknisi dan kategori
        $technician = null;
        $categoryId = $request->category_id;

        if ($request->filled('technician_id')) {
            $technician = User::find($request->technician_id);
            if ($technician && $technician->category_id) {
                $categoryId = $technician->category_id;
            }
        } elseif ($categoryId) {
            $technician = User::where(function ($q) {
                    $q->where('role', 'petugas')->orWhere('status', 'petugas');
                })
                ->where('category_id', $categoryId)
                ->first();
        } else {
            // Coba ambil dari kategori fasilitas
            $facility = Facility::find($request->id_fasilitas);
            if ($facility && $facility->category_id) {
                $categoryId = $facility->category_id;
                $technician = User::where(function ($q) {
                        $q->where('role', 'petugas')->orWhere('status', 'petugas');
                    })
                    ->where('category_id', $categoryId)
                    ->first();
            }
        }

        // 2. Tentukan status laporan:
        // - Jika Darurat -> status 'darurat' (Fast-Track: langsung eksekusi perbaikan tanpa RAB)
        // - Jika urgensi Tinggi -> status 'menunggu_rab' (KHUSUS Tinggi yang butuh pengajuan RAB ke Admin Sarpras)
        // - Jika urgensi Rendah / Sedang -> status 'menunggu' (menunggu konfirmasi petugas menekan sedang dikerjakan)
        if ($urgensi === 'darurat') {
            $statusLaporan = 'darurat';
        } elseif ($urgensi === 'tinggi') {
            $statusLaporan = 'menunggu_rab';
        } else {
            $statusLaporan = 'menunggu';
        }

        $deskripsi = $request->deskripsi_kerusakan;
        if ($request->filled('catatan_tambahan')) {
            $deskripsi .= "\n\n[Catatan Tambahan]: " . trim($request->catatan_tambahan);
        }

        DamageReport::create([
            'id_user'             => Auth::id() ?: Auth::user()->id_user,
            'technician_id'       => $technician ? $technician->id_user : null,
            'id_fasilitas'        => $request->id_fasilitas,
            'category_id'         => $categoryId,
            'tanggal_waktu'       => now(),
            'deskripsi_kerusakan' => $deskripsi,
            'foto_bukti'          => $fotoPath,
            'is_emergency'        => $urgensi === 'darurat',
            'tingkat_urgensi'     => $urgensi,
            'status_laporan'      => $statusLaporan,
        ]);

        // Perbarui kondisi fasilitas menjadi Rusak
        $facility = Facility::find($request->id_fasilitas);
        if ($facility) {
            $facility->kondisi = 'Rusak';
            $facility->save();
        }

        $techName = $technician ? $technician->nama : 'Petugas Sarpras';
        if ($statusLaporan === 'darurat') {
            $statusMsg = 'Laporan Darurat: Langsung eksekusi perbaikan di lapangan tanpa syarat RAB.';
        } elseif ($statusLaporan === 'menunggu_rab') {
            $statusMsg = 'Laporan Urgensi Tinggi: Menunggu teknisi mengajukan form RAB ke Admin Sarpras.';
        } else {
            $statusMsg = 'Laporan berhasil dibuat. Menunggu konfirmasi petugas teknisi untuk memulai pengerjaan.';
        }

        return redirect()->route('pelapor.dashboard')
                         ->with('success', "Laporan berhasil dikirim dan otomatis ditugaskan ke {$techName}! {$statusMsg}");
    }

    /**
     * Simpan laporan darurat (Emergency).
     */
    public function storeEmergency(Request $request)
    {
        $request->validate([
            'id_fasilitas'        => 'required|exists:facilities,id_fasilitas',
            'technician_id'       => 'nullable|exists:users,id_user',
            'category_id'         => 'nullable|exists:categories,id',
            'deskripsi_kerusakan' => 'required|string|min:3',
        ]);

        // Validasi: Fasilitas tidak boleh dilaporkan jika sedang dalam penanganan aktif
        $activeReport = DamageReport::where('id_fasilitas', $request->id_fasilitas)
            ->where('status_laporan', '!=', 'selesai')
            ->first();

        if ($activeReport) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fasilitas atau ruangan ini sedang dalam penanganan perbaikan dan belum dapat dilaporkan kembali.');
        }

        $technician = null;
        $categoryId = $request->category_id;

        if ($request->filled('technician_id')) {
            $technician = User::find($request->technician_id);
            if ($technician && $technician->category_id) {
                $categoryId = $technician->category_id;
            }
        } elseif ($categoryId) {
            $technician = User::where(function ($q) {
                    $q->where('role', 'petugas')->orWhere('status', 'petugas');
                })
                ->where('category_id', $categoryId)
                ->first();
        } else {
            $technician = User::where(function ($q) {
                $q->where('role', 'petugas')->orWhere('status', 'petugas');
            })->first();
            if ($technician) {
                $categoryId = $technician->category_id;
            }
        }

        DamageReport::create([
            'id_user'             => Auth::user()->id_user,
            'technician_id'       => $technician ? $technician->id_user : null,
            'id_fasilitas'        => $request->id_fasilitas,
            'category_id'         => $categoryId,
            'tanggal_waktu'       => now(),
            'deskripsi_kerusakan' => '[DARURAT] ' . $request->deskripsi_kerusakan,
            'foto_bukti'          => null,
            'is_emergency'        => true,
            'tingkat_urgensi'     => 'darurat',
            'status_laporan'      => 'darurat',
        ]);

        // Perbarui kondisi fasilitas menjadi Rusak
        $facility = Facility::find($request->id_fasilitas);
        if ($facility) {
            $facility->kondisi = 'Rusak';
            $facility->save();
        }

        $techName = $technician ? $technician->nama : 'Petugas';
        return redirect()->route('pelapor.dashboard')
                         ->with('success', "Panggilan Darurat berhasil dikirim langsung ke {$techName}! Petugas sedang disiagakan.");
    }

    /**
     * Cari tiket berdasarkan ID (format TKT 0600 / TKT-XXXX / CTH: TKT 0600).
     */
    public function trackTicket(Request $request)
    {
        $request->validate(['ticket_id' => 'required|string']);

        $rawId = trim($request->ticket_id);
        $clean = preg_replace('/[^0-9]/', '', $rawId);
        $id = intval($clean);

        $report = null;
        if ($id > 0) {
            $user = Auth::user();
            $report = DamageReport::where('id_laporan', $id)
                        ->where(function ($q) use ($user) {
                            $q->where('id_user', $user->id_user);
                            if (in_array($user->email, ['siswa@sekolah.com', 'pelapor@sekolah.com'])) {
                                $q->orWhereIn('id_user', [1, 4]);
                            }
                        })
                        ->with(['facility', 'category', 'technician', 'verification.workOrder', 'verification.budgetProposal'])
                        ->first();
        }

        if (!$report) {
            return back()->with('track_error', "Tiket '" . htmlspecialchars($rawId) . "' tidak ditemukan dalam riwayat akun Anda.");
        }

        return back()->with('tracked_ticket', $report);
    }

    /**
     * Tampilkan halaman daftar tiket pelapor.
     */
    public function tickets()
    {
        $user = Auth::user();
        $status = strtolower(trim($user->status ?? 'pelapor'));

        if (in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('admin.work-orders.index');
        } elseif (in_array($status, ['petugas', 'teknisi', 'staf'])) {
            return redirect()->route('petugas.dashboard');
        }

        $tickets = DamageReport::where(function ($q) use ($user) {
                            $q->where('id_user', $user->id_user);
                            if (in_array($user->email, ['siswa@sekolah.com', 'pelapor@sekolah.com'])) {
                                $q->orWhereIn('id_user', [1, 4]);
                            }
                        })
                        ->with(['facility', 'user', 'category', 'technician', 'verification.workOrder', 'verification.budgetProposal.items'])
                        ->latest()
                        ->get();

        $ongoingCount = DamageReport::where(function ($q) use ($user) {
                            $q->where('id_user', $user->id_user);
                            if (in_array($user->email, ['siswa@sekolah.com', 'pelapor@sekolah.com'])) {
                                $q->orWhereIn('id_user', [1, 4]);
                            }
                        })
                        ->whereIn('status_laporan', ['menunggu', 'menunggu_rab', 'proses', 'proses_perbaikan', 'darurat'])
                        ->count();

        return view('pelapor.tickets', compact('user', 'tickets', 'ongoingCount'));
    }
}
