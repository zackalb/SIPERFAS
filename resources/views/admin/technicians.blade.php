<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Petugas & Teknisi - SIPERFAS</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-all group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <!-- Menu Data Petugas (Aktif) -->
                <a href="{{ route('admin.technicians.index') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-50/70 text-blue-700 rounded-xl text-sm font-bold border-l-[3px] border-blue-600 transition-all shadow-xs">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <!-- Topbar: Konsisten Admin SarPras -->
        <header class="bg-white border-b border-slate-100 flex items-center justify-between px-8 py-4 z-10 shrink-0">
            <h2 class="text-xl font-extrabold text-blue-950 tracking-tight">Admin SarPras</h2>

            <!-- Notifications & Profile -->
            <div class="flex items-center space-x-5">
                <button class="text-slate-500 hover:text-blue-600 transition-all relative">
                    <svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    @if($hasEmergency ?? false)
                        <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-red-600 rounded-full border-2 border-white animate-pulse"></span>
                    @endif
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

            <!-- Flash Error Message -->
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

            <!-- 1. Header Page & Add Button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-black text-blue-950 tracking-tight">Data Petugas & Teknisi Lapangan</h3>
                    <p class="text-xs text-slate-500 font-medium mt-1">Kelola data petugas, akun login, dan spesialisasi kategori penanganan perbaikan fasilitas.</p>
                </div>
                <button type="button" onclick="openAddModal()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs flex items-center gap-2 transition-all shadow-md shadow-blue-600/20 cursor-pointer active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Tambah Petugas Teknisi</span>
                </button>
            </div>

            <!-- 2. KPI Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <!-- TOTAL TEKNISI -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">TOTAL PETUGAS</p>
                        <h3 class="text-3xl font-black text-blue-900 mt-2 tracking-tight">{{ $totalTechnicians }}</h3>
                        <p class="text-[11px] text-slate-400 font-semibold mt-1">Akun teknisi aktif di sistem</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- TUGAS AKTIF -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">TUGAS SEDANG BERJALAN</p>
                        <h3 class="text-3xl font-black text-amber-600 mt-2 tracking-tight">{{ $activeTasksTotal }}</h3>
                        <p class="text-[11px] text-amber-600 font-semibold mt-1">Dalam proses / inspeksi teknisi</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- TOTAL SELESAI -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider">PERBAIKAN SELESAI</p>
                        <h3 class="text-3xl font-black text-emerald-600 mt-2 tracking-tight">{{ $completedTasksTotal }}</h3>
                        <p class="text-[11px] text-emerald-600 font-semibold mt-1">Tiket sukses diperbaiki</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 3. Filter & Search Controls -->
            <form method="GET" action="{{ route('admin.technicians.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex flex-1 flex-wrap items-center gap-3 w-full">
                    <!-- Search Input -->
                    <div class="relative flex-1 min-w-[240px]">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" id="tech-search" name="search" value="{{ request('search') }}" oninput="filterTechnicians()" placeholder="Cari nama teknisi atau email..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    <!-- Filter Kategori Spesialisasi -->
                    <select id="tech-filter-category" name="category_id" onchange="filterTechnicians()" class="px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <option value="">Semua Spesialisasi Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                    <button type="button" onclick="resetTechFilter()" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Reset Filter
                    </button>
                    <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Terapkan
                    </button>
                </div>
            </form>

            <!-- 4. Technicians Table View with Pagination & Action Column -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="overflow-x-auto min-h-[420px]">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/80 text-slate-400 font-bold bg-slate-50/50">
                                <th class="px-6 py-4 font-bold">PETUGAS / TEKNISI</th>
                                <th class="px-6 py-4 font-bold">SPESIALISASI</th>
                                <th class="px-6 py-4 font-bold text-center">STATUS</th>
                                <th class="px-6 py-4 font-bold text-center">TUGAS AKTIF</th>
                                <th class="px-6 py-4 font-bold text-center">SELESAI</th>
                                <th class="px-6 py-4 font-bold text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100" id="tech-table-body">
                            @forelse($technicians as $tech)
                                @php
                                    $catName = $tech->category ? $tech->category->name : 'Umum';
                                    $catId = $tech->category_id;
                                    $lowerCat = strtolower($catName);
                                    
                                    // Sesuai dengan icon di Dashboard (Fasilitas Sering Rusak)
                                    if ($catId == 1 || stripos($lowerCat, 'listrik') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
                                        $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                    } elseif ($catId == 2 || stripos($lowerCat, 'air') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>';
                                        $badgeClass = 'bg-sky-50 text-sky-700 border-sky-200';
                                    } elseif ($catId == 3 || stripos($lowerCat, 'bangunan') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>';
                                        $badgeClass = 'bg-orange-50 text-orange-700 border-orange-200';
                                    } elseif ($catId == 4 || $lowerCat === 'it' || stripos($lowerCat, 'komputer') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>';
                                        $badgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-200';
                                    } elseif ($catId == 6 || stripos($lowerCat, 'jaringan') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>';
                                        $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                    } elseif ($catId == 7 || stripos($lowerCat, 'kendaraan') !== false || stripos($lowerCat, 'mobil') !== false || stripos($lowerCat, 'motor') !== false) {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM3 13l2-6a2 2 0 012-1h10a2 2 0 012 1l2 6m-16 0h16m0 0v4a1 1 0 01-1 1h-1a1 1 0 01-1-1v-1H6v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-4z"/></svg>';
                                        $badgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                    } else {
                                        $iconSvg = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
                                        $badgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                    }
                                @endphp
                                <tr class="tech-row hover:bg-slate-50/70 transition-colors"
                                    data-nama="{{ strtolower($tech->nama) }}"
                                    data-email="{{ strtolower($tech->email) }}"
                                    data-kategori="{{ $tech->category_id }}">
                                    <!-- Petugas: Avatar & Nama/Email -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3.5">
                                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 font-extrabold text-sm flex items-center justify-center border border-blue-200 shadow-xs shrink-0">
                                                {{ strtoupper(substr($tech->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 text-sm leading-tight hover:text-blue-600 transition-colors">
                                                    {{ $tech->nama }}
                                                </div>
                                                <div class="text-[11px] text-slate-400 font-medium font-mono mt-0.5">
                                                    {{ $tech->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Spesialisasi Badge -->
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold border inline-flex items-center gap-1.5 {{ $badgeClass }}">
                                            <span class="inline-flex items-center">{!! $iconSvg !!}</span>
                                            <span>{{ $catName }}</span>
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Siap Ditugaskan
                                        </span>
                                    </td>

                                    <!-- Tugas Aktif -->
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-black {{ $tech->active_tasks_count > 0 ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-slate-50 text-slate-500 border border-slate-200' }}">
                                            {{ $tech->active_tasks_count }} Tiket
                                        </span>
                                    </td>

                                    <!-- Selesai -->
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-black {{ $tech->completed_tasks_count > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-50 text-slate-500 border border-slate-200' }}">
                                            {{ $tech->completed_tasks_count }} Tiket
                                        </span>
                                    </td>

                                    <!-- Action Dropdown Menu (Titik 3) -->
                                    <td class="px-6 py-4 text-center relative">
                                        <div class="relative inline-block text-left">
                                            <button type="button" onclick="toggleTechActionMenu(event, 'tech-menu-{{ $tech->id_user }}')" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors mx-auto cursor-pointer" title="Pilihan Aksi">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 8a2 2 0 110-4 2 2 0 010 4zm0 2a2 2 0 110 4 2 2 0 010-4zm0 6a2 2 0 110 4 2 2 0 010-4z"></path>
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu Box -->
                                            <div id="tech-menu-{{ $tech->id_user }}" class="hidden absolute right-0 mt-1.5 w-36 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-30 text-left">
                                                <button type="button" onclick="openEditModal({{ json_encode($tech) }}); closeAllTechMenus();" class="w-full flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors text-left cursor-pointer">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    <span>Edit Petugas</span>
                                                </button>
                                                <button type="button" onclick="confirmDelete({{ $tech->id_user }}, '{{ addslashes($tech->nama) }}'); closeAllTechMenus();" class="w-full flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors text-left cursor-pointer">
                                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span>Hapus Petugas</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">
                                        Belum ada data petugas teknisi terdaftar.
                                    </td>
                                </tr>
                            @endforelse

                            <!-- Hidden row for no search results -->
                            <tr id="tech-no-results" class="hidden">
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="font-semibold text-slate-700 text-sm">Tidak ada data petugas yang sesuai</p>
                                        <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci pencarian atau filter spesialisasi Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer / Pagination -->
                <div class="bg-slate-50/75 border-t border-slate-200/80 px-6 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs font-semibold text-slate-500" id="tech-count-display">Menampilkan 0 petugas</span>
                    <div id="techPagination" class="flex items-center gap-1.5">
                        <!-- Tombol navigasi halaman (‹ 1 2 3 ›) digenerate secara dinamis -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Teknisi Baru -->
    <div id="addModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-7 shadow-2xl border border-slate-100 transition-all transform animate-in fade-in zoom-in-95 duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900">Tambah Petugas Teknisi</h3>
                        <p class="text-[11px] text-slate-400 font-medium">Daftarkan akun teknisi dan pilih bidang spesialisasi.</p>
                    </div>
                </div>
                <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.technicians.store') }}" class="mt-5 space-y-4">
                @csrf
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Teknisi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" required placeholder="Contoh: Joko Perkasa, S.T." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Email Login -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Login <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required placeholder="Contoh: joko.teknisi@sekolah.com" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Password Awal -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Password Awal <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" id="create_tech_password" name="password" required value="password123" placeholder="Minimal 6 karakter" class="w-full pl-3.5 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <button type="button" onclick="togglePasswordVisibility('create_tech_password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer" title="Tampilkan / Sembunyikan Kata Sandi">
                            <svg class="eye-open w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg class="eye-closed w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Default: <code class="font-mono bg-slate-100 px-1 py-0.5 rounded">password123</code> (dapat diubah teknisi nanti).</p>
                </div>

                <!-- Kategori Spesialisasi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Spesialisasi <span class="text-red-500">*</span></label>
                    <input type="text" name="kategori" list="category_suggestions" required placeholder="Contoh: Listrik, AC, Plumbing, Bangunan, IT, CCTV..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <datalist id="category_suggestions">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}">
                        @endforeach
                    </datalist>
                    <p class="text-[10px] text-slate-400 mt-1">Ketik nama spesialisasi bidang teknisi (bebas diisi sesuai kebutuhan).</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-3">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition-all shadow-md shadow-blue-600/20 cursor-pointer">
                        Simpan Teknisi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Teknisi -->
    <div id="editModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-7 shadow-2xl border border-slate-100 transition-all transform">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900">Edit Data Teknisi</h3>
                        <p class="text-[11px] text-slate-400 font-medium">Perbarui profil dan spesialisasi petugas.</p>
                    </div>
                </div>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="editForm" method="POST" action="" class="mt-5 space-y-4">
                @csrf
                @method('PUT')
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Teknisi <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_nama" name="nama" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Email Login -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Login <span class="text-red-500">*</span></label>
                    <input type="email" id="edit_email" name="email" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Password Baru (Opsional) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Password Baru (Opsional)</label>
                    <div class="relative">
                        <input type="password" id="edit_tech_password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full pl-3.5 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <button type="button" onclick="togglePasswordVisibility('edit_tech_password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer" title="Tampilkan / Sembunyikan Kata Sandi">
                            <svg class="eye-open w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg class="eye-closed w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Kategori Spesialisasi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Spesialisasi <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_kategori" name="kategori" list="category_suggestions" required placeholder="Contoh: Listrik, AC, Plumbing, Bangunan, IT, CCTV..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    <p class="text-[10px] text-slate-400 mt-1">Ketik nama spesialisasi bidang teknisi (bebas diisi sesuai kebutuhan).</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition-all shadow-md shadow-blue-600/20 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-100 text-center">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3 class="text-base font-black text-slate-900">Hapus Petugas Teknisi?</h3>
            <p class="text-xs text-slate-500 mt-1">Apakah Anda yakin ingin menghapus akun <span id="delete_tech_name" class="font-bold text-slate-800"></span> dari sistem?</p>

            <form id="deleteForm" method="POST" action="" class="mt-6 flex items-center justify-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                    Batal
                </button>
                <button type="submit" class="w-1/2 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs transition-all shadow-md shadow-red-600/20">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        function resetPasswordToggle(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;
            input.type = 'password';
            const btn = input.parentElement ? input.parentElement.querySelector('button') : null;
            if (btn) {
                const eyeOpen = btn.querySelector('.eye-open');
                const eyeClosed = btn.querySelector('.eye-closed');
                if (eyeOpen && eyeClosed) {
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                }
            }
        }

        function openAddModal() {
            resetPasswordToggle('create_tech_password');
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            resetPasswordToggle('create_tech_password');
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(tech) {
            resetPasswordToggle('edit_tech_password');
            document.getElementById('edit_nama').value = tech.nama;
            document.getElementById('edit_email').value = tech.email;
            document.getElementById('edit_kategori').value = tech.category ? tech.category.name : '';
            document.getElementById('editForm').action = "/admin/technicians/" + tech.id_user;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            resetPasswordToggle('edit_tech_password');
            document.getElementById('editModal').classList.add('hidden');
        }

        function confirmDelete(id, name) {
            document.getElementById('delete_tech_name').innerText = name;
            document.getElementById('deleteForm').action = "/admin/technicians/" + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // ==========================================
        // TOGGLE SHOW / HIDE PASSWORD
        // ==========================================
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');
            if (eyeOpen && eyeClosed) {
                if (isPassword) {
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                } else {
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                }
            }
        }

        // ==========================================
        // ACTION DROPDOWN MENU
        // ==========================================
        function toggleTechActionMenu(event, menuId) {
            event.stopPropagation();
            document.querySelectorAll('[id^="tech-menu-"]').forEach(m => {
                if (m.id !== menuId) m.classList.add('hidden');
            });
            const target = document.getElementById(menuId);
            if (target) target.classList.toggle('hidden');
        }

        function closeAllTechMenus() {
            document.querySelectorAll('[id^="tech-menu-"]').forEach(m => m.classList.add('hidden'));
        }

        document.addEventListener('click', closeAllTechMenus);

        // ==========================================
        // PAGINASI TABEL PETUGAS (MINIMAL 10 BARIS PER HALAMAN)
        // ==========================================
        const TECH_PAGE_SIZE = 10;
        let currentTechPage = 1;

        function filterTechnicians(resetPage = true) {
            if (resetPage) {
                currentTechPage = 1;
            }

            const query = (document.getElementById('tech-search')?.value || '').toLowerCase().trim();
            const categoryId = document.getElementById('tech-filter-category')?.value || '';

            const rows = Array.from(document.querySelectorAll('.tech-row'));
            const matchedRows = [];

            rows.forEach(row => {
                const nama = (row.getAttribute('data-nama') || '').toLowerCase();
                const email = (row.getAttribute('data-email') || '').toLowerCase();
                const cat = row.getAttribute('data-kategori') || '';

                const matchesQuery = !query || nama.includes(query) || email.includes(query);
                const matchesCategory = !categoryId || cat === categoryId;

                if (matchesQuery && matchesCategory) {
                    matchedRows.push(row);
                } else {
                    row.classList.add('hidden');
                }
            });

            const totalMatched = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalMatched / TECH_PAGE_SIZE));

            if (currentTechPage > totalPages) currentTechPage = totalPages;
            if (currentTechPage < 1) currentTechPage = 1;

            // Sembunyikan semua row yang cocok terlebih dahulu
            matchedRows.forEach(r => r.classList.add('hidden'));

            // Tampilkan hanya slice 10 baris pada halaman aktif
            const startIdx = (currentTechPage - 1) * TECH_PAGE_SIZE;
            const endIdx = startIdx + TECH_PAGE_SIZE;
            const pageRows = matchedRows.slice(startIdx, endIdx);
            pageRows.forEach(r => r.classList.remove('hidden'));

            // Handle empty state pencarian
            const noResults = document.getElementById('tech-no-results');
            if (noResults) {
                if (totalMatched === 0 && rows.length > 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            // Update info counter
            const countDisplay = document.getElementById('tech-count-display');
            if (countDisplay) {
                if (totalMatched === 0) {
                    countDisplay.innerText = 'Menampilkan 0 petugas';
                } else {
                    const from = startIdx + 1;
                    const to = startIdx + pageRows.length;
                    countDisplay.innerText = `Menampilkan ${from} hingga ${to} dari ${totalMatched} petugas`;
                }
            }

            // Render tombol paginasi
            renderTechPagination(totalPages, currentTechPage);
        }

        function renderTechPagination(totalPages, current) {
            const container = document.getElementById('techPagination');
            if (!container) return;
            container.innerHTML = '';

            if (totalPages <= 1) return;

            // Tombol Prev (‹)
            const prevBtn = document.createElement('button');
            prevBtn.type = 'button';
            prevBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${current === 1 ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            prevBtn.innerHTML = '‹';
            prevBtn.disabled = current === 1;
            prevBtn.onclick = () => {
                if (current > 1) {
                    currentTechPage = current - 1;
                    filterTechnicians(false);
                }
            };
            container.appendChild(prevBtn);

            // Nomor Halaman
            let startPage = Math.max(1, current - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            if (startPage > 1) {
                container.appendChild(createTechPageBtn(1, current === 1));
                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
            }

            for (let p = startPage; p <= endPage; p++) {
                container.appendChild(createTechPageBtn(p, p === current));
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
                container.appendChild(createTechPageBtn(totalPages, current === totalPages));
            }

            // Tombol Next (›)
            const nextBtn = document.createElement('button');
            nextBtn.type = 'button';
            nextBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${current === totalPages ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            nextBtn.innerHTML = '›';
            nextBtn.disabled = current === totalPages;
            nextBtn.onclick = () => {
                if (current < totalPages) {
                    currentTechPage = current + 1;
                    filterTechnicians(false);
                }
            };
            container.appendChild(nextBtn);
        }

        function createTechPageBtn(page, isActive) {
            const btn = document.createElement('button');
            btn.type = 'button';
            if (isActive) {
                btn.className = 'w-8 h-8 rounded-lg bg-[#1e3a8a] text-white font-bold flex items-center justify-center text-xs shadow-xs';
            } else {
                btn.className = 'w-8 h-8 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition-all cursor-pointer';
            }
            btn.innerText = page;
            btn.onclick = () => {
                currentTechPage = page;
                filterTechnicians(false);
            };
            return btn;
        }

        function resetTechFilter() {
            const s = document.getElementById('tech-search');
            const c = document.getElementById('tech-filter-category');
            if (s) s.value = '';
            if (c) c.value = '';
            filterTechnicians(true);
        }

        // Inisialisasi awal paginasi saat dokumen siap
        document.addEventListener('DOMContentLoaded', () => {
            filterTechnicians(true);
        });
    </script>
    @include('partials.logout-modal')
</body>
</html>
