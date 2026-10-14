<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Teknisi - SIPERFAS</title>
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
                    <div class="relative pl-3 border-l border-slate-200" id="petugasProfileContainer">
                        <button type="button" onclick="togglePetugasProfileDropdown()" class="flex items-center space-x-3 focus:outline-none cursor-pointer group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $user->nama ?? 'Petugas Teknisi' }}</p>
                                <p class="text-[11px] text-slate-500 font-semibold">{{ $user->category ? 'Teknisi ' . $user->category->name : 'Petugas Teknisi' }}</p>
                            </div>
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm sm:text-base flex items-center justify-center border border-blue-200 shadow-xs shrink-0 group-hover:ring-2 group-hover:ring-blue-400 transition-all">
                                {{ strtoupper(substr($user->nama ?? 'T', 0, 1)) }}
                            </div>
                        </button>

                        <!-- Profile Popover / Dropdown Menu -->
                        <div id="petugasProfileDropdown" class="hidden absolute right-0 mt-2.5 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in duration-150">
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
            <div class="flex-1 overflow-auto p-4 sm:p-8 space-y-6 pb-24 md:pb-8">

                <!-- Flash Success Message -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- KPI Metric Cards (Mirip Admin Sarpras) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <!-- Total Tugas -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 tracking-wide uppercase">Total Tugas</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalAssigned }}</h3>
                            <div class="text-xs mt-1.5 flex items-center gap-1 font-medium text-slate-500">
                                <span>Semua laporan</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                    </div>

                    <!-- Perlu Ditangani -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 tracking-wide uppercase">Perlu Ditangani</p>
                            <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $pending }}</h3>
                            <div class="text-xs mt-1.5 flex items-center gap-1 font-medium text-amber-600">
                                <span>Belum dikerjakan</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>

                    <!-- Sedang Dikerjakan -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 tracking-wide uppercase">Sedang Dikerjakan</p>
                            <h3 class="text-2xl font-bold text-indigo-600 mt-1">{{ $inProgress }}</h3>
                            <div class="text-xs mt-1.5 flex items-center gap-1 font-medium text-indigo-600">
                                <span>Proses perbaikan</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                    </div>

                    <!-- Telah Selesai -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 tracking-wide uppercase">Telah Selesai</p>
                            <h3 class="text-2xl font-bold text-emerald-600 mt-1">{{ $completed }}</h3>
                            <div class="text-xs mt-1.5 flex items-center gap-1 font-medium text-emerald-600">
                                <span>Fasilitas pulih</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Work Orders / Task Table (Sama persis dengan Admin Sarpras) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Daftar Instruksi Kerja Teknisi</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Semua laporan perbaikan yang perlu ditangani di lapangan</p>
                        </div>

                        <!-- Status Filter Tabs -->
                        <div class="flex items-center gap-1.5 bg-slate-50 p-1 rounded-xl border border-slate-100">
                            <button onclick="filterTasks('all')" class="task-filter-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-white text-slate-800 shadow-xs transition-all" id="btn-filter-all">Semua</button>
                            <button onclick="filterTasks('menunggu')" class="task-filter-btn px-3 py-1.5 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all" id="btn-filter-menunggu">Perlu Ditangani</button>
                            <button onclick="filterTasks('proses')" class="task-filter-btn px-3 py-1.5 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all" id="btn-filter-proses">Diproses</button>
                            <button onclick="filterTasks('darurat')" class="task-filter-btn px-3 py-1.5 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all" id="btn-filter-darurat">Darurat</button>
                            <button onclick="filterTasks('selesai')" class="task-filter-btn px-3 py-1.5 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all" id="btn-filter-selesai">Selesai</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-[#f8fafc] text-slate-400 font-semibold text-xs border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Fasilitas / Masalah</th>
                                    <th class="px-6 py-4">Pelapor & Lokasi</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi Pengerjaan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($allTasks as $task)
                                    <tr class="hover:bg-slate-50/50 transition-colors task-row" data-status="{{ $task->status_laporan }}">
                                        <!-- Facility & Description -->
                                        <td class="px-6 py-4.5">
                                            <div class="font-bold text-slate-800 text-sm">{{ $task->facility->nama_fasilitas ?? 'Fasilitas Sekolah' }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5 line-clamp-1 max-w-xs">{{ $task->deskripsi_kerusakan }}</div>
                                        </td>

                                        <!-- Reporter & Location -->
                                        <td class="px-6 py-4.5">
                                            <div class="font-semibold text-slate-800">{{ $task->user->nama ?? 'Warga Sekolah' }}</div>
                                            <div class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="truncate max-w-[200px]">{{ $task->facility->lokasi_detail ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <!-- Category -->
                                        <td class="px-6 py-4.5">
                                            <div class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                                                @if(\Illuminate\Support\Str::contains(strtolower($task->facility->kategori_area ?? ''), 'listrik'))
                                                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                                @elseif(\Illuminate\Support\Str::contains(strtolower($task->facility->kategori_area ?? ''), ['toilet', 'sanitasi', 'pipa']))
                                                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                                @elseif(\Illuminate\Support\Str::contains(strtolower($task->facility->kategori_area ?? ''), 'kelas'))
                                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                                @else
                                                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                                                @endif
                                                <span>{{ $task->facility->kategori_area ?? 'Umum' }}</span>
                                            </div>
                                        </td>

                                        <!-- Status Pill -->
                                        <td class="px-6 py-4.5">
                                            @if($task->status_laporan === 'darurat')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                                                    Darurat
                                                </span>
                                            @elseif($task->status_laporan === 'menunggu')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                                    Perlu Ditangani
                                                </span>
                                            @elseif($task->status_laporan === 'menunggu_rab')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                                    Menunggu RAB
                                                </span>
                                            @elseif(in_array($task->status_laporan, ['proses', 'proses_perbaikan']))
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                    Sedang Dikerjakan
                                                </span>
                                            @elseif($task->status_laporan === 'selesai')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-700 border border-slate-200">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status_laporan)) }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Action Button -->
                                        <td class="px-6 py-4.5 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($task->status_laporan === 'darurat')
                                                    <a href="{{ route('petugas.tasks.show', $task->id_laporan) }}" class="inline-flex items-center justify-center gap-1.5 bg-red-600 hover:bg-red-700 text-white font-bold py-1.5 px-3.5 rounded-xl text-xs shadow-sm shadow-red-500/30 transition-all animate-pulse">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                                        <span>Respon Cepat</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('petugas.tasks.show', $task->id_laporan) }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded-xl text-xs shadow-sm transition-all">
                                                        {{ $task->status_laporan === 'selesai' ? 'Detail' : 'Eksekusi' }}
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-slate-400 font-medium">
                                            Tidak ada instruksi kerja perbaikan saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function filterTasks(status) {
            document.querySelectorAll('.task-filter-btn').forEach(btn => {
                btn.className = 'task-filter-btn px-3 py-1.5 text-xs font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all';
            });
            const activeBtn = document.getElementById('btn-filter-' + status);
            if (activeBtn) {
                activeBtn.className = 'task-filter-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-white text-slate-800 shadow-xs transition-all';
            }

            const rows = document.querySelectorAll('.task-row');
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all') {
                    row.classList.remove('hidden');
                } else if (status === 'menunggu') {
                    if (rowStatus === 'menunggu' || rowStatus === 'menunggu_rab') row.classList.remove('hidden');
                    else row.classList.add('hidden');
                } else if (status === 'darurat') {
                    if (rowStatus === 'darurat') row.classList.remove('hidden');
                    else row.classList.add('hidden');
                } else if (status === 'proses') {
                    if (rowStatus === 'proses' || rowStatus === 'proses_perbaikan') row.classList.remove('hidden');
                    else row.classList.add('hidden');
                } else if (status === 'selesai') {
                    if (rowStatus === 'selesai') row.classList.remove('hidden');
                    else row.classList.add('hidden');
                }
            });
        }

        // Notification Dropdown Toggle
        function togglePetugasNotificationDropdown() {
            const notifDropdown = document.getElementById('petugasNotificationDropdown');
            const profileDropdown = document.getElementById('petugasProfileDropdown');
            if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('hidden');
            }
            if (notifDropdown) {
                notifDropdown.classList.toggle('hidden');
            }
        }

        // Profile Dropdown Toggle
        function togglePetugasProfileDropdown() {
            const profileDropdown = document.getElementById('petugasProfileDropdown');
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

            const profileContainer = document.getElementById('petugasProfileContainer');
            const profileDropdown = document.getElementById('petugasProfileDropdown');
            if (profileContainer && profileDropdown && !profileContainer.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Mobile Bottom Navigation Bar (Petugas Teknisi) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-8 py-2 flex items-center justify-around safe-area-bottom">
        <!-- 1. Tugas Perbaikan (Aktif) -->
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
