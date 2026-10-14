<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAdmin ? 'Pengaturan Sistem' : 'Pengaturan Keamanan' }} - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        .checkered-pattern {
            background-color: #f8fafc;
            background-image: linear-gradient(45deg, #e2e8f0 25%, transparent 25%), 
                              linear-gradient(-45deg, #e2e8f0 25%, transparent 25%), 
                              linear-gradient(45deg, transparent 75%, #e2e8f0 75%), 
                              linear-gradient(-45deg, transparent 75%, #e2e8f0 75%);
            background-size: 16px 16px;
            background-position: 0 0, 0 8px, 8px -8px, -8px 0px;
        }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex h-screen overflow-hidden">

    @if($isAdmin)
        <!-- Unified Admin Sidebar -->
        @include('partials.admin-sidebar')
    @else
        <!-- Non-Admin Sidebar (Petugas / Pelapor) -->
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col h-full hidden md:flex shrink-0">
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
                    @if(in_array($role, ['petugas', 'teknisi', 'staf']))
                        <a href="{{ route('petugas.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span>Tugas Perbaikan</span>
                        </a>
                    @else
                        <a href="{{ route('pelapor.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Lapor Kerusakan</span>
                        </a>
                        <a href="{{ route('pelapor.tickets') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            <span>Tiket Saya</span>
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Sidebar Footer / Settings & Logout -->
            <div class="mt-auto p-6 border-t border-slate-100">
                <div class="space-y-1.5">
                    <a href="{{ route('settings.security') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-50/80 text-blue-700 rounded-xl text-sm font-bold border-l-4 border-blue-600 transition-all shadow-xs">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Pengaturan</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-xl text-sm font-medium transition-all cursor-pointer">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    @endif

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Topbar: Responsif Mobile & Desktop -->
        <header class="bg-white border-b border-slate-100 flex items-center justify-between px-4 sm:px-8 py-3.5 z-20 shrink-0">
            <div class="flex items-center space-x-3">
                @if($isAdmin)
                    <button type="button" onclick="toggleAdminSidebar()" class="md:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer" aria-label="Buka Menu Sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                @else
                    <a href="{{ route('dashboard') }}" class="md:hidden text-slate-500 hover:text-slate-800 mr-1 p-1 rounded-lg hover:bg-slate-100 transition-colors" aria-label="Kembali ke Dashboard">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    </a>
                @endif
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">
                        {{ $isAdmin ? 'Pengaturan Sistem' : 'Pengaturan Keamanan' }}
                    </h2>
                        <p class="text-[11px] sm:text-xs text-slate-500 hidden sm:block">
                            {{ $isAdmin ? 'Kelola autentikasi keamanan, identitas logo aplikasi, dan riwayat log aktivitas' : 'Kelola Autentikasi Dua Faktor (2FA) dan perlindungan akun Anda' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-4">
                    @php
                        $userStatus = strtolower($user->status ?? $user->role ?? 'pelapor');
                        $isPetugas = in_array($userStatus, ['petugas', 'teknisi', 'staf', 'admin']);
                        
                        $labelJabatan = 'Siswa';
                        if ($role === 'admin' || $userStatus === 'admin') {
                            $labelJabatan = 'Administrator Sarpras';
                        } elseif (in_array($role, ['petugas', 'teknisi'])) {
                            $labelJabatan = 'Petugas Teknisi';
                        } elseif (str_contains(strtolower($user->nama ?? ''), 'guru') || str_contains(strtolower($user->email ?? ''), 'guru')) {
                            $labelJabatan = 'Guru Sekolah';
                        }
                    @endphp

                    <!-- User Profile Button & Dropdown -->
                    <div class="relative" id="securityProfileContainer">
                        <button type="button" onclick="toggleSecurityProfileDropdown()" class="flex items-center space-x-3 p-1 rounded-full hover:bg-slate-50 transition-all cursor-pointer focus:outline-none">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm sm:text-base flex items-center justify-center border border-blue-200 shadow-xs shrink-0 group-hover:ring-2 group-hover:ring-blue-400 transition-all">
                                {{ strtoupper(substr($user->nama ?? 'U', 0, 1)) }}
                            </div>
                        </button>

                        <!-- Profile Popover / Dropdown Menu -->
                        <div id="securityProfileDropdown" class="hidden absolute right-0 mt-2.5 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in duration-150">
                            <div class="px-4 py-2.5 border-b border-slate-100">
                                <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->nama ?? 'Pengguna' }}</p>
                                <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">{{ $user->email ?? '' }}</p>
                                <span class="inline-block mt-1.5 px-2 py-0.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-md">
                                    {{ $labelJabatan }}
                                </span>
                            </div>
                            <div class="p-1.5">
                                <form method="POST" action="{{ route('logout') }}" id="header-logout-form">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-2.5 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-auto p-4 md:p-8 bg-[#f8fafc] pb-24 md:pb-8">
                <div class="max-w-5xl mx-auto space-y-6">

                    <!-- Notification Messages -->
                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-2xl flex items-start gap-3 shadow-sm">
                            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-sm">Autentikasi Dua Faktor telah disiapkan!</p>
                                <p class="text-xs mt-0.5 text-blue-700">Silakan pindai kode QR di bawah menggunakan Google Authenticator atau Authy, lalu masukkan 6-digit kode OTP untuk menyelesaikan konfirmasi.</p>
                            </div>
                        </div>
                    @elseif (session('status') == 'two-factor-authentication-confirmed')
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold">2FA Berhasil Diaktifkan!</h4>
                                <p class="text-xs mt-0.5 text-blue-700">Autentikasi dua faktor sekarang aktif untuk akun Anda. Harap simpan kode pemulihan (recovery codes) Anda di tempat yang aman.</p>
                            </div>
                        </div>
                    @elseif (session('status') == 'two-factor-authentication-disabled')
                        <div class="p-4 bg-slate-100 border border-slate-200 text-slate-700 rounded-2xl flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold">2FA Telah Dinonaktifkan</h4>
                                <p class="text-xs mt-0.5">Perlindungan autentikasi dua faktor akun Anda telah dimatikan.</p>
                            </div>
                        </div>
                    @elseif (session('status') == 'logo-updated' || session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm animate-in fade-in duration-200">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold">{{ session('success') ?? 'Pengaturan Berhasil Disimpan!' }}</h4>
                                <p class="text-xs mt-0.5 text-emerald-700">Perubahan pengaturan telah berhasil diperbarui dan diterapkan ke seluruh sistem.</p>
                            </div>
                        </div>
                    @elseif (session('status') == 'logo-reset')
                        <div class="p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-2xl flex items-start gap-3 shadow-sm animate-in fade-in duration-200">
                            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold">Logo Berhasil Direset</h4>
                                <p class="text-xs mt-0.5 text-blue-700">Logo aplikasi kini telah dikembalikan menggunakan logo default SIPERFAS.</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-start gap-3 shadow-sm">
                            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-bold text-xs uppercase tracking-wider mb-1">Terjadi Kesalahan:</p>
                                @foreach ($errors->all() as $error)
                                    <p class="text-xs">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- User Account Card -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0B3A82] to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-900/10 shrink-0">
                                {{ strtoupper(substr($user->nama ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold text-slate-800">{{ $user->nama }}</h3>
                                    <span class="px-2 py-0.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-md">
                                        {{ $labelJabatan }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 font-mono-code">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        <div>
                            @if ($twoFactorEnabled)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    2FA Aktif & Terlindungi
                                </span>
                            @elseif ($twoFactorPending)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/80">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Menunggu Konfirmasi Kode
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    2FA Belum Aktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Role Admin Navigation Tabs -->
                    @if($isAdmin)
                        <div class="bg-white p-1.5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center space-x-1 overflow-x-auto">
                            <button type="button" onclick="switchSettingsTab('security')" id="tab-btn-security" class="flex-1 min-w-[130px] flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $activeTab === 'security' ? 'bg-[#0B3A82] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span>Keamanan & 2FA</span>
                            </button>

                            <button type="button" onclick="switchSettingsTab('logo')" id="tab-btn-logo" class="flex-1 min-w-[130px] flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $activeTab === 'logo' ? 'bg-[#0B3A82] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Logo Aplikasi</span>
                                @if($isCustomLogo)
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                @endif
                            </button>

                            <button type="button" onclick="switchSettingsTab('logs')" id="tab-btn-logs" class="flex-1 min-w-[130px] flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $activeTab === 'logs' ? 'bg-[#0B3A82] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                <span>Riwayat Log Aktivitas</span>
                                <span class="px-1.5 py-0.2 bg-slate-200 text-slate-700 text-[10px] rounded-full font-bold">
                                    {{ $logStats['total'] }}
                                </span>
                            </button>
                        </div>
                    @endif

                    <!-- ========================================== -->
                    <!-- TAB 1: KEAMANAN & 2FA                      -->
                    <!-- ========================================== -->
                    <div id="tab-content-security" class="{{ $activeTab === 'security' ? '' : 'hidden' }} space-y-6">
                        <!-- 2FA Main Management Card -->
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-800">Autentikasi Dua Faktor (Two-Factor Authentication)</h3>
                                        <p class="text-xs text-slate-500">Menambahkan lapisan keamanan ekstra ke akun Anda menggunakan aplikasi authenticator.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 space-y-6">
                                {{-- KONDISI 1: 2FA BELUM AKTIF --}}
                                @if (! $twoFactorEnabled && ! $twoFactorPending)
                                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                                        <div class="max-w-xl">
                                            <h4 class="text-sm font-bold text-slate-800 mb-2">Mengapa Anda perlu mengaktifkan 2FA?</h4>
                                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                                Ketika Autentikasi Dua Faktor diaktifkan, Anda akan diminta memasukkan token 6-digit yang aman dan acak dari aplikasi ponsel (seperti <strong>Google Authenticator</strong>, <strong>Microsoft Authenticator</strong>, atau <strong>Authy</strong>) setiap kali Anda masuk ke sistem SIPERFAS.
                                            </p>

                                            <form method="POST" action="{{ route('two-factor.enable') }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-2 bg-[#0B3A82] text-white px-5 py-2.5 rounded-xl hover:bg-blue-800 transition-all font-semibold shadow-md shadow-blue-900/10 text-xs cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    <span>Aktifkan Autentikasi Dua Faktor</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                {{-- KONDISI 2: 2FA PENDING KONFIRMASI (QR CODE DITAMPILKAN) --}}
                                @if ($twoFactorPending)
                                    <div class="bg-blue-50/50 rounded-2xl p-6 border border-blue-100">
                                        <div class="flex items-center gap-2 text-blue-800 font-bold text-sm mb-4">
                                            <span class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">1</span>
                                            <span>Pindai Kode QR dengan Aplikasi Authenticator</span>
                                        </div>

                                        <p class="text-xs text-slate-600 leading-relaxed mb-6">
                                            Buka aplikasi autentikator di ponsel Anda (misalnya <strong>Google Authenticator</strong>), pilih <strong>Scan a QR code</strong>, dan arahkan kamera ke barcode berikut:
                                        </p>

                                        <div class="flex flex-col sm:flex-row items-center gap-8 mb-6">
                                            <!-- QR Code Container -->
                                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 shrink-0">
                                                {!! $qrCodeSvg !!}
                                            </div>

                                            <!-- Manual Secret Key -->
                                            <div class="space-y-3 flex-1 text-center sm:text-left">
                                                <p class="text-xs font-semibold text-slate-700">Tidak bisa memindai barcode?</p>
                                                <p class="text-xs text-slate-500 leading-relaxed">
                                                    Anda dapat memasukkan kode kunci manual (Setup Key) berikut ke aplikasi:
                                                </p>
                                                <div class="flex items-center gap-2 max-w-sm">
                                                    <input 
                                                        type="text" 
                                                        readonly 
                                                        id="setup-key-input"
                                                        value="{{ $setupKey }}" 
                                                        class="w-full font-mono-code text-xs py-2 px-3 bg-white border border-slate-200 rounded-lg text-slate-700 font-semibold select-all"
                                                    >
                                                    <button 
                                                        type="button" 
                                                        onclick="copySetupKey()"
                                                        id="copy-key-btn"
                                                        class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition-colors shrink-0 flex items-center gap-1 cursor-pointer"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>
                                                        <span id="copy-text">Salin</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-t border-blue-100 pt-6">
                                            <div class="flex items-center gap-2 text-blue-800 font-bold text-sm mb-3">
                                                <span class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">2</span>
                                                <span>Konfirmasi Kode OTP 6-Digit</span>
                                            </div>

                                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                                Masukkan 6 digit angka yang muncul di aplikasi autentikator Anda untuk mengonfirmasi pengaktifan 2FA:
                                            </p>

                                            <form method="POST" action="{{ route('two-factor.confirm') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 max-w-md">
                                                @csrf
                                                <input 
                                                    type="text" 
                                                    name="code" 
                                                    inputmode="numeric" 
                                                    autocomplete="one-time-code" 
                                                    maxlength="6" 
                                                    required 
                                                    placeholder="000000" 
                                                    class="font-mono-code text-center tracking-[0.2em] text-lg font-bold py-2.5 px-4 border border-blue-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-slate-800 placeholder-slate-300"
                                                >
                                                <button type="submit" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition-all font-semibold shadow-md shadow-emerald-900/10 text-xs shrink-0 flex items-center justify-center gap-1.5 cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <span>Verifikasi & Aktifkan</span>
                                                </button>
                                            </form>

                                            <div class="mt-4">
                                                <form method="POST" action="{{ route('two-factor.disable') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-red-600 transition-colors cursor-pointer">
                                                        Batalkan Pengaturan 2FA
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- KONDISI 3: 2FA SUDAH AKTIF --}}
                                @if ($twoFactorEnabled)
                                    <div class="space-y-6">
                                        <!-- Recovery Codes Box -->
                                        <div class="bg-slate-900 text-white rounded-2xl p-6 border border-slate-800 shadow-md">
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                                                <div>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                                        </svg>
                                                        <h4 class="text-sm font-bold text-white">Kode Pemulihan Darurat (Recovery Codes)</h4>
                                                    </div>
                                                    <p class="text-xs text-slate-400 mt-1">
                                                        Simpan kode-kode berikut di tempat yang aman. Anda dapat menggunakannya jika kehilangan akses ke perangkat autentikator.
                                                    </p>
                                                </div>

                                                <div class="flex items-center gap-2">
                                                    <button 
                                                        type="button" 
                                                        onclick="copyAllRecoveryCodes()" 
                                                        class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-xs font-medium transition-colors flex items-center gap-1.5 border border-slate-700 cursor-pointer"
                                                    >
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>
                                                        <span id="copy-codes-text">Salin Semua</span>
                                                    </button>

                                                    <button 
                                                        type="button" 
                                                        onclick="downloadRecoveryCodes()" 
                                                        class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-xs font-medium transition-colors flex items-center gap-1.5 border border-slate-700 cursor-pointer"
                                                    >
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                        <span>Unduh .txt</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Grid of Recovery Codes -->
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 bg-slate-950/60 p-4 rounded-xl border border-slate-800/80 mb-4" id="recovery-codes-list">
                                                @foreach ($recoveryCodes as $code)
                                                    <div class="font-mono-code text-xs text-emerald-400 bg-slate-900/80 px-3 py-2 rounded-lg text-center font-bold tracking-wider border border-slate-800/50">
                                                        {{ $code }}
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Regenerate Codes Button -->
                                            <div class="flex items-center justify-between pt-2">
                                                <p class="text-[11px] text-slate-400">Setiap kode pemulihan hanya dapat digunakan satu kali.</p>
                                                
                                                <form method="POST" action="{{ route('two-factor.regenerate-recovery-codes') }}" onsubmit="return confirm('Apakah Anda yakin ingin membuat ulang kode pemulihan? Kode lama Anda tidak akan berlaku lagi.');">
                                                    @csrf
                                                    <button type="submit" class="text-xs font-semibold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                        </svg>
                                                        <span>Buat Ulang Kode Pemulihan</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Disable 2FA Danger Zone -->
                                        <div class="p-5 border border-red-100 bg-red-50/40 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                            <div>
                                                <h4 class="text-xs font-bold text-red-900">Nonaktifkan Autentikasi Dua Faktor</h4>
                                                <p class="text-xs text-red-700/80 mt-0.5">
                                                    Menonaktifkan 2FA akan mengurangi tingkat keamanan akun Anda.
                                                </p>
                                            </div>

                                            <form method="POST" action="{{ route('two-factor.disable') }}" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan Autentikasi Dua Faktor (2FA)? Akun Anda akan menjadi kurang aman.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-semibold shadow-sm transition-colors shrink-0 cursor-pointer">
                                                    Nonaktifkan 2FA
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($isAdmin)
                        <!-- ========================================== -->
                        <!-- TAB 2: PENGATURAN LOGO APLIKASI (ADMIN)    -->
                        <!-- ========================================== -->
                        <div id="tab-content-logo" class="{{ $activeTab === 'logo' ? '' : 'hidden' }} space-y-6">
                            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-bold text-slate-800">Kustomisasi Logo Aplikasi SIPERFAS</h3>
                                            <p class="text-xs text-slate-500">Ubah logo utama yang ditampilkan di sidebar, halaman login, topbar mobile, dan laporan resmi.</p>
                                        </div>
                                    </div>

                                    <div>
                                        @if($isCustomLogo)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                                                Logo Kustom Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                                Logo Bawaan Sistem
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-6 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                                        <!-- Preview Card Logo Aktif -->
                                        <div class="md:col-span-4 bg-slate-50 rounded-2xl p-5 border border-slate-200/80 flex flex-col items-center text-center">
                                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">Logo Aktif Saat Ini</span>
                                            
                                            <div class="w-36 h-36 rounded-2xl checkered-pattern border border-slate-200 flex items-center justify-center p-4 shadow-inner mb-4 relative overflow-hidden group">
                                                <img id="active-logo-img" src="{{ $currentLogo }}" alt="Current Logo" class="max-w-full max-h-full object-contain drop-shadow-sm transition-transform duration-200 group-hover:scale-105">
                                            </div>

                                            <p class="text-xs font-semibold text-slate-700 mb-1">Pratinjau Logo Sistem</p>
                                            <p class="text-[11px] text-slate-400 max-w-[200px] leading-relaxed mb-4">
                                                Logo ini aktif tampil pada sidebar menu, halaman login, dan portal pengguna.
                                            </p>

                                            @if($isCustomLogo)
                                                <form method="POST" action="{{ route('admin.settings.logo.reset') }}" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan logo ke logo default bawaan sistem?');" class="w-full">
                                                    @csrf
                                                    <button type="submit" class="w-full py-2 px-3 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                        </svg>
                                                        <span>Kembalikan Logo Default</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                        <!-- Form Upload Logo Baru -->
                                        <div class="md:col-span-8">
                                            <form method="POST" action="{{ route('admin.settings.logo.update') }}" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                
                                                <div class="border-2 border-dashed border-slate-300 hover:border-indigo-500 rounded-2xl p-6 transition-colors bg-white text-center cursor-pointer relative" id="drop-zone">
                                                    <input 
                                                        type="file" 
                                                        name="logo" 
                                                        id="logo-file-input" 
                                                        accept="image/png, image/jpeg, image/jpg, image/svg+xml, image/webp" 
                                                        required 
                                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                                        onchange="handleLogoSelect(this)"
                                                    >
                                                    
                                                    <div id="upload-placeholder" class="space-y-2">
                                                        <div class="w-12 h-12 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-xs">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                            </svg>
                                                        </div>
                                                        <p class="text-xs font-bold text-slate-800">
                                                            Klik untuk memilih berkas atau seret berkas ke sini
                                                        </p>
                                                        <p class="text-[11px] text-slate-400">
                                                            Format: <strong class="text-slate-600">PNG, JPG, SVG, WebP</strong> (Maksimal 2MB)
                                                        </p>
                                                    </div>

                                                    <!-- Live Preview Box (Saat berkas dipilih) -->
                                                    <div id="upload-preview-container" class="hidden flex flex-col items-center justify-center space-y-3">
                                                        <div class="w-24 h-24 rounded-xl checkered-pattern border border-slate-200 flex items-center justify-center p-2 shadow-xs">
                                                            <img id="upload-preview-img" src="" alt="New Logo Preview" class="max-w-full max-h-full object-contain">
                                                        </div>
                                                        <div>
                                                            <p id="upload-preview-name" class="text-xs font-bold text-slate-800 truncate max-w-xs"></p>
                                                            <p id="upload-preview-size" class="text-[10px] text-slate-400"></p>
                                                        </div>
                                                        <span class="inline-block px-2.5 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-semibold rounded-lg">
                                                            Klik area ini untuk memilih berkas gambar lain
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Ketentuan & Panduan Logo -->
                                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200/80">
                                                    <h5 class="text-xs font-bold text-slate-700 mb-2 flex items-center gap-1.5">
                                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span>Tips & Ketentuan Rekomendasi Logo:</span>
                                                    </h5>
                                                    <ul class="text-[11px] text-slate-500 space-y-1 list-disc list-inside">
                                                        <li>Gunakan format <strong>PNG transparan</strong> atau <strong>SVG</strong> untuk tampilan paling tajam dan adaptif di latar belakang putih maupun gelap.</li>
                                                        <li>Rasio aspek ideal adalah <strong>1:1 (persegi)</strong> atau horizontal ringkas (minimal 128 &times; 128 piksel).</li>
                                                        <li>Perubahan logo langsung terlihat di seluruh sistem tanpa perlu memulai ulang server.</li>
                                                    </ul>
                                                </div>

                                                <div class="flex justify-end pt-2">
                                                    <button type="submit" id="save-logo-btn" class="bg-[#0B3A82] hover:bg-blue-800 text-white px-6 py-2.5 rounded-xl font-bold text-xs shadow-md shadow-blue-900/15 transition-all flex items-center gap-2 cursor-pointer">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        <span>Simpan & Terapkan Logo Baru</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================== -->
                        <!-- TAB 3: RIWAYAT LOG AKTIVITAS (ADMIN)       -->
                        <!-- ========================================== -->
                        <div id="tab-content-logs" class="{{ $activeTab === 'logs' ? '' : 'hidden' }} space-y-6">
                            <!-- Stats Cards -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500">Total Log Aktivitas</p>
                                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ number_format($logStats['total']) }}</h3>
                                    </div>
                                </div>

                                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500">Aktivitas Hari Ini</p>
                                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ number_format($logStats['today']) }}</h3>
                                    </div>
                                </div>

                                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-500">Pengguna Aktif Terdata</p>
                                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ number_format($logStats['unique_users']) }}</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter & Search Toolbar Card -->
                            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                                <form method="GET" action="{{ route('settings.security') }}" class="space-y-4">
                                    <input type="hidden" name="tab" value="logs">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3 items-center">
                                        <!-- Search Input -->
                                        <div class="md:col-span-5 relative">
                                            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                            <input 
                                                type="text" 
                                                name="search" 
                                                value="{{ request('search') }}" 
                                                placeholder="Cari aksi, pengguna, atau IP..." 
                                                class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800"
                                            >
                                        </div>

                                        <!-- Filter Aksi -->
                                        <div class="md:col-span-3">
                                            <select name="action_filter" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-700">
                                                <option value="">Semua Aksi</option>
                                                <option value="LOGIN" {{ request('action_filter') === 'LOGIN' ? 'selected' : '' }}>LOGIN (Masuk)</option>
                                                <option value="LOGOUT" {{ request('action_filter') === 'LOGOUT' ? 'selected' : '' }}>LOGOUT (Keluar)</option>
                                                <option value="UPDATE_LOGO" {{ request('action_filter') === 'UPDATE_LOGO' ? 'selected' : '' }}>UPDATE_LOGO (Ganti Logo)</option>
                                                <option value="RESET_LOGO" {{ request('action_filter') === 'RESET_LOGO' ? 'selected' : '' }}>RESET_LOGO (Reset Logo)</option>
                                                <option value="APPROVE_RAB" {{ request('action_filter') === 'APPROVE_RAB' ? 'selected' : '' }}>APPROVE_RAB (Setujui RAB)</option>
                                                <option value="REJECT_RAB" {{ request('action_filter') === 'REJECT_RAB' ? 'selected' : '' }}>REJECT_RAB (Tolak RAB)</option>
                                                <option value="CREATE_REPORT" {{ request('action_filter') === 'CREATE_REPORT' ? 'selected' : '' }}>CREATE_REPORT (Tiket Laporan)</option>
                                                <option value="SYSTEM_INIT" {{ request('action_filter') === 'SYSTEM_INIT' ? 'selected' : '' }}>SYSTEM_INIT (Sistem)</option>
                                            </select>
                                        </div>

                                        <!-- Filter Role -->
                                        <div class="md:col-span-2">
                                            <select name="role_filter" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-700">
                                                <option value="">Semua Role</option>
                                                <option value="admin" {{ request('role_filter') === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="petugas" {{ request('role_filter') === 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                <option value="pelapor" {{ request('role_filter') === 'pelapor' ? 'selected' : '' }}>Pelapor</option>
                                            </select>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="md:col-span-2 flex items-center space-x-2">
                                            <button type="submit" class="w-full py-2 px-3 bg-[#0B3A82] text-white rounded-xl text-xs font-bold hover:bg-blue-800 transition-colors shadow-sm cursor-pointer text-center">
                                                Filter
                                            </button>
                                            @if(request('search') || request('action_filter') || request('role_filter') || request('date_filter'))
                                                <a href="{{ route('settings.security', ['tab' => 'logs']) }}" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-semibold transition-colors" title="Reset Filter">
                                                    Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Activity Logs Table Card -->
                            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                                <th class="py-3.5 px-4 sm:px-6">Waktu & Tanggal</th>
                                                <th class="py-3.5 px-4">Pengguna</th>
                                                <th class="py-3.5 px-4">Tipe Aksi</th>
                                                <th class="py-3.5 px-4">Detail Aktivitas</th>
                                                <th class="py-3.5 px-4 sm:px-6">IP / Perangkat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 text-xs">
                                            @forelse($activityLogs as $log)
                                                @php
                                                    $actionBadgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                                    if ($log->action === 'LOGIN') {
                                                        $actionBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                                    } elseif ($log->action === 'LOGOUT') {
                                                        $actionBadgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                                    } elseif (str_contains($log->action, 'LOGO')) {
                                                        $actionBadgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-200';
                                                    } elseif (str_contains($log->action, 'RAB')) {
                                                        $actionBadgeClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                                    } elseif (str_contains($log->action, 'REPORT')) {
                                                        $actionBadgeClass = 'bg-sky-50 text-sky-700 border-sky-200';
                                                    }
                                                @endphp
                                                <tr class="hover:bg-slate-50/70 transition-colors">
                                                    <!-- Waktu -->
                                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">
                                                        <div class="font-bold text-slate-800 text-xs">
                                                            {{ $log->created_at->format('d M Y, H:i') }}
                                                        </div>
                                                        <div class="text-[10px] text-slate-400">
                                                            {{ $log->created_at->diffForHumans() }}
                                                        </div>
                                                    </td>

                                                    <!-- Pengguna -->
                                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                                        <div class="flex items-center space-x-2.5">
                                                            <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                                                {{ strtoupper(substr($log->user_name ?? 'U', 0, 1)) }}
                                                            </div>
                                                            <div>
                                                                <div class="font-bold text-slate-800 text-xs leading-tight">
                                                                    {{ $log->user_name }}
                                                                </div>
                                                                <span class="inline-block px-1.5 py-0.2 bg-slate-100 text-slate-500 rounded text-[9px] font-semibold uppercase tracking-wider mt-0.5">
                                                                    {{ $log->user_role }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <!-- Tipe Aksi -->
                                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $actionBadgeClass }}">
                                                            {{ $log->action }}
                                                        </span>
                                                    </td>

                                                    <!-- Deskripsi -->
                                                    <td class="py-3.5 px-4 min-w-[240px]">
                                                        <p class="text-xs text-slate-700 font-medium leading-relaxed">
                                                            {{ $log->description }}
                                                        </p>
                                                    </td>

                                                    <!-- IP / Perangkat -->
                                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">
                                                        <div class="font-mono-code text-[11px] text-slate-600 font-semibold">
                                                            {{ $log->ip_address ?? '127.0.0.1' }}
                                                        </div>
                                                        <div class="text-[10px] text-slate-400 truncate max-w-[140px]" title="{{ $log->user_agent }}">
                                                            {{ Str::limit($log->user_agent ?? 'Browser Desktop', 25) }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="py-12 text-center">
                                                        <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                                            </svg>
                                                        </div>
                                                        <p class="text-xs font-bold text-slate-700 mb-0.5">Tidak Ada Riwayat Log Ditemukan</p>
                                                        <p class="text-[11px] text-slate-400">Tidak ada catatan log yang sesuai dengan filter pencarian Anda.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                @if($activityLogs instanceof \Illuminate\Pagination\LengthAwarePaginator && $activityLogs->hasPages())
                                    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                                        {{ $activityLogs->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </main>

    <script>
        function copySetupKey() {
            const copyText = document.getElementById("setup-key-input");
            if (!copyText) return;
            navigator.clipboard.writeText(copyText.value);
            
            const btnText = document.getElementById("copy-text");
            btnText.innerText = "Tersalin!";
            setTimeout(() => {
                btnText.innerText = "Salin";
            }, 2000);
        }

        function copyAllRecoveryCodes() {
            const codes = @json($recoveryCodes);
            const textToCopy = "KODE PEMULIHAN 2FA SIPERFAS\nAkun: {{ $user->email }}\n\n" + codes.join("\n");
            
            navigator.clipboard.writeText(textToCopy);
            const btnText = document.getElementById("copy-codes-text");
            btnText.innerText = "Tersalin!";
            setTimeout(() => {
                btnText.innerText = "Salin Semua";
            }, 2000);
        }

        function downloadRecoveryCodes() {
            const codes = @json($recoveryCodes);
            const textContent = "KODE PEMULIHAN 2FA SIPERFAS\nAkun: {{ $user->email }}\nTanggal: " + new Date().toLocaleString('id-ID') + "\n\n" + codes.join("\n") + "\n\nCatatan: Setiap kode hanya dapat digunakan satu kali.";
            
            const blob = new Blob([textContent], { type: "text/plain;charset=utf-8" });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "siperfas-kode-pemulihan.txt";
            link.click();
        }

        function toggleSecurityProfileDropdown() {
            const profileDropdown = document.getElementById('securityProfileDropdown');
            if (profileDropdown) {
                profileDropdown.classList.toggle('hidden');
            }
        }

        // Close profile dropdown on outside click
        document.addEventListener('click', function(e) {
            const profileContainer = document.getElementById('securityProfileContainer');
            const profileDropdown = document.getElementById('securityProfileDropdown');
            if (profileContainer && profileDropdown && !profileContainer.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // Admin Tab Switching
        function switchSettingsTab(tabName) {
            const tabs = ['security', 'logo', 'logs'];
            tabs.forEach(t => {
                const content = document.getElementById('tab-content-' + t);
                const btn = document.getElementById('tab-btn-' + t);
                if (content && btn) {
                    if (t === tabName) {
                        content.classList.remove('hidden');
                        btn.className = "flex-1 min-w-[130px] flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs font-bold transition-all cursor-pointer bg-[#0B3A82] text-white shadow-md shadow-blue-900/10";
                    } else {
                        content.classList.add('hidden');
                        btn.className = "flex-1 min-w-[130px] flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl text-xs font-bold transition-all cursor-pointer text-slate-600 hover:text-slate-900 hover:bg-slate-50";
                    }
                }
            });

            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            window.history.replaceState({}, '', url);
        }

        // Live Logo Image Preview Handler
        function handleLogoSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-preview-img').src = e.target.result;
                    document.getElementById('upload-preview-name').textContent = file.name;
                    document.getElementById('upload-preview-size').textContent = (file.size / 1024).toFixed(1) + ' KB';
                    
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('upload-preview-container').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    @if(!in_array($role, ['admin']))
        <!-- Mobile Bottom Navigation Bar (Sesuai Role Pengguna) -->
        <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-4 py-2 flex items-center justify-around safe-area-bottom">
            @if(in_array($role, ['petugas', 'teknisi', 'staf']))
                <a href="{{ route('petugas.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="text-[10px] mt-1 tracking-tight">Tugas Perbaikan</span>
                </a>
                <a href="{{ route('settings.security') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold">
                    <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-[10px] mt-1 tracking-tight">Pengaturan</span>
                    <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
                </a>
            @else
                <a href="{{ route('pelapor.dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-[10px] mt-1 tracking-tight">Lapor Kerusakan</span>
                </a>
                <a href="{{ route('pelapor.tickets') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-slate-400 hover:text-slate-600 font-medium">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <span class="text-[10px] mt-1 tracking-tight">Tiket Saya</span>
                </a>
                <a href="{{ route('settings.security') }}" class="flex flex-col items-center justify-center flex-1 py-1 transition-all text-blue-600 font-bold">
                    <svg class="w-5 h-5 text-blue-600 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-[10px] mt-1 tracking-tight">Pengaturan</span>
                    <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mt-0.5"></span>
                </a>
            @endif
        </nav>
    @endif

    <!-- Global Logout Confirmation Modal Include -->
    @include('partials.logout-modal')

</body>
</html>
