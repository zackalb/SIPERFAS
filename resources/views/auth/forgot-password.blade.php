<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SIPERFAS</title>
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
                
                <h2 class="text-[26px] font-bold text-gray-800 italic leading-tight font-serif tracking-tight">Pemulihan Akun Anda</h2>
                <p class="text-sm text-gray-600 mt-3 font-medium italic max-w-xs mx-auto leading-relaxed font-serif">
                    Masukkan email terdaftar untuk mengatur ulang kata sandi dan mengakses kembali layanan fasilitas.
                </p>
            </div>
        </div>

        <!-- Right Side: Forgot Password Form -->
        <div class="w-full md:w-[50%] flex flex-col justify-center p-8 sm:p-12 lg:px-16 lg:py-12 relative">
            
            <div class="w-full max-w-md mx-auto">
                <div class="text-center mb-8">
                    <img src="{{ \App\Models\Setting::getLogo() }}" class="h-10 mx-auto mb-4 object-contain" alt="Logo">
                    <h1 class="text-xl font-bold text-[#0B3A82] mb-1.5">Lupa Kata Sandi</h1>
                    <p class="text-[13px] text-gray-500 tracking-wide">Masukkan email yang terdaftar di akun Anda untuk melanjutkan pengaturan kata sandi baru.</p>
                </div>

                @if(session('status'))
                    <div class="mb-5 p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl text-xs font-semibold flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @error('email')
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-semibold flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Email Terdaftar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-3 py-3 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-sm bg-gray-50/50 font-medium placeholder-gray-400 transition-all" placeholder="Masukkan email terdaftar">
                        </div>
                    </div>

                    @if(config('services.turnstile.site_key'))
                        <div class="py-1 flex flex-col items-center justify-center">
                            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="light"></div>
                            @error('cf-turnstile-response')
                                <p class="text-xs text-red-600 font-semibold mt-1 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-[#0B3A82] text-white py-3 rounded-xl hover:bg-blue-800 transition-colors font-semibold shadow-md shadow-blue-900/10 text-sm cursor-pointer mt-2">
                        Verifikasi & Buat Kata Sandi Baru
                    </button>

                    <div class="pt-2 text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-600 hover:text-[#0B3A82] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Kembali ke Halaman Masuk</span>
                        </a>
                    </div>
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

</body>
</html>
