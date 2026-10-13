<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @if(config('services.turnstile.site_key'))
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="bg-white rounded-[24px] shadow-xl w-full max-w-5xl flex overflow-hidden min-h-[560px] border border-gray-100">
        
        <!-- Left Side: Illustration Container -->
        <div class="hidden md:flex md:w-[50%] bg-[#F8F9FA] flex-col items-center justify-center p-12 relative border-r border-gray-100">
            <div class="w-full text-center relative z-10">
                <img src="{{ asset('illustration.png') }}" alt="Ilustrasi SIPERFAS" class="w-full max-w-sm mx-auto object-contain mb-8 mix-blend-multiply">
                
                <h2 class="text-[26px] font-bold text-gray-800 italic leading-tight font-serif tracking-tight">Jagalah Fasilitas Sekolah Kita</h2>
                <p class="text-sm text-gray-600 mt-3 font-medium italic max-w-xs mx-auto leading-relaxed font-serif">
                    Kirim laporan perbaikan hanya dalam beberapa ketukan. Sarpras siap menangani dengan cepat!
                </p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-[50%] flex flex-col justify-center p-8 sm:p-12 lg:px-16 lg:py-12 relative">
            
            <div class="w-full max-w-md mx-auto">
                <div class="text-center mb-8">
                    <img src="{{ asset('logo.png') }}" class="h-10 mx-auto mb-4 object-contain" alt="Logo">
                    <h1 class="text-xl font-bold text-[#0B3A82] mb-1.5">Selamat Datang di SIPERFAS</h1>
                    <p class="text-[13px] text-gray-500 tracking-wide">Sistem Informasi Pelaporan Fasilitas</p>
                </div>

                <!-- Notifikasi Berhasil (misal setelah reset kata sandi) -->
                @if(session('success'))
                    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Peringatan Rate Limiting / Terblokir / Percobaan Gagal -->
                @error('identity')
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-semibold flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div class="flex-1">
                            <span class="block font-bold mb-0.5">Pemberitahuan Keamanan:</span>
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @enderror

                <!-- Quick Role Switcher (Pelapor: Siswa & Guru) -->
                <div class="mb-5 bg-gradient-to-r from-blue-50/70 to-indigo-50/50 border border-blue-100 rounded-2xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-900 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Masuk Sebagai Pelapor:
                        </span>
                        <span class="text-[10px] text-blue-600 font-semibold bg-white/80 px-2 py-0.5 rounded-full border border-blue-100">Pilih salah satu</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="selectRole('siswa')" id="role-btn-siswa" class="flex items-center gap-2.5 p-2.5 rounded-xl border transition-all text-slate-700 bg-white border-slate-200/90 hover:border-blue-500 hover:shadow-xs cursor-pointer text-left group">
                            <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </span>
                            <div class="min-w-0">
                                <span class="block text-xs font-bold text-slate-900 leading-tight">Siswa</span>
                                <span class="block text-[10px] text-slate-400 font-medium truncate">siswa@sekolah.com</span>
                            </div>
                        </button>
                        <button type="button" onclick="selectRole('guru')" id="role-btn-guru" class="flex items-center gap-2.5 p-2.5 rounded-xl border transition-all text-slate-700 bg-white border-slate-200/90 hover:border-indigo-500 hover:shadow-xs cursor-pointer text-left group">
                            <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v5m4-5v5m4-5v5M3 4h18M4 4h16v9H4V4zm4 15h8"></path></svg>
                            </span>
                            <div class="min-w-0">
                                <span class="block text-xs font-bold text-slate-900 leading-tight">Guru</span>
                                <span class="block text-[10px] text-slate-400 font-medium truncate">guru@sekolah.com</span>
                            </div>
                        </button>
                    </div>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="identity" value="{{ old('identity') }}" required class="w-full pl-10 pr-3 py-3 border @error('identity') border-red-500 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-sm bg-gray-50/50 font-medium placeholder-gray-400 transition-all" placeholder="Alamat Email / NIP / NISN">
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password_input" required class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-sm bg-gray-50/50 font-medium placeholder-gray-400 transition-all" placeholder="Kata Sandi">
                            
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" onclick="document.getElementById('password_input').type = document.getElementById('password_input').type === 'password' ? 'text' : 'password'">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} class="w-4 h-4 text-[#0B3A82] border-gray-300 rounded focus:ring-[#0B3A82] cursor-pointer">
                            <span class="text-[12px] font-medium text-gray-600">Ingat Saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[12px] font-semibold text-[#0B3A82] hover:text-blue-800 transition-colors">Lupa Kata Sandi?</a>
                    </div>

                    @if(config('services.turnstile.site_key'))
                        <div class="py-1 flex flex-col items-center justify-center">
                            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="light"></div>
                            @error('cf-turnstile-response')
                                <p class="text-xs text-red-600 font-semibold mt-1 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-[#0B3A82] text-white py-3 rounded-xl hover:bg-blue-800 transition-colors font-semibold shadow-md shadow-blue-900/10 text-sm cursor-pointer">
                        Masuk
                    </button>
                </form>

                <div class="mt-10 flex justify-between items-center text-[11px] text-gray-400 font-medium pt-4 border-t border-gray-100">
                    <div>© {{ date('Y') }} SIPERFAS.</div>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-gray-700 transition-colors">Bantuan</a>
                        <a href="#" class="hover:text-gray-700 transition-colors">Kebijakan Privasi</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            const identityInput = document.querySelector('input[name="identity"]');
            const passwordInput = document.getElementById('password_input');
            const btnSiswa = document.getElementById('role-btn-siswa');
            const btnGuru = document.getElementById('role-btn-guru');

            if (role === 'siswa') {
                if (identityInput) identityInput.value = 'siswa@sekolah.com';
                if (passwordInput) passwordInput.value = 'password123';
                if (btnSiswa) {
                    btnSiswa.classList.add('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-200');
                    btnSiswa.classList.remove('bg-white');
                }
                if (btnGuru) {
                    btnGuru.classList.remove('border-indigo-600', 'bg-indigo-50/70', 'ring-2', 'ring-indigo-200');
                    btnGuru.classList.add('bg-white');
                }
            } else if (role === 'guru') {
                if (identityInput) identityInput.value = 'guru@sekolah.com';
                if (passwordInput) passwordInput.value = 'password123';
                if (btnGuru) {
                    btnGuru.classList.add('border-indigo-600', 'bg-indigo-50/70', 'ring-2', 'ring-indigo-200');
                    btnGuru.classList.remove('bg-white');
                }
                if (btnSiswa) {
                    btnSiswa.classList.remove('border-blue-600', 'bg-blue-50/70', 'ring-2', 'ring-blue-200');
                    btnSiswa.classList.add('bg-white');
                }
            }
        }
    </script>
</body>
</html>
