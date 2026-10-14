<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan RAB - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Hide number input spinners */
        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800 flex flex-col h-screen overflow-hidden">



    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
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
            <!-- Topbar -->
            <header class="bg-white border-b border-slate-100 flex items-center justify-between px-8 py-4 z-10 shrink-0">
                <h2 class="text-xl font-extrabold text-blue-950 tracking-tight">Admin SarPras</h2>

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
            <div class="flex-1 overflow-y-auto bg-slate-50 p-8">
                <div class="max-w-4xl mx-auto space-y-6">
                    
                    <!-- Breadcrumbs & Header -->
                    <div>
                        <div class="flex items-center text-sm font-medium text-slate-500 mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Tiket</a>
                            <span class="mx-2">›</span>
                            <a href="{{ route('admin.work-orders.show', $report->id_laporan) }}" class="hover:text-blue-600">WO-{{ date('Y') }}-{{ str_pad($report->id_laporan, 3, '0', STR_PAD_LEFT) }}</a>
                            <span class="mx-2">›</span>
                            <span class="text-slate-900">Pengajuan RAB</span>
                        </div>
                        <h1 class="text-3xl font-bold text-slate-900">Formulir Pengajuan RAB</h1>
                        <p class="text-slate-500 mt-1">Rencana Anggaran Biaya untuk perbaikan kerusakan.</p>
                    </div>

                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('info') }}</span>
                        </div>
                    @endif

                    <!-- Ticket Detail Card -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-lg font-bold text-slate-900">WO-{{ date('Y') }}-{{ str_pad($report->id_laporan, 3, '0', STR_PAD_LEFT) }}</span>
                            <span class="bg-blue-50 text-blue-600 text-xs font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">Perlu RAB</span>
                        </div>
                        <p class="text-slate-600 mb-6">{{ $report->deskripsi_kerusakan }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</div>
                                    <div class="text-sm font-semibold text-slate-800 mt-0.5">{{ $report->facility->lokasi_detail ?? 'Lokasi tidak diketahui' }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Dilaporkan</div>
                                    <div class="text-sm font-semibold text-slate-800 mt-0.5">{{ \Carbon\Carbon::parse($report->tanggal_waktu)->format('d M Y, H:i WIB') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic RAB Form -->
                    <form action="{{ route('admin.rab.store', $report->id_laporan) }}" method="POST" id="rab-form" onsubmit="return validateAdminRabForm(event)">
                        @csrf
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-slate-900">Rincian Kebutuhan</h3>
                                <span id="admin-rab-row-badge" class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-lg border border-slate-200">1 / 5 Baris</span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left" id="rab-table">
                                    <thead>
                                        <tr class="border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            <th class="pb-4 pr-4 w-2/5">Nama Barang / Jasa <span class="text-red-500">*</span></th>
                                            <th class="pb-4 pr-4 w-24">QTY <span class="text-red-500">*</span></th>
                                            <th class="pb-4 pr-4 w-32">Satuan <span class="text-red-500">*</span></th>
                                            <th class="pb-4 pr-4 w-40">Harga Satuan (Rp) <span class="text-red-500">*</span></th>
                                            <th class="pb-4 pr-4 w-40 text-right">Subtotal (Rp)</th>
                                            <th class="pb-4 w-10"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="rab-body">
                                        <!-- Row 1 (Default) -->
                                        <tr class="group border-b border-slate-50" id="row-0">
                                            <td class="py-3 pr-4">
                                                <input type="text" name="items[0][nama]" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none" placeholder="Pipa PVC 3/4 inch">
                                            </td>
                                            <td class="py-3 pr-4">
                                                <input type="number" name="items[0][qty]" required min="1" value="1" oninput="calculateRow(0)" id="qty-0" class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none text-center">
                                            </td>
                                            <td class="py-3 pr-4">
                                                <input type="text" name="items[0][satuan]" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none" placeholder="Btg">
                                            </td>
                                            <td class="py-3 pr-4 relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-slate-400 text-sm font-medium">Rp</span>
                                                </div>
                                                <input type="number" name="items[0][harga]" required min="1" value="" placeholder="Min. Rp 1" oninput="calculateRow(0)" id="harga-0" class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl pl-8 pr-3 py-2 text-sm font-medium text-slate-700 outline-none text-right">
                                            </td>
                                            <td class="py-3 pr-4 text-right">
                                                <span class="text-sm font-bold text-slate-900" id="subtotal-0">0</span>
                                            </td>
                                            <td class="py-3 text-right">
                                                <button type="button" onclick="removeRow(0)" class="text-slate-300 hover:text-red-500 transition-colors p-1" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add Row Button -->
                            <button type="button" id="btn-admin-add-row" onclick="addRow()" class="w-full mt-4 border-2 border-dashed border-blue-200 text-blue-600 hover:bg-blue-50 hover:border-blue-300 font-semibold text-sm py-3 rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                <span>Tambah Baris</span>
                            </button>
                            <div id="admin-rab-max-notice" class="hidden w-full mt-3 text-center py-2.5 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-xs font-bold">
                                Batas maksimal 5 baris kebutuhan tercapai
                            </div>
                        </div>

                        <!-- Footer actions -->
                        <div class="mt-6 flex flex-col md:flex-row gap-6 items-end justify-between bg-slate-50/50 p-6 rounded-2xl border border-slate-200 shadow-sm">
                            <div class="w-full md:w-1/2">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" rows="2" class="w-full bg-white border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 outline-none resize-none placeholder-slate-300" placeholder="Misal: Perlu dibeli segera di toko terdekat..."></textarea>
                            </div>

                            <div class="w-full md:w-auto flex flex-col items-end">
                                <div class="text-right mb-4">
                                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Estimasi Biaya</div>
                                    <div class="text-3xl font-bold text-[#0f172a] flex items-baseline gap-1">
                                        <span class="text-xl">Rp</span>
                                        <span id="grand-total">0</span>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</a>
                                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                        Kirim Pengajuan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Javascript for Dynamic Form -->
    <script>
        let rowCount = 1;
        const MAX_RAB_ROWS = 5;

        // Auto-calculate on load
        document.addEventListener("DOMContentLoaded", () => {
            calculateGrandTotal();
            updateAdminRabRowCount();
        });

        // Format number to Indonesian Rupiah standard format
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID').format(number);
        };

        function updateAdminRabRowCount() {
            const tbody = document.getElementById('rab-body');
            if (!tbody) return;
            const rows = tbody.querySelectorAll('tr');
            const badge = document.getElementById('admin-rab-row-badge');
            const addBtn = document.getElementById('btn-admin-add-row');
            const maxNotice = document.getElementById('admin-rab-max-notice');
            if (badge) badge.textContent = `${rows.length} / ${MAX_RAB_ROWS} Baris`;
            if (rows.length >= MAX_RAB_ROWS) {
                if (addBtn) addBtn.classList.add('hidden');
                if (maxNotice) maxNotice.classList.remove('hidden');
            } else {
                if (addBtn) addBtn.classList.remove('hidden');
                if (maxNotice) maxNotice.classList.add('hidden');
            }
        }

        function addRow() {
            const tbody = document.getElementById('rab-body');
            const currentRows = tbody.querySelectorAll('tr').length;
            if (currentRows >= MAX_RAB_ROWS) {
                alert('Batas maksimal pengajuan RAB adalah 5 baris.');
                return;
            }

            const rowId = rowCount++;
            
            const tr = document.createElement('tr');
            tr.className = "group border-b border-slate-50";
            tr.id = `row-${rowId}`;
            
            tr.innerHTML = `
                <td class="py-3 pr-4">
                    <input type="text" name="items[${rowId}][nama]" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none" placeholder="Item baru...">
                </td>
                <td class="py-3 pr-4">
                    <input type="number" name="items[${rowId}][qty]" required min="1" value="1" oninput="calculateRow(${rowId})" id="qty-${rowId}" class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none text-center">
                </td>
                <td class="py-3 pr-4">
                    <input type="text" name="items[${rowId}][satuan]" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 outline-none" placeholder="Satuan">
                </td>
                <td class="py-3 pr-4 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-slate-400 text-sm font-medium">Rp</span>
                    </div>
                    <input type="number" name="items[${rowId}][harga]" required min="1" value="" placeholder="Min. Rp 1" oninput="calculateRow(${rowId})" id="harga-${rowId}" class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-xl pl-8 pr-3 py-2 text-sm font-medium text-slate-700 outline-none text-right">
                </td>
                <td class="py-3 pr-4 text-right">
                    <span class="text-sm font-bold text-slate-900" id="subtotal-${rowId}">0</span>
                </td>
                <td class="py-3 text-right">
                    <button type="button" onclick="removeRow(${rowId})" class="text-slate-300 hover:text-red-500 transition-colors p-1" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            `;
            
            tbody.appendChild(tr);
            calculateGrandTotal();
            updateAdminRabRowCount();
        }

        function removeRow(id) {
            const row = document.getElementById(`row-${id}`);
            if (row) {
                row.remove();
                calculateGrandTotal();
                updateAdminRabRowCount();
            }
        }

        function validateAdminRabForm(e) {
            const tbody = document.getElementById('rab-body');
            if (!tbody) return true;
            const rows = tbody.querySelectorAll('tr');
            if (rows.length === 0) {
                alert('Minimal harus ada 1 baris item RAB.');
                if (e) e.preventDefault();
                return false;
            }
            if (rows.length > MAX_RAB_ROWS) {
                alert(`Batas maksimal pengajuan RAB adalah ${MAX_RAB_ROWS} baris!`);
                if (e) e.preventDefault();
                return false;
            }
            const hargaInputs = tbody.querySelectorAll('input[name$="[harga]"]');
            for (let i = 0; i < hargaInputs.length; i++) {
                const val = parseFloat(hargaInputs[i].value);
                if (isNaN(val) || val <= 0) {
                    alert('Harga satuan tidak boleh 0 rupiah! Harap masukkan harga yang valid (lebih dari Rp 0).');
                    hargaInputs[i].focus();
                    if (e) e.preventDefault();
                    return false;
                }
            }
            return true;
        }

        function calculateRow(id) {
            const qtyInput = document.getElementById(`qty-${id}`);
            const hargaInput = document.getElementById(`harga-${id}`);
            const subtotalSpan = document.getElementById(`subtotal-${id}`);
            
            if (qtyInput && hargaInput && subtotalSpan) {
                const qty = parseFloat(qtyInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const subtotal = qty * harga;
                
                subtotalSpan.innerText = formatRupiah(subtotal);
                
                calculateGrandTotal();
            }
        }

        function calculateGrandTotal() {
            let total = 0;
            // Iterate all inputs that name starts with items and ends with [harga]
            const hargaInputs = document.querySelectorAll('input[name$="[harga]"]');
            hargaInputs.forEach(input => {
                // Extract row id from input id (harga-X)
                const id = input.id.split('-')[1];
                const qtyInput = document.getElementById(`qty-${id}`);
                
                const qty = parseFloat(qtyInput.value) || 0;
                const harga = parseFloat(input.value) || 0;
                
                total += (qty * harga);
            });
            
            const grandTotalEl = document.getElementById('grand-total');
            if (grandTotalEl) {
                grandTotalEl.innerText = formatRupiah(total);
            }
        }
    </script>
    @include('partials.logout-modal')
</body>
</html>
