<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket & Work Order (WO) - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased text-gray-800 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full hidden md:flex">
        <div class="p-6">
            <div class="flex items-center space-x-3 mb-8">
                <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-8 h-8 object-contain">
                <div>
                    <h1 class="text-sm font-bold text-gray-900 leading-tight">SIPERFAS</h1>
                    <p class="text-[10px] text-gray-500 font-medium">Sistem Informasi Pelaporan Fasilitas</p>
                </div>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ route('pelapor.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Lapor Kerusakan</span>
                </a>
                <a href="{{ route('pelapor.tickets') }}" class="flex items-center justify-between px-4 py-2.5 bg-blue-50/50 text-blue-700 rounded-lg text-sm font-semibold border-l-2 border-blue-600">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        <span>Tiket / WO</span>
                    </div>
                    @if(($ongoingCount ?? 0) > 0)
                        <span class="px-2 py-0.5 bg-blue-600 text-white text-[10px] font-bold rounded-full">{{ $ongoingCount }}</span>
                    @endif
                </a>
            </nav>
        </div>

        <div class="mt-auto p-6 border-t border-gray-100">
            <div class="space-y-1">
                <a href="{{ route('settings.security') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Topbar: Responsif Mobile & Desktop -->
        <header class="bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-8 py-3.5 z-20 shrink-0">
            <div class="flex items-center space-x-3">
                <!-- Mobile Logo & Nama Aplikasi -->
                <div class="flex items-center space-x-2.5 md:hidden">
                    <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-7 h-7 object-contain">
                    <div>
                        <h1 class="text-sm font-bold text-gray-900 leading-tight">SIPERFAS</h1>
                        <p class="text-[9px] text-gray-500 font-medium">Pelapor</p>
                    </div>
                </div>
                <h2 class="text-xl font-extrabold text-blue-950 tracking-tight hidden md:block">Pelapor</h2>
            </div>

            <!-- Notifications & Profile Dropdown -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Notifications Dropdown (Pelapor: Hanya ketika tugas sudah selesai) -->
                <div class="relative" id="pelaporNotificationContainer">
                    <button type="button" onclick="togglePelaporNotificationDropdown()" class="text-slate-500 hover:text-blue-600 transition-all relative p-1.5 rounded-lg hover:bg-slate-100 cursor-pointer focus:outline-none" title="Notifikasi Tugas Selesai">
                        <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        @if(($pelaporNotificationCount ?? 0) > 0)
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500 border-2 border-white"></span>
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Popover Panel -->
                    <div id="pelaporNotificationDropdown" class="hidden absolute right-0 sm:right-auto sm:left-1/2 sm:-translate-x-1/2 md:translate-x-0 md:left-auto md:right-0 mt-2.5 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200/90 z-50 overflow-hidden transform transition-all duration-200 origin-top-right">
                        <!-- Header -->
                        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-slate-50 to-blue-50/40 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-800 leading-tight">Pemberitahuan</h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-500">Tugas Perbaikan Selesai</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if(($pelaporNotificationCount ?? 0) > 0)
                                    <button type="button" id="markAllReadBtn" onclick="markAllNotificationsAsRead(event)" class="text-[11px] text-blue-600 hover:text-blue-800 font-semibold hover:underline cursor-pointer flex items-center space-x-1 transition-colors" title="Tandai semua notifikasi telah dibaca">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>Tandai baca semua</span>
                                    </button>
                                    <span id="pelaporNotifBadge" class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] sm:text-[11px] font-bold rounded-full border border-emerald-200">
                                        {{ $pelaporNotificationCount }} Baru
                                    </span>
                                @else
                                    <span id="pelaporNotifBadge" class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] sm:text-[11px] font-medium rounded-full">
                                        0 Baru
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- List Notifikasi -->
                        <div id="pelaporNotifList" class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            @forelse($pelaporNotifications ?? [] as $notif)
                                <div id="pelaporNotifItem-{{ $notif->id_laporan }}" onclick="openTicketDetailAndMarkRead({{ $notif->id_laporan }}, @js($notif))" class="block p-3.5 hover:bg-slate-50/90 transition-colors group cursor-pointer bg-emerald-50/20">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5 border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-0.5">
                                                <div class="flex items-center space-x-1.5 truncate">
                                                    <span class="text-xs font-bold text-slate-900 truncate">{{ $notif->facility->nama_fasilitas ?? 'Fasilitas' }}</span>
                                                    <span class="unread-notif-dot w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                                </div>
                                                <span class="text-[10px] text-slate-400 shrink-0 ml-1">{{ $notif->updated_at ? $notif->updated_at->diffForHumans() : 'Selesai' }}</span>
                                            </div>
                                            <p class="text-[11px] text-slate-600 leading-snug line-clamp-2">
                                                Perbaikan kerusakan telah selesai ditangani oleh <strong class="text-slate-800">{{ $notif->technician->nama ?? 'Petugas Teknisi' }}</strong>.
                                            </p>
                                            <div class="mt-2 flex items-center text-[10px] font-bold text-emerald-600 group-hover:text-emerald-700">
                                                <span>Lihat Bukti Hasil Perbaikan &rarr;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-700 mb-1">Belum Ada Tugas Selesai</p>
                                    <p class="text-[11px] text-slate-400 max-w-[220px] mx-auto">Notifikasi hanya muncul saat teknisi telah menyelesaikan perbaikan fasilitas yang Anda laporkan.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('pelapor.tickets') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                Lihat Semua Tiket & Riwayat &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Avatar Profile Info with Dropdown Toggle -->
                <div class="relative pl-3 border-l border-slate-200" id="pelaporProfileContainer">
                    <button type="button" onclick="togglePelaporProfileDropdown()" class="flex items-center space-x-3 focus:outline-none cursor-pointer group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $user->nama ?? 'Pelapor' }}</p>
                            <p class="text-[11px] text-slate-500 font-semibold">{{ (str_contains(strtolower($user->nama ?? ''), 'guru') || str_contains(strtolower($user->email ?? ''), 'guru')) ? 'Guru Sekolah' : 'Siswa' }}</p>
                        </div>
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm sm:text-base flex items-center justify-center border border-blue-200 shadow-xs shrink-0 group-hover:ring-2 group-hover:ring-blue-400 transition-all">
                            {{ strtoupper(substr($user->nama ?? 'P', 0, 1)) }}
                        </div>
                    </button>

                    <!-- Profile Popover / Dropdown Menu -->
                    <div id="pelaporProfileDropdown" class="hidden absolute right-0 mt-2.5 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in duration-150">
                        <div class="px-4 py-2.5 border-b border-slate-100">
                            <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->nama ?? 'Pelapor' }}</p>
                            <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">{{ $user->email ?? '' }}</p>
                            <span class="inline-block mt-1.5 px-2 py-0.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-md">
                                {{ (str_contains(strtolower($user->nama ?? ''), 'guru') || str_contains(strtolower($user->email ?? ''), 'guru')) ? 'Guru Sekolah' : 'Siswa' }}
                            </span>
                        </div>
                        <div class="p-1.5">
                            <a href="{{ route('settings.security') }}" class="flex items-center space-x-2.5 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 rounded-xl transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Pengaturan Akun</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-2.5 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Content with Mobile Bottom Clearance -->
        <div class="flex-1 overflow-auto p-4 md:p-8 pb-24 md:pb-8">
            <div class="max-w-6xl mx-auto">

                <!-- Header Section -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Tiket & Work Order (WO)</h1>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">Tracking System</span>
                        </div>
                        <p class="text-xs text-gray-500 font-medium">Pantau linimasa pelacakan riwayat pekerjaan lapangan (Alur 4 Tahap & 5 Tahap RAB) serta komparasi foto Sebelum & Sesudah.</p>
                    </div>
                    <a href="{{ route('pelapor.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all self-start sm:self-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Buat Laporan Baru</span>
                    </a>
                </div>

                <!-- Search & Filter Bar -->
                <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shadow-xs">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari ID tiket (Cth: TKT 0600), fasilitas, atau kata kunci..." class="w-full bg-gray-50/70 border-none rounded-xl py-2.5 pl-10 pr-4 text-xs sm:text-sm focus:ring-2 focus:ring-blue-500 placeholder-gray-400 font-medium" onkeyup="filterTickets()">
                    </div>
                    <div class="flex gap-2 overflow-x-auto">
                        <button onclick="filterByStatus('Semua')" class="filter-btn active px-3.5 py-2 text-xs font-bold rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition-colors whitespace-nowrap shadow-xs">Semua</button>
                        <button onclick="filterByStatus('Sedang Berjalan')" class="filter-btn px-3.5 py-2 text-xs font-bold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors whitespace-nowrap flex items-center gap-1.5">
                            <span>Sedang Berjalan</span>
                            @if(($ongoingCount ?? 0) > 0)
                                <span class="px-1.5 py-0.2 bg-blue-600 text-white rounded-full text-[10px] font-extrabold">{{ $ongoingCount }}</span>
                            @endif
                        </button>
                        <button onclick="filterByStatus('Selesai')" class="filter-btn px-3.5 py-2 text-xs font-bold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors whitespace-nowrap">Selesai</button>
                    </div>
                </div>

                <!-- Tickets Grid -->
                <div id="ticketsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    
                    @forelse($tickets as $ticket)
                    @php
                        $urgency = strtolower($ticket->tingkat_urgensi ?? 'sedang');
                        $isHigh = ($urgency === 'tinggi') || !empty($ticket->verification?->budgetProposal);
                        $status = $ticket->status_laporan;

                        // Calculate stage and percentage
                        if ($isHigh) {
                            $totalSteps = 5;
                            if ($status === 'selesai') {
                                $currentStep = 5;
                                $stepLabel = 'Tahap 5/5: Perbaikan Selesai';
                                $progressPercent = 100;
                            } elseif (in_array($status, ['proses', 'proses_perbaikan'])) {
                                $currentStep = 4;
                                $stepLabel = 'Tahap 4/5: Pengerjaan Fisik';
                                $progressPercent = 80;
                            } elseif ($status === 'menunggu_rab') {
                                $currentStep = 3;
                                $stepLabel = 'Tahap 3/5: Persetujuan RAB';
                                $progressPercent = 60;
                            } elseif ($ticket->technician_read_at) {
                                $currentStep = 2;
                                $stepLabel = 'Tahap 2/5: Inspeksi Teknisi';
                                $progressPercent = 40;
                            } else {
                                $currentStep = 1;
                                $stepLabel = 'Tahap 1/5: Laporan Terkirim';
                                $progressPercent = 20;
                            }
                        } else {
                            $totalSteps = 4;
                            if ($status === 'selesai') {
                                $currentStep = 4;
                                $stepLabel = 'Tahap 4/4: Perbaikan Selesai';
                                $progressPercent = 100;
                            } elseif (in_array($status, ['proses', 'proses_perbaikan'])) {
                                $currentStep = 3;
                                $stepLabel = 'Tahap 3/4: Pengerjaan Fisik';
                                $progressPercent = 75;
                            } elseif ($ticket->technician_read_at) {
                                $currentStep = 2;
                                $stepLabel = 'Tahap 2/4: Dibaca Teknisi';
                                $progressPercent = 50;
                            } else {
                                $currentStep = 1;
                                $stepLabel = 'Tahap 1/4: Laporan Terkirim';
                                $progressPercent = 25;
                            }
                        }

                        $urgencyBadge = match($urgency) {
                            'tinggi' => '<span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-700 border border-rose-200"><svg class="w-2 h-2 text-rose-500 fill-current shrink-0" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg><span>Tinggi (5 Tahap RAB)</span></span>',
                            'sedang' => '<span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-200"><svg class="w-2 h-2 text-amber-500 fill-current shrink-0" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg><span>Sedang (4 Tahap)</span></span>',
                            'darurat' => '<span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-red-100 text-red-700 border border-red-200 animate-pulse"><svg class="w-2.5 h-2.5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg><span>Darurat</span></span>',
                            default => '<span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200"><svg class="w-2 h-2 text-emerald-500 fill-current shrink-0" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg><span>Rendah (4 Tahap)</span></span>',
                        };

                        $statusColors = [
                            'menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'proses' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'proses_perbaikan' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'menunggu_rab' => 'bg-purple-50 text-purple-700 border-purple-200',
                            'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'darurat' => 'bg-red-50 text-red-700 border-red-200'
                        ];
                        $statusColor = $statusColors[$ticket->status_laporan] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                        $woFoto = $ticket->verification?->workOrder?->foto_after;
                    @endphp
                    <div class="ticket-card bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-xs hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-all duration-200 cursor-pointer group flex flex-col justify-between" 
                         onclick="openTicketDetail({{ $ticket->id_laporan }})"
                         data-status="{{ $ticket->status_laporan }}"
                         data-search="{{ strtolower('tkt ' . str_pad($ticket->id_laporan, 4, '0', STR_PAD_LEFT) . ' tkt-' . str_pad($ticket->id_laporan, 4, '0', STR_PAD_LEFT) . ' ' . $ticket->id_laporan . ' ' . ($ticket->facility->nama_fasilitas ?? '') . ' ' . ($ticket->facility->lokasi_detail ?? '') . ' ' . ($ticket->technician->nama ?? '') . ' ' . $ticket->deskripsi_kerusakan) }}">
                        
                        <!-- Ticket Header -->
                        <div class="p-5 border-b border-gray-100">
                            <div class="flex justify-between items-start mb-2.5 gap-2 flex-wrap">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-xs font-extrabold text-blue-900 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100/80">TKT {{ str_pad($ticket->id_laporan, 4, '0', STR_PAD_LEFT) }}</span>
                                    {!! $urgencyBadge !!}
                                </div>
                                <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider border {{ $statusColor }} shrink-0">
                                    {{ str_replace('_', ' ', ucfirst($ticket->status_laporan)) }}
                                </span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-1 truncate group-hover:text-blue-600 transition-colors">{{ $ticket->facility->nama_fasilitas ?? 'Fasilitas' }}</h3>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-3">{{ $ticket->deskripsi_kerusakan }}</p>

                            <!-- Tracking Progress Indicator on Card -->
                            <div class="p-2.5 bg-slate-50/90 rounded-xl border border-slate-100 space-y-1.5">
                                <div class="flex items-center justify-between text-[11px] font-bold">
                                    <span class="text-slate-800 flex items-center gap-1 truncate">
                                        <span class="w-2 h-2 rounded-full {{ $progressPercent === 100 ? 'bg-emerald-500' : 'bg-blue-600 animate-pulse' }} shrink-0"></span>
                                        <span class="truncate">{{ $stepLabel }}</span>
                                    </span>
                                    <span class="text-slate-500 text-[10px] font-extrabold shrink-0 ml-1">{{ $progressPercent }}%</span>
                                </div>
                                <div class="w-full bg-slate-200/80 h-1.5 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-500 {{ $progressPercent === 100 ? 'bg-emerald-500' : 'bg-blue-600' }}" style="width: {{ $progressPercent }}%"></div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mt-3 pt-3 border-t border-gray-100 text-xs">
                                @if($ticket->category)
                                    <span class="bg-slate-100 text-slate-700 font-semibold px-2 py-0.5 rounded text-[10px]">
                                        {{ $ticket->category->name }}
                                    </span>
                                @endif
                                @if($ticket->technician)
                                    <span class="text-gray-500 text-[11px] truncate flex items-center gap-1">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Teknisi: <strong class="text-gray-800">{{ $ticket->technician->nama }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Ticket Body Info with Before/After indicators -->
                        <div class="p-4 bg-gray-50/50 space-y-2">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ $ticket->created_at->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $ticket->foto_bukti ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-400' }}">
                                    Foto Sebelum: {{ $ticket->foto_bukti ? 'Tersedia' : '-' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center min-w-0">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate">{{ $ticket->facility->lokasi_detail ?? 'Lokasi tidak tersedia' }}</span>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $woFoto ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-400' }}">
                                    Foto Sesudah: {{ $woFoto ? 'Tersedia' : ($ticket->status_laporan === 'selesai' ? '-' : 'Menunggu Selesai') }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="px-4 py-2.5 bg-blue-50/40 border-t border-blue-50/60 flex items-center justify-between text-xs font-semibold text-blue-700 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                <span>Lihat Tracking Linimasa & Foto</span>
                            </span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>

                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Tiket</h3>
                        <p class="text-sm text-gray-500">Anda belum memiliki laporan tiket.</p>
                    </div>
                    @endforelse

                </div>

                <!-- No Results Message -->
                <div id="noResults" class="hidden text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak Ada Hasil</h3>
                    <p class="text-sm text-gray-500">Coba kata kunci atau filter lain.</p>
                </div>

            </div>
            
            <footer class="mt-12 text-center text-[11px] font-medium text-gray-400 border-t border-gray-100 pt-6 pb-4">
                &copy; {{ date('Y') }} SIPERFAS - Sistem Informasi Pelaporan Fasilitas. All rights reserved.
            </footer>
        </div>
    </main>

    <!-- Modal Detail Tiket & Tracking Interaktif -->
    <div id="ticketModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background Overlay (Strictly behind modal) -->
        <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-xs transition-opacity" onclick="closeTicketDetail()"></div>

        <!-- Centered Modal Wrapper -->
        <div class="relative min-h-screen flex items-center justify-center p-3 sm:p-6 z-10 pointer-events-none">
            <!-- Modal Content Card: Solid White, Crisp, No Fog/Blur -->
            <div class="relative w-full max-w-4xl bg-white rounded-3xl shadow-2xl border border-slate-200 pointer-events-auto my-6 flex flex-col max-h-[92vh] overflow-hidden animate-in fade-in zoom-in-95 duration-150">
                
                <!-- Modal Top Header -->
                <div class="shrink-0 bg-white px-6 sm:px-8 py-5 border-b border-slate-100 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center font-black text-sm border border-blue-100 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900" id="modal-ticket-id">Detail Tiket</h3>
                                <span id="modal-status-badge" class="text-xs font-bold px-2.5 py-0.5 rounded-full border"></span>
                                <span id="modal-urgency-badge" class="text-xs font-bold px-2.5 py-0.5 rounded-full border"></span>
                            </div>
                            <p class="text-xs text-slate-500 mt-0.5">Rincian formulir laporan pelapor, dokumentasi perbaikan teknisi, dan linimasa pelacakan.</p>
                        </div>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-700 hover:bg-slate-100 p-2 rounded-xl transition-colors cursor-pointer" onclick="closeTicketDetail()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Scrollable Body -->
                <div class="flex-1 overflow-y-auto p-6 sm:p-8 space-y-6 bg-slate-50/50">
                    
                    <!-- 1. Linimasa Pelacakan Progres Laporan (Real-time Stepper) -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse"></span>
                                <h4 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">Linimasa Progres Pelacakan</h4>
                            </div>
                            <span class="text-[11px] text-slate-500 font-medium" id="modal-tracking-summary">Diperbarui otomatis oleh sistem</span>
                        </div>

                        <!-- Flow Distinction Banner (4 Tahap vs 5 Tahap RAB) -->
                        <div id="modal-flow-banner" class="mb-4"></div>

                        <!-- 4 or 5-Stage Stepper Grid -->
                        <div id="tracking-stepper-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 relative">
                            
                            <!-- Step 1: Terkirim -->
                            <div class="p-3.5 rounded-xl border relative overflow-hidden transition-all" id="step-1-card">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold" id="step-1-icon">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tahap 1</span>
                                </div>
                                <h5 class="text-xs font-bold text-slate-800 leading-tight mb-1">Laporan Terkirim</h5>
                                <p class="text-[11px] text-slate-600 font-medium leading-snug mb-1" id="step-1-desc">Laporan masuk sistem</p>
                                <span class="text-[10px] text-slate-400 font-semibold block" id="step-1-time">-</span>
                            </div>

                            <!-- Step 2: Dibaca Teknisi -->
                            <div class="p-3.5 rounded-xl border relative overflow-hidden transition-all" id="step-2-card">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold" id="step-2-icon"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tahap 2</span>
                                </div>
                                <h5 class="text-xs font-bold text-slate-800 leading-tight mb-1">Dibaca Teknisi</h5>
                                <p class="text-[11px] text-slate-600 font-medium leading-snug mb-1" id="step-2-desc">Menunggu dibaca</p>
                                <span class="text-[10px] text-slate-400 font-semibold block" id="step-2-time">-</span>
                            </div>

                            <!-- Step 3: Persetujuan RAB (Khusus Urgensi Tinggi) -->
                            <div class="p-3.5 rounded-xl border relative overflow-hidden transition-all hidden" id="step-rab-card">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold" id="step-rab-icon"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-purple-700 bg-purple-100/70 px-1.5 py-0.5 rounded" id="step-rab-badge">Tahap 3</span>
                                </div>
                                <h5 class="text-xs font-bold text-slate-800 leading-tight mb-1">Persetujuan RAB</h5>
                                <p class="text-[11px] text-slate-600 font-medium leading-snug mb-1" id="step-rab-desc">Menunggu persetujuan</p>
                                <span class="text-[10px] text-slate-400 font-semibold block" id="step-rab-time">-</span>
                            </div>

                            <!-- Step Pengerjaan Fisik (Tahap 3 biasa / Tahap 4 saat Urgensi Tinggi) -->
                            <div class="p-3.5 rounded-xl border relative overflow-hidden transition-all" id="step-3-card">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold" id="step-3-icon"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400" id="step-3-badge">Tahap 3</span>
                                </div>
                                <h5 class="text-xs font-bold text-slate-800 leading-tight mb-1">Pengerjaan Fisik</h5>
                                <p class="text-[11px] text-slate-600 font-medium leading-snug mb-1" id="step-3-desc">Menunggu giliran</p>
                                <span class="text-[10px] text-slate-400 font-semibold block" id="step-3-time">-</span>
                            </div>

                            <!-- Step Perbaikan Selesai (Tahap 4 biasa / Tahap 5 saat Urgensi Tinggi) -->
                            <div class="p-3.5 rounded-xl border relative overflow-hidden transition-all" id="step-4-card">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold" id="step-4-icon"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400" id="step-4-badge">Tahap 4</span>
                                </div>
                                <h5 class="text-xs font-bold text-slate-800 leading-tight mb-1">Perbaikan Selesai</h5>
                                <p class="text-[11px] text-slate-600 font-medium leading-snug mb-1" id="step-4-desc">Menunggu perbaikan</p>
                                <span class="text-[10px] text-slate-400 font-semibold block" id="step-4-time">-</span>
                            </div>

                        </div>

                        <!-- RAB Status & Breakdown Card (Khusus Urgensi Tinggi) -->
                        <div id="modal-rab-detail-box" class="mt-4 pt-4 border-t border-slate-100 hidden">
                            <div class="p-4 rounded-2xl bg-purple-50/50 border border-purple-200/70">
                                <div class="flex items-center justify-between mb-2 flex-wrap gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-lg bg-purple-600 text-white flex items-center justify-center text-[10px] font-black shadow-xs">RAB</span>
                                        <h5 class="text-xs font-bold text-purple-950">Pengajuan Anggaran Biaya (RAB) ke Admin Sarpras</h5>
                                    </div>
                                    <span id="rab-approval-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"></span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs mt-3">
                                    <div class="bg-white/90 p-3 rounded-xl border border-purple-100 shadow-2xs">
                                        <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Estimasi Biaya Diajukan</span>
                                        <span id="rab-cost-amount" class="text-sm font-extrabold text-purple-900 mt-0.5 block">-</span>
                                    </div>
                                    <div class="bg-white/90 p-3 rounded-xl border border-purple-100 shadow-2xs">
                                        <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Status Verifikasi Sarpras</span>
                                        <span id="rab-admin-status" class="font-bold text-slate-800 text-xs mt-0.5 block">-</span>
                                    </div>
                                </div>
                                <div id="rab-notes-container" class="mt-2.5 bg-white/90 p-3 rounded-xl border border-purple-100 text-xs shadow-2xs">
                                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block mb-1">Catatan Persetujuan / Revisi Admin Sarpras</span>
                                    <p id="rab-notes-text" class="text-slate-700 font-semibold leading-relaxed text-xs">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Dua Kolom Komparasi: Laporan Pelapor (Sebelum) vs Penanganan Teknisi (Sesudah) -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- KOLOM KIRI: Laporan Asli dari Pelapor (Kondisi Awal) -->
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </span>
                                        <div>
                                            <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Laporan Pengajuan Pelapor</h4>
                                            <p class="text-[11px] text-slate-400 font-medium">Data formulir & bukti kondisi awal</p>
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 uppercase">Kondisi Awal</span>
                                </div>

                                <!-- Detail Form Pelapor -->
                                <div class="space-y-3 text-xs mb-4">
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 space-y-2">
                                        <div class="flex justify-between items-start gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Nama Fasilitas:</span>
                                            <span class="font-bold text-slate-900 text-right" id="modal-facility">-</span>
                                        </div>
                                        <div class="flex justify-between items-start gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Lokasi / Ruangan:</span>
                                            <span class="font-bold text-slate-700 text-right" id="modal-location">-</span>
                                        </div>
                                        <div class="flex justify-between items-center gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Kategori:</span>
                                            <span class="font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded text-[11px]" id="modal-category">-</span>
                                        </div>
                                        <div class="flex justify-between items-center gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Waktu Lapor:</span>
                                            <span class="font-semibold text-slate-600" id="modal-date">-</span>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="text-slate-400 font-semibold block mb-1">Deskripsi Masalah / Keluhan:</span>
                                        <div class="bg-amber-50/50 p-3 rounded-xl border border-amber-200/60 text-xs text-amber-950 font-medium leading-relaxed" id="modal-description">
                                            -
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Bukti dari Pelapor -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Foto Bukti Pelapor (Sebelum)
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-medium">Klik untuk perbesar</span>
                                </div>

                                <div id="container-photo-before" class="relative rounded-xl overflow-hidden bg-slate-100 border border-slate-200 min-h-[170px] flex items-center justify-center group cursor-pointer" onclick="zoomPhoto('before')">
                                    <img id="img-photo-before" src="" alt="Foto Bukti Pelapor" class="w-full h-48 object-cover hidden">
                                    
                                    <!-- Zoom Hover Overlay -->
                                    <div id="overlay-photo-before" class="hidden absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-1.5 backdrop-blur-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        <span>Perbesar Foto Bukti</span>
                                    </div>

                                    <!-- Empty Placeholder -->
                                    <div id="empty-photo-before" class="p-5 text-center text-slate-400">
                                        <svg class="w-9 h-9 mx-auto mb-1.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-xs font-bold text-slate-500">Tidak ada lampiran foto bukti</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">Pelapor membuat laporan ini tanpa mengunggah foto</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KOLOM KANAN: Dokumentasi & Hasil Kerja Teknisi (Kondisi Sesudah) -->
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </span>
                                        <div>
                                            <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Dokumentasi & Tindakan Teknisi</h4>
                                            <p class="text-[11px] text-slate-400 font-medium">Penanganan petugas & foto hasil kerja</p>
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 uppercase">Kondisi Sesudah</span>
                                </div>

                                <!-- Detail Teknisi -->
                                <div class="space-y-3 text-xs mb-4">
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 space-y-2">
                                        <div class="flex justify-between items-center gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Teknisi Bertugas:</span>
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900" id="modal-technician">-</div>
                                        </div>
                                        <div class="flex justify-between items-center gap-2">
                                            <span class="text-slate-400 font-semibold shrink-0">Status Pengerjaan:</span>
                                            <span class="font-bold" id="modal-action-status">-</span>
                                        </div>
                                    </div>

                                    <!-- Catatan Tindakan Teknisi -->
                                    <div>
                                        <span class="text-slate-400 font-semibold block mb-1">Catatan Tindakan / Inspeksi:</span>
                                        <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100 text-xs text-blue-950 font-medium leading-relaxed" id="modal-technician-notes">
                                            Belum ada catatan tindakan dari teknisi.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Hasil Perbaikan dari Teknisi -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Foto Hasil Perbaikan (Sesudah)
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-medium">Klik untuk perbesar</span>
                                </div>

                                <div id="container-photo-after" class="relative rounded-xl overflow-hidden bg-slate-100 border border-slate-200 min-h-[170px] flex items-center justify-center group cursor-pointer" onclick="zoomPhoto('after')">
                                    <img id="img-photo-after" src="" alt="Foto Hasil Perbaikan" class="w-full h-48 object-cover hidden">
                                    
                                    <!-- Zoom Hover Overlay -->
                                    <div id="overlay-photo-after" class="hidden absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-1.5 backdrop-blur-xs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        <span>Perbesar Foto Hasil</span>
                                    </div>

                                    <!-- Empty Placeholder -->
                                    <div id="empty-photo-after" class="p-5 text-center text-slate-400">
                                        <svg class="w-9 h-9 mx-auto mb-1.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-xs font-bold text-slate-500" id="empty-photo-after-title">Menunggu dokumentasi teknisi</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5" id="empty-photo-after-desc">Foto hasil perbaikan akan diunggah setelah perbaikan selesai dilakukan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="shrink-0 bg-white px-6 sm:px-8 py-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-400 font-medium hidden sm:inline">SIPERFAS - Sistem Informasi Pelaporan Fasilitas</span>
                    <button type="button" class="px-5 py-2 text-sm font-bold text-slate-700 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors cursor-pointer ml-auto" onclick="closeTicketDetail()">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Lightbox Zoom Modal (Untuk Foto Sebelum & Sesudah) -->
    <div id="imageZoomModal" class="fixed inset-0 z-60 overflow-hidden hidden" aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity" onclick="closeImageZoom()"></div>
            <div class="relative inline-block max-w-4xl w-full bg-slate-900 rounded-3xl overflow-hidden shadow-2xl z-10 border border-slate-800">
                <div class="p-4 flex items-center justify-between border-b border-slate-800 text-white">
                    <span class="text-sm font-bold tracking-wide" id="zoom-title">Foto Dokumentasi</span>
                    <button type="button" onclick="closeImageZoom()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-slate-800 transition-colors cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-4 flex items-center justify-center bg-black/50 max-h-[75vh]">
                    <img id="zoom-img" src="" alt="Zoom Foto" class="max-h-[70vh] max-w-full object-contain rounded-xl">
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentFilter = 'Semua';

        // Data tiket lengkap yang disiapkan secara terstruktur
        const ticketsData = Object.assign(
            {},
            @json(($pelaporNotifications ?? collect())->keyBy('id_laporan')),
            @json($tickets->keyBy('id_laporan'))
        );

        let currentActiveTicket = null;

        // Filter by status
        function filterByStatus(status) {
            currentFilter = status;
            
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            });
            event.target.classList.remove('bg-gray-100', 'text-gray-700');
            event.target.classList.add('active', 'bg-blue-600', 'text-white');
            
            filterTickets();
        }

        // Search and filter tickets
        function filterTickets() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.ticket-card');
            let visibleCount = 0;
            const filterNorm = currentFilter.toLowerCase();

            cards.forEach(card => {
                const status = (card.getAttribute('data-status') || '').toLowerCase();
                const searchData = card.getAttribute('data-search') || '';
                
                let matchesStatus = false;
                if (filterNorm === 'semua') {
                    matchesStatus = true;
                } else if (filterNorm === 'sedang berjalan' || filterNorm === 'diproses') {
                    matchesStatus = ['menunggu', 'proses', 'proses_perbaikan', 'menunggu_rab', 'darurat'].includes(status);
                } else if (filterNorm === 'selesai') {
                    matchesStatus = (status === 'selesai');
                } else {
                    matchesStatus = (status === filterNorm);
                }
                
                const matchesSearch = !searchTerm || searchData.includes(searchTerm);

                if (matchesStatus && matchesSearch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('noResults').classList.toggle('hidden', visibleCount > 0);
            document.getElementById('ticketsGrid').classList.toggle('hidden', visibleCount === 0);
        }

        function formatDateTimeID(dateStr) {
            if (!dateStr) return null;
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return null;
            return d.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }) + ' WIB';
        }

        // Buka modal detail tiket lengkap
        function openTicketDetail(ticketIdOrData, fallbackData) {
            try {
                let ticket;
                if (typeof ticketIdOrData === 'object' && ticketIdOrData !== null) {
                    ticket = ticketIdOrData;
                } else if (ticketsData && ticketsData[ticketIdOrData]) {
                    ticket = ticketsData[ticketIdOrData];
                } else if (fallbackData) {
                    ticket = fallbackData;
                }
                if (!ticket) {
                    console.warn('Data tiket tidak ditemukan untuk ID:', ticketIdOrData);
                    return;
                }

                currentActiveTicket = ticket;
                const wo = ticket.verification ? (ticket.verification.work_order || ticket.verification.workOrder) : null;
                const fotoAfter = wo ? wo.foto_after : null;

                // 1. Header Information
                const tktNumber = String(ticket.id_laporan).padStart(4, '0');
                const tktIdEl = document.getElementById('modal-ticket-id');
                if (tktIdEl) tktIdEl.textContent = `Tiket #TKT-${tktNumber}`;
                
                // Status Badge
                const statusBadge = document.getElementById('modal-status-badge');
                if (statusBadge) {
                    const cleanStatus = (ticket.status_laporan || '').replace('_', ' ');
                    statusBadge.textContent = cleanStatus.charAt(0).toUpperCase() + cleanStatus.slice(1);
                    
                    const statusStyles = {
                        'menunggu': 'bg-amber-50 text-amber-700 border-amber-200',
                        'proses': 'bg-blue-50 text-blue-700 border-blue-200',
                        'proses_perbaikan': 'bg-blue-50 text-blue-700 border-blue-200',
                        'diproses': 'bg-blue-50 text-blue-700 border-blue-200',
                        'menunggu_rab': 'bg-purple-50 text-purple-700 border-purple-200',
                        'selesai': 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        'darurat': 'bg-red-50 text-red-700 border-red-200'
                    };
                    statusBadge.className = `text-xs font-bold px-2.5 py-0.5 rounded-full border ${statusStyles[ticket.status_laporan] || 'bg-gray-100 text-gray-700 border-gray-200'}`;
                }

                // Urgency Badge
                const urgBadge = document.getElementById('modal-urgency-badge');
                const urg = (ticket.tingkat_urgensi || 'Sedang').toLowerCase();
                if (urgBadge) {
                    const urgStyles = {
                        'darurat': 'bg-red-50 text-red-700 border-red-200',
                        'tinggi': 'bg-amber-50 text-amber-700 border-amber-200',
                        'sedang': 'bg-blue-50 text-blue-700 border-blue-200',
                        'rendah': 'bg-slate-100 text-slate-700 border-slate-200'
                    };
                    urgBadge.textContent = `Urgensi: ${urg.charAt(0).toUpperCase() + urg.slice(1)}`;
                    urgBadge.className = `text-xs font-bold px-2.5 py-0.5 rounded-full border ${urgStyles[urg] || 'bg-slate-100 text-slate-700 border-slate-200'}`;
                }

                // 2. Formulir Data Laporan
                const facEl = document.getElementById('modal-facility');
                if (facEl) facEl.textContent = ticket.facility?.nama_fasilitas || 'Fasilitas Tidak Diketahui';

                const locEl = document.getElementById('modal-location');
                if (locEl) locEl.textContent = ticket.facility?.lokasi_detail || 'Lokasi tidak tersedia';

                const catEl = document.getElementById('modal-category');
                if (catEl) catEl.textContent = ticket.category?.name || ticket.facility?.kategori_area || 'Umum';
                
                const techName = ticket.technician?.nama || 'Petugas Umum Sarpras';
                const techEl = document.getElementById('modal-technician');
                if (techEl) {
                    techEl.innerHTML = `
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] font-bold shrink-0">
                            ${techName.charAt(0)}
                        </span>
                        <span>${techName}</span>
                    `;
                }

                const createdTime = formatDateTimeID(ticket.created_at || ticket.tanggal_waktu);
                const dateEl = document.getElementById('modal-date');
                if (dateEl) dateEl.textContent = createdTime || '-';

                const descEl = document.getElementById('modal-description');
                if (descEl) descEl.textContent = ticket.deskripsi_kerusakan || '-';

                // 3. Status Stepper Tracking Timeline
                renderTrackingTimeline(ticket, wo);

                // 4. Dokumentasi Foto Sebelum & Sesudah
                // Foto Sebelum (Pelapor)
                const imgBefore = document.getElementById('img-photo-before');
                const overlayBefore = document.getElementById('overlay-photo-before');
                const emptyBefore = document.getElementById('empty-photo-before');
                if (imgBefore && overlayBefore && emptyBefore) {
                    if (ticket.foto_bukti) {
                        imgBefore.src = `/storage/${ticket.foto_bukti}`;
                        imgBefore.classList.remove('hidden');
                        overlayBefore.classList.remove('hidden');
                        emptyBefore.classList.add('hidden');
                    } else {
                        imgBefore.src = '';
                        imgBefore.classList.add('hidden');
                        overlayBefore.classList.add('hidden');
                        emptyBefore.classList.remove('hidden');
                    }
                }

                // Foto Sesudah (Teknisi)
                const imgAfter = document.getElementById('img-photo-after');
                const overlayAfter = document.getElementById('overlay-photo-after');
                const emptyAfter = document.getElementById('empty-photo-after');
                const emptyAfterTitle = document.getElementById('empty-photo-after-title');
                const emptyAfterDesc = document.getElementById('empty-photo-after-desc');

                if (imgAfter && overlayAfter && emptyAfter) {
                    if (fotoAfter) {
                        imgAfter.src = `/storage/${fotoAfter}`;
                        imgAfter.classList.remove('hidden');
                        overlayAfter.classList.remove('hidden');
                        emptyAfter.classList.add('hidden');
                    } else {
                        imgAfter.src = '';
                        imgAfter.classList.add('hidden');
                        overlayAfter.classList.add('hidden');
                        emptyAfter.classList.remove('hidden');
                        
                        if (emptyAfterTitle && emptyAfterDesc) {
                            if (ticket.status_laporan === 'selesai') {
                                emptyAfterTitle.textContent = 'Perbaikan Selesai';
                                emptyAfterDesc.textContent = 'Tugas selesai tanpa lampiran foto dokumentasi penanganan teknisi.';
                            } else {
                                emptyAfterTitle.textContent = 'Menunggu Dokumentasi Teknisi';
                                emptyAfterDesc.textContent = 'Foto hasil perbaikan akan diunggah setelah teknisi menyelesaikan pekerjaan di lokasi.';
                            }
                        }
                    }
                }

                // Status Tindakan Teknisi
                const actionStatusEl = document.getElementById('modal-action-status');
                if (actionStatusEl) {
                    if (ticket.status_laporan === 'selesai') {
                        actionStatusEl.textContent = 'Perbaikan Selesai';
                        actionStatusEl.className = 'font-bold text-emerald-600';
                    } else if (['proses', 'proses_perbaikan', 'darurat'].includes(ticket.status_laporan)) {
                        actionStatusEl.textContent = 'Sedang Dikerjakan di Lokasi';
                        actionStatusEl.className = 'font-bold text-blue-600';
                    } else if (ticket.status_laporan === 'menunggu_rab') {
                        actionStatusEl.textContent = 'Pengajuan RAB Material';
                        actionStatusEl.className = 'font-bold text-purple-600';
                    } else {
                        actionStatusEl.textContent = 'Menunggu Konfirmasi Teknisi';
                        actionStatusEl.className = 'font-bold text-amber-600';
                    }
                }

                // Catatan Inspeksi / Tindakan Teknisi
                const techNotesText = document.getElementById('modal-technician-notes');
                if (techNotesText) {
                    const notes = ticket.verification?.catatan_inspeksi;
                    if (notes) {
                        techNotesText.textContent = notes;
                    } else {
                        techNotesText.textContent = 'Belum ada catatan tindakan dari teknisi.';
                    }
                }

                // Tampilkan Modal
                const modal = document.getElementById('ticketModal');
                if (modal) modal.classList.remove('hidden');
            } catch (err) {
                console.error('Error openTicketDetail:', err);
                const modal = document.getElementById('ticketModal');
                if (modal) modal.classList.remove('hidden');
            }
        }

        // Render Stepper Linimasa
        function renderTrackingTimeline(ticket, wo) {
            try {
                const status = ticket.status_laporan;
                const techName = ticket.technician?.nama || 'Teknisi Lapangan';
                const urgency = (ticket.tingkat_urgensi || '').toLowerCase();
                const proposal = ticket.verification?.budget_proposal || ticket.verification?.budgetProposal;
                const isHighUrgency = (urgency === 'tinggi') || !!proposal;
                const rabCost = proposal?.estimasi_biaya || proposal?.total_anggaran;

                const grid = document.getElementById('tracking-stepper-grid');
                const stepRabCard = document.getElementById('step-rab-card');
                const step3Badge = document.getElementById('step-3-badge');
                const step4Badge = document.getElementById('step-4-badge');

                // Flow banner & Summary Header
                const bannerEl = document.getElementById('modal-flow-banner');
                const summaryEl = document.getElementById('modal-tracking-summary');
                if (bannerEl) {
                    if (isHighUrgency) {
                        bannerEl.innerHTML = `
                            <div class="p-3.5 rounded-2xl bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200/80 flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 text-sm font-bold shadow-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="flex-1 text-xs">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="font-extrabold text-purple-900">Alur Sistem 5 Tahap (Urgensi Tinggi)</span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-200 text-purple-800">Butuh Pengajuan Biaya RAB</span>
                                    </div>
                                    <p class="text-purple-950/80 text-[11px] leading-relaxed">
                                        Kerusakan tingkat <strong>Tinggi</strong> memerlukan inspeksi teknisi dan pengajuan <strong>Rancangan Anggaran Biaya (RAB)</strong> ke Admin Sarpras. Pengerjaan fisik lapangan baru dimulai setelah admin menyetujui RAB (atau revisi jika ditolak).
                                    </p>
                                </div>
                            </div>
                        `;
                        if (summaryEl) summaryEl.textContent = 'Sistem 5 Tahap (Dengan Validasi & Persetujuan RAB Sarpras)';
                    } else {
                        bannerEl.innerHTML = `
                            <div class="p-3.5 rounded-2xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200/80 flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 text-sm font-bold shadow-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div class="flex-1 text-xs">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="font-extrabold text-blue-900">Alur Sistem 4 Tahap (Urgensi Rendah & Sedang)</span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Eksekusi Langsung</span>
                                    </div>
                                    <p class="text-blue-950/80 text-[11px] leading-relaxed">
                                        Kerusakan tingkat <strong>Rendah / Sedang</strong> dapat langsung dikerjakan oleh petugas teknisi terkait tanpa memerlukan pengajuan RAB khusus ke Admin Sarpras.
                                    </p>
                                </div>
                            </div>
                        `;
                        if (summaryEl) summaryEl.textContent = 'Sistem 4 Tahap (Penanganan Cepat Langsung Tanpa RAB)';
                    }
                }

                // Sesuaikan kolom grid & nomor tahap berdasarkan urgensi
                if (grid) {
                    if (isHighUrgency) {
                        grid.classList.remove('lg:grid-cols-4');
                        grid.classList.add('lg:grid-cols-5');
                    } else {
                        grid.classList.remove('lg:grid-cols-5');
                        grid.classList.add('lg:grid-cols-4');
                    }
                }

                if (step3Badge) {
                    step3Badge.textContent = isHighUrgency ? 'Tahap 4' : 'Tahap 3';
                }
                if (step4Badge) {
                    step4Badge.textContent = isHighUrgency ? 'Tahap 5' : 'Tahap 4';
                }

                // 1. Step 1: Laporan Terkirim
                const step1Card = document.getElementById('step-1-card');
                const step1Icon = document.getElementById('step-1-icon');
                const step1Time = document.getElementById('step-1-time');
                const step1Desc = document.getElementById('step-1-desc');

                if (step1Card) step1Card.className = 'p-3.5 rounded-xl border border-emerald-200 shadow-xs relative overflow-hidden bg-emerald-50/20';
                if (step1Icon) {
                    step1Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-emerald-100 text-emerald-700';
                    step1Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`;
                }
                if (step1Desc) step1Desc.textContent = isHighUrgency ? 'Laporan kerusakan berat terkirim' : 'Laporan berhasil dibuat';
                if (step1Time) step1Time.textContent = formatDateTimeID(ticket.created_at || ticket.tanggal_waktu) || 'Terkirim';

                // 2. Step 2: Dibaca / Diinspeksi Teknisi
                const step2Card = document.getElementById('step-2-card');
                const step2Icon = document.getElementById('step-2-icon');
                const step2Time = document.getElementById('step-2-time');
                const step2Desc = document.getElementById('step-2-desc');

                const isRead = ticket.technician_read_at || ['proses', 'proses_perbaikan', 'menunggu_rab', 'selesai'].includes(status);

                if (isRead) {
                    if (step2Card) step2Card.className = 'p-3.5 rounded-xl border border-emerald-200 shadow-xs relative overflow-hidden bg-emerald-50/20';
                    if (step2Icon) {
                        step2Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-emerald-100 text-emerald-700';
                        step2Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>`;
                    }
                    if (step2Desc) step2Desc.textContent = isHighUrgency ? `Inspeksi lapangan oleh ${techName}` : `Dibaca oleh ${techName}`;
                    if (step2Time) step2Time.textContent = formatDateTimeID(ticket.technician_read_at) || 'Telah ditinjau';
                } else {
                    if (step2Card) step2Card.className = 'p-3.5 rounded-xl border border-slate-200 shadow-xs relative overflow-hidden bg-white';
                    if (step2Icon) {
                        step2Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-slate-100 text-slate-400';
                        step2Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                    }
                    if (step2Desc) step2Desc.textContent = isHighUrgency ? `Menunggu inspeksi ${techName}` : `Menunggu dibaca ${techName}`;
                    if (step2Time) step2Time.textContent = 'Dalam antrean';
                }

                // 3. Step RAB: Persetujuan RAB (Tahap 3 Khusus Urgensi Tinggi)
                if (isHighUrgency && stepRabCard) {
                    stepRabCard.classList.remove('hidden');
                    const stepRabIcon = document.getElementById('step-rab-icon');
                    const stepRabTime = document.getElementById('step-rab-time');
                    const stepRabDesc = document.getElementById('step-rab-desc');

                    const isRabApproved = (proposal && proposal.status_persetujuan === 'disetujui') || ['proses', 'proses_perbaikan', 'selesai'].includes(status);
                    const isRabRejected = (proposal && proposal.status_persetujuan === 'ditolak');

                    if (isRabApproved) {
                        stepRabCard.className = 'p-3.5 rounded-xl border border-emerald-200 shadow-xs relative overflow-hidden bg-emerald-50/20';
                        if (stepRabIcon) {
                            stepRabIcon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-emerald-100 text-emerald-700';
                            stepRabIcon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`;
                        }
                        if (stepRabDesc) {
                            stepRabDesc.textContent = rabCost 
                                ? `Disetujui (Rp ${Number(rabCost).toLocaleString('id-ID')})`
                                : 'RAB Disetujui Admin Sarpras';
                        }
                        if (stepRabTime) stepRabTime.textContent = formatDateTimeID(proposal?.tanggal_persetujuan || proposal?.updated_at) || 'Telah disetujui';
                    } else if (isRabRejected) {
                        stepRabCard.className = 'p-3.5 rounded-xl border border-rose-200 shadow-xs relative overflow-hidden bg-rose-50/20';
                        if (stepRabIcon) {
                            stepRabIcon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-rose-100 text-rose-700';
                            stepRabIcon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`;
                        }
                        if (stepRabDesc) stepRabDesc.textContent = 'RAB ditolak / butuh revisi';
                        if (stepRabTime) stepRabTime.textContent = formatDateTimeID(proposal?.updated_at) || 'Ditolak Sarpras';
                    } else if (status === 'menunggu_rab' || (proposal && proposal.status_persetujuan === 'menunggu_persetujuan')) {
                        stepRabCard.className = 'p-3.5 rounded-xl border border-purple-200 shadow-xs relative overflow-hidden bg-purple-50/30';
                        if (stepRabIcon) {
                            stepRabIcon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-purple-600 text-white animate-pulse';
                            stepRabIcon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                        }
                        if (stepRabDesc) {
                            stepRabDesc.textContent = rabCost 
                                ? `Menunggu ACC (Rp ${Number(rabCost).toLocaleString('id-ID')})`
                                : 'Menunggu verifikasi biaya Admin';
                        }
                        if (stepRabTime) stepRabTime.textContent = formatDateTimeID(proposal?.tanggal_pengajuan || proposal?.created_at) || 'Ditinjau Sarpras';
                    } else {
                        // Belum diajukan
                        stepRabCard.className = 'p-3.5 rounded-xl border border-slate-200 shadow-xs relative overflow-hidden bg-white';
                        if (stepRabIcon) {
                            stepRabIcon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-slate-100 text-slate-400';
                            stepRabIcon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>`;
                        }
                        if (stepRabDesc) stepRabDesc.textContent = 'Menunggu pengajuan RAB';
                        if (stepRabTime) stepRabTime.textContent = 'Dalam antrean';
                    }
                } else if (stepRabCard) {
                    stepRabCard.classList.add('hidden');
                }

                // 4. Step Fisik: Pengerjaan Fisik (Tahap 3 biasa / Tahap 4 saat Urgensi Tinggi)
                const step3Card = document.getElementById('step-3-card');
                const step3Icon = document.getElementById('step-3-icon');
                const step3Time = document.getElementById('step-3-time');
                const step3Desc = document.getElementById('step-3-desc');

                if (status === 'selesai') {
                    if (step3Card) step3Card.className = 'p-3.5 rounded-xl border border-emerald-200 shadow-xs relative overflow-hidden bg-emerald-50/20';
                    if (step3Icon) {
                        step3Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-emerald-100 text-emerald-700';
                        step3Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`;
                    }
                    if (step3Desc) step3Desc.textContent = 'Pengerjaan tuntas';
                    if (step3Time) step3Time.textContent = formatDateTimeID(wo?.tanggal_mulai) || 'Selesai dikerjakan';
                } else if (['proses', 'proses_perbaikan', 'darurat'].includes(status)) {
                    if (step3Card) step3Card.className = 'p-3.5 rounded-xl border border-blue-300 shadow-xs relative overflow-hidden bg-blue-50/30';
                    if (step3Icon) {
                        step3Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-blue-600 text-white animate-pulse';
                        step3Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>`;
                    }
                    if (step3Desc) step3Desc.textContent = 'Sedang dikerjakan di lokasi';
                    if (step3Time) step3Time.textContent = formatDateTimeID(wo?.tanggal_mulai) || 'Sedang Berjalan';
                } else if (status === 'menunggu_rab' && !isHighUrgency) {
                    if (step3Card) step3Card.className = 'p-3.5 rounded-xl border border-purple-200 shadow-xs relative overflow-hidden bg-purple-50/30';
                    if (step3Icon) {
                        step3Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-purple-100 text-purple-700';
                        step3Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>`;
                    }
                    if (step3Desc) step3Desc.textContent = 'Pengajuan RAB Material';
                    if (step3Time) step3Time.textContent = 'Menunggu ACC Sarpras';
                } else {
                    if (step3Card) step3Card.className = 'p-3.5 rounded-xl border border-slate-200 shadow-xs relative overflow-hidden bg-white';
                    if (step3Icon) {
                        step3Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-slate-100 text-slate-400';
                        step3Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                    }
                    if (step3Desc) step3Desc.textContent = isHighUrgency ? 'Menunggu persetujuan RAB' : 'Menunggu giliran';
                    if (step3Time) step3Time.textContent = 'Belum dimulai';
                }

                // 5. Step Selesai (Tahap 4 biasa / Tahap 5 saat Urgensi Tinggi)
                const step4Card = document.getElementById('step-4-card');
                const step4Icon = document.getElementById('step-4-icon');
                const step4Time = document.getElementById('step-4-time');
                const step4Desc = document.getElementById('step-4-desc');

                if (status === 'selesai') {
                    if (step4Card) step4Card.className = 'p-3.5 rounded-xl border border-emerald-200 shadow-xs relative overflow-hidden bg-emerald-50/20';
                    if (step4Icon) {
                        step4Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-emerald-600 text-white';
                        step4Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                    }
                    if (step4Desc) step4Desc.textContent = 'Fasilitas berfungsi normal';
                    if (step4Time) step4Time.textContent = formatDateTimeID(wo?.tanggal_selesai || ticket.updated_at) || 'Tuntas';
                } else {
                    if (step4Card) step4Card.className = 'p-3.5 rounded-xl border border-slate-200 shadow-xs relative overflow-hidden bg-white';
                    if (step4Icon) {
                        step4Icon.className = 'w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold bg-slate-100 text-slate-400';
                        step4Icon.innerHTML = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                    }
                    if (step4Desc) step4Desc.textContent = 'Menunggu perbaikan usai';
                    if (step4Time) step4Time.textContent = 'Belum selesai';
                }

                // 6. RAB Status & Details Box
                const rabDetailBox = document.getElementById('modal-rab-detail-box');
                const rabApprovalBadge = document.getElementById('rab-approval-badge');
                const rabCostAmount = document.getElementById('rab-cost-amount');
                const rabAdminStatus = document.getElementById('rab-admin-status');
                const rabNotesText = document.getElementById('rab-notes-text');

                if (rabDetailBox) {
                    if (isHighUrgency) {
                        rabDetailBox.classList.remove('hidden');
                        const formattedCost = rabCost ? 'Rp ' + Number(rabCost).toLocaleString('id-ID') : 'Belum Ditentukan';
                        const adminNotes = ticket.verification?.catatan_inspeksi || proposal?.rincian_kebutuhan;

                        if (proposal && proposal.status_persetujuan === 'disetujui') {
                            if (rabApprovalBadge) {
                                rabApprovalBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200';
                                rabApprovalBadge.textContent = 'Disetujui Admin Sarpras';
                            }
                            if (rabCostAmount) rabCostAmount.textContent = formattedCost;
                            if (rabAdminStatus) {
                                rabAdminStatus.textContent = 'Disetujui - Lanjut Pengerjaan Fisik';
                                rabAdminStatus.className = 'font-bold text-emerald-600 text-xs mt-0.5 block';
                            }
                            if (rabNotesText) rabNotesText.textContent = adminNotes || 'Anggaran telah disetujui penuh oleh Admin Sarpras. Petugas siap mengeksekusi perbaikan.';
                        } else if (proposal && proposal.status_persetujuan === 'ditolak') {
                            if (rabApprovalBadge) {
                                rabApprovalBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200';
                                rabApprovalBadge.textContent = 'Ditolak / Butuh Revisi';
                            }
                            if (rabCostAmount) rabCostAmount.textContent = formattedCost;
                            if (rabAdminStatus) {
                                rabAdminStatus.textContent = 'Perlu Revisi RAB oleh Teknisi';
                                rabAdminStatus.className = 'font-bold text-rose-600 text-xs mt-0.5 block';
                            }
                            if (rabNotesText) rabNotesText.textContent = adminNotes || 'Pengajuan RAB ditolak oleh Admin Sarpras. Teknisi diminta merevisi rincian anggaran biaya sebelum perbaikan fisik dapat dimulai.';
                        } else if (status === 'menunggu_rab' || (proposal && proposal.status_persetujuan === 'menunggu_persetujuan')) {
                            if (rabApprovalBadge) {
                                rabApprovalBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 border border-purple-200 animate-pulse';
                                rabApprovalBadge.textContent = 'Menunggu Persetujuan Admin';
                            }
                            if (rabCostAmount) rabCostAmount.textContent = formattedCost;
                            if (rabAdminStatus) {
                                rabAdminStatus.textContent = 'Sedang Ditinjau Admin Sarpras';
                                rabAdminStatus.className = 'font-bold text-purple-600 text-xs mt-0.5 block';
                            }
                            if (rabNotesText) rabNotesText.textContent = adminNotes || 'Teknisi telah menyusun estimasi biaya dan mengajukannya ke Admin Sarpras untuk proses approval anggaran.';
                        } else {
                            if (rabApprovalBadge) {
                                rabApprovalBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200';
                                rabApprovalBadge.textContent = 'Menunggu Penyusunan RAB';
                            }
                            if (rabCostAmount) rabCostAmount.textContent = 'Belum Ditentukan';
                            if (rabAdminStatus) {
                                rabAdminStatus.textContent = 'Teknisi Sedang Menginspeksi Fasilitas';
                                rabAdminStatus.className = 'font-bold text-slate-600 text-xs mt-0.5 block';
                            }
                            if (rabNotesText) rabNotesText.textContent = 'Fasilitas dengan kerusakan tinggi membutuhkan pengecekan komponen oleh teknisi sebelum pengajuan RAB dikirim ke admin.';
                        }
                    } else {
                        rabDetailBox.classList.add('hidden');
                    }
                }
            } catch (err) {
                console.error('Error renderTrackingTimeline:', err);
            }
        }

        function closeTicketDetail() {
            document.getElementById('ticketModal').classList.add('hidden');
            currentActiveTicket = null;
        }

        // Lightbox Zoom
        function zoomPhoto(type) {
            if (!currentActiveTicket) return;
            const wo = currentActiveTicket.verification ? (currentActiveTicket.verification.work_order || currentActiveTicket.verification.workOrder) : null;
            const zoomModal = document.getElementById('imageZoomModal');
            const zoomImg = document.getElementById('zoom-img');
            const zoomTitle = document.getElementById('zoom-title');

            if (type === 'before' && currentActiveTicket.foto_bukti) {
                zoomImg.src = `/storage/${currentActiveTicket.foto_bukti}`;
                zoomTitle.textContent = 'Foto Kondisi Awal (Sebelum Perbaikan - Oleh Pelapor)';
                zoomModal.classList.remove('hidden');
            } else if (type === 'after' && wo && wo.foto_after) {
                zoomImg.src = `/storage/${wo.foto_after}`;
                zoomTitle.textContent = 'Foto Hasil Perbaikan (Setelah Perbaikan - Oleh Teknisi)';
                zoomModal.classList.remove('hidden');
            }
        }

        function closeImageZoom() {
            document.getElementById('imageZoomModal').classList.add('hidden');
        }

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const zoomModal = document.getElementById('imageZoomModal');
                if (!zoomModal.classList.contains('hidden')) {
                    closeImageZoom();
                } else {
                    closeTicketDetail();
                }
            }
        });

        // Notification Dropdown Toggle
        function togglePelaporNotificationDropdown() {
            const notifDropdown = document.getElementById('pelaporNotificationDropdown');
            const profileDropdown = document.getElementById('pelaporProfileDropdown');
            if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('hidden');
            }
            if (notifDropdown) {
                notifDropdown.classList.toggle('hidden');
            }
        }

        // Profile Dropdown Toggle
        function togglePelaporProfileDropdown() {
            const profileDropdown = document.getElementById('pelaporProfileDropdown');
            const notifDropdown = document.getElementById('pelaporNotificationDropdown');
            if (notifDropdown && !notifDropdown.classList.contains('hidden')) {
                notifDropdown.classList.add('hidden');
            }
            if (profileDropdown) {
                profileDropdown.classList.toggle('hidden');
            }
        }

        // Buka modal detail dan tandai notifikasi dibaca (otomatis hapus dari daftar notifikasi)
        function openTicketDetailAndMarkRead(id, notifData) {
            // Tutup popover notifikasi
            const notifDropdown = document.getElementById('pelaporNotificationDropdown');
            if (notifDropdown) notifDropdown.classList.add('hidden');

            // Munculkan popup tiket
            openTicketDetail(id, notifData);

            // Tandai sudah dibaca di backend & hapus dari UI notifikasi
            fetch(`/notifications/mark-read/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                // Otomatis hapus baris notifikasi yang dibuka
                const itemEl = document.getElementById(`pelaporNotifItem-${id}`);
                if (itemEl) itemEl.remove();

                // Cek sisa notifikasi aktif
                const remainingItems = document.querySelectorAll('#pelaporNotifList > [id^="pelaporNotifItem-"]');
                const badge = document.getElementById('pelaporNotifBadge');
                if (remainingItems.length === 0) {
                    const bellContainer = document.getElementById('pelaporNotificationContainer');
                    if (bellContainer) {
                        const pingBadge = bellContainer.querySelector('button span.flex');
                        if (pingBadge) pingBadge.remove();
                    }
                    if (badge) {
                        badge.className = 'px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] sm:text-[11px] font-medium rounded-full';
                        badge.textContent = '0 Baru';
                    }
                    const markBtn = document.getElementById('markAllReadBtn');
                    if (markBtn) markBtn.remove();

                    const notifList = document.getElementById('pelaporNotifList');
                    if (notifList) {
                        notifList.innerHTML = `
                            <div class="p-8 text-center" id="pelaporNotifEmpty">
                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-slate-700 mb-1">Belum Ada Tugas Selesai</p>
                                <p class="text-[11px] text-slate-400 max-w-[220px] mx-auto">Semua notifikasi telah dibaca. Notifikasi hanya muncul saat teknisi telah menyelesaikan perbaikan fasilitas yang Anda laporkan.</p>
                            </div>
                        `;
                    }
                } else {
                    if (badge) {
                        badge.textContent = `${remainingItems.length} Baru`;
                    }
                }
            })
            .catch(err => console.error('Gagal menandai notifikasi perorangan', err));
        }

        // Tandai baca semua (otomatis hapus seluruh pesan notifikasi dari popover)
        function markAllNotificationsAsRead(e) {
            if (e) e.stopPropagation();
            fetch('{{ route('notifications.mark-all-read') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const bellContainer = document.getElementById('pelaporNotificationContainer');
                    if (bellContainer) {
                        const pingBadge = bellContainer.querySelector('button span.flex');
                        if (pingBadge) pingBadge.remove();
                    }
                    const badge = document.getElementById('pelaporNotifBadge');
                    if (badge) {
                        badge.className = 'px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] sm:text-[11px] font-medium rounded-full';
                        badge.textContent = '0 Baru';
                    }
                    const markBtn = document.getElementById('markAllReadBtn');
                    if (markBtn) markBtn.remove();

                    // Otomatis hapus pesan notif dan munculkan pesan kosong
                    const notifList = document.getElementById('pelaporNotifList');
                    if (notifList) {
                        notifList.innerHTML = `
                            <div class="p-8 text-center" id="pelaporNotifEmpty">
                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-slate-700 mb-1">Belum Ada Tugas Selesai</p>
                                <p class="text-[11px] text-slate-400 max-w-[220px] mx-auto">Semua notifikasi telah dibaca. Notifikasi hanya muncul saat teknisi telah menyelesaikan perbaikan fasilitas yang Anda laporkan.</p>
                            </div>
                        `;
                    }
                }
            })
            .catch(err => console.error('Gagal menandai notifikasi dibaca', err));
        }

        // Buka popup tiket otomatis jika URL membawa parameter ticket_id
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const targetTicketId = urlParams.get('ticket_id') || urlParams.get('open_ticket');
            if (targetTicketId) {
                setTimeout(() => {
                    openTicketDetail(targetTicketId);
                }, 150);
            }
        });

        // Close dropdowns on outside click
        document.addEventListener('click', function(e) {
            const notifContainer = document.getElementById('pelaporNotificationContainer');
            const notifDropdown = document.getElementById('pelaporNotificationDropdown');
            if (notifContainer && notifDropdown && !notifContainer.contains(e.target)) {
                notifDropdown.classList.add('hidden');
            }

            const profileContainer = document.getElementById('pelaporProfileContainer');
            const profileDropdown = document.getElementById('pelaporProfileDropdown');
            if (profileContainer && profileDropdown && !profileContainer.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Mobile Bottom Navigation Bar (Khusus Layar Ponsel) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-4 py-2 flex items-center justify-around safe-area-bottom">
        <!-- 1. Lapor Kerusakan -->
        <a href="{{ route('pelapor.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Lapor Kerusakan</span>
        </a>

        <!-- 2. Tiket / WO (Aktif) -->
        <a href="{{ route('pelapor.tickets') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold relative">
            <div class="relative">
                <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                @if(($ongoingCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-2 px-1.5 py-0.2 bg-blue-600 text-white rounded-full text-[9px] font-extrabold shadow-xs">{{ $ongoingCount }}</span>
                @endif
            </div>
            <span class="text-[10px] mt-1 tracking-tight">Tiket / WO</span>
            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
        </a>

        <!-- 3. Pengaturan -->
        <a href="{{ route('settings.security') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Pengaturan</span>
        </a>
    </nav>
    @include('partials.logout-modal')
</body>
</html>
