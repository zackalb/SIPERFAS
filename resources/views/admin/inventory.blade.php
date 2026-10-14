<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Inventaris & Aset - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex h-screen overflow-hidden">

    <!-- Unified Admin Sidebar -->
    @include('partials.admin-sidebar')

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Topbar -->
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
                        @if($hasEmergency ?? false)
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

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto bg-[#f8fafc] p-6 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-6">

                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-xs">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl flex items-center gap-3 shadow-xs">
                            <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                            <p class="text-sm font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Header Section with Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight">Katalog Inventaris & Aset</h1>
                            <p class="text-slate-500 text-sm mt-1 font-medium">Kelola dan pantau seluruh fasilitas.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button onclick="toggleModal('modal-tambah')" class="bg-[#0f172a] hover:bg-slate-800 text-white px-4.5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-xs flex items-center gap-2 cursor-pointer active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                <span>Tambah Aset</span>
                            </button>
                        </div>
                    </div>

                    <!-- Print Header Dokumen Resmi (Hanya Muncul Saat Print/PDF) -->
                    <div class="hidden print:block mb-6 border-b-2 border-slate-900 pb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-xl font-black text-slate-900 uppercase tracking-wide">SIPERFAS - BUKU INDUK KATALOG INVENTARIS ASET</h1>
                                <p class="text-xs text-slate-600 font-bold mt-0.5">Badan Pengelola Sarana, Prasarana & Manajemen Fasilitas Sekolah</p>
                            </div>
                            <div class="text-right text-[11px] text-slate-500 font-medium">
                                <p>Tanggal Cetak: {{ now()->format('d F Y, H:i') }} WIB</p>
                                <p>Admin: {{ $user->nama ?? 'Admin Sarpras' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Bar -->
                    <div class="bg-white p-3 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row gap-3">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="inventory-search" oninput="filterInventory()" class="w-full bg-slate-50/70 border border-slate-200/80 rounded-xl py-2.5 pl-10 pr-4 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 transition-all" placeholder="Cari Kode Aset, Nama, atau Lokasi...">
                        </div>
                        <div class="flex gap-3">
                            <div class="relative">
                                <select id="filter-kategori" onchange="filterInventory()" class="bg-slate-50/70 border border-slate-200/80 rounded-xl py-2.5 pl-3.5 pr-8 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 min-w-[160px] appearance-none cursor-pointer">
                                    <option value="">Semua Kategori</option>
                                    @if(isset($facilityCategories))
                                        @foreach($facilityCategories as $fCat)
                                            <option value="{{ $fCat->name }}">{{ $fCat->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select id="filter-status" onchange="filterInventory()" class="bg-slate-50/70 border border-slate-200/80 rounded-xl py-2.5 pl-3.5 pr-8 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 min-w-[150px] appearance-none cursor-pointer">
                                    <option value="">Semua Status</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Card 1: Total Aset -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4 hover:border-blue-200 transition-all">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">TOTAL ASET</p>
                                <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight mt-0.5" id="stat-total">{{ $totalAset }}</h3>
                            </div>
                        </div>

                        <!-- Card 2: Kondisi Baik -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4 hover:border-emerald-200 transition-all">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">KONDISI BAIK</p>
                                <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight mt-0.5" id="stat-baik">{{ $kondisiBaik }}</h3>
                            </div>
                        </div>

                        <!-- Card 3: Perlu Perhatian -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4 hover:border-rose-200 transition-all">
                            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">PERLU PERHATIAN</p>
                                <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight mt-0.5" id="stat-perhatian">{{ $perluPerhatian }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse" id="inventory-table">
                                <thead>
                                    <tr class="bg-slate-50/75 border-b border-slate-200/80 text-[11px] uppercase tracking-wider text-slate-500 font-bold">
                                        <th class="px-6 py-3.5">Kode Aset</th>
                                        <th class="px-6 py-3.5">Nama & Kategori</th>
                                        <th class="px-6 py-3.5">Lokasi</th>
                                        <th class="px-6 py-3.5">Status</th>
                                        <th class="px-6 py-3.5">Riwayat Perbaikan</th>
                                        <th class="px-6 py-3.5 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @forelse($inventory as $item)
                                        @php
                                            // Determine asset status logically
                                            $latestReport = $item->damageReports->first();
                                            $status = 'Baik';
                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200/70';
                                            $dotColor = 'bg-emerald-500';
                                            
                                            if ($latestReport) {
                                                if (in_array($latestReport->status_laporan, ['menunggu', 'darurat'])) {
                                                    $status = 'Rusak';
                                                    $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200/70';
                                                    $dotColor = 'bg-rose-500';
                                                } elseif ($latestReport->status_laporan === 'proses') {
                                                    $status = 'Dalam Perbaikan';
                                                    $badgeClass = 'bg-amber-50 text-amber-800 border-amber-200/70';
                                                    $dotColor = 'bg-amber-500';
                                                }
                                            }

                                            // Explicit override if condition in facility table is not Baik
                                            if ($status === 'Baik' && !in_array(strtolower($item->kondisi), ['baik', 'normal'])) {
                                                if (strtolower($item->kondisi) === 'dalam perbaikan') {
                                                    $status = 'Dalam Perbaikan';
                                                    $badgeClass = 'bg-amber-50 text-amber-800 border-amber-200/70';
                                                    $dotColor = 'bg-amber-500';
                                                } else {
                                                    $status = 'Rusak';
                                                    $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200/70';
                                                    $dotColor = 'bg-rose-500';
                                                }
                                            }

                                            // Determine Icon based on Category/Name
                                            $kat = strtolower($item->kategori_area . ' ' . $item->nama_fasilitas);
                                        @endphp
                                        <tr class="hover:bg-slate-50/70 transition-colors group inventory-row" 
                                            data-kode="AST-{{ str_pad($item->id_fasilitas, 3, '0', STR_PAD_LEFT) }}" 
                                            data-nama="{{ strtolower($item->nama_fasilitas) }}" 
                                            data-kategori="{{ $item->kategori_area }}" 
                                            data-lokasi="{{ strtolower($item->lokasi_detail) }}" 
                                            data-status="{{ $status }}">
                                            
                                            <!-- Kode Aset -->
                                            <td class="px-6 py-4.5 whitespace-nowrap">
                                                <span class="font-bold text-slate-800 text-sm tracking-wide">AST-{{ str_pad($item->id_fasilitas, 3, '0', STR_PAD_LEFT) }}</span>
                                            </td>

                                            <!-- Nama & Kategori -->
                                            <td class="px-6 py-4.5">
                                                <div class="flex items-center gap-3.5">
                                                    <div class="w-10 h-10 rounded-xl bg-slate-100/90 text-slate-500 flex items-center justify-center shrink-0 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                                        @if(str_contains($kat, 'ac') || str_contains($kat, 'elektronik') || str_contains($kat, 'proyektor') || str_contains($kat, 'komputer') || str_contains($kat, 'listrik') || str_contains($kat, 'sound'))
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                        @elseif(str_contains($kat, 'kursi') || str_contains($kat, 'meja') || str_contains($kat, 'furnitur'))
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                        @elseif(str_contains($kat, 'sanitasi') || str_contains($kat, 'toilet') || str_contains($kat, 'wastafel') || str_contains($kat, 'pipa'))
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                                        @elseif(str_contains($kat, 'pintu') || str_contains($kat, 'struktur') || str_contains($kat, 'gedung') || str_contains($kat, 'kaca'))
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                        @else
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors">{{ $item->nama_fasilitas }}</div>
                                                        <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $item->kategori_area }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Lokasi -->
                                            <td class="px-6 py-4.5 text-slate-600 font-medium">
                                                {{ $item->lokasi_detail }}
                                            </td>

                                            <!-- Status -->
                                            <td class="px-6 py-4.5 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $badgeClass }}">
                                                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                                    {{ $status }}
                                                </span>
                                            </td>

                                            <!-- Riwayat Perbaikan -->
                                            <td class="px-6 py-4.5 text-slate-600 font-medium text-sm whitespace-nowrap">
                                                @if($latestReport)
                                                    @if($latestReport->status_laporan === 'selesai')
                                                        {{ \Carbon\Carbon::parse($latestReport->tanggal_waktu)->format('d M Y') }}
                                                    @elseif($latestReport->status_laporan === 'proses')
                                                        <span>{{ \Carbon\Carbon::parse($latestReport->tanggal_waktu)->format('d M Y') }}</span>
                                                        <span class="text-amber-700 text-xs font-semibold ml-1">(Sedang Berjalan)</span>
                                                    @else
                                                        <span class="text-slate-400">-</span>
                                                    @endif
                                                @else
                                                    <span class="text-slate-400">-</span>
                                                @endif
                                            </td>

                                            <!-- Aksi -->
                                            <td class="px-6 py-4.5 text-center relative">
                                                <button onclick="toggleActionMenu(event, 'menu-{{ $item->id_fasilitas }}')" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors mx-auto cursor-pointer">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8a2 2 0 110-4 2 2 0 010 4zm0 2a2 2 0 110 4 2 2 0 010-4zm0 6a2 2 0 110 4 2 2 0 010-4z"></path></svg>
                                                </button>
                                                
                                                <!-- Action Dropdown Menu -->
                                                <div id="menu-{{ $item->id_fasilitas }}" class="hidden absolute right-6 top-10 w-40 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-20 text-left">
                                                    <button type="button" onclick="openEditModal({{ json_encode($item) }})" class="w-full flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-colors text-left cursor-pointer">
                                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        Edit Aset
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.inventory.facilities.destroy', $item->id_fasilitas) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset {{ $item->nama_fasilitas }} dari database?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors text-left cursor-pointer">
                                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                            Hapus Aset
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty-state">
                                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                    </div>
                                                    <p class="font-semibold text-slate-700 text-sm">Tidak ada data inventaris.</p>
                                                    <p class="text-xs text-slate-400 mt-1">Silakan tambahkan data aset pertama Anda.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <!-- No Results on Search Message (Hidden by default) -->
                                    <tr id="no-search-results" class="hidden">
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                </div>
                                                <p class="font-semibold text-slate-700 text-sm">Tidak ada aset yang sesuai</p>
                                                <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci atau filter pencarian Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Footer / Pagination -->
                        <div class="bg-slate-50/75 border-t border-slate-200/80 px-6 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <span class="text-xs font-semibold text-slate-500" id="row-count-display">Menampilkan 0 aset</span>
                            <div id="inventoryPagination" class="flex items-center gap-1.5">
                                <!-- Tombol navigasi halaman (‹ 1 2 3 ›) digenerate secara dinamis -->
                            </div>
                        </div>
                    </div>

                    <!-- Footer Tanda Tangan Resmi (Hanya Muncul Saat Cetak / Export PDF) -->
                    <div class="hidden print:flex justify-between items-end mt-12 pt-8 text-xs font-semibold">
                        <div class="space-y-1">
                            <p class="text-slate-500">Status Inventaris: Tercatat & Terverifikasi Aktif</p>
                            <p class="text-slate-500">SIPERFAS - Sistem Informasi Pelaporan Fasilitas</p>
                        </div>
                        <div class="text-center w-64 space-y-16">
                            <p class="text-slate-800">Mengetahui,<br>Kepala Bagian Sarana & Prasarana</p>
                            <p class="font-extrabold text-slate-900 underline uppercase tracking-wider">( {{ $user->nama ?? 'Admin Sarpras' }} )</p>
                        </div>
                    </div>

                </div>
            </div>
        </main>

    <!-- Modal Tambah Aset -->
    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4 transition-all">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-150">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tambah Aset Baru</h3>
                        <p class="text-xs text-slate-500 font-medium">Lengkapi rincian sarana/fasilitas baru.</p>
                    </div>
                </div>
                <button onclick="toggleModal('modal-tambah')" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.inventory.facilities.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Fasilitas / Aset</label>
                    <input type="text" name="nama_fasilitas" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Misal: AC Daikin 2PK">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Fasilitas</label>
                            <button type="button" onclick="openTambahKategoriModal('tambah')" class="text-[11px] text-blue-600 hover:text-blue-800 font-bold flex items-center gap-1 cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span>+ Baru</span>
                            </button>
                        </div>
                        <select name="kategori_area" id="tambah-kategori" onchange="onCategoryAreaChange('tambah')" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer">
                            @if(isset($facilityCategories))
                                @foreach($facilityCategories as $fCat)
                                    <option value="{{ $fCat->name }}" data-category-id="{{ $fCat->category_id }}" data-category-name="{{ $fCat->category->name ?? 'Umum' }}">
                                        {{ $fCat->name }}
                                    </option>
                                @endforeach
                            @endif
                            <option value="__ADD_NEW__" class="font-bold text-blue-600">+ Tambah Kategori Baru...</option>
                        </select>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Bidang Teknisi</label>
                            <span class="text-[10px] text-slate-400 font-bold flex items-center gap-1" title="Bidang teknisi otomatis ditentukan oleh kategori fasilitas">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Terkunci
                            </span>
                        </div>
                        <input type="text" id="tambah-category-id-display" readonly value="" placeholder="Otomatis terisi..." class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-700 cursor-not-allowed select-none focus:outline-none">
                        <input type="hidden" name="category_id" id="tambah-category-id" value="">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kondisi Awal</label>
                        <select name="kondisi" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Lokasi Detail</label>
                        <input type="text" name="lokasi_detail" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Misal: Gedung A, Ruang 302">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3">
                    <button type="button" onclick="toggleModal('modal-tambah')" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">Batal</button>
                    <button type="submit" class="bg-[#0f172a] hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs cursor-pointer">Simpan Aset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Aset -->
    <div id="modal-edit" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4 transition-all">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-150">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Edit Data Aset</h3>
                        <p class="text-xs text-slate-500 font-medium">Perbarui informasi sarana / fasilitas.</p>
                    </div>
                </div>
                <button onclick="toggleModal('modal-edit')" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="form-edit-aset" method="POST" action="" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Fasilitas / Aset</label>
                    <input type="text" name="nama_fasilitas" id="edit-nama" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Fasilitas</label>
                            <button type="button" onclick="openTambahKategoriModal('edit')" class="text-[11px] text-blue-600 hover:text-blue-800 font-bold flex items-center gap-1 cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span>+ Baru</span>
                            </button>
                        </div>
                        <select name="kategori_area" id="edit-kategori" onchange="onCategoryAreaChange('edit')" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer">
                            @if(isset($facilityCategories))
                                @foreach($facilityCategories as $fCat)
                                    <option value="{{ $fCat->name }}" data-category-id="{{ $fCat->category_id }}" data-category-name="{{ $fCat->category->name ?? 'Umum' }}">
                                        {{ $fCat->name }}
                                    </option>
                                @endforeach
                            @endif
                            <option value="__ADD_NEW__" class="font-bold text-blue-600">+ Tambah Kategori Baru...</option>
                        </select>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Bidang Teknisi</label>
                            <span class="text-[10px] text-slate-400 font-bold flex items-center gap-1" title="Bidang teknisi otomatis ditentukan oleh kategori fasilitas">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Terkunci
                            </span>
                        </div>
                        <input type="text" id="edit-category-id-display" readonly value="" placeholder="Otomatis terisi..." class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-700 cursor-not-allowed select-none focus:outline-none">
                        <input type="hidden" name="category_id" id="edit-category-id" value="">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kondisi</label>
                        <select name="kondisi" id="edit-kondisi" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Lokasi Detail</label>
                        <input type="text" name="lokasi_detail" id="edit-lokasi" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3">
                    <button type="button" onclick="toggleModal('modal-edit')" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">Batal</button>
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs cursor-pointer">Perbarui Aset</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Kategori Fasilitas Baru Dinamis -->
    <div id="modal-tambah-kategori" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-60 hidden flex items-center justify-center p-4 transition-all">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in-95 duration-150">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Tambah Kategori Fasilitas</h3>
                        <p class="text-xs text-slate-500">Pasangkan kategori fasilitas dengan bidang teknisinya.</p>
                    </div>
                </div>
                <button type="button" onclick="toggleModal('modal-tambah-kategori')" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="form-tambah-kategori" onsubmit="submitNewFacilityCategory(event)" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Kategori Fasilitas <span class="text-red-500">*</span></label>
                    <input type="text" id="new-category-name" required placeholder="Misal: Kendaraan Operasional, Audio Sound" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pasangkan ke Bidang Teknisi <span class="text-red-500">*</span></label>
                    <select id="new-category-target" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer">
                        <option value="" disabled selected>Pilih Bidang Teknisi...</option>
                        @if(isset($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Aset dalam kategori ini nantinya otomatis ditangani oleh teknisi di bidang tersebut.</p>
                </div>

                <div id="category-error-msg" class="hidden text-xs text-red-600 bg-red-50 p-2.5 rounded-xl border border-red-200 font-semibold"></div>

                <div class="flex items-center justify-end gap-2.5 pt-2">
                    <button type="button" onclick="toggleModal('modal-tambah-kategori')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition cursor-pointer">Batal</button>
                    <button type="submit" id="btn-save-category" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-bold transition shadow-xs cursor-pointer flex items-center gap-1.5">
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Client-side Interactive Filter Script -->
    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function toggleActionMenu(event, menuId) {
            event.stopPropagation();
            document.querySelectorAll('[id^="menu-"]').forEach(m => {
                if (m.id !== menuId) m.classList.add('hidden');
            });
            const target = document.getElementById(menuId);
            if (target) target.classList.toggle('hidden');
        }

        // Close action menus when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
        });

        let callerModalContext = 'tambah'; // 'tambah' or 'edit'

        function openTambahKategoriModal(context = 'tambah') {
            callerModalContext = context;
            const nameEl = document.getElementById('new-category-name');
            const targetEl = document.getElementById('new-category-target');
            const errEl = document.getElementById('category-error-msg');
            if (nameEl) nameEl.value = '';
            if (targetEl) targetEl.selectedIndex = 0;
            if (errEl) errEl.classList.add('hidden');
            toggleModal('modal-tambah-kategori');
        }

        function onCategoryAreaChange(context) {
            const select = document.getElementById(`${context}-kategori`);
            if (!select) return;

            if (select.value === '__ADD_NEW__') {
                select.selectedIndex = 0;
                openTambahKategoriModal(context);
                return;
            }

            const selectedOption = select.options[select.selectedIndex];
            if (!selectedOption) return;

            const catId = selectedOption.getAttribute('data-category-id');
            const catName = selectedOption.getAttribute('data-category-name');

            const hiddenInput = document.getElementById(`${context}-category-id`);
            const displayInput = document.getElementById(`${context}-category-id-display`);

            if (hiddenInput && catId) {
                hiddenInput.value = catId;
            }
            if (displayInput) {
                displayInput.value = catName || '';
            }
        }

        async function submitNewFacilityCategory(e) {
            e.preventDefault();
            const nameInput = document.getElementById('new-category-name');
            const targetSelect = document.getElementById('new-category-target');
            const errorMsg = document.getElementById('category-error-msg');
            const btn = document.getElementById('btn-save-category');

            const name = nameInput.value.trim();
            const categoryId = targetSelect.value;

            if (!name || !categoryId) {
                if (errorMsg) {
                    errorMsg.textContent = 'Harap lengkapi semua kolom.';
                    errorMsg.classList.remove('hidden');
                }
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span>Menyimpan...</span>';

            try {
                const response = await fetch("{{ route('admin.inventory.categories.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        category_id: categoryId
                    })
                });

                const res = await response.json();

                if (res.success) {
                    // Masukkan option baru ke dropdown kategori di form Tambah dan Edit
                    ['tambah-kategori', 'edit-kategori'].forEach(id => {
                        const sel = document.getElementById(id);
                        if (sel) {
                            const opt = document.createElement('option');
                            opt.value = res.data.name;
                            opt.setAttribute('data-category-id', res.data.category_id);
                            opt.setAttribute('data-category-name', res.data.category_name);
                            opt.textContent = res.data.name;

                            // Sisipkan sebelum option terakhir (+ Tambah Kategori Baru...)
                            const lastOpt = sel.options[sel.options.length - 1];
                            sel.insertBefore(opt, lastOpt);

                            if (id.startsWith(callerModalContext)) {
                                sel.value = res.data.name;
                                onCategoryAreaChange(callerModalContext);
                            }
                        }
                    });

                    // Update juga dropdown filter kategori di atas tabel inventaris
                    const filterSel = document.getElementById('filter-kategori');
                    if (filterSel) {
                        const optFilter = document.createElement('option');
                        optFilter.value = res.data.name;
                        optFilter.textContent = res.data.name;
                        filterSel.appendChild(optFilter);
                    }

                    toggleModal('modal-tambah-kategori');
                } else {
                    if (errorMsg) {
                        errorMsg.textContent = res.message || 'Gagal menambahkan kategori fasilitas.';
                        errorMsg.classList.remove('hidden');
                    }
                }
            } catch (err) {
                console.error('Error adding category:', err);
                if (errorMsg) {
                    errorMsg.textContent = 'Terjadi kesalahan sistem atau nama kategori sudah ada.';
                    errorMsg.classList.remove('hidden');
                }
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span>Simpan Kategori</span>';
            }
        }

        function openEditModal(item) {
            document.getElementById('edit-nama').value = item.nama_fasilitas;
            document.getElementById('edit-kondisi').value = item.kondisi;
            document.getElementById('edit-lokasi').value = item.lokasi_detail;
            
            const katSelect = document.getElementById('edit-kategori');
            if (katSelect) {
                let found = false;
                for (let i = 0; i < katSelect.options.length; i++) {
                    if (katSelect.options[i].value === item.kategori_area) {
                        katSelect.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                if (!found && item.kategori_area) {
                    const opt = document.createElement('option');
                    opt.value = item.kategori_area;
                    opt.setAttribute('data-category-id', item.category_id || '1');
                    opt.setAttribute('data-category-name', item.category ? item.category.name : 'Umum');
                    opt.textContent = item.kategori_area;
                    katSelect.insertBefore(opt, katSelect.options[katSelect.options.length - 1]);
                    katSelect.value = item.kategori_area;
                }
                onCategoryAreaChange('edit');
            }

            const form = document.getElementById('form-edit-aset');
            form.action = `/admin/inventory/facilities/${item.id_fasilitas}`;
            
            toggleModal('modal-edit');
        }

        // Inisialisasi otomatis kunci bidang teknisi saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            onCategoryAreaChange('tambah');
        });

        function syncSearch(val) {
            const mainSearch = document.getElementById('inventory-search');
            if (mainSearch) {
                mainSearch.value = val;
                filterInventory();
            }
        }

        const PAGE_SIZE = 10;
        let currentInvPage = 1;

        function filterInventory(resetPage = true) {
            if (resetPage) {
                currentInvPage = 1;
            }

            const query = (document.getElementById('inventory-search')?.value || '').toLowerCase().trim();
            const kategori = document.getElementById('filter-kategori')?.value || '';
            const status = document.getElementById('filter-status')?.value || '';
            
            const rows = Array.from(document.querySelectorAll('.inventory-row'));
            const matchedRows = [];

            rows.forEach(row => {
                const kode = row.getAttribute('data-kode').toLowerCase();
                const nama = row.getAttribute('data-nama').toLowerCase();
                const kat = row.getAttribute('data-kategori');
                const lokasi = row.getAttribute('data-lokasi').toLowerCase();
                const stat = row.getAttribute('data-status');

                const matchesQuery = !query || kode.includes(query) || nama.includes(query) || lokasi.includes(query);
                const matchesKategori = !kategori || kat === kategori;
                const matchesStatus = !status || stat === status;

                if (matchesQuery && matchesKategori && matchesStatus) {
                    matchedRows.push(row);
                } else {
                    row.classList.add('hidden');
                }
            });

            const totalMatched = matchedRows.length;
            const totalPages = Math.max(1, Math.ceil(totalMatched / PAGE_SIZE));

            if (currentInvPage > totalPages) currentInvPage = totalPages;
            if (currentInvPage < 1) currentInvPage = 1;

            // Sembunyikan semua baris yang cocok, lalu tampilkan hanya slice halaman aktif (maks 10 baris)
            matchedRows.forEach(r => r.classList.add('hidden'));

            const startIdx = (currentInvPage - 1) * PAGE_SIZE;
            const endIdx = startIdx + PAGE_SIZE;
            const pageRows = matchedRows.slice(startIdx, endIdx);
            pageRows.forEach(r => r.classList.remove('hidden'));

            // Handle empty state
            const noResults = document.getElementById('no-search-results');
            if (noResults) {
                if (totalMatched === 0 && rows.length > 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            // Update informasi entri
            const countDisplay = document.getElementById('row-count-display');
            if (countDisplay) {
                if (totalMatched === 0) {
                    countDisplay.innerText = 'Menampilkan 0 aset';
                } else {
                    const from = startIdx + 1;
                    const to = startIdx + pageRows.length;
                    countDisplay.innerText = `Menampilkan ${from} hingga ${to} dari ${totalMatched} aset`;
                }
            }

            // Render tombol paginasi (‹ 1 2 3 ›)
            renderInventoryPaginationButtons('inventoryPagination', totalPages, currentInvPage, function(newPage) {
                currentInvPage = newPage;
                filterInventory(false);
            });
        }

        function renderInventoryPaginationButtons(containerId, totalPages, current, onPageChange) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';

            if (totalPages <= 1) {
                return;
            }

            // Tombol Prev (‹)
            const prevBtn = document.createElement('button');
            prevBtn.type = 'button';
            prevBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${current === 1 ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            prevBtn.innerHTML = '‹';
            prevBtn.disabled = current === 1;
            prevBtn.onclick = () => { if (current > 1) onPageChange(current - 1); };
            container.appendChild(prevBtn);

            // Nomor Halaman
            let startPage = Math.max(1, current - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            if (startPage > 1) {
                container.appendChild(createInvPageBtn(1, current === 1, onPageChange));
                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
            }

            for (let p = startPage; p <= endPage; p++) {
                container.appendChild(createInvPageBtn(p, p === current, onPageChange));
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('span');
                    dots.className = 'px-1 text-slate-400 text-xs font-bold';
                    dots.innerText = '...';
                    container.appendChild(dots);
                }
                container.appendChild(createInvPageBtn(totalPages, current === totalPages, onPageChange));
            }

            // Tombol Next (›)
            const nextBtn = document.createElement('button');
            nextBtn.type = 'button';
            nextBtn.className = `w-8 h-8 rounded-lg border flex items-center justify-center text-xs transition-all shadow-2xs ${current === totalPages ? 'border-slate-200 text-slate-300 cursor-not-allowed opacity-50' : 'border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 cursor-pointer'}`;
            nextBtn.innerHTML = '›';
            nextBtn.disabled = current === totalPages;
            nextBtn.onclick = () => { if (current < totalPages) onPageChange(current + 1); };
            container.appendChild(nextBtn);
        }

        function createInvPageBtn(page, isActive, onPageChange) {
            const btn = document.createElement('button');
            btn.type = 'button';
            if (isActive) {
                btn.className = 'w-8 h-8 rounded-lg bg-[#1e3a8a] text-white font-bold flex items-center justify-center text-xs shadow-xs';
            } else {
                btn.className = 'w-8 h-8 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold flex items-center justify-center text-xs transition-all cursor-pointer';
            }
            btn.innerText = page;
            btn.onclick = () => onPageChange(page);
            return btn;
        }

        // Inisialisasi awal tabel inventaris saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            filterInventory(true);
        });
        filterInventory(true);
    </script>
    @include('partials.logout-modal')
</body>
</html>
