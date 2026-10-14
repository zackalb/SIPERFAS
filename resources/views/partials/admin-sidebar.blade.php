<!-- Sidebar Admin SarPras SIPERFAS (Konsisten & Responsif) -->
@php
    $isDashboardActive   = request()->routeIs('admin.dashboard*');
    $isWorkOrdersActive  = request()->routeIs('admin.work-orders*') || request()->routeIs('admin.rab*');
    $isInventoryActive   = request()->routeIs('admin.inventory*');
    $isTechniciansActive = request()->routeIs('admin.technicians*');
    $isAnalyticsActive   = request()->routeIs('admin.analytics*');
    $isSettingsActive    = request()->routeIs('settings*');

    $activeClass   = 'flex items-center space-x-3 px-4 py-2.5 bg-blue-50/80 text-blue-700 rounded-xl text-sm font-bold border-l-4 border-blue-600 transition-all shadow-xs';
    $inactiveClass = 'flex items-center space-x-3 px-4 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-xl text-sm font-medium transition-all group';

    $activeIconClass   = 'w-5 h-5 text-blue-600 shrink-0';
    $inactiveIconClass = 'w-5 h-5 text-slate-400 group-hover:text-slate-600 shrink-0 transition-colors';
@endphp

<!-- 1. Desktop Persistent Sidebar -->
<aside class="w-64 bg-white border-r border-slate-100 flex flex-col h-full hidden md:flex shrink-0 z-20">
    <div class="p-6">
        <!-- Logo & App Title -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 mb-8 group">
            <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo SIPERFAS" class="w-8 h-8 object-contain transition-transform duration-200 group-hover:scale-105">
            <div>
                <h1 class="text-sm font-bold text-slate-900 leading-tight">SIPERFAS</h1>
                <p class="text-[10px] text-slate-500 font-medium">Sistem Informasi Pelaporan Fasilitas</p>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="space-y-1.5">
            <!-- 1. Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="{{ $isDashboardActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isDashboardActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- 2. Perintah Kerja -->
            <a href="{{ route('admin.work-orders.index') }}" class="{{ $isWorkOrdersActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isWorkOrdersActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span>Perintah Kerja</span>
            </a>

            <!-- 3. Katalog Inventaris -->
            <a href="{{ route('admin.inventory.index') }}" class="{{ $isInventoryActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isInventoryActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Katalog Inventaris</span>
            </a>

            <!-- 4. Data Petugas -->
            <a href="{{ route('admin.technicians.index') }}" class="{{ $isTechniciansActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isTechniciansActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Data Petugas</span>
            </a>

            <!-- 5. Laporan & Analitik -->
            <a href="{{ route('admin.analytics.index') }}" class="{{ $isAnalyticsActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isAnalyticsActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span>Laporan & Analitik</span>
            </a>
        </nav>
    </div>

    <!-- Sidebar Footer / Settings & Logout -->
    <div class="mt-auto p-6 border-t border-slate-100">
        <div class="space-y-1.5">
            <!-- Pengaturan -->
            <a href="{{ route('settings.security') }}" class="{{ $isSettingsActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isSettingsActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengaturan</span>
            </a>

            <!-- Keluar -->
            <form method="POST" action="{{ route('logout') }}" id="sidebar-admin-logout-form">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl text-sm font-medium transition-all cursor-pointer">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- 2. Mobile Drawer Navigation Overlay & Panel -->
<div id="adminMobileDrawerOverlay" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden md:hidden transition-opacity duration-200" onclick="closeAdminSidebar()"></div>

<div id="adminMobileDrawer" class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-2xl flex flex-col h-full transform -translate-x-full md:hidden transition-transform duration-300 ease-in-out">
    <div class="p-6 flex-1 overflow-y-auto">
        <!-- Drawer Header with Logo & Close Button -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ \App\Models\Setting::getLogo() }}" alt="Logo SIPERFAS" class="w-8 h-8 object-contain">
                <div>
                    <h1 class="text-sm font-bold text-slate-900 leading-tight">SIPERFAS</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Admin SarPras</p>
                </div>
            </a>
            <button type="button" onclick="closeAdminSidebar()" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors" aria-label="Tutup Menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Drawer Navigation Links -->
        <nav class="space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" class="{{ $isDashboardActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isDashboardActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.work-orders.index') }}" class="{{ $isWorkOrdersActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isWorkOrdersActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span>Perintah Kerja</span>
            </a>

            <a href="{{ route('admin.inventory.index') }}" class="{{ $isInventoryActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isInventoryActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Katalog Inventaris</span>
            </a>

            <a href="{{ route('admin.technicians.index') }}" class="{{ $isTechniciansActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isTechniciansActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Data Petugas</span>
            </a>

            <a href="{{ route('admin.analytics.index') }}" class="{{ $isAnalyticsActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isAnalyticsActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span>Laporan & Analitik</span>
            </a>
        </nav>
    </div>

    <!-- Drawer Footer -->
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        <div class="space-y-1.5">
            <a href="{{ route('settings.security') }}" class="{{ $isSettingsActive ? $activeClass : $inactiveClass }}">
                <svg class="{{ $isSettingsActive ? $activeIconClass : $inactiveIconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengaturan</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" id="mobile-admin-logout-form">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl text-sm font-medium transition-all cursor-pointer">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    window.toggleAdminSidebar = function() {
        const overlay = document.getElementById('adminMobileDrawerOverlay');
        const drawer = document.getElementById('adminMobileDrawer');
        if (!overlay || !drawer) return;

        if (drawer.classList.contains('-translate-x-full')) {
            overlay.classList.remove('hidden');
            drawer.classList.remove('-translate-x-full');
            drawer.classList.add('translate-x-0');
            document.body.style.overflow = 'hidden';
        } else {
            closeAdminSidebar();
        }
    };

    window.closeAdminSidebar = function() {
        const overlay = document.getElementById('adminMobileDrawerOverlay');
        const drawer = document.getElementById('adminMobileDrawer');
        if (!overlay || !drawer) return;

        drawer.classList.remove('translate-x-0');
        drawer.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAdminSidebar();
        }
    });
</script>
