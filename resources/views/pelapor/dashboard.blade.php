<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Kerusakan - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }

        @keyframes planeFlyOut {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); opacity: 1; }
            25% { transform: translate(-4px, 4px) scale(0.9) rotate(-12deg); opacity: 1; }
            100% { transform: translate(60px, -60px) scale(1.3) rotate(25deg); opacity: 0; }
        }
        .animate-plane-fly {
            display: inline-block;
            animation: planeFlyOut 0.65s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        @keyframes shimmerTrack {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .animate-shimmer {
            background-size: 200% 100%;
            animation: shimmerTrack 1.8s linear infinite;
        }
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
                <a href="{{ route('pelapor.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-50/50 text-blue-700 rounded-lg text-sm font-semibold border-l-2 border-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Lapor Kerusakan</span>
                </a>
                <a href="{{ route('pelapor.tickets') }}" class="flex items-center justify-between px-4 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        <span>Tiket / WO</span>
                    </div>
                    @if(($ongoingCount ?? 0) > 0)
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full">{{ $ongoingCount }}</span>
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
                                <div id="pelaporNotifItem-{{ $notif->id_laporan }}" onclick="openTicketDetailAndMarkRead(@js($notif))" class="block p-3.5 hover:bg-slate-50/90 transition-colors group cursor-pointer bg-emerald-50/20">
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
                                <div class="p-8 text-center" id="pelaporNotifEmpty">
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

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(isset($errors) && $errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                        <ul class="list-disc pl-5 text-sm font-medium space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Red Banner Button (Triggers Emergency Modal) -->
                <div class="mb-6">
                    <button type="button" onclick="toggleModal('modal-darurat')" class="w-full bg-[#cc0000] rounded-2xl p-5 md:p-6 text-left flex items-center gap-5 hover:bg-red-700 transition shadow-md shadow-red-900/10 cursor-pointer active:scale-[0.99]">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm animate-pulse">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-1 uppercase tracking-wider flex items-center gap-2">
                                <span>Lapor Darurat</span>
                                <span class="text-xs bg-white/20 text-white px-2.5 py-0.5 rounded-full font-bold">Fast-Track</span>
                            </h2>
                            <p class="text-red-100 text-sm font-medium">Tekan untuk melaporkan insiden kritis yang membutuhkan penanganan segera (Korsleting, Pipa Pecah, Bahaya).</p>
                        </div>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column: Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden relative">
                            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <h3 class="font-bold text-gray-900 text-[17px]">Buat Laporan Baru</h3>
                                </div>
                                <span class="bg-gray-100 text-gray-600 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Standard Form</span>
                            </div>
                            
                            <form action="{{ route('pelapor.lapor') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5" onsubmit="return validateReportForm(event)">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5 flex items-center justify-between">
                                            <span>Nama Pelapor</span>
                                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full inline-flex items-center gap-1.5 {{ (str_contains(strtolower($user->nama ?? ''), 'guru') || str_contains(strtolower($user->email ?? ''), 'guru')) ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                                @if(str_contains(strtolower($user->nama ?? ''), 'guru') || str_contains(strtolower($user->email ?? ''), 'guru'))
                                                    <svg class="w-3.5 h-3.5 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v5m4-5v5m4-5v5M3 4h18M4 4h16v9H4V4zm4 15h8"></path></svg>
                                                    <span>Guru Sekolah</span>
                                                @else
                                                    <svg class="w-3.5 h-3.5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                                    <span>Siswa</span>
                                                @endif
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </div>
                                            <input type="text" name="nama_pelapor" value="{{ $user->nama }}" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-10 pr-4 text-sm text-slate-800 font-semibold focus:ring-0">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Tingkat Urgensi Kerusakan <span class="text-red-500">*</span></label>
                                        <div class="grid grid-cols-3 gap-2">
                                            <!-- Rendah -->
                                            <label class="urgency-option cursor-pointer border-2 border-slate-200 rounded-xl p-2.5 hover:border-emerald-400 transition-all bg-white relative block text-center has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:shadow-xs">
                                                <input type="radio" name="tingkat_urgensi" value="rendah" class="sr-only" onchange="onUrgencySelected('rendah')">
                                                <span class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-emerald-700">
                                                    <svg class="w-2.5 h-2.5 text-emerald-500 fill-current" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg>
                                                    <span>Rendah</span>
                                                </span>
                                                <span class="block text-[10px] text-slate-500 mt-0.5 font-medium leading-tight">Ringan (4 Tahap)</span>
                                            </label>

                                            <!-- Sedang -->
                                            <label class="urgency-option cursor-pointer border-2 border-slate-200 rounded-xl p-2.5 hover:border-amber-400 transition-all bg-white relative block text-center has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50 has-[:checked]:shadow-xs">
                                                <input type="radio" name="tingkat_urgensi" value="sedang" checked class="sr-only" onchange="onUrgencySelected('sedang')">
                                                <span class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-amber-700">
                                                    <svg class="w-2.5 h-2.5 text-amber-500 fill-current" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg>
                                                    <span>Sedang</span>
                                                </span>
                                                <span class="block text-[10px] text-slate-500 mt-0.5 font-medium leading-tight">Sedang (4 Tahap)</span>
                                            </label>

                                            <!-- Tinggi -->
                                            <label class="urgency-option cursor-pointer border-2 border-slate-200 rounded-xl p-2.5 hover:border-rose-400 transition-all bg-white relative block text-center has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:shadow-xs">
                                                <input type="radio" name="tingkat_urgensi" value="tinggi" class="sr-only" onchange="onUrgencySelected('tinggi')">
                                                <span class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-rose-700">
                                                    <svg class="w-2.5 h-2.5 text-rose-500 fill-current" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3.5"/></svg>
                                                    <span>Tinggi</span>
                                                </span>
                                                <span class="block text-[10px] text-rose-600 mt-0.5 font-extrabold leading-tight">RAB (5 Tahap)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Urgency Indicator Banner -->
                                <div id="urgency-indicator-banner" class="p-3 bg-amber-50/90 border border-amber-200 rounded-xl text-xs text-amber-900 flex items-start gap-2.5 transition-all">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 mt-1 shrink-0"></span>
                                    <div>
                                        <p class="font-bold leading-tight" id="urgency-indicator-title">Urgensi Sedang (Alur 4 Tahapan Tracking)</p>
                                        <p class="text-[11px] text-amber-800 mt-0.5 leading-snug" id="urgency-indicator-desc">Fasilitas mengalami gangguan sebagian. Penanganan langsung dikerjakan oleh teknisi di lapangan tanpa syarat RAB.</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Pilih Apa yang Diperbaiki (Jobdesk Teknisi) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                            </div>
                                            <select name="technician_id" id="form-technician" required onchange="onFormTechnicianChange(this)" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                                                <option value="" disabled selected>Pilih Bidang / Teknisi...</option>
                                                @foreach($emergencyTechnicians as $tech)
                                                    @php
                                                        $cleanName = trim(preg_replace('/\s*\([^)]*Teknisi[^)]*\)/i', '', $tech->nama));
                                                        $catName = $tech->category->name ?? 'Umum';
                                                    @endphp
                                                    <option value="{{ $tech->id_user }}" data-category-id="{{ $tech->category_id }}" data-category-name="{{ $catName }}">
                                                        Teknisi {{ $catName }} ({{ $cleanName }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="category_id" id="form-category-id" value="">
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Lokasi Fasilitas & Ruangan Kejadian <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </div>
                                            <select name="id_fasilitas" id="form-facility" required onchange="onFormFacilityChange(this)" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                                                <option value="" disabled selected>Pilih Lokasi Fasilitas & Ruangan...</option>
                                                @foreach($facilities as $fac)
                                                    <option value="{{ $fac->id_fasilitas }}" data-category-id="{{ $fac->category_id }}">
                                                        {{ $fac->nama_fasilitas }} ({{ $fac->lokasi_detail ?? $fac->kategori_area }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Keluhan / Deskripsi Kerusakan <span class="text-red-500">*</span></label>
                                    <textarea name="deskripsi_kerusakan" rows="3" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400" placeholder="Jelaskan detail keluhan atau masalah fasilitas yang Anda temui..."></textarea>
                                </div>

                                <div>
                                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5 flex items-center justify-between">
                                        <span>Catatan Tambahan untuk Petugas (Opsional)</span>
                                        <span class="text-[11px] text-slate-400 font-normal">Contoh: Di dekat pintu belakang, stop kontak longgar</span>
                                    </label>
                                    <input type="text" name="catatan_tambahan" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400" placeholder="Tambahkan catatan lokasi spesifik atau instruksi penanganan...">
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-2 flex-wrap">
                                        <label class="block text-[13px] font-bold text-gray-700">Lampiran Bukti Foto Kerusakan <span class="text-red-500 font-extrabold">* (Wajib Diisi)</span></label>
                                        <span class="text-xs text-gray-500 font-medium">Pilih salah satu cara pengambilan foto:</span>
                                    </div>

                                    <!-- Switcher Opsi 1 (Kamera Real-Time) vs Opsi 2 (Unggah File) -->
                                    <div class="grid grid-cols-2 gap-2 p-1 bg-gray-100/90 rounded-2xl mb-3 border border-gray-200/70">
                                        <button type="button" id="tab-btn-camera" onclick="switchPhotoTab('camera')" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-white text-blue-700 shadow-xs cursor-pointer">
                                            <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><circle cx="12" cy="13" r="4" stroke-width="2"></circle></svg>
                                            <span class="truncate">Opsi 1: Kamera Real-Time</span>
                                        </button>
                                        <button type="button" id="tab-btn-upload" onclick="switchPhotoTab('upload')" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all text-gray-500 hover:text-gray-800 cursor-pointer">
                                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="truncate">Opsi 2: Unggah File (JPG/PNG)</span>
                                        </button>
                                    </div>

                                    <!-- Shared Hidden File Input, Base64 Fallback & Canvas -->
                                    <input type="file" name="foto_bukti" id="file-upload" class="hidden" accept=".jpg,.jpeg,.png,image/jpeg,image/png" onchange="previewImage(this)">
                                    <input type="hidden" name="foto_kamera_base64" id="foto-kamera-base64" value="">
                                    <canvas id="camera-canvas" class="hidden"></canvas>

                                    <!-- PANEL OPSI 1: KAMERA REAL-TIME -->
                                    <div id="photo-panel-camera" class="block">
                                        <!-- Error Notification (jika izin kamera ditolak / tidak tersedia) -->
                                        <div id="camera-error-banner" class="hidden mb-3 p-3.5 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-2.5 text-xs text-amber-800">
                                            <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            <div class="flex-1">
                                                <p class="font-bold" id="camera-error-text">Tidak dapat mengakses kamera perangkat.</p>
                                                <p class="text-[11px] text-amber-700 mt-0.5">Pastikan izin kamera diizinkan di peramban, atau gunakan Opsi 2 (Unggah File).</p>
                                            </div>
                                            <button type="button" onclick="switchPhotoTab('upload')" class="underline font-bold text-blue-700 text-xs shrink-0 cursor-pointer">Buka Opsi 2</button>
                                        </div>

                                        <!-- 1. Standby State (Belum Buka Kamera & Belum Ada Foto) -->
                                        <div id="camera-standby-state" class="border-2 border-dashed border-blue-200 bg-blue-50/20 rounded-2xl p-6 text-center hover:border-blue-400 hover:bg-blue-50/40 transition-all flex flex-col items-center justify-center min-h-[190px]">
                                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-3 shadow-xs">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><circle cx="12" cy="13" r="4" stroke-width="2"></circle></svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-gray-800 mb-1">Ambil Foto Langsung di Lokasi</h4>
                                            <p class="text-xs text-gray-500 max-w-sm mb-4">Gunakan kamera ponsel atau laptop untuk memotret fisik fasilitas secara langsung saat ini.</p>
                                            <button type="button" onclick="startCamera()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-md shadow-blue-600/20 flex items-center gap-2 transition cursor-pointer active:scale-95">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                                Nyalakan & Buka Kamera
                                            </button>
                                        </div>

                                        <!-- 2. Viewfinder State (Kamera Sedang Aktif Streaming) -->
                                        <div id="camera-viewfinder-state" class="hidden relative bg-black rounded-2xl overflow-hidden shadow-lg border border-gray-800">
                                            <video id="camera-video" autoplay playsinline muted class="w-full h-64 sm:h-80 object-cover"></video>
                                            
                                            <!-- Top Overlays -->
                                            <div class="absolute top-3 left-3 z-10">
                                                <span class="bg-red-600/90 text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1.5 backdrop-blur-xs shadow-md">
                                                    <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                                                    LIVE KAMERA
                                                </span>
                                            </div>

                                            <div class="absolute top-3 right-3 z-10 flex items-center gap-2">
                                                <button type="button" onclick="switchCameraFacing()" title="Putar Kamera Depan / Belakang" class="bg-black/60 hover:bg-black/85 text-white text-xs font-semibold px-3 py-1.5 rounded-xl flex items-center gap-1.5 backdrop-blur-xs transition cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5"></path></svg>
                                                    <span>Putar</span>
                                                </button>
                                            </div>

                                            <!-- Bottom Shutter Action Bar -->
                                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent p-4 flex items-center justify-between z-10">
                                                <button type="button" onclick="stopCamera(true)" class="text-white/80 hover:text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-white/10 transition cursor-pointer">
                                                    Batal
                                                </button>

                                                <!-- Big Shutter Button -->
                                                <button type="button" onclick="captureCameraPhoto()" class="w-14 h-14 rounded-full border-4 border-white bg-blue-600 hover:bg-blue-500 flex items-center justify-center text-white shadow-xl transform active:scale-90 transition cursor-pointer group" title="Ambil Foto">
                                                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><circle cx="12" cy="13" r="4" stroke-width="2"></circle></svg>
                                                </button>

                                                <span class="text-[11px] text-white/70 font-medium hidden sm:inline">Jepret Foto</span>
                                                <div class="sm:hidden w-8"></div>
                                            </div>
                                        </div>

                                        <!-- 3. Result State (Foto Berhasil Ditangkap) -->
                                        <div id="camera-result-state" class="hidden relative rounded-2xl overflow-hidden border border-emerald-200 shadow-sm bg-slate-900 group">
                                            <img id="camera-preview-img" src="" alt="Hasil Foto Kamera" class="w-full h-64 sm:h-80 object-cover">
                                            
                                            <!-- Top Success Badge -->
                                            <div class="absolute top-3 left-3 z-10">
                                                <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-xl flex items-center gap-1.5 shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    Foto Kamera Berhasil Diambil
                                                </span>
                                            </div>

                                            <!-- Bottom Actions -->
                                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/85 via-black/50 to-transparent p-4 flex items-center justify-between gap-2 z-10">
                                                <button type="button" onclick="retakeCameraPhoto()" class="px-4 py-2 bg-white/90 hover:bg-white text-gray-800 rounded-xl text-xs font-bold shadow-md flex items-center gap-1.5 transition cursor-pointer active:scale-95">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5"></path></svg>
                                                    Foto Ulang
                                                </button>

                                                <button type="button" onclick="clearCameraPhoto()" class="px-3 py-2 bg-red-600/90 hover:bg-red-700 text-white rounded-xl text-xs font-bold shadow-md flex items-center gap-1.5 transition cursor-pointer active:scale-95">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PANEL OPSI 2: UNGGAH FILE (JPG / PNG) -->
                                    <div id="photo-panel-upload" class="hidden">
                                        <div onclick="document.getElementById('file-upload').click()" class="border-2 border-dashed border-gray-200 rounded-2xl h-48 flex items-center justify-center text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-all relative overflow-hidden group">
                                            <!-- Default State UI -->
                                            <div id="upload-default-state" class="space-y-1 p-6">
                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <p class="text-sm font-bold text-gray-600">Klik untuk unggah foto</p>
                                                <p class="text-xs text-gray-400 font-medium">Maks. 5MB (Hanya format JPG dan PNG)</p>
                                            </div>

                                            <!-- Preview State UI -->
                                            <div id="upload-preview-state" class="hidden w-full h-full absolute inset-0">
                                                <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                                                <div id="pdf-preview-icon" class="hidden w-full h-full bg-red-50 text-red-500 flex flex-col items-center justify-center p-6">
                                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    <p id="file-name" class="text-xs font-bold truncate max-w-xs"></p>
                                                </div>
                                                <!-- Hover Overlay -->
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white p-4">
                                                    <svg class="w-6 h-6 mb-1 text-gray-250" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5"></path></svg>
                                                    <p class="text-xs font-bold truncate max-w-xs mt-1" id="hover-file-name"></p>
                                                    <p class="text-[10px] text-gray-300">Klik kembali untuk mengganti foto</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-2">
                                    <button type="reset" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer" onclick="resetReportForm()">Batal</button>
                                    <button type="submit" id="btn-submit-report" class="group relative overflow-hidden px-6 py-2.5 flex items-center gap-2 text-sm font-bold text-white bg-gradient-to-r from-[#0B3A82] to-blue-700 hover:from-blue-900 hover:to-blue-800 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md hover:shadow-blue-900/20 active:scale-95 cursor-pointer disabled:opacity-80">
                                        <span id="btn-text-content" class="flex items-center gap-2 transition-transform duration-300">
                                            <svg id="submit-plane-icon" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                            <span id="submit-btn-label">Kirim Laporan</span>
                                        </span>
                                        <span id="btn-submitting-content" class="hidden items-center gap-2">
                                            <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>Mengirim Laporan...</span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Tracking & Info -->
                    <div class="space-y-6">
                        
                        <!-- Tracking Card -->
                        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-5 border-b border-gray-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <h3 class="font-bold text-gray-900 text-base">Lacak Tiket</h3>
                            </div>
                            
                            <div class="p-5">
                                <p class="text-[13px] text-gray-500 font-medium mb-4 leading-relaxed">Masukkan ID Tiket Anda untuk melihat status penanganan terkini.</p>
                                
                                <form action="{{ route('pelapor.track') }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <input type="text" name="ticket_id" placeholder="CTH: TKT 0600" required class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:outline-none uppercase">
                                    <button type="submit" class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </button>
                                </form>

                                @if(session('track_error'))
                                    <div class="mt-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-semibold">
                                        {{ session('track_error') }}
                                    </div>
                                @endif

                                @if(session('tracked_ticket'))
                                    @php $tracked = session('tracked_ticket'); @endphp
                                    <div onclick="openTicketDetail({{ json_encode($tracked) }})" class="mt-5 bg-blue-50 p-4 rounded-xl border border-blue-100 cursor-pointer hover:bg-blue-100/50 transition-colors">
                                        @if($tracked->foto_bukti)
                                            <img src="{{ asset('storage/' . $tracked->foto_bukti) }}" class="w-full h-32 object-cover rounded-lg mb-3">
                                        @endif
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="text-xs font-bold text-blue-800 bg-blue-200 px-2.5 py-0.5 rounded-full">TKT {{ str_pad($tracked->id_laporan, 4, '0', STR_PAD_LEFT) }}</span>
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-widest bg-blue-100 text-blue-700">{{ $tracked->status_laporan }}</span>
                                        </div>
                                        <h4 class="font-bold text-sm text-gray-900 line-clamp-1 truncate">{{ $tracked->facility->nama_fasilitas ?? 'Fasilitas' }}</h4>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $tracked->deskripsi_kerusakan }}</p>
                                    </div>
                                @endif
                                
                                <div class="mt-6">
                                    <div class="bg-[#F8F9FA] rounded-xl p-4">
                                        <h4 class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-4">Laporan Terbaru Anda</h4>
                                        
                                        <div class="space-y-3">
                                            @forelse($myReports as $report)
                                            <div onclick="openTicketDetail({{ json_encode($report) }})" class="flex gap-3 bg-white p-3 rounded-lg border border-gray-100 shadow-sm relative overflow-hidden group hover:border-blue-200 transition-colors cursor-pointer">
                                                @if($report->foto_bukti)
                                                    <img src="{{ asset('storage/' . $report->foto_bukti) }}" class="w-10 h-10 rounded-lg object-cover">
                                                @else
                                                    <div class="w-10 h-10 rounded-lg shrink-0 flex items-center justify-center {{ $report->is_emergency ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-600' }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path></svg>
                                                    </div>
                                                @endif
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-2 mb-1">
                                                        <h4 class="text-sm font-bold text-gray-900 truncate">{{ $report->facility->nama_fasilitas ?? 'Fasilitas' }}</h4>
                                                        @php
                                                            $statusColor = match($report->status_laporan) {
                                                                'selesai' => 'bg-green-100 text-green-700',
                                                                'darurat' => 'bg-red-100 text-red-700',
                                                                'proses', 'proses_perbaikan', 'diproses' => 'bg-blue-100 text-blue-700',
                                                                'menunggu_rab' => 'bg-amber-100 text-amber-700',
                                                                default => 'bg-[#FFEDE1] text-[#E0643D]'
                                                            };
                                                        @endphp
                                                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider {{ $statusColor }}">
                                                            {{ $report->status_laporan }}
                                                        </span>
                                                    </div>
                                                    <p class="text-[11px] text-gray-500 font-medium">TKT-[{{ str_pad($report->id_laporan, 4, '0', STR_PAD_LEFT) }}] • {{ $report->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            @empty
                                                <p class="text-xs text-gray-400 text-center py-2">Belum ada laporan.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="bg-[#f5f3ff] border border-[#ede9fe] rounded-[20px] p-5 flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#8b5cf6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="text-[13px] font-bold text-[#5b21b6] mb-1">Jam Operasional Teknisi</h4>
                                <p class="text-xs text-[#7c3aed] leading-relaxed font-medium">Tim fasilitas beroperasi pukul 08:00 - 16:00. Laporan di luar jam tersebut akan diproses pada hari kerja berikutnya, kecuali bersifat darurat.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <footer class="mt-12 text-center text-[11px] font-medium text-gray-400 border-t border-gray-100 pt-6 pb-4">
                &copy; {{ date('Y') }} SIPERFAS - Sistem Informasi Pelaporan Fasilitas. All rights reserved.
            </footer>
        </div>
    </main>

    <!-- Modal Detail Tiket & Tracking Interaktif (Sama seperti halaman Tiket) -->
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

    <!-- Modal script -->
    <script>
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

        let currentActiveTicket = null;

        function openTicketDetail(elementOrData) {
            try {
                let ticket;
                if (elementOrData instanceof HTMLElement) {
                    ticket = JSON.parse(elementOrData.getAttribute('data-report'));
                } else if (typeof elementOrData === 'string') {
                    ticket = JSON.parse(elementOrData);
                } else {
                    ticket = elementOrData;
                }

                if (!ticket) return;

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
            const modal = document.getElementById('ticketModal');
            if (modal) modal.classList.add('hidden');
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
            const modal = document.getElementById('imageZoomModal');
            if (modal) modal.classList.add('hidden');
        }

        // Alias for backwards compatibility
        const openReportModal = openTicketDetail;
        const closeReportModal = closeTicketDetail;

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const zoomModal = document.getElementById('imageZoomModal');
                if (zoomModal && !zoomModal.classList.contains('hidden')) {
                    closeImageZoom();
                } else {
                    closeTicketDetail();
                }
            }
        });

        const allFacilities = @json($facilities);

        function populateAllFacilities(selectEl, selectedId = null) {
            if (!selectEl) return;
            selectEl.innerHTML = '';
            selectEl.disabled = false;

            const defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.disabled = true;
            defaultOpt.selected = !selectedId;
            defaultOpt.textContent = 'Pilih Lokasi Fasilitas & Ruangan...';
            selectEl.appendChild(defaultOpt);

            allFacilities.forEach(fac => {
                const opt = document.createElement('option');
                opt.value = fac.id_fasilitas;
                opt.setAttribute('data-category-id', fac.category_id || '');
                opt.textContent = `${fac.nama_fasilitas} (${fac.lokasi_detail || fac.kategori_area})`;
                if (selectedId && String(fac.id_fasilitas) === String(selectedId)) {
                    opt.selected = true;
                }
                selectEl.appendChild(opt);
            });
        }

        function filterFacilitiesByCategoryId(catId, selectEl, defaultText, preserveFacId = null) {
            if (!selectEl) return;
            selectEl.innerHTML = '';
            
            if (!catId) {
                populateAllFacilities(selectEl, preserveFacId);
                return;
            }

            // Filter facilities matching category_id
            const matched = allFacilities.filter(f => {
                if (f.category_id) return String(f.category_id) === String(catId);
                const text = ((f.nama_fasilitas || '') + ' ' + (f.kategori_area || '') + ' ' + (f.lokasi_detail || '')).toLowerCase();
                if (String(catId) === '1' && /(listrik|lampu|stop\s*kontak|saklar|ac|kabel|panel|sound|elektronik)/i.test(text)) return true;
                if (String(catId) === '2' && /(air|wastafel|pipa|sanitasi|toilet|keran|kran|wc|tandon)/i.test(text)) return true;
                if (String(catId) === '3' && /(bangunan|struktur|furnitur|pintu|meja|kursi|plafon|atap|lantai|dinding|kaca)/i.test(text)) return true;
                if (String(catId) === '4' && /(komputer|pc|proyektor|laptop|server|layar|infocus|laboratorium|printer)/i.test(text)) return true;
                if (String(catId) === '6' && /(jaringan|wifi|internet|router|switch)/i.test(text)) return true;
                if (String(catId) === '7' && /(kendaraan|motor|mobil|bus|sepeda|parkir)/i.test(text)) return true;
                return false;
            });
            selectEl.disabled = false;

            let preservedFound = false;
            const defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.disabled = true;
            defaultOpt.textContent = defaultText || 'Pilih Fasilitas / Ruangan...';
            selectEl.appendChild(defaultOpt);

            if (matched.length === 0) {
                const emptyOpt = document.createElement('option');
                emptyOpt.value = '';
                emptyOpt.disabled = true;
                emptyOpt.selected = true;
                emptyOpt.textContent = 'Semua fasilitas untuk bidang ini sedang dalam penanganan perbaikan';
                selectEl.appendChild(emptyOpt);
            } else {
                matched.forEach(fac => {
                    const opt = document.createElement('option');
                    opt.value = fac.id_fasilitas;
                    opt.setAttribute('data-category-id', fac.category_id || '');
                    opt.textContent = `${fac.nama_fasilitas} (${fac.lokasi_detail || fac.kategori_area})`;
                    if (preserveFacId && String(fac.id_fasilitas) === String(preserveFacId)) {
                        opt.selected = true;
                        preservedFound = true;
                    }
                    selectEl.appendChild(opt);
                });
                if (!preservedFound) {
                    defaultOpt.selected = true;
                }
            }
        }

        function onFormTechnicianChange(select) {
            const opt = select.options[select.selectedIndex];
            const catId = opt.getAttribute('data-category-id');
            const catName = opt.getAttribute('data-category-name');
            
            const catIdInput = document.getElementById('form-category-id');
            if (catIdInput) catIdInput.value = catId || '';

            const facSelect = document.getElementById('form-facility');
            const currentFacId = facSelect ? facSelect.value : null;
            filterFacilitiesByCategoryId(catId, facSelect, `Pilih Fasilitas (${catName})...`, currentFacId);
        }

        function onFormFacilityChange(select) {
            const opt = select.options[select.selectedIndex];
            if (!opt) return;
            const catId = opt.getAttribute('data-category-id');
            if (!catId) return;

            const catIdInput = document.getElementById('form-category-id');
            if (catIdInput) catIdInput.value = catId;

            // Otomatis pilih teknisi yang sesuai bidang keahlian fasilitas
            const techSelect = document.getElementById('form-technician');
            if (techSelect) {
                for (let i = 0; i < techSelect.options.length; i++) {
                    const techOpt = techSelect.options[i];
                    if (String(techOpt.getAttribute('data-category-id')) === String(catId)) {
                        techSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        // --- REAL-TIME CAMERA & ATTACHMENT LOGIC ---
        let activePhotoTab = 'camera';
        let cameraStream = null;
        let cameraFacing = 'environment';

        function switchPhotoTab(tab) {
            activePhotoTab = tab;
            const btnCam = document.getElementById('tab-btn-camera');
            const btnUp = document.getElementById('tab-btn-upload');
            const panelCam = document.getElementById('photo-panel-camera');
            const panelUp = document.getElementById('photo-panel-upload');

            if (tab === 'camera') {
                if (btnCam) btnCam.className = 'flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-white text-blue-700 shadow-xs cursor-pointer';
                if (btnUp) btnUp.className = 'flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all text-gray-500 hover:text-gray-800 cursor-pointer';
                if (panelCam) panelCam.classList.remove('hidden');
                if (panelUp) panelUp.classList.add('hidden');
            } else {
                if (btnUp) btnUp.className = 'flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-white text-blue-700 shadow-xs cursor-pointer';
                if (btnCam) btnCam.className = 'flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all text-gray-500 hover:text-gray-800 cursor-pointer';
                if (panelUp) panelUp.classList.remove('hidden');
                if (panelCam) panelCam.classList.add('hidden');
                // Hentikan streaming kamera jika sedang berjalan saat beralih tab
                stopCamera(false);
            }
        }

        async function startCamera() {
            const standby = document.getElementById('camera-standby-state');
            const viewfinder = document.getElementById('camera-viewfinder-state');
            const result = document.getElementById('camera-result-state');
            const errorBanner = document.getElementById('camera-error-banner');
            const video = document.getElementById('camera-video');

            if (errorBanner) errorBanner.classList.add('hidden');

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                showCameraError('Peramban Anda tidak mendukung akses kamera secara langsung. Silakan gunakan Opsi 2 (Unggah Berkas).');
                return;
            }

            try {
                // Hentikan stream yang ada sebelumnya bila ada
                stopCamera(false);

                let constraints = {
                    video: {
                        facingMode: { ideal: cameraFacing },
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                };

                try {
                    cameraStream = await navigator.mediaDevices.getUserMedia(constraints);
                } catch (e) {
                    // Fallback jika facingMode ditolak oleh peramban tertentu
                    cameraStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                }

                if (video) {
                    video.srcObject = cameraStream;
                    await video.play();
                }

                if (standby) standby.classList.add('hidden');
                if (result) result.classList.add('hidden');
                if (viewfinder) viewfinder.classList.remove('hidden');
            } catch (err) {
                console.error('Camera access error:', err);
                let msg = 'Kamera tidak dapat diakses atau izin kamera belum diizinkan.';
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    msg = 'Izin kamera ditolak. Berikan izin kamera pada peramban Anda, atau gunakan Opsi 2 (Unggah File).';
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    msg = 'Kamera tidak ditemukan pada perangkat Anda.';
                }
                showCameraError(msg);
            }
        }

        function showCameraError(msg) {
            const errorBanner = document.getElementById('camera-error-banner');
            const errorText = document.getElementById('camera-error-text');
            if (errorText) errorText.textContent = msg;
            if (errorBanner) errorBanner.classList.remove('hidden');
        }

        function stopCamera(showStandby = true) {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
            const video = document.getElementById('camera-video');
            if (video) {
                video.srcObject = null;
            }

            const viewfinder = document.getElementById('camera-viewfinder-state');
            if (viewfinder) viewfinder.classList.add('hidden');

            if (showStandby) {
                const standby = document.getElementById('camera-standby-state');
                const result = document.getElementById('camera-result-state');
                const previewImg = document.getElementById('camera-preview-img');
                if (previewImg && previewImg.src && previewImg.src.startsWith('data:image')) {
                    if (result) result.classList.remove('hidden');
                    if (standby) standby.classList.add('hidden');
                } else {
                    if (standby) standby.classList.remove('hidden');
                    if (result) result.classList.add('hidden');
                }
            }
        }

        function switchCameraFacing() {
            cameraFacing = (cameraFacing === 'environment') ? 'user' : 'environment';
            startCamera();
        }

        function captureCameraPhoto() {
            const video = document.getElementById('camera-video');
            const canvas = document.getElementById('camera-canvas');
            if (!video || !canvas) return;

            const width = video.videoWidth || 640;
            const height = video.videoHeight || 480;

            canvas.width = width;
            canvas.height = height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, width, height);

            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);

            // Tampilkan foto di UI preview
            const previewImg = document.getElementById('camera-preview-img');
            if (previewImg) previewImg.src = dataUrl;

            // Simpan ke hidden input foto_kamera_base64
            const base64Input = document.getElementById('foto-kamera-base64');
            if (base64Input) base64Input.value = dataUrl;

            // Masukkan ke file-upload input melalui DataTransfer agar validasi Laravel multipart berjalan lancar
            canvas.toBlob(function(blob) {
                if (blob) {
                    try {
                        const file = new File([blob], "bukti_kamera_" + Date.now() + ".jpg", { type: "image/jpeg" });
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        const fileInput = document.getElementById('file-upload');
                        if (fileInput) fileInput.files = dt.files;
                    } catch (e) {
                        console.warn('DataTransfer not available, relying on base64 fallback:', e);
                    }
                }
            }, 'image/jpeg', 0.9);

            // Hentikan stream kamera dan tampilkan state result
            stopCamera(false);
            const viewfinder = document.getElementById('camera-viewfinder-state');
            const result = document.getElementById('camera-result-state');
            const standby = document.getElementById('camera-standby-state');
            if (viewfinder) viewfinder.classList.add('hidden');
            if (standby) standby.classList.add('hidden');
            if (result) result.classList.remove('hidden');
        }

        function retakeCameraPhoto() {
            clearCameraPhoto();
            startCamera();
        }

        function clearCameraPhoto() {
            const previewImg = document.getElementById('camera-preview-img');
            if (previewImg) previewImg.src = '';

            const base64Input = document.getElementById('foto-kamera-base64');
            if (base64Input) base64Input.value = '';

            const fileInput = document.getElementById('file-upload');
            if (fileInput) fileInput.value = '';

            stopCamera(false);

            const result = document.getElementById('camera-result-state');
            const standby = document.getElementById('camera-standby-state');
            const viewfinder = document.getElementById('camera-viewfinder-state');
            if (result) result.classList.add('hidden');
            if (viewfinder) viewfinder.classList.add('hidden');
            if (standby) standby.classList.remove('hidden');
        }

        function resetReportForm() {
            clearCameraPhoto();
            resetImagePreview();
            switchPhotoTab('camera');
            const facSelect = document.getElementById('form-facility');
            if (facSelect) {
                populateAllFacilities(facSelect);
            }
            const catIdInput = document.getElementById('form-category-id');
            if (catIdInput) catIdInput.value = '';
            resetSubmitButtonState();
        }

        function resetSubmitButtonState() {
            const btn = document.getElementById('btn-submit-report');
            const planeIcon = document.getElementById('submit-plane-icon');
            const btnText = document.getElementById('btn-text-content');
            const btnSubmitting = document.getElementById('btn-submitting-content');
            const overlay = document.getElementById('submit-report-overlay');

            if (btn) {
                btn.disabled = false;
                btn.classList.remove('pointer-events-none');
            }
            if (planeIcon) {
                planeIcon.classList.remove('animate-plane-fly');
            }
            if (btnText && btnSubmitting) {
                btnText.classList.remove('hidden');
                btnSubmitting.classList.add('hidden');
                btnSubmitting.classList.remove('flex');
            }
            if (overlay) {
                overlay.classList.add('hidden');
                if (overlay.firstElementChild) {
                    overlay.firstElementChild.classList.remove('scale-100');
                    overlay.firstElementChild.classList.add('scale-95');
                }
            }
        }

        function triggerSubmitReportAnimation() {
            const btn = document.getElementById('btn-submit-report');
            const planeIcon = document.getElementById('submit-plane-icon');
            const btnText = document.getElementById('btn-text-content');
            const btnSubmitting = document.getElementById('btn-submitting-content');
            const overlay = document.getElementById('submit-report-overlay');
            const progressFill = document.getElementById('submit-progress-fill');
            const stepText = document.getElementById('submit-step-text');

            if (btn) {
                btn.classList.add('pointer-events-none');
                setTimeout(() => { btn.disabled = true; }, 100);
            }
            if (planeIcon) {
                planeIcon.classList.add('animate-plane-fly');
            }
            if (btnText && btnSubmitting) {
                setTimeout(() => {
                    btnText.classList.add('hidden');
                    btnSubmitting.classList.remove('hidden');
                    btnSubmitting.classList.add('flex');
                }, 180);
            }

            if (overlay) {
                setTimeout(() => {
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        if (overlay.firstElementChild) {
                            overlay.firstElementChild.classList.remove('scale-95');
                            overlay.firstElementChild.classList.add('scale-100');
                        }
                    }, 20);

                    if (progressFill) {
                        setTimeout(() => { progressFill.style.width = '35%'; }, 80);
                        setTimeout(() => { 
                            progressFill.style.width = '70%'; 
                            if (stepText) stepText.textContent = 'Mendaftarkan tiket laporan ke sistem...';
                        }, 700);
                        setTimeout(() => { 
                            progressFill.style.width = '94%'; 
                            if (stepText) stepText.textContent = 'Menghubungkan notifikasi ke teknisi SarPras...';
                        }, 1500);
                    }
                }, 200);
            }
        }

        function validateReportForm(e) {
            const form = (e && e.target) ? e.target : document.querySelector('form[action="{{ route('pelapor.lapor') }}"]');
            if (form && !form.checkValidity()) {
                return false;
            }

            const fileInput = document.getElementById('file-upload');
            const base64Input = document.getElementById('foto-kamera-base64');
            const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasBase64 = base64Input && base64Input.value && base64Input.value.trim() !== '';

            if (!hasFile && !hasBase64) {
                if (e) e.preventDefault();
                alert('Foto bukti kerusakan wajib dilampirkan!\nSilakan gunakan Opsi 1 (Kamera Real-Time) untuk memotret atau Opsi 2 (Unggah File) untuk memilih foto bukti.');
                return false;
            }

            triggerSubmitReportAnimation();
            return true;
        }

        function previewImage(input) {
            const file = input.files && input.files[0];
            const defaultState = document.getElementById('upload-default-state');
            const previewState = document.getElementById('upload-preview-state');
            const imagePreview = document.getElementById('image-preview');
            const pdfIcon = document.getElementById('pdf-preview-icon');
            const fileName = document.getElementById('file-name');
            const hoverFileName = document.getElementById('hover-file-name');

            if (file) {
                const fName = file.name.toLowerCase();
                const isValidExt = fName.endsWith('.jpg') || fName.endsWith('.jpeg') || fName.endsWith('.png');
                const isValidMime = file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpg';

                if (!isValidExt || !isValidMime) {
                    alert('Format file tidak sesuai! Bukti lampiran hanya diperbolehkan format JPG dan PNG.');
                    resetImagePreview();
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal ukuran file adalah 5MB.');
                    resetImagePreview();
                    return;
                }

                // Bersihkan data foto kamera agar berkas file yang diunggah diprioritaskan
                const base64Input = document.getElementById('foto-kamera-base64');
                if (base64Input) base64Input.value = '';
                const cameraPreviewImg = document.getElementById('camera-preview-img');
                if (cameraPreviewImg) cameraPreviewImg.src = '';

                if (fileName) fileName.innerText = file.name;
                if (hoverFileName) hoverFileName.innerText = file.name;
                
                defaultState.classList.add('hidden');
                previewState.classList.remove('hidden');

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    if (pdfIcon) pdfIcon.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                resetImagePreview();
            }
        }

        function resetImagePreview() {
            const input = document.getElementById('file-upload');
            if (input) input.value = "";
            
            const defState = document.getElementById('upload-default-state');
            const prevState = document.getElementById('upload-preview-state');
            if (defState) defState.classList.remove('hidden');
            if (prevState) prevState.classList.add('hidden');
            
            const imagePreview = document.getElementById('image-preview');
            if (imagePreview) {
                imagePreview.src = "#";
                imagePreview.classList.add('hidden');
            }
            
            const pdfIcon = document.getElementById('pdf-preview-icon');
            if (pdfIcon) pdfIcon.classList.add('hidden');
            const nameEl = document.getElementById('file-name');
            if (nameEl) nameEl.innerText = "";
            const hoverNameEl = document.getElementById('hover-file-name');
            if (hoverNameEl) hoverNameEl.innerText = "";
        }

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function onEmergencyTechnicianChange(select) {
            const opt = select.options[select.selectedIndex];
            const cat = opt.getAttribute('data-category') || '';
            const catId = opt.getAttribute('data-category-id') || '';

            const catIdInput = document.getElementById('emergency-category-id');
            if (catIdInput) catIdInput.value = catId;

            const descEl = document.getElementById('emergency-desc');
            if (descEl && (!descEl.value || descEl.value.startsWith('Insiden Darurat:'))) {
                descEl.value = 'Insiden Darurat: ' + cat;
            }

            const facSelect = document.getElementById('emergency-facility');
            filterFacilitiesByCategoryId(catId, facSelect, `Pilih Lokasi Kejadian (${cat})...`);
        }
    </script>

    <!-- Modal Lapor Darurat Cepat -->
    <div id="modal-darurat" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4 transition-all">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 lg:p-7 shadow-2xl border border-red-100 animate-in fade-in zoom-in-95 duration-150">
            <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Kirim Panggilan Darurat</h3>
                        <p class="text-xs text-slate-500 font-medium">Petugas teknisi terkait akan langsung menerima peringatan siaga.</p>
                    </div>
                </div>
                <button type="button" onclick="toggleModal('modal-darurat')" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('pelapor.darurat') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- 1. Pilih Teknisi / Kategori Insiden Terlebih Dahulu -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">1. Pilih Kategori Insiden / Petugas Penanganan</label>
                    <select name="technician_id" id="emergency-technician" required onchange="onEmergencyTechnicianChange(this)" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-3.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 cursor-pointer">
                        <option value="" disabled selected>Pilih Kategori Insiden / Petugas...</option>
                        @foreach($emergencyTechnicians as $tech)
                            @php
                                $cleanName = trim(preg_replace('/\s*\([^)]*Teknisi[^)]*\)/i', '', $tech->nama));
                                $catName = $tech->category->name ?? 'Umum';
                            @endphp
                            <option value="{{ $tech->id_user }}" data-category-id="{{ $tech->category_id }}" data-category="{{ $catName }}">
                                {{ $catName }} — {{ $cleanName }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="category_id" id="emergency-category-id" value="">
                </div>

                <!-- 2. Pilih Fasilitas Sesuai Kategori Teknisi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">2. Pilih Lokasi / Fasilitas Darurat</label>
                    <select name="id_fasilitas" id="emergency-facility" required disabled class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-3.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed">
                        <option value="" disabled selected>-- Pilih Petugas / Teknisi terlebih dahulu --</option>
                    </select>
                </div>

                <!-- 3. Deskripsi Singkat -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">3. Deskripsi Singkat Kejadian</label>
                    <textarea name="deskripsi_kerusakan" id="emergency-desc" rows="2" required placeholder="Jelaskan secara singkat kondisi darurat yang terjadi..." class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 resize-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3">
                    <button type="button" onclick="toggleModal('modal-darurat')" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">Batal</button>
                    <button type="submit" class="bg-[#cc0000] hover:bg-red-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md flex items-center gap-2 cursor-pointer active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span>Kirim Sinyal Darurat</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Bottom Navigation Bar (Khusus Layar Ponsel) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-4 py-2 flex items-center justify-around safe-area-bottom">
        <!-- 1. Lapor Kerusakan (Aktif) -->
        <a href="{{ route('pelapor.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold">
            <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Lapor Kerusakan</span>
            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
        </a>

        <!-- 2. Tiket / WO -->
        <a href="{{ route('pelapor.tickets') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium relative">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Tiket / WO</span>
            @if(($ongoingCount ?? 0) > 0)
                <span class="absolute top-0.5 right-6 w-4 h-4 bg-blue-600 text-white rounded-full text-[9px] flex items-center justify-center font-bold">{{ $ongoingCount }}</span>
            @endif
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

    <script>
        // Urgency Card Selection Handler
        function onUrgencySelected(urg) {
            const banner = document.getElementById('urgency-indicator-banner');
            const title = document.getElementById('urgency-indicator-title');
            const desc = document.getElementById('urgency-indicator-desc');
            if (!banner || !title || !desc) return;

            if (urg === 'rendah') {
                banner.className = 'p-3 bg-emerald-50/90 border border-emerald-200 rounded-xl text-xs text-emerald-900 flex items-start gap-2.5 transition-all';
                title.textContent = 'Urgensi Rendah (Alur 4 Tahapan Tracking)';
                desc.textContent = 'Kerusakan ringan / minor. Laporan langsung dikerjakan teknisi di lapangan tanpa syarat pengajuan RAB.';
            } else if (urg === 'sedang') {
                banner.className = 'p-3 bg-amber-50/90 border border-amber-200 rounded-xl text-xs text-amber-900 flex items-start gap-2.5 transition-all';
                title.textContent = 'Urgensi Sedang (Alur 4 Tahapan Tracking)';
                desc.textContent = 'Fasilitas mengalami gangguan sebagian. Penanganan langsung dieksekusi teknisi di lapangan tanpa syarat RAB.';
            } else if (urg === 'tinggi') {
                banner.className = 'p-3 bg-rose-50/90 border border-rose-200 rounded-xl text-xs text-rose-900 flex items-start gap-2.5 transition-all';
                title.textContent = 'Urgensi Tinggi (Alur 5 Tahapan Tracking - Butuh RAB & Approval Admin)';
                desc.textContent = 'Kerusakan berat / mati total. Teknisi wajib mengajukan formulir Rencana Anggaran Biaya (RAB) ke Admin Sarpras terlebih dahulu untuk disetujui sebelum pengerjaan fisik dapat dimulai.';
            }
        }
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
        function openTicketDetailAndMarkRead(ticket) {
            if (!ticket) return;

            // Tutup popover notifikasi
            const notifDropdown = document.getElementById('pelaporNotificationDropdown');
            if (notifDropdown) notifDropdown.classList.add('hidden');

            // Munculkan popup tiket langsung
            openTicketDetail(ticket);

            const id = ticket.id_laporan;

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

        // Pulihkan tombol jika kembali via browser back button (bfcache)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                resetSubmitButtonState();
            }
        });
    </script>

    <!-- Overlay Animasi Pengiriman Laporan (Super Smooth & Premium) -->
    <div id="submit-report-overlay" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="bg-white/95 backdrop-blur-xl border border-white/60 rounded-3xl p-8 max-w-sm w-full shadow-2xl shadow-blue-900/30 text-center relative overflow-hidden transform scale-95 transition-all duration-300">
            <!-- Glowing Background Circles -->
            <div class="absolute -top-16 -left-16 w-36 h-36 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-16 -right-16 w-36 h-36 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>

            <!-- Central Animated Graphic -->
            <div class="relative w-24 h-24 mx-auto mb-5 flex items-center justify-center">
                <!-- Ping Ripple Wave -->
                <div class="absolute inset-0 rounded-full bg-blue-400/20 animate-ping"></div>
                <!-- Outer Radial Dashed Ring -->
                <div class="absolute inset-1 rounded-full border-2 border-dashed border-blue-400/50 animate-[spin_10s_linear_infinite]"></div>
                <!-- Center Bouncing Icon Box -->
                <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-700 via-blue-600 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/35 animate-bounce">
                    <svg class="w-8 h-8 -rotate-12 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
            </div>

            <!-- Title & Dynamic Step -->
            <h4 class="text-lg font-bold text-slate-900 mb-1">Mengirim Laporan...</h4>
            <p id="submit-step-text" class="text-xs font-semibold text-blue-600 mb-4 transition-all duration-300">Mengunggah berkas & foto bukti...</p>

            <!-- Animated Progress Bar -->
            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden mb-3.5 border border-slate-200/70 p-0.5 shadow-inner">
                <div id="submit-progress-fill" class="h-full bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400 rounded-full transition-all duration-700 ease-out w-0 animate-shimmer" style="background-size: 200% 100%;"></div>
            </div>

            <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                Mohon tunggu sejenak, data dan bukti foto laporan sedang didaftarkan ke sistem SarPras.
            </p>
        </div>
    </div>

    <!-- Mobile Bottom Navigation Bar (Khusus Layar Ponsel) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-4 py-2 flex items-center justify-around safe-area-bottom">
        <!-- 1. Lapor Kerusakan (Aktif) -->
        <a href="{{ route('pelapor.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold">
            <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-[10px] mt-1 tracking-tight">Lapor Kerusakan</span>
            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
        </a>

        <!-- 2. Tiket / WO -->
        <a href="{{ route('pelapor.tickets') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium relative">
            <div class="relative">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                @if(($ongoingCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-2 px-1.5 py-0.2 bg-blue-600 text-white rounded-full text-[9px] font-extrabold shadow-xs">{{ $ongoingCount }}</span>
                @endif
            </div>
            <span class="text-[10px] mt-1 tracking-tight">Tiket / WO</span>
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
