<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Analitik - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes drawPath {
            0% {
                stroke-dashoffset: 1500;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        .animate-chart-line {
            stroke-dasharray: 1500;
            stroke-dashoffset: 1500;
            animation: drawPath 1.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        .animate-chart-area {
            animation: chartFadeIn 1.5s ease-out 0.6s forwards;
            opacity: 0;
        }

        @keyframes chartFadeIn {
            to { opacity: 1; }
        }

        .progress-bar-animated {
            transition: width 1.5s cubic-bezier(0.25, 1, 0.5, 1);
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm 12mm 15mm 12mm;
            }
            html, body {
                height: auto !important;
                overflow: visible !important;
                background-color: #ffffff !important;
                color: #0f172a !important;
                font-size: 10pt !important;
            }
            aside, header, .no-print, #budgetModal, #customDateModal {
                display: none !important;
            }
            .flex-1.overflow-auto {
                overflow: visible !important;
                height: auto !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .trx-row {
                display: table-row !important;
            }
            .no-print-pagination {
                display: none !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                page-break-inside: auto !important;
            }
            tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }
            thead {
                display: table-header-group !important;
            }
            tfoot {
                display: table-footer-group !important;
            }
            .bg-white, .bg-slate-50 {
                box-shadow: none !important;
            }
            .progress-bar-animated {
                transition: none !important;
            }
        }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex h-screen overflow-hidden">

    <!-- Unified Admin Sidebar -->
    @include('partials.admin-sidebar')

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Topbar: Konsisten Admin SarPras -->
        <header class="bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-8 py-3.5 sm:py-4 z-10 shrink-0">
            <div class="flex items-center space-x-3">
                <button type="button" onclick="toggleAdminSidebar()" class="md:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer" aria-label="Buka Menu Sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h2 class="text-xl font-extrabold text-blue-950 tracking-tight">Admin SarPras</h2>
            </div>

            <!-- Notifications & Profile -->
            <div class="flex items-center space-x-5">
                <button class="text-slate-500 hover:text-blue-600 transition-all relative">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </button>
                <button class="text-slate-500 hover:text-blue-600 transition-all">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Avatar Profile Info (Siluet Biru Khusus Admin) -->
                <div class="flex items-center space-x-3 border-l border-slate-200 pl-5">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-900 leading-tight">{{ $user->nama ?? 'Admin Sarpras' }}</p>
                        <p class="text-[11px] text-slate-500 font-semibold">Sarana & Prasarana</p>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-blue-200 shadow-xs flex items-center justify-center shrink-0">
                        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#2563eb"/>
                            <circle cx="50" cy="38" r="16" fill="#bfdbfe"/>
                            <ellipse cx="50" cy="85" rx="33" ry="25" fill="#bfdbfe"/>
                        </svg>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Page Content -->
        <div class="flex-1 overflow-auto p-8 space-y-6">

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-sm font-bold flex items-center gap-2 shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-bold flex items-center gap-2 shadow-xs">
                    <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-bold space-y-1 shadow-xs">
                    @foreach($errors->all() as $err)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $err }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- 1. Page Header & Export Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 no-print">
                <div>
                    <h3 class="text-2xl font-black text-blue-950 tracking-tight">Laporan & Analitik Strategis</h3>
                    <p class="text-xs text-slate-500 font-medium mt-1">Tinjauan komprehensif alokasi dan realisasi pengeluaran anggaran fasilitas sekolah secara waktu nyata.</p>
                </div>
                <div class="flex items-center gap-2.5">
                    <!-- Tombol Ekspor PDF (Dokumen PDF Asli / Unduh Berkas PDF) -->
                    <a href="{{ route('admin.analytics.exportPdf', ['period' => request('period', 'tahun'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs flex items-center gap-2 transition-all shadow-xs cursor-pointer active:scale-95" title="Unduh Berkas Resmi PDF">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h1m-1 4h6m-6 4h6"/>
                        </svg>
                        <span>Ekspor PDF</span>
                    </a>

                    <!-- Tombol Ekspor Excel -->
                    <a href="{{ route('admin.analytics.exportExcel', ['period' => request('period', 'tahun'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs flex items-center gap-2 transition-all shadow-xs cursor-pointer active:scale-95" title="Unduh Lembar Kerja Excel (.xls) Rapi & Terstruktur">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Ekspor Excel</span>
                    </a>
                </div>
            </div>

            <!-- Print Header Dokumen Resmi (Hanya Muncul Saat Ekspor PDF / Cetak) -->
            <div class="hidden print:block mb-6 border-b-2 border-slate-900 pb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-12 h-12 object-contain">
                        <div>
                            <h1 class="text-lg font-black text-slate-900 uppercase tracking-wide">SIPERFAS - LAPORAN KEUANGAN & REALISASI ANGGARAN SARPRAS</h1>
                            <p class="text-xs text-slate-600 font-bold mt-0.5">Badan Pengelola Sarana, Prasarana & Manajemen Aset Sekolah</p>
                            <p class="text-[11px] text-slate-500 font-medium">Periode: <strong class="text-slate-800">{{ $periodLabel ?? 'Tahun Berjalan' }}</strong></p>
                        </div>
                    </div>
                    <div class="text-right text-[11px] text-slate-600 font-medium space-y-0.5">
                        <p>Tahun Ajaran: <strong class="text-slate-900">{{ $tahunAjaran }}</strong></p>
                        <p>Tanggal Cetak: <strong class="text-slate-900">{{ now()->format('d F Y, H:i') }} WIB</strong></p>
                        <p>Koordinator: <strong class="text-slate-900">{{ $user->nama ?? 'Admin Sarpras' }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- 2. Period Filter Tabs (Fungsional: Tahun Berjalan, Triwulan, Semester, Tanggal Kustom) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white border border-slate-100 p-2 rounded-2xl shadow-xs">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <!-- Tahun Berjalan -->
                    <a href="{{ route('admin.analytics.index', ['period' => 'tahun']) }}" 
                       class="px-4 py-2 {{ ($period ?? 'tahun') === 'tahun' ? 'bg-[#0f172a] text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-semibold' }} rounded-xl text-xs transition-all flex items-center gap-1.5">
                        <span>Tahun Berjalan</span>
                    </a>

                    <!-- Triwulan -->
                    <a href="{{ route('admin.analytics.index', ['period' => 'triwulan']) }}" 
                       class="px-4 py-2 {{ ($period ?? '') === 'triwulan' ? 'bg-[#0f172a] text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-semibold' }} rounded-xl text-xs transition-all flex items-center gap-1.5">
                        <span>Triwulan</span>
                    </a>

                    <!-- Semester -->
                    <a href="{{ route('admin.analytics.index', ['period' => 'semester']) }}" 
                       class="px-4 py-2 {{ ($period ?? '') === 'semester' ? 'bg-[#0f172a] text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-semibold' }} rounded-xl text-xs transition-all flex items-center gap-1.5">
                        <span>Semester</span>
                    </a>

                    <!-- Tanggal Kustom -->
                    <button type="button" onclick="openCustomDateModal()" 
                            class="px-4 py-2 {{ ($period ?? '') === 'custom' ? 'bg-[#0f172a] text-white font-bold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-semibold' }} rounded-xl text-xs transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5 {{ ($period ?? '') === 'custom' ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>
                            @if(($period ?? '') === 'custom' && !empty($startDate) && !empty($endDate))
                                {{ \Carbon\Carbon::parse($startDate)->format('d M') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                            @else
                                Tanggal Kustom
                            @endif
                        </span>
                    </button>
                </div>

                <!-- Info Label Rentang Aktif & Tombol Reset -->
                <div class="flex items-center gap-2 px-2 text-xs flex-wrap">
                    <span class="text-slate-400 font-medium">Rentang Aktif:</span>
                    <span class="font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100 flex items-center gap-1.5 shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                        {{ $periodLabel ?? 'Tahun Berjalan' }}
                    </span>
                    @if(($period ?? 'tahun') !== 'tahun')
                        <a href="{{ route('admin.analytics.index', ['period' => 'tahun']) }}" class="text-[11px] font-bold text-slate-400 hover:text-red-600 transition-colors ml-1 px-1.5 py-0.5 rounded hover:bg-red-50 inline-flex items-center gap-1" title="Reset ke filter awal Tahun Berjalan">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- 3. 3 Financial KPI Cards (Hanya SATU Tombol: "Atur Anggaran") -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Total Anggaran Card (HANYA SATU TOMBOL "Atur Anggaran") -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:shadow-md transition-all">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">TOTAL ANGGARAN (DIALOKASIKAN)</p>
                            <h3 class="text-2xl font-black text-slate-900 mt-2 tracking-tight flex items-baseline gap-1">
                                <span>Rp</span>
                                <span id="num_total_anggaran" data-target="{{ $totalAnggaran }}">{{ number_format($totalAnggaran, 0, ',', '.') }}</span>
                            </h3>
                        </div>
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <!-- SATU-SATUNYA TOMBOL PENGATURAN ANGGARAN -->
                            <button type="button" onclick="openBudgetModal()" class="no-print px-3 py-1.5 bg-blue-50 hover:bg-blue-600 hover:text-white text-blue-700 font-bold text-xs rounded-xl transition-all flex items-center gap-1.5 border border-blue-200 shadow-2xs cursor-pointer group/btn" title="Klik untuk mengatur atau mengubah pagu anggaran">
                                <svg class="w-3.5 h-3.5 text-blue-600 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                <span>Atur Anggaran</span>
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-50">
                        <p class="text-[11px] text-slate-400 font-semibold">Tahun Ajaran <span class="text-slate-700 font-bold">{{ $tahunAjaran }}</span></p>
                    </div>
                </div>

                <!-- Pengeluaran Terealisasi Card -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] flex flex-col justify-between hover:shadow-md transition-all">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">PENGELUARAN TEREALISASI</p>
                            <h3 class="text-2xl font-black text-slate-900 mt-2 tracking-tight flex items-baseline gap-1">
                                <span>Rp</span>
                                <span id="num_pengeluaran" data-target="{{ $pengeluaranTerealisasi }}">{{ number_format($pengeluaranTerealisasi, 0, ',', '.') }}</span>
                            </h3>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-[11px] font-bold text-blue-700 mt-3 mb-1.5">
                            <span><span id="num_persen">{{ $persenTerpakai }}</span>% Terpakai</span>
                            <span class="text-slate-400 font-medium text-[10px]">Real Database RAB</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div id="progress_terpakai" class="bg-[#1d4ed8] h-1.5 rounded-full progress-bar-animated" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Sisa Saldo (Solid Blue Card) -->
                <div class="bg-gradient-to-br from-[#1d4ed8] to-[#1e40af] text-white p-6 rounded-2xl shadow-lg shadow-blue-900/10 flex flex-col justify-between hover:shadow-xl transition-all">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-extrabold text-blue-200 uppercase tracking-wider">SISA SALDO ANGGARAN</p>
                            <h3 class="text-2xl font-black text-white mt-2 tracking-tight flex items-baseline gap-1">
                                <span>Rp</span>
                                <span id="num_sisa" data-target="{{ $sisaSaldo }}">{{ number_format($sisaSaldo, 0, ',', '.') }}</span>
                            </h3>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-white/10 text-white flex items-center justify-center shrink-0 backdrop-blur-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-between">
                        <p class="text-[11px] text-blue-100 font-medium">Sisa saldo aman untuk operasional</p>
                        <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-bold">100% Real-Time</span>
                    </div>
                </div>
            </div>

            <!-- 4. 2-Column Analytics Charts (Garis Kurva Dinamis Bounded + Animasi Halus Tanpa Loncat) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                <!-- Left: Tren Biaya Pemeliharaan (7 of 12) -->
                <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6 overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-slate-900">Tren Realisasi Biaya Pemeliharaan — {{ $periodLabel ?? '6 Bulan Terakhir' }}</h3>
                            <p class="text-[11px] text-slate-400 font-medium mt-0.5">Berdasarkan tanggal persetujuan proposal RAB fasilitas sekolah.</p>
                        </div>
                        <span class="text-[10px] font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                            Grafik Riil Dinamis
                        </span>
                    </div>

                    @php
                        // Koordinat x bounded dengan jarak aman dari tepi (35 .. 435 pada lebar viewBox 500)
                        $xStep = [35, 115, 195, 275, 355, 435];
                        $scaleMax = max(5000000, $maxTrenValue);
                        $chartPoints = [];
                        foreach ($trenBiaya as $idx => $t) {
                            $x = $xStep[$idx];
                            $ratio = $scaleMax > 0 ? min(1, $t['nominal'] / $scaleMax) : 0;
                            // y dari 160 (dasar grafik) ke 35 (puncak grafik)
                            $y = 160 - round($ratio * 125);
                            $chartPoints[] = [
                                'x' => $x,
                                'y' => $y,
                                'nominal' => $t['nominal'],
                                'bulan' => $t['bulan'],
                                'label' => $t['label'],
                            ];
                        }

                        // Formula cubic bezier path
                        $linePath = "M {$chartPoints[0]['x']} {$chartPoints[0]['y']}";
                        for ($i = 0; $i < count($chartPoints) - 1; $i++) {
                            $x0 = $chartPoints[$i]['x'];
                            $y0 = $chartPoints[$i]['y'];
                            $x1 = $chartPoints[$i+1]['x'];
                            $y1 = $chartPoints[$i+1]['y'];
                            $cx = ($x0 + $x1) / 2;
                            $linePath .= " C {$cx} {$y0}, {$cx} {$y1}, {$x1} {$y1}";
                        }
                        $areaPath = "{$linePath} L {$chartPoints[5]['x']} 165 L {$chartPoints[0]['x']} 165 Z";
                    @endphp

                    <!-- Line Chart SVG Graphic -->
                    <div class="relative h-60 w-full flex flex-col justify-between pt-2">
                        <!-- Y-Axis labels & Grid lines -->
                        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none text-[10px] text-slate-400 font-semibold">
                            <div class="flex items-center">
                                <span class="w-10">Rp {{ number_format($scaleMax / 1000000, 1) }}jt</span>
                                <div class="flex-1 border-b border-dashed border-slate-100 ml-2"></div>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10">Rp {{ number_format(($scaleMax * 0.75) / 1000000, 1) }}jt</span>
                                <div class="flex-1 border-b border-dashed border-slate-100 ml-2"></div>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10">Rp {{ number_format(($scaleMax * 0.5) / 1000000, 1) }}jt</span>
                                <div class="flex-1 border-b border-dashed border-slate-100 ml-2"></div>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10">Rp {{ number_format(($scaleMax * 0.25) / 1000000, 1) }}jt</span>
                                <div class="flex-1 border-b border-dashed border-slate-100 ml-2"></div>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10">Rp 0</span>
                                <div class="flex-1 border-b border-slate-200 ml-2"></div>
                            </div>
                        </div>

                        <!-- SVG Curve Graphic -->
                        <svg class="w-full h-full pl-10 pb-6 overflow-hidden" viewBox="0 0 500 180" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="blueGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#2563eb" stop-opacity="0.25"/>
                                    <stop offset="100%" stop-color="#2563eb" stop-opacity="0.0"/>
                                </linearGradient>
                            </defs>
                            
                            <!-- Area Fill with Fade In Animation -->
                            <path d="{{ $areaPath }}" fill="url(#blueGradient)" class="animate-chart-area"/>
                            
                            <!-- Line Stroke with Smooth Draw Animation -->
                            <path d="{{ $linePath }}" fill="none" stroke="#2563eb" stroke-width="3" stroke-linecap="round" class="animate-chart-line"/>
                            
                            <!-- Interactive Data Points (Bounded, Tanpa CSS Transform Scale yang Bikin Keluar) -->
                            @foreach($chartPoints as $idx => $pt)
                                @php
                                    // Hitung posisi tooltip agar selalu berada di dalam area grafik
                                    $tipW = 96;
                                    if ($idx >= 4) {
                                        $tipX = $pt['x'] - $tipW - 10; // Letakkan di sebelah kiri titik
                                    } elseif ($idx <= 1) {
                                        $tipX = $pt['x'] + 10;         // Letakkan di sebelah kanan titik
                                    } else {
                                        $tipX = $pt['x'] - ($tipW / 2); // Di tengah
                                    }
                                    $tipY = max(8, $pt['y'] - 28);
                                @endphp
                                <g class="group/point cursor-pointer">
                                    <!-- Area Target Hover yang Cukup Luas -->
                                    <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="14" fill="transparent" class="cursor-pointer" />
                                    
                                    @if($loop->last && $pt['nominal'] > 0)
                                        <!-- Animasi Ring Berdenyut Menggunakan Native SVG Animate (Dijamin 100% Tidak Keluar Koordinat) -->
                                        <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="5" fill="#3b82f6" opacity="0.6">
                                            <animate attributeName="r" values="5;12;5" dur="2.4s" repeatCount="indefinite" />
                                            <animate attributeName="opacity" values="0.6;0;0.6" dur="2.4s" repeatCount="indefinite" />
                                        </circle>
                                    @endif

                                    <!-- Lingkaran Luar yang Muncul Saat Hover (Tanpa Loncat) -->
                                    <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="8" fill="none" stroke="#2563eb" stroke-width="2" opacity="0" class="group-hover/point:opacity-100 transition-opacity duration-150" />

                                    <!-- Titik Utama Lingkaran -->
                                    <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="4.5" fill="#1d4ed8" stroke="#ffffff" stroke-width="2" class="group-hover/point:fill-blue-600 transition-colors duration-150" />
                                    
                                    <!-- Tooltip SVG yang Aman di Dalam Batas Grafik -->
                                    <g class="opacity-0 group-hover/point:opacity-100 transition-opacity duration-200 pointer-events-none">
                                        <rect x="{{ $tipX }}" y="{{ $tipY }}" width="{{ $tipW }}" height="22" rx="6" fill="#0f172a" opacity="0.95"/>
                                        <text x="{{ $tipX + ($tipW / 2) }}" y="{{ $tipY + 15 }}" fill="#ffffff" font-size="9.5" font-weight="bold" text-anchor="middle">
                                            {{ $pt['bulan'] }}: {{ $pt['label'] }}
                                        </text>
                                    </g>
                                </g>
                            @endforeach
                        </svg>

                        <!-- X-Axis Months (Rata dan Pas dengan Titik Sumbu X) -->
                        <div class="flex justify-between pl-12 pr-6 pt-2 text-[11px] font-bold text-slate-500">
                            @foreach($trenBiaya as $tb)
                                <span class="{{ $loop->last ? 'text-blue-700 font-black' : '' }}">{{ $tb['bulan'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right: Distribusi Pengeluaran Riil (5 of 12) -->
                <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-sm font-extrabold text-slate-900">Distribusi Pengeluaran</h3>
                            <p class="text-[11px] text-slate-400 font-medium mt-0.5">Proporsi biaya riil per kategori fasilitas.</p>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md">Real Data</span>
                    </div>

                    <div class="space-y-4">
                        @forelse($distribusiPengeluaran as $dist)
                            <div>
                                <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $dist['color'] }}"></span>
                                        <span class="text-slate-800 font-bold">{{ $dist['nama'] }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-black text-slate-900">{{ $dist['persen'] }}%</span>
                                        <span class="text-[10px] text-slate-400 font-medium ml-1">({{ 'Rp ' . number_format($dist['nominal'], 0, ',', '.') }})</span>
                                    </div>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="h-2 rounded-full progress-bar-animated" style="width: {{ $dist['persen'] }}%; background-color: {{ $dist['color'] }}"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-6">Belum ada pengeluaran terealisasi di database.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-medium">
                        <span>Total Realisasi:</span>
                        <span class="font-extrabold text-blue-900">Rp {{ number_format($pengeluaranTerealisasi, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- 5. Bottom Table: Log Transaksi Utama Terkini (Real Data Sesuai Periode) -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">Log Transaksi & Pengajuan Anggaran — {{ $periodLabel ?? 'Semua' }}</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Daftar riwayat pengeluaran dari proposal RAB yang tercatat pada rentang periode aktif.</p>
                    </div>
                    <a href="{{ route('admin.work-orders.index') }}" class="text-xs font-bold text-blue-700 hover:underline">Lihat Semua Work Orders →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="text-slate-400 font-bold border-b border-slate-100">
                            <tr>
                                <th class="py-3 px-3">TANGGAL</th>
                                <th class="py-3 px-3">DESKRIPSI PROPOSAL</th>
                                <th class="py-3 px-3">KATEGORI</th>
                                <th class="py-3 px-3">STATUS</th>
                                <th class="py-3 px-3 text-right">JUMLAH (RP)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50" id="trx-table-body">
                            @forelse($logTransaksi as $trx)
                                <tr class="trx-row hover:bg-slate-50/60 transition-colors">
                                    <td class="py-3.5 px-3 font-medium text-slate-600">
                                        {{ $trx['tanggal'] }}
                                    </td>
                                    <td class="py-3.5 px-3 font-bold text-slate-800">
                                        {{ $trx['deskripsi'] }}
                                    </td>
                                    <td class="py-3.5 px-3">
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-[11px] inline-flex items-center">
                                            {{ $trx['kategori'] }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-3">
                                        @if($trx['status'] === 'Terbayar')
                                            <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 font-bold text-[11px] border border-emerald-100 inline-flex items-center gap-1">
                                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                <span>{{ $trx['status'] }}</span>
                                            </span>
                                        @elseif($trx['status'] === 'Ditolak')
                                            <span class="px-2.5 py-1 rounded-lg bg-red-50 text-red-700 font-bold text-[11px] border border-red-100 inline-flex items-center gap-1">
                                                <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                <span>{{ $trx['status'] }}</span>
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-bold text-[11px] border border-amber-100 inline-flex items-center gap-1">
                                                <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span>{{ $trx['status'] }}</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-3 text-right font-black text-slate-900">
                                        Rp {{ number_format($trx['jumlah'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400 italic">
                                        Belum ada data transaksi pengeluaran tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer / Pagination -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs no-print-pagination">
                    <span class="text-slate-500 font-medium" id="trx-pagination-info">Menampilkan 0 transaksi</span>
                    <div id="trxPagination" class="flex items-center gap-1.5">
                        <!-- Tombol navigasi halaman (‹ 1 2 3 ›) digenerate secara dinamis -->
                    </div>
                </div>
            </div>

            <!-- Print Footer Tanda Tangan Resmi -->
            <div class="hidden print:block mt-12 pt-8 border-t border-slate-200">
                <div class="flex justify-between items-start text-xs text-slate-700">
                    <div>
                        <p class="font-bold">Mengetahui,</p>
                        <p class="text-slate-500 mb-16">Kepala Sekolah</p>
                        <p class="font-extrabold text-slate-900 underline uppercase tracking-wider">( .................................................. )</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Dibuat Oleh,</p>
                        <p class="text-slate-500 mb-16">Koordinator Sarana & Prasarana</p>
                        <p class="font-extrabold text-slate-900 underline uppercase tracking-wider">( {{ $user->nama ?? 'Admin Sarpras' }} )</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Atur Alokasi Total Anggaran (RAPBS) -->
    <div id="budgetModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-7 shadow-2xl border border-slate-100 transition-all transform">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900">Atur Alokasi Anggaran Sekolah</h3>
                        <p class="text-[11px] text-slate-400 font-medium">Tetapkan pagu total anggaran pemeliharaan sarpras.</p>
                    </div>
                </div>
                <button type="button" onclick="closeBudgetModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.budget.update') }}" class="mt-5 space-y-4">
                @csrf

                <!-- Tahun Ajaran (Pilih Langsung Tanpa Ketik Manual) -->
                <div>
                    <label for="select_tahun_ajaran" class="block text-xs font-bold text-slate-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                    @php
                        $baseYear = (int) date('Y');
                        $academicYears = [];
                        for ($y = $baseYear; $y <= $baseYear + 5; $y++) {
                            $academicYears[] = $y . '/' . ($y + 1);
                        }
                    @endphp
                    <div class="relative">
                        <select id="select_tahun_ajaran" name="tahun_ajaran" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all appearance-none cursor-pointer pr-10">
                            @foreach($academicYears as $year)
                                <option value="{{ $year }}" {{ ($tahunAjaran ?? '') === $year ? 'selected' : '' }}>
                                    Tahun Ajaran {{ $year }} {{ ($year === $baseYear . '/' . ($baseYear + 1)) ? '(Tahun Berjalan)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Quick Preset Pills untuk Tahun Ajaran -->
                    <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                        @foreach(array_slice($academicYears, 0, 4) as $quickYear)
                            <button type="button" onclick="document.getElementById('select_tahun_ajaran').value='{{ $quickYear }}'" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors cursor-pointer">
                                {{ $quickYear }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Nominal Total Anggaran -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Total Nominal Anggaran (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-black text-slate-400">Rp</span>
                        <input type="text" id="input_nominal_anggaran" name="total_anggaran" value="{{ number_format($totalAnggaran, 0, ',', '.') }}" required oninput="formatAndCalculate(this)" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-black text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    
                    <!-- Quick Nominal Preset Pills -->
                    <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                        <button type="button" onclick="setBudgetPreset(25000000)" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors">Rp 25 Jt</button>
                        <button type="button" onclick="setBudgetPreset(50000000)" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors">Rp 50 Jt</button>
                        <button type="button" onclick="setBudgetPreset(75000000)" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors">Rp 75 Jt</button>
                        <button type="button" onclick="setBudgetPreset(100000000)" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors">Rp 100 Jt</button>
                        <button type="button" onclick="setBudgetPreset(200000000)" class="px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-600 rounded-lg text-[10px] font-bold transition-colors">Rp 200 Jt</button>
                    </div>
                </div>

                <!-- Proyeksi Perhitungan Riil Card -->
                <div class="p-3.5 bg-blue-50/60 border border-blue-100 rounded-2xl space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Realisasi Pengeluaran:</span>
                        <span class="font-bold text-red-600">- Rp {{ number_format($pengeluaranTerealisasi, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs pt-1.5 border-t border-blue-200/50">
                        <span class="text-slate-700 font-bold">Proyeksi Sisa Saldo:</span>
                        <span id="preview_sisa_saldo" class="font-black text-blue-900">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-3">
                    <button type="button" onclick="closeBudgetModal()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition-all shadow-md shadow-blue-600/20 cursor-pointer">
                        Simpan Alokasi Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Filter Tanggal Kustom -->
    <div id="customDateModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-150">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-black text-slate-900">Filter Tanggal Kustom</h3>
                </div>
                <button type="button" onclick="closeCustomDateModal()" class="text-slate-400 hover:text-slate-600 p-1 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Quick Presets -->
            <div class="mt-3">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Pilihan Cepat:</p>
                <div class="grid grid-cols-2 gap-1.5">
                    <button type="button" onclick="setDatePreset('7days')" class="px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] font-semibold text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-colors cursor-pointer text-center">7 Hari Terakhir</button>
                    <button type="button" onclick="setDatePreset('30days')" class="px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] font-semibold text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-colors cursor-pointer text-center">30 Hari Terakhir</button>
                    <button type="button" onclick="setDatePreset('thisMonth')" class="px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] font-semibold text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-colors cursor-pointer text-center">Bulan Ini</button>
                    <button type="button" onclick="setDatePreset('lastMonth')" class="px-2.5 py-1.5 rounded-xl border border-slate-200 text-[11px] font-semibold text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-colors cursor-pointer text-center">Bulan Lalu</button>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.analytics.index') }}" class="mt-4 space-y-3">
                <input type="hidden" name="period" value="custom">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Dari Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="custom_start_date" name="start_date" value="{{ $startDate ?? now()->subMonth()->format('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Sampai Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="custom_end_date" name="end_date" value="{{ $endDate ?? now()->format('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-50">
                    <button type="button" onclick="closeCustomDateModal()" class="px-3.5 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0f172a] hover:bg-slate-800 text-white font-bold rounded-xl text-xs shadow-xs cursor-pointer">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Animations & Interactions -->
    <script>
        const realPengeluaran = {{ $pengeluaranTerealisasi }};

        // Modal Budget Controls
        function openBudgetModal() {
            document.getElementById('budgetModal').classList.remove('hidden');
        }

        function closeBudgetModal() {
            document.getElementById('budgetModal').classList.add('hidden');
        }

        // Modal Custom Date Controls
        function openCustomDateModal() {
            document.getElementById('customDateModal').classList.remove('hidden');
        }

        function closeCustomDateModal() {
            document.getElementById('customDateModal').classList.add('hidden');
        }

        // Quick Preset Helper for Custom Date
        function setDatePreset(type) {
            const startInput = document.getElementById('custom_start_date');
            const endInput = document.getElementById('custom_end_date');
            if (!startInput || !endInput) return;

            const now = new Date();
            const pad = (n) => String(n).padStart(2, '0');
            const toYMD = (d) => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;

            endInput.value = toYMD(now);

            if (type === '7days') {
                const d = new Date();
                d.setDate(d.getDate() - 7);
                startInput.value = toYMD(d);
            } else if (type === '30days') {
                const d = new Date();
                d.setDate(d.getDate() - 30);
                startInput.value = toYMD(d);
            } else if (type === 'thisMonth') {
                const d = new Date(now.getFullYear(), now.getMonth(), 1);
                startInput.value = toYMD(d);
            } else if (type === 'lastMonth') {
                const dStart = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                const dEnd = new Date(now.getFullYear(), now.getMonth(), 0);
                startInput.value = toYMD(dStart);
                endInput.value = toYMD(dEnd);
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeBudgetModal();
                closeCustomDateModal();
            }
        });

        function setBudgetPreset(amount) {
            const input = document.getElementById('input_nominal_anggaran');
            input.value = amount.toLocaleString('id-ID');
            formatAndCalculate(input);
        }

        function formatAndCalculate(input) {
            let val = input.value.replace(/[^0-9]/g, '');
            if (!val) val = '0';
            const num = parseInt(val, 10);
            input.value = num.toLocaleString('id-ID');

            const sisa = Math.max(0, num - realPengeluaran);
            document.getElementById('preview_sisa_saldo').innerText = 'Rp ' + sisa.toLocaleString('id-ID');
        }

        // CountUp Animation
        function animateCounter(id, target, duration = 1200) {
            const element = document.getElementById(id);
            if (!element) return;
            const startTime = performance.now();

            function update(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Ease out expo
                const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const current = Math.floor(easeProgress * target);
                element.innerText = current.toLocaleString('id-ID');

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.innerText = target.toLocaleString('id-ID');
                }
            }
            requestAnimationFrame(update);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Animate Numbers
            const totalTarget = parseInt(document.getElementById('num_total_anggaran')?.dataset?.target || '0', 10);
            const pengeluaranTarget = parseInt(document.getElementById('num_pengeluaran')?.dataset?.target || '0', 10);
            const sisaTarget = parseInt(document.getElementById('num_sisa')?.dataset?.target || '0', 10);

            animateCounter('num_total_anggaran', totalTarget, 1400);
            animateCounter('num_pengeluaran', pengeluaranTarget, 1400);
            animateCounter('num_sisa', sisaTarget, 1400);

            // Animate Progress Bar
            setTimeout(() => {
                const pBar = document.getElementById('progress_terpakai');
                if (pBar) {
                    pBar.style.width = '{{ $persenTerpakai }}%';
                }
            }, 300);

            // Inisialisasi Paginasi Log Transaksi
            renderTrxPagination();
        });

        // ==========================================
        // PAGINASI TABEL LOG TRANSAKSI (5 BARIS PER HALAMAN)
        // ==========================================
        const TRX_PAGE_SIZE = 5;
        let currentTrxPage = 1;

        function renderTrxPagination() {
            const rows = Array.from(document.querySelectorAll('.trx-row'));
            const totalRows = rows.length;
            const infoEl = document.getElementById('trx-pagination-info');
            const container = document.getElementById('trxPagination');

            if (totalRows === 0) {
                if (infoEl) infoEl.innerText = 'Menampilkan 0 transaksi';
                if (container) container.innerHTML = '';
                return;
            }

            const totalPages = Math.max(1, Math.ceil(totalRows / TRX_PAGE_SIZE));
            if (currentTrxPage > totalPages) currentTrxPage = totalPages;
            if (currentTrxPage < 1) currentTrxPage = 1;

            const startIdx = (currentTrxPage - 1) * TRX_PAGE_SIZE;
            const endIdx = startIdx + TRX_PAGE_SIZE;

            rows.forEach((row, idx) => {
                if (idx >= startIdx && idx < endIdx) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });

            if (infoEl) {
                const from = startIdx + 1;
                const to = Math.min(endIdx, totalRows);
                infoEl.innerText = `Menampilkan ${from} - ${to} dari ${totalRows} transaksi`;
            }

            if (!container) return;
            container.innerHTML = '';

            if (totalPages <= 1) return;

            // Tombol Prev (‹)
            const prevBtn = document.createElement('button');
            prevBtn.type = 'button';
            prevBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${currentTrxPage === 1 ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            prevBtn.innerHTML = '‹';
            prevBtn.disabled = currentTrxPage === 1;
            prevBtn.onclick = () => {
                if (currentTrxPage > 1) {
                    currentTrxPage--;
                    renderTrxPagination();
                }
            };
            container.appendChild(prevBtn);

            // Nomor Halaman
            let startPage = Math.max(1, currentTrxPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            if (startPage > 1) {
                container.appendChild(createTrxPageBtn(1, currentTrxPage === 1));
                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
            }

            for (let p = startPage; p <= endPage; p++) {
                container.appendChild(createTrxPageBtn(p, p === currentTrxPage));
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
                container.appendChild(createTrxPageBtn(totalPages, currentTrxPage === totalPages));
            }

            // Tombol Next (›)
            const nextBtn = document.createElement('button');
            nextBtn.type = 'button';
            nextBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${currentTrxPage === totalPages ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            nextBtn.innerHTML = '›';
            nextBtn.disabled = currentTrxPage === totalPages;
            nextBtn.onclick = () => {
                if (currentTrxPage < totalPages) {
                    currentTrxPage++;
                    renderTrxPagination();
                }
            };
            container.appendChild(nextBtn);
        }

        function createTrxPageBtn(page, isActive) {
            const btn = document.createElement('button');
            btn.type = 'button';
            if (isActive) {
                btn.className = 'w-8 h-8 rounded-lg bg-[#1e3a8a] text-white font-bold flex items-center justify-center text-xs shadow-xs';
            } else {
                btn.className = 'w-8 h-8 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition-all cursor-pointer';
            }
            btn.innerText = page;
            btn.onclick = () => {
                currentTrxPage = page;
                renderTrxPagination();
            };
            return btn;
        }

        // Ekspor Dokumen Resmi ke PDF (Vektor Asli / Non-Screenshot)
        function exportAnalyticsToPdf() {
            // 1. Tampilkan semua baris transaksi untuk dicetak
            const allRows = document.querySelectorAll('.trx-row');
            allRows.forEach(row => {
                row.style.setProperty('display', 'table-row', 'important');
            });

            // 2. Trigger dialog cetak / Simpan sebagai PDF native browser
            setTimeout(() => {
                window.print();

                // 3. Kembalikan state paginasi normal setelah dialog print selesai
                setTimeout(() => {
                    renderTrxPagination();
                }, 800);
            }, 150);
        }

        // Export Excel Spreadsheet Terstruktur (.xls)
        function exportAnalyticsToExcel() {
            const data = @json($logTransaksi);
            const totalAnggaran = {{ $totalAnggaran }};
            const realisasi = {{ $pengeluaranTerealisasi }};
            const sisa = {{ $sisaSaldo }};
            const persen = {{ $persenTerpakai }};
            const tahunAjaran = @json($tahunAjaran);
            const periodLabel = @json($periodLabel ?? 'Tahun Berjalan');

            let html = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta charset="utf-8">
                    <style>
                        body { font-family: Arial, sans-serif; font-size: 11pt; }
                        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                        th { background-color: #0f172a; color: #ffffff; font-weight: bold; border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
                        td { border: 1px solid #cbd5e1; padding: 6px 8px; }
                        .title { font-size: 14pt; font-weight: bold; color: #0f172a; }
                        .subtitle { font-size: 10pt; font-weight: bold; color: #475569; }
                        .kpi-th { background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: left; }
                        .num { text-align: right; }
                        .bold { font-weight: bold; }
                    </style>
                </head>
                <body>
                    <table>
                        <tr><td colspan="6" class="title">SIPERFAS - LAPORAN REALISASI ANGGARAN & PEMELIHARAAN SARPRAS</td></tr>
                        <tr><td colspan="6" class="subtitle">Badan Pengelola Sarana, Prasarana & Manajemen Aset Sekolah</td></tr>
                        <tr><td colspan="6">Tahun Ajaran: ${tahunAjaran} | Periode: ${periodLabel} | Tanggal Cetak: ${new Date().toLocaleDateString('id-ID')}</td></tr>
                        <tr><td colspan="6"></td></tr>
                    </table>

                    <table>
                        <tr><th colspan="2" class="kpi-th">RINGKASAN ANGGARAN SEKOLAH</th></tr>
                        <tr><td>Total Pagu Anggaran Dialokasikan</td><td class="num bold">Rp ${totalAnggaran.toLocaleString('id-ID')}</td></tr>
                        <tr><td>Total Realisasi Pengeluaran (${periodLabel})</td><td class="num bold">Rp ${realisasi.toLocaleString('id-ID')}</td></tr>
                        <tr><td>Sisa Saldo Anggaran</td><td class="num bold">Rp ${sisa.toLocaleString('id-ID')}</td></tr>
                        <tr><td>Persentase Serapan Anggaran</td><td class="num bold">${persen}%</td></tr>
                    </table>

                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">NO</th>
                                <th style="width: 120px;">TANGGAL</th>
                                <th>DESKRIPSI PROPOSAL / PEKERJAAN</th>
                                <th>KATEGORI</th>
                                <th>STATUS</th>
                                <th style="text-align: right;">JUMLAH (RP)</th>
                            </tr>
                        </thead>
                        <tbody>`;

            if (data && data.length > 0) {
                data.forEach((item, index) => {
                    html += `
                        <tr>
                            <td style="text-align: center;">${index + 1}</td>
                            <td>${item.tanggal}</td>
                            <td>${item.deskripsi}</td>
                            <td>${item.kategori}</td>
                            <td>${item.status}</td>
                            <td class="num">Rp ${Number(item.jumlah).toLocaleString('id-ID')}</td>
                        </tr>`;
                });
                html += `
                        <tr>
                            <td colspan="5" class="bold" style="text-align: right; background-color: #f1f5f9;">TOTAL REALISASI</td>
                            <td class="num bold" style="background-color: #f1f5f9;">Rp ${realisasi.toLocaleString('id-ID')}</td>
                        </tr>`;
            } else {
                html += `<tr><td colspan="6" style="text-align: center;">Tidak ada data transaksi pada periode ini.</td></tr>`;
            }

            html += `
                        </tbody>
                    </table>
                </body>
                </html>`;

            const blob = new Blob(['\uFEFF' + html], { type: 'application/vnd.ms-excel;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const downloadLink = document.createElement('a');
            downloadLink.href = url;
            downloadLink.download = 'Laporan_Keuangan_Sarpras_' + new Date().toISOString().slice(0, 10) + '.xls';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            URL.revokeObjectURL(url);
        }
    </script>
    @include('partials.logout-modal')
</body>
</html>
