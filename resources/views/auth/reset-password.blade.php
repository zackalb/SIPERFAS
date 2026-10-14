<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - SIPERFAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="bg-white rounded-[24px] shadow-xl w-full max-w-5xl flex overflow-hidden min-h-[560px] border border-gray-100">
        
        <!-- Left Side: Illustration Container -->
        <div class="hidden md:flex md:w-[50%] bg-[#F8F9FA] flex-col items-center justify-center p-12 relative border-r border-gray-100">
            <div class="w-full text-center relative z-10">
                <img src="{{ asset('illustration.png') }}" alt="Ilustrasi SIPERFAS" class="w-full max-w-sm mx-auto object-contain mb-8 mix-blend-multiply">
                
                <h2 class="text-[26px] font-bold text-gray-800 italic leading-tight font-serif tracking-tight">Perbarui Kata Sandi Anda</h2>
                <p class="text-sm text-gray-600 mt-3 font-medium italic max-w-xs mx-auto leading-relaxed font-serif">
                    Gunakan kombinasi kata sandi yang kuat untuk menjaga keamanan akses sistem sarpras sekolah.
                </p>
            </div>
        </div>

        <!-- Right Side: Reset Password Form -->
        <div class="w-full md:w-[50%] flex flex-col justify-center p-8 sm:p-12 lg:px-16 lg:py-12 relative">
            
            <div class="w-full max-w-md mx-auto">
                <div class="text-center mb-6">
                    <img src="{{ \App\Models\Setting::getLogo() }}" class="h-10 mx-auto mb-4 object-contain" alt="Logo">
                    <h1 class="text-xl font-bold text-[#0B3A82] mb-1.5">Atur Kata Sandi Baru</h1>
                    <p class="text-[13px] text-gray-500 tracking-wide">Silakan tentukan kata sandi baru untuk akun Anda.</p>
                </div>

                @if(session('status'))
                    <div class="mb-5 p-3.5 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl text-xs font-semibold flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-semibold">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Email Terdaftar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $email) }}" required readonly class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-sm bg-gray-100 font-medium text-gray-600">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="new_password" required minlength="6" class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-sm bg-gray-50/50 font-medium placeholder-gray-400 transition-all" placeholder="Minimal 6 karakter">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" onclick="document.getElementById('new_password').type = document.getElementById('new_password').type === 'password' ? 'text' : 'password'">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-[18px] w-[18px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="confirm_password" required minlength="6" class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 text-sm bg-gray-50/50 font-medium placeholder-gray-400 transition-all" placeholder="Ulangi kata sandi baru">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" onclick="document.getElementById('confirm_password').type = document.getElementById('confirm_password').type === 'password' ? 'text' : 'password'">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#0B3A82] text-white py-3 rounded-xl hover:bg-blue-800 transition-colors font-semibold shadow-md shadow-blue-900/10 text-sm cursor-pointer mt-2">
                        Simpan Kata Sandi Baru
                    </button>

                    <div class="pt-2 text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-600 hover:text-[#0B3A82] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Batal & Kembali ke Halaman Masuk</span>
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
