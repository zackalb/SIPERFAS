<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Sarpras - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col h-full hidden md:flex shrink-0 z-20">
        <div class="p-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3 mb-8">
                <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-8 h-8 object-contain">
                <div>
                    <h1 class="text-sm font-bold text-slate-900 leading-tight">SIPERFAS</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Sistem Informasi Pelaporan Fasilitas</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-50/70 text-blue-700 rounded-xl text-sm font-bold transition-all shadow-xs">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.work-orders.index') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span>Perintah Kerja</span>
                </a>
                <a href="{{ route('admin.inventory.index') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>Katalog Inventaris</span>
                </a>
                <a href="{{ route('admin.technicians.index') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Data Petugas</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Laporan & Analitik</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="mt-auto p-6 border-t border-slate-100">
            <div class="space-y-1.5">
                <a href="{{ route('settings.security') }}" class="flex items-center space-x-3 px-4 py-2 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-xl text-sm font-medium transition-all">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Topbar -->
        <header class="bg-white border-b border-slate-100 flex items-center justify-between px-8 py-4 z-10 shrink-0">
            <h2 class="text-xl font-extrabold text-blue-950 tracking-tight">Admin SarPras</h2>

            <!-- Notifications & Profile -->
            <div class="flex items-center space-x-5">
                <button class="text-slate-500 hover:text-blue-600 transition-all relative">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    @if($hasEmergency || $pendingRabsCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-red-600 rounded-full border-2 border-white animate-pulse"></span>
                    @endif
                </button>
                <button class="text-slate-500 hover:text-blue-600 transition-all">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <!-- Avatar Profile Info -->
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

            <!-- 2. 4 KPI Metric Cards (Screenshot 1) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Tiket Aktif -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500">Total Tiket Aktif</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-2 tracking-tight">{{ $totalActiveTickets }}</h3>
                        <p class="text-xs text-blue-600 font-bold mt-2 flex items-center gap-0.5">
                            <span>↑ {{ $percentageChange }}%  bulan lalu</span>
                        </p>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Menunggu Persetujuan -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500">Menunggu Persetujuan</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-2 tracking-tight">{{ $pendingRabsCount }}</h3>
                        <p class="text-xs text-[#b45309] font-bold mt-2">
                            Segera tindak lanjuti
                        </p>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-[#b45309] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- SLA Terpenuhi (%) -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500">SLA Terpenuhi (%)</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-2 tracking-tight">{{ $slaPercentage }}%</h3>
                        <p class="text-xs text-blue-600 font-bold mt-2">
                            Target: >90%
                        </p>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Serapan Anggaran (YTD) -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-bold text-slate-500">Serapan Anggaran (YTD)</p>
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 mt-1 tracking-tight">{{ $budgetAbsorptionPercentage }}%</h3>
                        <!-- Progress bar -->
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3 overflow-hidden">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $budgetAbsorptionPercentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Middle Section: Tindakan Cepat : Persetujuan RAB & SLA Penyelesaian (Screenshot 1) -->
            <div id="approval-rab-section" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Left: Tindakan Cepat : Persetujuan RAB (7 of 12 cols) -->
                <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Tindakan Cepat : Persetujuan RAB</h3>
                        <span class="text-xs font-semibold text-slate-400">Menampilkan proposal butuh persetujuan</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="text-slate-400 font-bold border-b border-slate-100">
                                <tr>
                                    <th class="py-3 px-2">No Tiket</th>
                                    <th class="py-3 px-2">Deskripsi</th>
                                    <th class="py-3 px-2 text-right">Estimasi Biaya (Rp)</th>
                                    <th class="py-3 px-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($proposals as $prop)
                                    @php
                                        $report = $prop->verification ? $prop->verification->damageReport : null;
                                        $facName = $report && $report->facility ? $report->facility->nama_fasilitas : 'Perbaikan Fasilitas';
                                        $ticketCode = $report ? 'TKT-' . $report->tanggal_waktu->format('Y') . '-' . str_pad($report->id_laporan, 3, '0', STR_PAD_LEFT) : 'TKT-2023-' . str_pad($prop->id_rab, 3, '0', STR_PAD_LEFT);
                                    @endphp
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <!-- No Tiket -->
                                        <td class="py-3.5 px-2 font-bold text-slate-800 shrink-0">
                                            {{ $ticketCode }}
                                        </td>

                                        <!-- Deskripsi -->
                                        <td class="py-3.5 px-2 font-medium text-slate-700 max-w-[200px]">
                                            <div class="line-clamp-2">{{ $facName }}</div>
                                        </td>

                                        <!-- Estimasi Biaya -->
                                        <td class="py-3.5 px-2 text-right font-bold text-slate-800">
                                            {{ number_format($prop->estimasi_biaya, 0, ',', '.') }}
                                        </td>

                                        <!-- Action Column: Hanya Icon Mata Sesuai Request -->
                                        <td class="py-3.5 px-2 text-center">
                                            <button type="button" onclick="openApprovalModal({{ $prop->id_rab }})" class="p-2 text-blue-600 hover:bg-blue-50 hover:text-blue-800 rounded-xl transition-all inline-flex items-center justify-center cursor-pointer shadow-xs border border-blue-100 bg-blue-50/40" title="Buka Formulir Approval RAB">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400 font-medium">
                                            Tidak ada proposal RAB yang menunggu persetujuan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right: SLA Penyelesaian Donut Chart (4 of 12 cols) - Dynamic & Animated with Tooltips -->
                <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6 flex flex-col justify-between h-full relative overflow-hidden group/card">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-base font-extrabold text-slate-900">SLA Penyelesaian</h3>
                        <span class="text-[11px] font-bold text-slate-400 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">
                            Total: {{ $slaData['total_tickets'] }} Tiket
                        </span>
                    </div>

                    @php
                        $c = 301.59; // 2 * PI * 48
                        $onTimeLen = ($slaData['on_time_percent'] / 100) * $c;
                        $inProgLen = ($slaData['in_progress_percent'] / 100) * $c;
                        $overdueLen = ($slaData['overdue_percent'] / 100) * $c;

                        $rot1 = -90;
                        $rot2 = -90 + ($slaData['on_time_percent'] * 3.6);
                        $rot3 = $rot2 + ($slaData['in_progress_percent'] * 3.6);
                    @endphp

                    <!-- Donut Gauge Chart with SVG Animations & Hover Tooltips -->
                    <div class="flex items-center justify-center my-3 relative group/chart cursor-pointer">
                        <svg class="w-44 h-44 transition-transform duration-500 group-hover/chart:scale-105" viewBox="0 0 120 120">
                            <!-- Background Circle -->
                            <circle cx="60" cy="60" r="48" stroke="#f1f5f9" stroke-width="12" fill="transparent"/>

                            <!-- On-Time Segment (Biru Tua) -->
                            @if($slaData['on_time_percent'] > 0)
                                <circle cx="60" cy="60" r="48"
                                        stroke="#1d4ed8" stroke-width="12" fill="transparent"
                                        stroke-dasharray="{{ $onTimeLen }} {{ $c - $onTimeLen }}"
                                        transform="rotate({{ $rot1 }} 60 60)"
                                        class="sla-segment transition-all duration-300 hover:stroke-[15] hover:brightness-110"
                                        style="animation: donutSegmentAnim 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                                </circle>
                            @endif

                            <!-- In-Progress Segment (Biru Muda) -->
                            @if($slaData['in_progress_percent'] > 0)
                                <circle cx="60" cy="60" r="48"
                                        stroke="#0ea5e9" stroke-width="12" fill="transparent"
                                        stroke-dasharray="{{ $inProgLen }} {{ $c - $inProgLen }}"
                                        transform="rotate({{ $rot2 }} 60 60)"
                                        class="sla-segment transition-all duration-300 hover:stroke-[15] hover:brightness-110"
                                        style="animation: donutSegmentAnim 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                                </circle>
                            @endif

                            <!-- Overdue Segment (Merah) -->
                            @if($slaData['overdue_percent'] > 0)
                                <circle cx="60" cy="60" r="48"
                                        stroke="#ef4444" stroke-width="12" fill="transparent"
                                        stroke-dasharray="{{ $overdueLen }} {{ $c - $overdueLen }}"
                                        transform="rotate({{ $rot3 }} 60 60)"
                                        class="sla-segment transition-all duration-300 hover:stroke-[15] hover:brightness-110"
                                        style="animation: donutSegmentAnim 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                                </circle>
                            @endif
                        </svg>

                        <!-- Centered Percent Text with Counter Animation -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
                            <span class="text-3xl font-black text-slate-900 leading-none transition-all duration-300" id="sla-counter-percent">
                                {{ $slaData['on_time_percent'] }}%
                            </span>
                            <span class="text-[11px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full mt-1.5 shadow-2xs">
                                Tepat Waktu
                            </span>
                        </div>

                        <!-- Floating Interactive Tooltip for Donut Chart on Hover -->
                        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 translate-y-2 opacity-0 group-hover/chart:opacity-100 group-hover/chart:translate-y-0 transition-all duration-300 pointer-events-none z-30 w-56 bg-slate-900/95 backdrop-blur-md text-white p-3 rounded-2xl shadow-xl border border-slate-700 text-xs text-left">
                            <p class="font-extrabold text-[11px] text-blue-300 border-b border-slate-800 pb-1 mb-1.5 flex items-center justify-between">
                                <span>Ringkasan Metrik SLA</span>
                                <span>{{ $slaData['total_tickets'] }} Tiket</span>
                            </p>
                            <div class="space-y-1 text-[11px]">
                                <div class="flex justify-between items-center text-emerald-300 font-semibold">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Tepat Waktu:
                                    </span>
                                    <span>{{ $slaData['on_time_count'] }} ({{ $slaData['on_time_percent'] }}%)</span>
                                </div>
                                <div class="flex justify-between items-center text-sky-300 font-semibold">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Dalam Proses:
                                    </span>
                                    <span>{{ $slaData['in_progress_count'] }} ({{ $slaData['in_progress_percent'] }}%)</span>
                                </div>
                                <div class="flex justify-between items-center text-rose-300 font-semibold">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        Melewati SLA:
                                    </span>
                                    <span>{{ $slaData['overdue_count'] }} ({{ $slaData['overdue_percent'] }}%)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Legend Items with Interactive Tooltips on Hover -->
                    <div class="space-y-2 pt-2 border-t border-slate-50 text-xs font-semibold">
                        <!-- Legend 1: On-Time -->
                        <div class="group/leg relative flex items-center justify-between p-1.5 rounded-xl hover:bg-blue-50/60 transition-all cursor-pointer">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#1d4ed8] group-hover/leg:scale-125 transition-transform shadow-xs"></span>
                                <span class="text-slate-700 font-medium">Selesai Tepat Waktu</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] text-slate-400 font-normal">({{ $slaData['on_time_count'] }} tiket)</span>
                                <span class="font-bold text-slate-900">{{ $slaData['on_time_percent'] }}%</span>
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 opacity-0 group-hover/leg:opacity-100 transition-all duration-200 pointer-events-none z-30 w-60 bg-slate-900/95 backdrop-blur-md text-white p-2.5 rounded-xl shadow-lg border border-slate-700 text-[11px] leading-relaxed">
                                <span class="font-bold text-blue-300 block mb-0.5">Selesai Tepat Waktu ({{ $slaData['on_time_count'] }} Tiket)</span>
                                Perbaikan diselesaikan oleh teknisi sebelum batas waktu toleransi standar (≤ 72 jam).
                            </div>
                        </div>

                        <!-- Legend 2: In Progress -->
                        <div class="group/leg relative flex items-center justify-between p-1.5 rounded-xl hover:bg-sky-50/60 transition-all cursor-pointer">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#0ea5e9] group-hover/leg:scale-125 transition-transform shadow-xs"></span>
                                <span class="text-slate-700 font-medium">Dalam Proses</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] text-slate-400 font-normal">({{ $slaData['in_progress_count'] }} tiket)</span>
                                <span class="font-bold text-slate-900">{{ $slaData['in_progress_percent'] }}%</span>
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 opacity-0 group-hover/leg:opacity-100 transition-all duration-200 pointer-events-none z-30 w-60 bg-slate-900/95 backdrop-blur-md text-white p-2.5 rounded-xl shadow-lg border border-slate-700 text-[11px] leading-relaxed">
                                <span class="font-bold text-sky-300 block mb-0.5">Dalam Proses ({{ $slaData['in_progress_count'] }} Tiket)</span>
                                Sedang ditangani oleh teknisi di lapangan dan masih dalam batas waktu penanganan aman (≤ 48 jam).
                            </div>
                        </div>

                        <!-- Legend 3: Overdue -->
                        <div class="group/leg relative flex items-center justify-between p-1.5 rounded-xl hover:bg-red-50/60 transition-all cursor-pointer">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#ef4444] group-hover/leg:scale-125 transition-transform shadow-xs"></span>
                                <span class="text-slate-700 font-medium">Melewati Batas SLA</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] text-slate-400 font-normal">({{ $slaData['overdue_count'] }} tiket)</span>
                                <span class="font-bold text-red-600">{{ $slaData['overdue_percent'] }}%</span>
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 opacity-0 group-hover/leg:opacity-100 transition-all duration-200 pointer-events-none z-30 w-60 bg-slate-900/95 backdrop-blur-md text-white p-2.5 rounded-xl shadow-lg border border-slate-700 text-[11px] leading-relaxed">
                                <span class="font-bold text-rose-300 block mb-0.5">Melewati Batas SLA ({{ $slaData['overdue_count'] }} Tiket)</span>
                                Tiket aktif yang memerlukan eskalasi karena telah melampaui batas waktu penanganan standar (> 48 jam).
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 4. Bottom Section: Fasilitas Sering Rusak (Dynamic, Animated & Interactive Tooltips) -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Fasilitas Sering Rusak</h3>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">Statistik kerusakan nyata berdasarkan kategori spesialisasi fasilitas sekolah</p>
                    </div>
                    <span class="text-xs font-bold text-blue-800 bg-blue-50 border border-blue-100 px-3 py-1 rounded-xl">
                        Arahkan kursor untuk detail lengkap
                    </span>
                </div>

                <div class="space-y-3.5">
                    @forelse($fasilitasSeringRusak as $item)
                        <div class="group relative flex items-center justify-between text-xs font-bold text-slate-700 p-2.5 -mx-2.5 rounded-xl hover:bg-slate-50/80 transition-all duration-200 cursor-pointer">
                            
                            <!-- Category Name & Icon -->
                            <div class="w-48 flex items-center gap-2.5 text-slate-800 shrink-0">
                                <span class="text-base p-1.5 bg-slate-100 rounded-lg group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-200">{{ $item['icon'] }}</span>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-900 group-hover:text-blue-700 transition-colors">{{ $item['kategori'] }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">{{ $item['persen'] }}% dari total kasus</span>
                                </div>
                            </div>

                            <!-- Animated Progress Bar with Gradient & Shimmer -->
                            <div class="flex-1 mx-6 bg-slate-100/90 rounded-full h-3 overflow-hidden p-0.5 relative shadow-inner">
                                <div class="h-full rounded-full bg-gradient-to-r from-blue-700 via-indigo-600 to-blue-500 transition-all duration-1000 ease-out group-hover:shadow-[0_0_12px_rgba(37,99,235,0.45)] relative overflow-hidden" 
                                     style="width: {{ $item['bar_width'] }}%; animation: barGrow 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                                    <!-- Subtle Shimmer Effect on Hover -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/25 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                            </div>

                            <!-- Case Count Badge -->
                            <div class="w-24 text-right font-extrabold text-slate-900 shrink-0">
                                <span class="px-2.5 py-1 bg-slate-100 group-hover:bg-blue-600 group-hover:text-white rounded-lg transition-all duration-200 inline-block shadow-2xs">
                                    {{ $item['kasus'] }} Kasus
                                </span>
                            </div>

                            <!-- Interactive Floating Tooltip on Hover -->
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 group-hover:-translate-y-1 transition-all duration-200 pointer-events-none z-30 w-72 bg-slate-900/95 backdrop-blur-md text-white p-3.5 rounded-2xl shadow-xl border border-slate-700 text-xs">
                                <div class="flex items-center justify-between border-b border-slate-800 pb-2 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base">{{ $item['icon'] }}</span>
                                        <span class="font-bold text-white text-xs">Kategori {{ $item['kategori'] }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 bg-blue-500/20 text-blue-300 font-extrabold text-[10px] rounded-md border border-blue-400/30">
                                        {{ $item['persen'] }}% Total
                                    </span>
                                </div>
                                <div class="space-y-1.5 text-[11px]">
                                    <div class="flex justify-between items-center text-slate-300">
                                        <span>Total Insiden:</span>
                                        <span class="font-extrabold text-white">{{ $item['kasus'] }} Kasus Kerusakan</span>
                                    </div>
                                    <div class="flex justify-between items-center text-emerald-400">
                                        <span>Status Selesai:</span>
                                        <span class="font-bold">{{ $item['selesai'] }} Kasus</span>
                                    </div>
                                    <div class="flex justify-between items-center text-amber-400">
                                        <span>Dalam Penanganan:</span>
                                        <span class="font-bold">{{ $item['dalam_proses'] }} Kasus</span>
                                    </div>
                                    <div class="pt-1.5 mt-1 border-t border-slate-800 text-[10px] text-slate-400 flex items-center justify-between">
                                        <span class="inline-flex items-center gap-1 text-slate-400">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Teknisi:
                                        </span>
                                        <span class="font-semibold text-blue-300">{{ $item['teknisi'] }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-400 text-xs">
                            Belum ada catatan kerusakan fasilitas di sistem.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- CSS Animations for Donut & Progress Bars -->
            <style>
                @keyframes donutSegmentAnim {
                    from {
                        stroke-dasharray: 0 301.59;
                    }
                }
                @keyframes barGrow {
                    from {
                        width: 0%;
                    }
                }
            </style>

        </div>
    </main>

    <!-- 5. Approval RAB Detail Modal (Screenshot 2) -->
    <div id="approval-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 sm:p-6">
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-2xl w-full overflow-hidden transform transition-all">
            
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-100 flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900" id="modal-title">Approval RAB: Perbaikan Atap Bocor (Gedung A)</h3>
                    <p class="text-xs text-slate-400 font-semibold mt-1" id="modal-subtitle">Ticket ID: #TCK-2023-0894 • Submitted: Oct 24, 2023</p>
                </div>
                <button type="button" onclick="closeApprovalModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-xl hover:bg-slate-100 transition-all cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Form with Rejection / Approval Action -->
            <form id="approval-action-form" method="POST" action="">
                @csrf
                <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">

                    <!-- Section 1: Informasi Bukti -->
                    <div class="border border-slate-100 rounded-2xl p-5 space-y-4">
                        <div class="flex items-center gap-2 text-slate-900 font-bold text-sm">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Informasi Bukti</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Left Info -->
                            <div class="space-y-3 text-xs">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Lokasi</span>
                                    <p class="font-bold text-slate-800 mt-0.5" id="modal-lokasi">Gedung A, Lantai 3, Ruang Kelas 302</p>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Deskripsi Kerusakan</span>
                                    <div class="mt-1 p-3 bg-slate-50 border border-slate-100 rounded-xl text-slate-700 leading-relaxed font-medium" id="modal-deskripsi">
                                        Plafon jebol akibat rembesan air hujan dari atap. Rangka kayu sebagian lapuk dan perlu diganti. Kondisi membahayakan kegiatan belajar mengajar karena potensi runtuh susulan.
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pelapor</span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px]" id="modal-pelapor-avatar">P</div>
                                        <div>
                                            <p class="font-bold text-slate-800 leading-tight" id="modal-pelapor-name">Pelapor</p>
                                            <p class="text-[10px] text-slate-400" id="modal-pelapor-role">Siswa / Guru</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Photo Before -->
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Foto Sebelum Perbaikan</span>
                                <div class="border-2 border-dashed border-slate-200 rounded-2xl h-44 flex flex-col items-center justify-center text-center p-4 bg-slate-50/40 relative overflow-hidden" id="modal-photo-container">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-1.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <span class="text-xs font-bold text-blue-700">contoh foto sebelumnya</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Rincian Anggaran Biaya (RAB) -->
                    <div class="border border-slate-100 rounded-2xl p-5 space-y-4">
                        <div class="flex items-center gap-2 text-slate-900 font-bold text-sm">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Rincian Anggaran Biaya (RAB)</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="text-slate-400 font-bold border-b border-slate-100">
                                    <tr>
                                        <th class="py-2.5 px-2">#</th>
                                        <th class="py-2.5 px-2">NAMA BARANG/JASA</th>
                                        <th class="py-2.5 px-2 text-center">QTY</th>
                                        <th class="py-2.5 px-2 text-right">HARGA SATUAN</th>
                                        <th class="py-2.5 px-2 text-right">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50" id="modal-rab-items">
                                    <!-- Dynamic Items Populated by JS -->
                                </tbody>
                                <tfoot>
                                    <tr class="border-t border-slate-100 font-bold">
                                        <td colspan="4" class="py-3 px-2 text-right text-slate-900 text-sm">Total Estimasi Biaya</td>
                                        <td class="py-3 px-2 text-right text-blue-900 text-sm" id="modal-rab-total">Rp 1.105.000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Section 3: Catatan Keputusan -->
                    <div class="border border-slate-100 rounded-2xl p-5 space-y-2">
                        <div class="flex items-center gap-2 text-slate-900 font-bold text-sm">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Catatan Keputusan</span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium">Tambahkan catatan jika menyetujui, atau alasan spesifik jika menolak/meminta revisi RAB ini.</p>
                        <textarea name="catatan_keputusan" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-700 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Masukkan catatan di sini (Wajib jika menolak/revisi)..."></textarea>
                    </div>

                </div>

                <!-- Modal Footer Action Buttons -->
                <div class="p-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
                    <button type="button" onclick="submitModalDecision('reject')" class="px-5 py-2.5 bg-white hover:bg-red-50 text-[#dc2626] border border-[#fca5a5] font-bold rounded-xl text-xs transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span>Tolak / Minta Revisi</span>
                    </button>
                    <button type="button" onclick="submitModalDecision('approve')" class="px-5 py-2.5 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-xl text-xs transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Setujui (Approve)</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- JavaScript Data & Modal Controller -->
    <script>
        const proposalsData = @json($proposals);

        function scrollToApproval() {
            document.getElementById('approval-rab-section').scrollIntoView({ behavior: 'smooth' });
        }

        let activeProposalId = null;

        function openApprovalModal(id) {
            activeProposalId = id;
            const prop = proposalsData.find(p => p.id_rab === id);
            if (!prop) return;

            const rep = prop.verification ? prop.verification.damage_report : null;
            const fac = rep && rep.facility ? rep.facility : null;
            const user = rep && rep.user ? rep.user : null;

            // Update Title & Subtitle
            document.getElementById('modal-title').innerText = 'Persetujuan RAB: ' + (fac ? fac.nama_fasilitas : 'Perbaikan Fasilitas');
            const ticketCode = rep ? '#TCK-' + (rep.tanggal_waktu ? new Date(rep.tanggal_waktu).getFullYear() : '2023') + '-' + String(rep.id_laporan).padStart(4, '0') : '#TCK-2023-0894';
            document.getElementById('modal-subtitle').innerText = 'ID Tiket: ' + ticketCode + ' • Diajukan: ' + (rep && rep.tanggal_waktu ? new Date(rep.tanggal_waktu).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) : '24 Okt 2023');

            // Update Location & Description
            document.getElementById('modal-lokasi').innerText = fac && fac.lokasi_detail ? fac.lokasi_detail : 'Gedung A, Lantai 3, Ruang Kelas 302';
            document.getElementById('modal-deskripsi').innerText = rep && rep.deskripsi_kerusakan ? rep.deskripsi_kerusakan : 'Plafon jebol akibat rembesan air hujan dari atap. Rangka kayu sebagian lapuk dan perlu diganti.';
            
            // Reporter
            document.getElementById('modal-pelapor-name').innerText = user ? user.nama : 'Pelapor';
            document.getElementById('modal-pelapor-avatar').innerText = user ? user.nama.charAt(0).toUpperCase() : 'P';

            // Photo Before
            const photoContainer = document.getElementById('modal-photo-container');
            if (rep && rep.foto_bukti) {
                photoContainer.innerHTML = `<img src="/storage/${rep.foto_bukti}" class="w-full h-full object-cover rounded-xl" alt="Bukti Foto">`;
            } else {
                photoContainer.innerHTML = `
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-blue-700">contoh foto sebelumnya</span>
                `;
            }

            // Items Table
            const itemsTbody = document.getElementById('modal-rab-items');
            itemsTbody.innerHTML = '';
            if (prop.items && prop.items.length > 0) {
                prop.items.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="py-2 px-2 text-slate-400 font-bold">${index + 1}</td>
                        <td class="py-2 px-2 font-bold text-slate-800">${item.nama_sarana_jasa}</td>
                        <td class="py-2 px-2 text-center text-slate-600">${item.qty} ${item.satuan}</td>
                        <td class="py-2 px-2 text-right text-slate-600">Rp ${Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                        <td class="py-2 px-2 text-right font-bold text-slate-800">Rp ${Number(item.subtotal).toLocaleString('id-ID')}</td>
                    `;
                    itemsTbody.appendChild(tr);
                });
            } else {
                itemsTbody.innerHTML = `
                    <tr>
                        <td class="py-2 px-2 text-slate-400 font-bold">1</td>
                        <td class="py-2 px-2 font-bold text-slate-800">Gypsum Board 9mm (Gyproc)</td>
                        <td class="py-2 px-2 text-center text-slate-600">4 lbr</td>
                        <td class="py-2 px-2 text-right text-slate-600">Rp 65.000</td>
                        <td class="py-2 px-2 text-right font-bold text-slate-800">Rp 260.000</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-2 text-slate-400 font-bold">2</td>
                        <td class="py-2 px-2 font-bold text-slate-800">Rangka Hollow 4x4 (Galvalum)</td>
                        <td class="py-2 px-2 text-center text-slate-600">6 btg</td>
                        <td class="py-2 px-2 text-right text-slate-600">Rp 45.000</td>
                        <td class="py-2 px-2 text-right font-bold text-slate-800">Rp 270.000</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-2 text-slate-400 font-bold">3</td>
                        <td class="py-2 px-2 font-bold text-slate-800">Cat Tembok/Plafon Putih (Dulux 5kg)</td>
                        <td class="py-2 px-2 text-center text-slate-600">1 gln</td>
                        <td class="py-2 px-2 text-right text-slate-600">Rp 175.000</td>
                        <td class="py-2 px-2 text-right font-bold text-slate-800">Rp 175.000</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-2 text-slate-400 font-bold">4</td>
                        <td class="py-2 px-2 font-bold text-slate-800">Jasa Tukang (Perbaikan & Pengecatan)</td>
                        <td class="py-2 px-2 text-center text-slate-600">2 hr</td>
                        <td class="py-2 px-2 text-right text-slate-600">Rp 200.000</td>
                        <td class="py-2 px-2 text-right font-bold text-slate-800">Rp 400.000</td>
                    </tr>
                `;
            }

            document.getElementById('modal-rab-total').innerText = 'Rp ' + Number(prop.estimasi_biaya).toLocaleString('id-ID');
            document.getElementById('approval-modal').classList.remove('hidden');
        }

        function closeApprovalModal() {
            document.getElementById('approval-modal').classList.add('hidden');
            activeProposalId = null;
        }

        function submitModalDecision(type) {
            if (!activeProposalId) return;
            const form = document.getElementById('approval-action-form');
            if (type === 'approve') {
                form.action = '/admin/rab/' + activeProposalId + '/approve';
            } else {
                form.action = '/admin/rab/' + activeProposalId + '/reject';
            }
            form.submit();
        }

        // Animate SLA Counter on Page Load
        document.addEventListener('DOMContentLoaded', () => {
            const counterEl = document.getElementById('sla-counter-percent');
            if (counterEl) {
                const target = parseInt({{ $slaData['on_time_percent'] }}) || 0;
                let current = 0;
                const duration = 1200;
                const stepTime = 20;
                const steps = duration / stepTime;
                const increment = target / steps;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counterEl.innerText = target + '%';
                        clearInterval(timer);
                    } else {
                        counterEl.innerText = Math.round(current) + '%';
                    }
                }, stepTime);
            }
        });
    </script>
    @include('partials.logout-modal')
</body>
</html>
