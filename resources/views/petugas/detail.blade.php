<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tugas - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex flex-col h-screen overflow-hidden">

    <!-- Red Warning Banner for Emergency Reports -->
    @if($hasEmergency)
        <div class="bg-[#cc0000] text-white text-center py-2.5 px-4 font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shrink-0 animate-pulse">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span>PERINGATAN: Laporan Darurat Baru Masuk!</span>
        </div>
    @endif

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col h-full hidden md:flex shrink-0">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-8 h-8 object-contain">
                    <div>
                        <h1 class="text-sm font-bold text-slate-900 leading-tight">SIPERFAS</h1>
                        <p class="text-[10px] text-slate-500 font-medium">Petugas Teknisi</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-1.5">
                    <a href="{{ route('petugas.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-50/50 text-blue-700 rounded-xl text-sm font-semibold border-l-2 border-blue-600 transition-all">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span>Tugas Perbaikan</span>
                    </a>
                </nav>
            </div>

            <!-- Sidebar Footer / Settings & Logout -->
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
            <!-- Topbar: Responsif Mobile & Desktop -->
            <header class="bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-8 py-3.5 z-20 shrink-0">
                <div class="flex items-center space-x-3">
                    <!-- Mobile Logo & Nama Aplikasi -->
                    <div class="flex items-center space-x-2.5 md:hidden">
                        <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo" class="w-7 h-7 object-contain">
                        <div>
                            <h1 class="text-sm font-bold text-gray-900 leading-tight">SIPERFAS</h1>
                            <p class="text-[9px] text-gray-500 font-medium">Petugas Teknisi</p>
                        </div>
                    </div>
                    <h2 class="text-xl font-extrabold text-blue-950 tracking-tight hidden md:block">Petugas Teknisi</h2>
                </div>

                <!-- Notifications & Profile Dropdown -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Notifications Dropdown (Petugas: Ketika ada laporan masuk dari pelapor) -->
                <div class="relative" id="petugasNotificationContainer">
                    <button type="button" onclick="togglePetugasNotificationDropdown()" class="text-slate-500 hover:text-blue-600 transition-all relative p-1.5 rounded-lg hover:bg-slate-100 cursor-pointer focus:outline-none" title="Notifikasi Laporan Masuk">
                        <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        @if(($petugasNotificationCount ?? 0) > 0 || ($hasEmergency ?? false))
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ ($hasEmergency ?? false) || ($petugasNotifications ?? collect())->contains('is_emergency', true) ? 'bg-red-400' : 'bg-blue-400' }} opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ ($hasEmergency ?? false) || ($petugasNotifications ?? collect())->contains('is_emergency', true) ? 'bg-red-600' : 'bg-blue-600' }} border-2 border-white"></span>
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Popover Panel -->
                    <div id="petugasNotificationDropdown" class="hidden absolute right-0 sm:right-auto sm:left-1/2 sm:-translate-x-1/2 md:translate-x-0 md:left-auto md:right-0 mt-2.5 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200/90 z-50 overflow-hidden transform transition-all duration-200 origin-top-right">
                        <!-- Header -->
                        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-slate-50 to-blue-50/40 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-800 leading-tight">Laporan Masuk</h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-500">Dari Pelapor Sekolah</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if(($petugasNotificationCount ?? 0) > 0)
                                    <button type="button" id="markAllReadBtn" onclick="markAllNotificationsAsRead(event)" class="text-[11px] text-blue-600 hover:text-blue-800 font-semibold hover:underline cursor-pointer flex items-center space-x-1 transition-colors" title="Tandai semua notifikasi telah dibaca">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>Tandai baca semua</span>
                                    </button>
                                    <span id="petugasNotifBadge" class="px-2 py-0.5 {{ ($petugasNotifications ?? collect())->contains('is_emergency', true) ? 'bg-red-100 text-red-700 border-red-200 animate-pulse' : 'bg-blue-100 text-blue-700 border-blue-200' }} text-[10px] sm:text-[11px] font-bold rounded-full border">
                                        {{ $petugasNotificationCount }} Baru
                                    </span>
                                @else
                                    <span id="petugasNotifBadge" class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] sm:text-[11px] font-medium rounded-full">
                                        0 Baru
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- List Notifikasi Laporan Masuk -->
                        <div id="petugasNotifList" class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            @forelse($petugasNotifications ?? [] as $item)
                                <a href="{{ route('petugas.tasks.show', $item->id_laporan) }}" class="block p-3.5 hover:bg-slate-50/90 transition-colors group {{ is_null($item->technician_read_at) ? 'bg-blue-50/30' : '' }}">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 rounded-lg {{ $item->is_emergency || $item->status_laporan === 'darurat' ? 'bg-red-50 text-red-600 border-red-100 group-hover:bg-red-600' : ($item->tingkat_urgensi === 'tinggi' ? 'bg-amber-50 text-amber-600 border-amber-100 group-hover:bg-amber-600' : 'bg-blue-50 text-blue-600 border-blue-100 group-hover:bg-blue-600') }} flex items-center justify-center shrink-0 mt-0.5 border group-hover:text-white transition-colors">
                                            @if($item->is_emergency || $item->status_laporan === 'darurat')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-0.5">
                                                <div class="flex items-center space-x-1.5 truncate">
                                                    <span class="text-xs font-bold text-slate-900 truncate">{{ $item->facility->nama_fasilitas ?? 'Fasilitas' }}</span>
                                                    @if(is_null($item->technician_read_at))
                                                        <span class="unread-notif-dot w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                                                    @endif
                                                </div>
                                                <span class="text-[10px] text-slate-400 shrink-0 ml-1">{{ $item->created_at ? $item->created_at->diffForHumans() : 'Baru saja' }}</span>
                                            </div>
                                            <p class="text-[11px] text-slate-600 leading-snug line-clamp-2">
                                                Dilaporkan oleh <strong class="text-slate-800">{{ $item->user->nama ?? 'Pelapor' }}</strong>: {{ $item->deskripsi_kerusakan }}
                                            </p>
                                            <div class="mt-2 flex items-center justify-between">
                                                <span class="inline-block px-1.5 py-0.5 text-[9px] font-bold rounded {{ $item->is_emergency || $item->status_laporan === 'darurat' ? 'bg-red-100 text-red-700' : ($item->tingkat_urgensi === 'tinggi' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                                    Urgensi {{ ucfirst($item->tingkat_urgensi) }}
                                                </span>
                                                <span class="text-[10px] font-bold text-blue-600 group-hover:text-blue-700">Tinjau Tugas &rarr;</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center">
                                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-700 mb-1">Tidak Ada Laporan Baru</p>
                                    <p class="text-[11px] text-slate-400 max-w-[220px] mx-auto">Semua laporan dari pelapor telah ditangani atau belum ada laporan baru yang masuk.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('petugas.dashboard') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                Buka Semua Daftar Tugas &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                    <!-- Avatar Profile Info with Dropdown Toggle -->
                    <div class="relative pl-3 border-l border-slate-200" id="petugasDetailProfileContainer">
                        <button type="button" onclick="togglePetugasDetailProfileDropdown()" class="flex items-center space-x-3 focus:outline-none cursor-pointer group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $user->nama ?? 'Petugas Teknisi' }}</p>
                                <p class="text-[11px] text-slate-500 font-semibold">{{ $user->category ? 'Teknisi ' . $user->category->name : 'Petugas Teknisi' }}</p>
                            </div>
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm sm:text-base flex items-center justify-center border border-blue-200 shadow-xs shrink-0 group-hover:ring-2 group-hover:ring-blue-400 transition-all">
                                {{ strtoupper(substr($user->nama ?? 'T', 0, 1)) }}
                            </div>
                        </button>

                        <!-- Profile Popover / Dropdown Menu -->
                        <div id="petugasDetailProfileDropdown" class="hidden absolute right-0 mt-2.5 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in duration-150">
                            <div class="px-4 py-2.5 border-b border-slate-100">
                                <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->nama ?? 'Petugas Teknisi' }}</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">{{ $user->email ?? '' }}</p>
                                <span class="inline-block mt-1.5 px-2 py-0.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-md">
                                    {{ $user->category ? 'Teknisi ' . $user->category->name : 'Petugas Teknisi' }}
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

            <!-- Scrollable Page Content with Mobile Bottom Clearance -->
            <div class="flex-1 overflow-auto p-4 sm:p-8 pb-24 md:pb-8">
                <div class="max-w-6xl mx-auto space-y-6">

                    <!-- Flash Message -->
                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Back Button & Page Title -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('petugas.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-slate-800 bg-white border border-slate-200/80 px-3.5 py-2 rounded-xl transition-all shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                <span>Kembali</span>
                            </a>
                            <h3 class="text-2xl font-bold text-slate-900">
                                Instruksi Kerja #@if($report->verification && $report->verification->workOrder)WO-{{ $report->tanggal_waktu->format('Y') }}-{{ str_pad($report->verification->workOrder->id_wo, 3, '0', STR_PAD_LEFT) }}@else TKT-{{ $report->tanggal_waktu->format('Y') }}-{{ str_pad($report->id_laporan, 3, '0', STR_PAD_LEFT) }}@endif
                            </h3>
                            
                            @if($report->status_laporan === 'darurat')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100 animate-pulse">
                                    Darurat
                                </span>
                            @elseif($report->status_laporan === 'menunggu')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                    Perlu Ditangani
                                </span>
                            @elseif($report->status_laporan === 'menunggu_rab')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                    Menunggu Persetujuan RAB
                                </span>
                            @elseif(in_array($report->status_laporan, ['proses', 'proses_perbaikan']))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span> Sedang Dikerjakan
                                </span>
                            @elseif($report->status_laporan === 'selesai')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-700 border border-slate-200">
                                    {{ ucfirst(str_replace('_', ' ', $report->status_laporan)) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Split Layout Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        
                        <!-- Left Column: Report Card Detail -->
                        <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                            <!-- Image section -->
                            <div class="relative h-64 bg-slate-100 flex items-center justify-center overflow-hidden">
                                @if($report->foto_bukti)
                                    <img src="{{ asset('storage/' . $report->foto_bukti) }}" alt="Foto Before" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center text-slate-400 p-6">
                                        <svg class="w-16 h-16 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-xs font-semibold">Tidak ada Lampiran Foto Sebelum</p>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4 bg-red-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-3 py-1 rounded-full tracking-wider uppercase">
                                    Foto 'Sebelum'
                                </div>
                            </div>

                            <!-- Text Details -->
                            <div class="p-6 space-y-6">
                                <div>
                                    <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $report->facility->nama_fasilitas }}</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                        {{ $report->deskripsi_kerusakan }}
                                    </p>
                                </div>

                                <div class="border-t border-slate-50 pt-5 space-y-4 text-sm font-semibold text-slate-700">
                                    <!-- Location Info -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Lokasi</div>
                                            <div class="text-slate-800">{{ $report->facility->lokasi_detail }}</div>
                                        </div>
                                    </div>

                                    <!-- Date Info -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Tanggal Dilaporkan</div>
                                            <div class="text-slate-800">{{ $report->tanggal_waktu->format('d F Y, H:i') }} WIB</div>
                                        </div>
                                    </div>

                                    <!-- Reporter Info -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Pelapor</div>
                                            <div class="text-slate-800">{{ $report->user->nama }} ({{ ucfirst($report->user->status) }})</div>
                                        </div>
                                    </div>

                                    <!-- Urgency Info -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-xl {{ $report->tingkat_urgensi === 'tinggi' || $report->is_emergency ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <div>
                                            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Tingkat Urgensi</div>
                                            <div class="{{ $report->tingkat_urgensi === 'tinggi' || $report->is_emergency ? 'text-red-600 font-bold' : 'text-slate-800' }}">
                                                {{ ucfirst($report->tingkat_urgensi ?? 'Sedang') }} {{ $report->is_emergency ? '(Panggilan Darurat)' : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Verification & Action Form -->
                        <div class="lg:col-span-7 space-y-6">

                            @php
                                $proposal = $report->verification ? $report->verification->budgetProposal : null;
                                $isEmergency = ($report->is_emergency || $report->status_laporan === 'darurat' || $report->tingkat_urgensi === 'darurat');
                                // Pengajuan RAB HANYA untuk laporan berurgensi TINGGI (BUKAN DARURAT)
                                $needRab = ($report->tingkat_urgensi === 'tinggi' && !$isEmergency);
                                $isRabApproved = $proposal && $proposal->status_persetujuan === 'disetujui';
                                $isRabPending = ($needRab || $proposal) && !$isRabApproved;
                            @endphp

                            <!-- Banner Fast-Track: Khusus Insiden Darurat (Langsung Eksekusi Tanpa RAB) -->
                            @if($isEmergency)
                                <div class="bg-gradient-to-r from-red-600 to-rose-600 rounded-3xl p-6 shadow-md text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center shrink-0 animate-pulse backdrop-blur-xs">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <div>
                                            <div class="inline-block text-[11px] font-extrabold uppercase tracking-wider bg-white/25 px-3 py-0.5 rounded-full mb-1">
                                                Fast-Track Eksekusi Lapangan
                                            </div>
                                            <h4 class="text-base font-bold text-white">Insiden Darurat: Langsung Eksekusi Perbaikan!</h4>
                                            <p class="text-xs text-red-100 mt-0.5">Kondisi darurat tidak memerlukan pengajuan RAB. Segera lakukan penanganan perbaikan di bawah.</p>
                                        </div>
                                    </div>
                                    <span class="px-3.5 py-1.5 bg-white text-red-600 text-xs font-bold rounded-xl shadow-xs shrink-0 self-start md:self-auto">
                                        Langsung Eksekusi (Tanpa RAB)
                                    </span>
                                </div>
                            @endif

                            <!-- Section RAB: Khusus Hanya Untuk Urgensi Tinggi -->
                            @if(($needRab || $proposal) && $report->tingkat_urgensi === 'tinggi')
                                <div class="bg-white rounded-3xl border {{ $proposal ? 'border-slate-100' : 'border-amber-200 bg-amber-50/10' }} shadow-sm p-8 flex flex-col">
                                    <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-5">
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900">Pengajuan Anggaran & Suku Cadang (RAB)</h4>
                                            <p class="text-xs text-slate-500 mt-0.5">Estimasi biaya pengadaan material dan suku cadang ke Admin Sarpras.</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $needRab ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                            {{ $needRab ? 'Wajib RAB' : 'RAB Material' }}
                                        </span>
                                    </div>

                                    @if($proposal)
                                        <!-- State: RAB Sudah Diajukan -->
                                        <div class="space-y-4">
                                            <!-- Status Approval Banner -->
                                            @if($proposal->status_persetujuan === 'menunggu_persetujuan')
                                                <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl flex items-center justify-between gap-4">
                                                    <div>
                                                        <span class="text-xs font-bold text-amber-800 uppercase tracking-wide">Status Pengajuan</span>
                                                        <h5 class="text-sm font-bold text-amber-900 mt-0.5">Menunggu Persetujuan Admin Sarpras</h5>
                                                        <p class="text-xs text-amber-700 mt-0.5">Total Estimasi: <span class="font-bold">Rp {{ number_format($proposal->estimasi_biaya, 0, ',', '.') }}</span></p>
                                                    </div>
                                                    <span class="px-3 py-1 bg-amber-200/70 text-amber-900 font-bold text-xs rounded-xl">Diproses</span>
                                                </div>
                                            @elseif($proposal->status_persetujuan === 'disetujui')
                                                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between gap-4">
                                                    <div>
                                                        <span class="text-xs font-bold text-emerald-800 uppercase tracking-wide">Status Pengajuan</span>
                                                        <h5 class="text-sm font-bold text-emerald-900 mt-0.5">RAB Disetujui Admin Sarpras</h5>
                                                        <p class="text-xs text-emerald-700 mt-0.5">Anggaran Disetujui: <span class="font-bold">Rp {{ number_format($proposal->estimasi_biaya, 0, ',', '.') }}</span></p>
                                                    </div>
                                                    <span class="px-3 py-1 bg-emerald-200 text-emerald-900 font-bold text-xs rounded-xl">Disetujui</span>
                                                </div>
                                            @else
                                                <!-- State: RAB Ditolak Admin -->
                                                <div class="space-y-3">
                                                    <div class="p-4 bg-red-50 border border-red-200 rounded-2xl flex items-center justify-between gap-4">
                                                        <div>
                                                            <span class="text-xs font-bold text-red-800 uppercase tracking-wide">Status Pengajuan</span>
                                                            <h5 class="text-sm font-bold text-red-900 mt-0.5">RAB Ditolak / Butuh Revisi</h5>
                                                        </div>
                                                        <span class="px-3 py-1 bg-red-200 text-red-900 font-bold text-xs rounded-xl">Ditolak</span>
                                                    </div>

                                                    <!-- Catatan Evaluasi / Alasan Penolakan dari Admin -->
                                                    <div class="p-3.5 bg-red-50/60 border border-red-200/80 rounded-xl text-xs">
                                                        <div class="flex items-center gap-1.5 font-bold text-red-900 mb-1">
                                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <span>Catatan Evaluasi Admin SarPras:</span>
                                                        </div>
                                                        <p class="text-slate-800 font-medium pl-5">
                                                            {{ $report->verification && $report->verification->catatan_inspeksi ? $report->verification->catatan_inspeksi : 'Estimasi biaya belum disetujui. Silakan revisi rincian barang/harga atau lakukan penanganan dengan suku cadang internal.' }}
                                                        </p>
                                                    </div>

                                                    <!-- Tombol Buka Form Revisi -->
                                                    <div class="flex items-center justify-between pt-1">
                                                        <p class="text-xs text-slate-500 font-medium">Teknisi dapat merevisi biaya pengadaan:</p>
                                                        <button type="button" onclick="toggleReviseForm()" class="px-3.5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                            <span>Ajukan Revisi RAB</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Table of Submitted Items (Ditampilkan jika tidak sedang mode revisi) -->
                                            <div id="submitted-items-table" class="border border-slate-100 rounded-2xl overflow-hidden">
                                                <table class="w-full text-left text-xs">
                                                    <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
                                                        <tr>
                                                            <th class="px-4 py-3">Nama Sarana / Suku Cadang</th>
                                                            <th class="px-4 py-3 text-center">Qty</th>
                                                            <th class="px-4 py-3 text-right">Harga Satuan</th>
                                                            <th class="px-4 py-3 text-right">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-slate-100">
                                                        @foreach($proposal->items as $item)
                                                            <tr>
                                                                <td class="px-4 py-3 font-semibold text-slate-800">{{ $item->nama_sarana_jasa }}</td>
                                                                <td class="px-4 py-3 text-center text-slate-600">{{ $item->qty }} {{ $item->satuan }}</td>
                                                                <td class="px-4 py-3 text-right text-slate-600">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                                                <td class="px-4 py-3 text-right font-bold text-slate-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Form Revisi RAB (Awalnya tersembunyi, muncul saat klik Ajukan Revisi) -->
                                            @if($proposal->status_persetujuan === 'ditolak')
                                                <div id="revise-rab-container" class="hidden mt-4 pt-4 border-t border-slate-200">
                                                    <div class="flex items-center justify-between mb-3">
                                                        <h5 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Formulir Revisi Anggaran (RAB Baru)</h5>
                                                        <span id="revise-row-count-badge" class="text-[11px] font-bold text-slate-600 bg-slate-100 px-2.5 py-0.5 rounded-lg border border-slate-200">{{ count($proposal->items) }} / 5 Baris</span>
                                                    </div>
                                                    <form action="{{ route('petugas.tasks.rab', $report->id_laporan) }}" method="POST" class="space-y-4" onsubmit="return validateReviseRabForm(event)">
                                                        @csrf
                                                        <div class="border border-slate-200 rounded-2xl overflow-hidden bg-slate-50/50 p-3 space-y-3">
                                                            <div id="revise-items-container" class="space-y-2.5">
                                                                @foreach($proposal->items as $idx => $it)
                                                                    <div class="grid grid-cols-12 gap-2 rab-row items-center bg-white p-3 rounded-xl border border-slate-200/80 shadow-xs relative" id="revise-row-{{ $idx }}">
                                                                        <div class="col-span-5">
                                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nama Suku Cadang / Jasa <span class="text-red-500">*</span></label>
                                                                            <input type="text" name="items[{{ $idx }}][nama]" value="{{ $it->nama_sarana_jasa }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none">
                                                                        </div>
                                                                        <div class="col-span-2">
                                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah <span class="text-red-500">*</span></label>
                                                                            <input type="number" min="1" name="items[{{ $idx }}][qty]" value="{{ $it->qty }}" required class="rab-qty w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center" oninput="calculateReviseTotal()">
                                                                        </div>
                                                                        <div class="col-span-2">
                                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Satuan <span class="text-red-500">*</span></label>
                                                                            <input type="text" name="items[{{ $idx }}][satuan]" value="{{ $it->satuan }}" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center">
                                                                        </div>
                                                                        <div class="col-span-3">
                                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                                                                            <input type="number" min="1" name="items[{{ $idx }}][harga]" value="{{ max(1, (int)$it->harga_satuan) }}" placeholder="Min. Rp 1" required class="rab-price w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" oninput="calculateReviseTotal()">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <div class="flex items-center justify-between pt-2">
                                                                <div>
                                                                    <button type="button" id="btn-add-revise-row" onclick="addReviseRabRow()" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1.5 cursor-pointer">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                                        <span>Tambah Komponen</span>
                                                                    </button>
                                                                    <span id="revise-max-notice" class="hidden text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">Batas maksimal 5 baris tercapai</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-xs text-slate-500 font-medium">Total Estimasi Revisi:</span>
                                                                    <span class="text-sm font-bold text-blue-900 ml-1.5" id="revise-grand-total">Rp {{ number_format($proposal->estimasi_biaya, 0, ',', '.') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Catatan Penjelasan Perubahan / Revisi</label>
                                                            <textarea name="catatan_kebutuhan" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-800 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Jelaskan penyesuaian harga atau penggantian item suku cadang yang telah dilakukan..."></textarea>
                                                        </div>

                                                        <div class="flex items-center justify-end gap-3 pt-2">
                                                            <button type="button" onclick="toggleReviseForm()" class="text-xs font-bold text-slate-400 hover:text-slate-600">
                                                                Batal
                                                            </button>
                                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs shadow-sm transition-all flex items-center gap-2 cursor-pointer">
                                                                <span>Kirim Ulang Proposal RAB (Revisi)</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <!-- Form Input RAB Baru -->
                                        <form action="{{ route('petugas.tasks.rab', $report->id_laporan) }}" method="POST" class="space-y-4" onsubmit="return validateRabForm(event)">
                                            @csrf
                                            
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Komponen & Suku Cadang yang Dibutuhkan</label>
                                                    <span id="rab-row-count-badge" class="text-[11px] font-bold text-slate-600 bg-slate-100 px-2.5 py-0.5 rounded-lg border border-slate-200">1 / 5 Baris</span>
                                                </div>
                                                <div class="border border-slate-200 rounded-2xl overflow-hidden bg-slate-50/50 p-3 space-y-3">
                                                    <div id="rab-items-container" class="space-y-2.5">
                                                        <!-- Initial Row -->
                                                        <div class="grid grid-cols-12 gap-2 rab-row items-center bg-white p-3 rounded-xl border border-slate-200/80 shadow-xs relative" id="rab-row-0">
                                                            <div class="col-span-5">
                                                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nama Suku Cadang / Jasa <span class="text-red-500">*</span></label>
                                                                <input type="text" name="items[0][nama]" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Kompresor AC 1PK">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah <span class="text-red-500">*</span></label>
                                                                <input type="number" min="1" name="items[0][qty]" value="1" required class="rab-qty w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center" oninput="calculateTotal()">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Satuan <span class="text-red-500">*</span></label>
                                                                <input type="text" name="items[0][satuan]" value="Unit" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center">
                                                            </div>
                                                            <div class="col-span-3">
                                                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                                                                <input type="number" min="1" name="items[0][harga]" value="" placeholder="Contoh: 150000" required class="rab-price w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" oninput="calculateTotal()">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center justify-between pt-2">
                                                        <div>
                                                            <button type="button" id="btn-add-rab-row" onclick="addRabRow()" class="text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1.5 cursor-pointer">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                                <span>Tambah Komponen Material</span>
                                                            </button>
                                                            <span id="rab-max-notice" class="hidden text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">Batas maksimal 5 baris tercapai</span>
                                                        </div>
                                                        <div class="text-right">
                                                            <span class="text-xs text-slate-500 font-medium">Total Estimasi:</span>
                                                            <span class="text-sm font-bold text-slate-900 ml-1.5" id="rab-grand-total">Rp 0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <label for="catatan_kebutuhan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keterangan Teknis & Alasan Pengajuan (Opsional)</label>
                                                <textarea name="catatan_kebutuhan" id="catatan_kebutuhan" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400" placeholder="Jelaskan mengapa komponen perlu diganti baru..."></textarea>
                                            </div>

                                            <button type="submit" class="w-full py-3 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl text-xs shadow-sm transition-all flex items-center justify-center gap-2 cursor-pointer">
                                                <span>Kirim Pengajuan RAB ke Admin</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif

                            <!-- Formulir Eksekusi & Bukti Pengerjaan -->
                            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 flex flex-col">
                                <div class="border-b border-slate-50 pb-6 mb-6">
                                    <h4 class="text-lg font-bold text-slate-900">Formulir Eksekusi Perbaikan Lapangan</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Kelola progres dan selesaikan perbaikan fasilitas sekolah</p>
                                </div>

                                <!-- Status Banner Aktif -->
                                @if(in_array($report->status_laporan, ['proses', 'proses_perbaikan']))
                                    <div class="mb-6 p-4.5 bg-indigo-50/70 border border-indigo-100 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h5 class="text-sm font-bold text-indigo-950">Status: Sedang Dikerjakan di Lapangan</h5>
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-200/80 text-indigo-900">Aktif</span>
                                                </div>
                                                <p class="text-xs text-indigo-700 mt-0.5">Tiket ini dalam proses penanganan. Silakan lengkapi bukti foto 'After' dan catatan di bawah untuk menyelesaikan perbaikan.</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('petugas.tasks.pause', $report->id_laporan) }}" method="POST" class="shrink-0">
                                            @csrf
                                            <button type="submit" class="w-full sm:w-auto px-3.5 py-2 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-xl text-xs font-bold transition-all shadow-xs flex items-center justify-center gap-1.5 cursor-pointer">
                                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span>Tunda Pengerjaan</span>
                                            </button>
                                        </form>
                                    </div>
                                @elseif(!in_array($report->status_laporan, ['selesai']))
                                    @if($isRabPending)
                                        <div class="mb-6 p-4.5 bg-amber-50 border border-amber-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                            <div class="flex items-start gap-3.5">
                                                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2">
                                                        <h5 class="text-sm font-bold text-amber-950">Status: Menunggu Persetujuan RAB</h5>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-200 text-amber-900">Terkunci</span>
                                                    </div>
                                                    @if($proposal && $proposal->status_persetujuan === 'ditolak')
                                                        <p class="text-xs text-amber-800 mt-1 leading-relaxed">Pengajuan RAB sebelumnya <strong>ditolak</strong> oleh Admin Sarpras. Silakan periksa catatan dan ajukan revisi di atas. Pekerjaan lapangan tidak dapat dimulai sebelum RAB disetujui.</p>
                                                    @elseif($proposal)
                                                        <p class="text-xs text-amber-800 mt-1 leading-relaxed">Pengajuan RAB (Rp {{ number_format($proposal->total_anggaran, 0, ',', '.') }}) telah diajukan ke Admin Sarpras. Menunggu persetujuan sebelum Anda dapat memulai pengerjaan fisik di lapangan.</p>
                                                    @else
                                                        <p class="text-xs text-amber-800 mt-1 leading-relaxed">Laporan urgensi tinggi memerlukan pengajuan Rencana Anggaran Biaya (RAB). Harap kirimkan pengajuan RAB di atas dan tunggu persetujuan Admin Sarpras.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="button" disabled class="shrink-0 px-4 py-2.5 bg-slate-200 text-slate-400 font-bold rounded-xl text-xs cursor-not-allowed flex items-center gap-2">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                                <span>Pengerjaan Terkunci</span>
                                            </button>
                                        </div>
                                    @else
                                        @if($isRabApproved)
                                            <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 text-emerald-900">
                                                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <div class="text-xs font-semibold">
                                                    RAB Disetujui Admin Sarpras (Rp {{ number_format($proposal->total_anggaran, 0, ',', '.') }}). Anda dapat memulai pengerjaan fisik sekarang.
                                                </div>
                                            </div>
                                        @endif
                                        <div class="mb-6 p-4.5 bg-amber-50/80 border border-amber-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-3.5">
                                                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                </div>
                                                <div>
                                                    <h5 class="text-sm font-bold text-amber-950">Status: Belum Dimulai (Perlu Ditangani)</h5>
                                                    <p class="text-xs text-amber-800 mt-0.5">Ubah status ke "Sedang Dikerjakan" untuk menginformasikan bahwa Anda sudah berada di lokasi fasilitas.</p>
                                                </div>
                                            </div>
                                            <form action="{{ route('petugas.tasks.start', $report->id_laporan) }}" method="POST" class="shrink-0">
                                                @csrf
                                                <button type="submit" class="w-full sm:w-auto px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition-all shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    <span>Mulai Pengerjaan</span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif

                                @if($report->status_laporan === 'selesai')
                                    <!-- Already Completed State -->
                                    @php
                                        $wo = $report->verification ? $report->verification->workOrder : null;
                                    @endphp
                                    <div class="space-y-6">
                                        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-900">
                                            <div class="flex items-center gap-2 text-sm font-bold">
                                                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span>Tugas perbaikan ini telah selesai dikerjakan!</span>
                                            </div>
                                            <p class="text-xs text-emerald-700 mt-1">Status fasilitas otomatis kembali menjadi "Baik" di sistem.</p>
                                        </div>

                                        @if($wo && $wo->foto_after)
                                            <div>
                                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Foto Hasil Perbaikan (After)</label>
                                                <div class="rounded-2xl overflow-hidden border border-slate-100 aspect-video max-h-72">
                                                    <img src="{{ asset('storage/' . $wo->foto_after) }}" class="w-full h-full object-cover" alt="Foto After Selesai">
                                                </div>
                                            </div>
                                        @endif

                                        @if($report->verification && $report->verification->catatan_inspeksi)
                                            <div>
                                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Catatan Teknis Teknisi</label>
                                                <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-medium text-slate-700">
                                                    {{ $report->verification->catatan_inspeksi }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($isRabPending)
                                    <!-- Locked Execution Form State -->
                                    <div class="py-10 px-6 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/60">
                                        <div class="w-14 h-14 bg-amber-50 text-amber-600 border border-amber-200 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-xs">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </div>
                                        <h5 class="text-sm font-bold text-slate-800">Formulir Eksekusi & Bukti Pengerjaan Terkunci</h5>
                                        <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 leading-relaxed">
                                            Formulir unggah foto hasil perbaikan ('After') dan catatan penyelesaian baru dapat diisi setelah Admin Sarpras menyetujui pengajuan Rencana Anggaran Biaya (RAB).
                                        </p>
                                    </div>
                                @elseif(!in_array($report->status_laporan, ['proses', 'proses_perbaikan']))
                                    <!-- Locked Execution Form State (Belum Mulai Pengerjaan) -->
                                    <div class="py-10 px-6 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/60">
                                        <div class="w-14 h-14 bg-blue-50 text-blue-600 border border-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-xs">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </div>
                                        <h5 class="text-sm font-bold text-slate-800">Unggah Bukti Selesai Terkunci</h5>
                                        <p class="text-xs text-slate-500 max-w-md mx-auto mt-1.5 leading-relaxed">
                                            Bukti foto hasil perbaikan ('After') tidak dapat diunggah sebelum Anda menekan tombol <strong>"Mulai Pengerjaan"</strong>. Silakan tekan tombol <strong>Mulai Pengerjaan</strong> di atas saat Anda telah tiba di lokasi fasilitas untuk memulai perbaikan.
                                        </p>
                                    </div>
                                @else
                                    <!-- Complete Task Form -->
                                    <form action="{{ route('petugas.tasks.complete', $report->id_laporan) }}" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="return validateCompleteForm(event)">
                                        @csrf

                                        <!-- 1. Unggah Foto 'After' -->
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 mb-2">1. Unggah Bukti Foto 'After' (Hasil Perbaikan) <span class="text-red-500 font-extrabold">* (Wajib Diisi)</span></label>
                                            <div onclick="document.getElementById('file-upload-after').click()" class="border-2 border-dashed border-slate-200 rounded-2xl h-48 flex items-center justify-center text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50/10 transition-all relative overflow-hidden group">
                                                <input type="file" name="foto_after" id="file-upload-after" class="hidden" accept="image/*" required onchange="previewImage(this)">
                                                
                                                <!-- Default State UI -->
                                                <div id="upload-default-state" class="space-y-1.5 p-6">
                                                    <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto shadow-xs group-hover:scale-105 transition-all">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                    <p class="text-sm font-bold text-blue-600 hover:text-blue-700">Klik untuk unggah foto hasil perbaikan</p>
                                                    <p class="text-xs text-slate-400 font-medium">atau seret dan lepas file di sini (PNG, JPG hingga 5MB)</p>
                                                </div>

                                                <!-- Preview State UI -->
                                                <img id="image-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover">
                                                
                                                <div id="upload-preview-state" class="hidden absolute inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span class="bg-white/90 text-slate-800 text-xs font-bold px-4 py-2 rounded-xl shadow-sm">Ganti Foto</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 2. Catatan Perbaikan Teknis -->
                                        <div>
                                            <label for="catatan_perbaikan" class="block text-sm font-bold text-slate-700 mb-2">2. Catatan Pengerjaan Teknis (Opsional)</label>
                                            <textarea name="catatan_perbaikan" id="catatan_perbaikan" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 transition-all" placeholder="Misal: Telah dilakukan penggantian MCB 16A dan penataan kabel grounding. AC kembali berfungsi dengan normal."></textarea>
                                        </div>

                                        <!-- Submit Button (Gaya Admin Sarpras) -->
                                        <div class="border-t border-slate-50 pt-6 flex items-center justify-end">
                                            <button type="submit" class="bg-[#0f172a] hover:bg-slate-800 text-white font-bold py-3 px-6 rounded-xl text-sm shadow-sm transition-all flex items-center gap-2 font-semibold cursor-pointer active:scale-98">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span>Simpan & Selesaikan Perbaikan</span>
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let rowIndex = 1;
        const MAX_RAB_ROWS = 5;

        function updateRabRowCount() {
            const container = document.getElementById('rab-items-container');
            if (!container) return;
            const rows = container.querySelectorAll('.rab-row');
            const badge = document.getElementById('rab-row-count-badge');
            const addBtn = document.getElementById('btn-add-rab-row');
            const maxNotice = document.getElementById('rab-max-notice');

            if (badge) badge.textContent = `${rows.length} / ${MAX_RAB_ROWS} Baris`;
            if (rows.length >= MAX_RAB_ROWS) {
                if (addBtn) addBtn.classList.add('hidden');
                if (maxNotice) maxNotice.classList.remove('hidden');
            } else {
                if (addBtn) addBtn.classList.remove('hidden');
                if (maxNotice) maxNotice.classList.add('hidden');
            }
        }

        function addRabRow() {
            const container = document.getElementById('rab-items-container');
            const currentRows = container.querySelectorAll('.rab-row').length;
            if (currentRows >= MAX_RAB_ROWS) {
                alert('Batas maksimal pengajuan RAB adalah 5 baris.');
                return;
            }

            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 gap-2 rab-row items-center bg-white p-3 rounded-xl border border-slate-200/80 shadow-xs relative';
            row.innerHTML = `
                <div class="col-span-5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nama Suku Cadang / Jasa <span class="text-red-500">*</span></label>
                    <input type="text" name="items[${rowIndex}][nama]" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Freon R32">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" min="1" name="items[${rowIndex}][qty]" value="1" required class="rab-qty w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center" oninput="calculateTotal()">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Satuan <span class="text-red-500">*</span></label>
                    <input type="text" name="items[${rowIndex}][satuan]" value="Pcs" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" min="1" name="items[${rowIndex}][harga]" value="" placeholder="Min. Rp 1" required class="rab-price w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" oninput="calculateTotal()">
                </div>
                <div class="col-span-1 flex items-end justify-center pt-3">
                    <button type="button" onclick="deleteRabRow(this)" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors cursor-pointer" title="Hapus Baris">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            `;
            container.appendChild(row);
            rowIndex++;
            calculateTotal();
            updateRabRowCount();
        }

        function deleteRabRow(btn) {
            const row = btn.closest('.rab-row');
            if (row) {
                row.remove();
                calculateTotal();
                updateRabRowCount();
            }
        }

        function validateRabForm(e) {
            const container = document.getElementById('rab-items-container');
            if (!container) return true;
            const rows = container.querySelectorAll('.rab-row');
            if (rows.length === 0) {
                alert('Minimal harus ada 1 baris komponen/material.');
                if (e) e.preventDefault();
                return false;
            }
            if (rows.length > MAX_RAB_ROWS) {
                alert(`Batas maksimal pengajuan RAB adalah ${MAX_RAB_ROWS} baris!`);
                if (e) e.preventDefault();
                return false;
            }
            for (let i = 0; i < rows.length; i++) {
                const priceInput = rows[i].querySelector('.rab-price');
                const priceVal = parseFloat(priceInput?.value);
                if (isNaN(priceVal) || priceVal <= 0) {
                    alert('Harga satuan tidak boleh 0 rupiah! Harap masukkan harga satuan yang valid (lebih dari Rp 0).');
                    if (priceInput) priceInput.focus();
                    if (e) e.preventDefault();
                    return false;
                }
            }
            return true;
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#rab-items-container .rab-row');
            rows.forEach(row => {
                const qtyInput = row.querySelector('.rab-qty');
                const priceInput = row.querySelector('.rab-price');
                if (qtyInput && priceInput) {
                    const qty = parseFloat(qtyInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    total += (qty * price);
                }
            });
            const grandTotalEl = document.getElementById('rab-grand-total');
            if (grandTotalEl) {
                grandTotalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
            }
        }

        function toggleReviseForm() {
            const container = document.getElementById('revise-rab-container');
            if (container) {
                container.classList.toggle('hidden');
                updateReviseRowCount();
            }
        }

        let reviseRowIndex = 100;

        function updateReviseRowCount() {
            const container = document.getElementById('revise-items-container');
            if (!container) return;
            const rows = container.querySelectorAll('.rab-row');
            const badge = document.getElementById('revise-row-count-badge');
            const addBtn = document.getElementById('btn-add-revise-row');
            const maxNotice = document.getElementById('revise-max-notice');

            if (badge) badge.textContent = `${rows.length} / ${MAX_RAB_ROWS} Baris`;
            if (rows.length >= MAX_RAB_ROWS) {
                if (addBtn) addBtn.classList.add('hidden');
                if (maxNotice) maxNotice.classList.remove('hidden');
            } else {
                if (addBtn) addBtn.classList.remove('hidden');
                if (maxNotice) maxNotice.classList.add('hidden');
            }
        }

        function addReviseRabRow() {
            const container = document.getElementById('revise-items-container');
            const currentRows = container.querySelectorAll('.rab-row').length;
            if (currentRows >= MAX_RAB_ROWS) {
                alert('Batas maksimal pengajuan RAB adalah 5 baris.');
                return;
            }

            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 gap-2 rab-row items-center bg-white p-3 rounded-xl border border-slate-200/80 shadow-xs relative';
            row.innerHTML = `
                <div class="col-span-5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nama Suku Cadang / Jasa <span class="text-red-500">*</span></label>
                    <input type="text" name="items[${reviseRowIndex}][nama]" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" placeholder="Item baru">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" min="1" name="items[${reviseRowIndex}][qty]" value="1" required class="rab-qty w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center" oninput="calculateReviseTotal()">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Satuan <span class="text-red-500">*</span></label>
                    <input type="text" name="items[${reviseRowIndex}][satuan]" value="Pcs" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none text-center">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" min="1" name="items[${reviseRowIndex}][harga]" value="" placeholder="Min. Rp 1" required class="rab-price w-full bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-medium focus:ring-1 focus:ring-blue-500 focus:outline-none" oninput="calculateReviseTotal()">
                </div>
                <div class="col-span-1 flex items-end justify-center pt-3">
                    <button type="button" onclick="deleteReviseRabRow(this)" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors cursor-pointer" title="Hapus Baris">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            `;
            container.appendChild(row);
            reviseRowIndex++;
            calculateReviseTotal();
            updateReviseRowCount();
        }

        function deleteReviseRabRow(btn) {
            const row = btn.closest('.rab-row');
            if (row) {
                row.remove();
                calculateReviseTotal();
                updateReviseRowCount();
            }
        }

        function validateReviseRabForm(e) {
            const container = document.getElementById('revise-items-container');
            if (!container) return true;
            const rows = container.querySelectorAll('.rab-row');
            if (rows.length === 0) {
                alert('Minimal harus ada 1 baris komponen/material.');
                if (e) e.preventDefault();
                return false;
            }
            if (rows.length > MAX_RAB_ROWS) {
                alert(`Batas maksimal pengajuan RAB adalah ${MAX_RAB_ROWS} baris!`);
                if (e) e.preventDefault();
                return false;
            }
            for (let i = 0; i < rows.length; i++) {
                const priceInput = rows[i].querySelector('.rab-price');
                const priceVal = parseFloat(priceInput?.value);
                if (isNaN(priceVal) || priceVal <= 0) {
                    alert('Harga satuan tidak boleh 0 rupiah! Harap masukkan harga satuan yang valid (lebih dari Rp 0).');
                    if (priceInput) priceInput.focus();
                    if (e) e.preventDefault();
                    return false;
                }
            }
            return true;
        }

        function calculateReviseTotal() {
            let total = 0;
            const container = document.getElementById('revise-items-container');
            if (container) {
                const rows = container.querySelectorAll('.rab-row');
                rows.forEach(row => {
                    const qtyInput = row.querySelector('.rab-qty');
                    const priceInput = row.querySelector('.rab-price');
                    if (qtyInput && priceInput) {
                        const qty = parseFloat(qtyInput.value) || 0;
                        const price = parseFloat(priceInput.value) || 0;
                        total += (qty * price);
                    }
                });
            }
            const grandTotalEl = document.getElementById('revise-grand-total');
            if (grandTotalEl) {
                grandTotalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
            }
        }


        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-default-state').classList.add('hidden');
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('upload-preview-state').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function validateCompleteForm(e) {
            const fileInput = document.getElementById('file-upload-after');
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                if (e) e.preventDefault();
                alert('Bukti foto hasil perbaikan (After) wajib diunggah sebelum menyelesaikan tugas!');
                return false;
            }
            return true;
        }

        // Notification Dropdown Toggle
        function togglePetugasNotificationDropdown() {
            const notifDropdown = document.getElementById('petugasNotificationDropdown');
            const profileDropdown = document.getElementById('petugasDetailProfileDropdown');
            if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('hidden');
            }
            if (notifDropdown) {
                notifDropdown.classList.toggle('hidden');
            }
        }

        // Profile Dropdown Toggle
        function togglePetugasDetailProfileDropdown() {
            const profileDropdown = document.getElementById('petugasDetailProfileDropdown');
            const notifDropdown = document.getElementById('petugasNotificationDropdown');
            if (notifDropdown && !notifDropdown.classList.contains('hidden')) {
                notifDropdown.classList.add('hidden');
            }
            if (profileDropdown) {
                profileDropdown.classList.toggle('hidden');
            }
        }

        // Mark all notifications as read
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
                    const bellContainer = document.getElementById('petugasNotificationContainer');
                    if (bellContainer) {
                        const pingBadge = bellContainer.querySelector('button span.flex');
                        if (pingBadge) pingBadge.remove();
                    }
                    const badge = document.getElementById('petugasNotifBadge');
                    if (badge) {
                        badge.className = 'px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] sm:text-[11px] font-medium rounded-full';
                        badge.textContent = '0 Baru';
                    }
                    const markBtn = document.getElementById('markAllReadBtn');
                    if (markBtn) markBtn.remove();

                    // Otomatis hapus seluruh pesan notifikasi dan ganti dengan tampilan kosong
                    const notifList = document.getElementById('petugasNotifList');
                    if (notifList) {
                        notifList.innerHTML = `
                            <div class="p-8 text-center" id="petugasNotifEmpty">
                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-xs font-semibold text-slate-700 mb-1">Tidak Ada Laporan Baru</p>
                                <p class="text-[11px] text-slate-400 max-w-[220px] mx-auto">Semua notifikasi telah dibaca. Notifikasi akan muncul saat ada laporan kerusakan baru dari pelapor.</p>
                            </div>
                        `;
                    }
                }
            })
            .catch(err => console.error('Gagal menandai notifikasi dibaca', err));
        }

        // Close dropdowns on outside click
        document.addEventListener('click', function(e) {
            const notifContainer = document.getElementById('petugasNotificationContainer');
            const notifDropdown = document.getElementById('petugasNotificationDropdown');
            if (notifContainer && notifDropdown && !notifContainer.contains(e.target)) {
                notifDropdown.classList.add('hidden');
            }

            const profileContainer = document.getElementById('petugasDetailProfileContainer');
            const profileDropdown = document.getElementById('petugasDetailProfileDropdown');
            if (profileContainer && profileDropdown && !profileContainer.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Mobile Bottom Navigation Bar (Petugas Teknisi) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-8 py-2 flex items-center justify-around safe-area-bottom">
        <!-- 1. Tugas Perbaikan (Indikator Aktif / Induk) -->
        <a href="{{ route('petugas.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold">
            <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Tugas Perbaikan</span>
            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
        </a>

        <!-- 2. Pengaturan -->
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
