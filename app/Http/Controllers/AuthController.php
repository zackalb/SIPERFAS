<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;
use App\Rules\TurnstileRule;

class AuthController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses autentikasi login dengan proteksi Rate Limiting (Maks 5 kali gagal -> Blokir 10 Menit).
     */
    public function login(Request $request)
    {
        $rules = [
            'identity' => 'required|string',
            'password' => 'required|string',
        ];

        if (!empty(config('services.turnstile.secret_key'))) {
            $rules['cf-turnstile-response'] = ['required', new TurnstileRule()];
        }

        $request->validate($rules, [
            'identity.required'              => 'Email atau identitas wajib diisi.',
            'password.required'              => 'Kata sandi wajib diisi.',
            'cf-turnstile-response.required' => 'Silakan selesaikan verifikasi Cloudflare Turnstile terlebih dahulu.',
        ]);

        // Key rate limiter unik berdasarkan input identity & alamat IP
        $throttleKey = Str::transliterate(Str::lower($request->input('identity')) . '|' . $request->ip());

        // 1. Cek apakah batas 5 kali percobaan gagal telah terlampaui
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            return back()->withErrors([
                'identity' => "Terlalu banyak percobaan masuk (maksimal 5 kali). Akun Anda diblokir sementara. Silakan tunggu {$minutes} menit ({$seconds} detik) untuk mencoba lagi.",
            ])->onlyInput('identity');
        }

        $credentials = [
            'email'    => $request->identity,
            'password' => $request->password,
        ];

        $user = Auth::getProvider()->retrieveByCredentials(['email' => $request->identity]);

        if ($user && Auth::getProvider()->validateCredentials($user, ['password' => $request->password])) {
            // Berhasil login: bersihkan hitungan percobaan gagal
            RateLimiter::clear($throttleKey);

            // Jika user telah mengaktifkan 2FA, arahkan ke halaman Two Factor Challenge
            if ($user->hasEnabledTwoFactorAuthentication()) {
                $request->session()->put([
                    'login.id'       => $user->getKey(),
                    'login.remember' => $request->boolean('remember'),
                ]);

                return redirect()->route('two-factor.login');
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            
            \App\Models\ActivityLog::record(
                'LOGIN',
                'Pengguna ' . ($user->nama ?? $user->email) . ' berhasil masuk ke sistem.',
                $user
            );

            $status = strtolower(trim($user->status ?? 'pelapor'));
            session(['active_role' => $status]);
            
            if (in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
                return redirect()->route('admin.dashboard');
            } elseif (in_array($status, ['petugas', 'teknisi', 'staf'])) {
                return redirect()->route('petugas.dashboard');
            }

            return redirect()->route('pelapor.dashboard');
        }

        // Gagal login: tambahkan hitungan percobaan gagal dengan waktu blokir 10 menit (600 detik)
        RateLimiter::hit($throttleKey, 600);
        $attemptsLeft = RateLimiter::remaining($throttleKey, 5);

        if ($attemptsLeft > 0) {
            $message = "Email atau Password yang Anda masukkan salah. Sisa kesempatan: {$attemptsLeft} kali percobaan lagi sebelum akun diblokir 10 menit.";
        } else {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            $message = "Batas 5 kali percobaan gagal telah tercapai! Akun Anda diblokir sementara. Silakan coba lagi dalam {$minutes} menit ({$seconds} detik).";
        }

        return back()->withErrors([
            'identity' => $message,
        ])->onlyInput('identity');
    }
    
    /**
     * Logout pengguna dari sistem.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            \App\Models\ActivityLog::record(
                'LOGOUT',
                'Pengguna ' . ($user->nama ?? $user->email) . ' keluar dari sistem.',
                $user
            );
        }

        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    /**
     * Tampilkan halaman lupa kata sandi.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Proses pengiriman/verifikasi email lupa kata sandi.
     */
    public function sendResetLink(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        if (!empty(config('services.turnstile.secret_key'))) {
            $rules['cf-turnstile-response'] = ['required', new TurnstileRule()];
        }

        $request->validate($rules, [
            'email.required'                 => 'Email wajib diisi.',
            'email.email'                    => 'Format email tidak valid.',
            'email.exists'                   => 'Email tidak terdaftar dalam sistem.',
            'cf-turnstile-response.required' => 'Silakan selesaikan verifikasi Cloudflare Turnstile terlebih dahulu.',
        ]);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => Hash::make($token),
                'created_at' => now(),
            ]
        );

        return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email])
            ->with('status', 'Email terverifikasi. Silakan masukkan kata sandi baru Anda.');
    }

    /**
     * Tampilkan formulir reset kata sandi baru.
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('token', 'email'));
    }

    /**
     * Simpan kata sandi baru pengguna.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'token'                 => 'required|string',
        ], [
            'email.required'        => 'Email wajib diisi.',
            'password.required'     => 'Kata sandi baru wajib diisi.',
            'password.min'          => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'User tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token reset setelah berhasil
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Bersihkan data limiter jika user pernah terblokir
        $throttleKey = Str::transliterate(Str::lower($request->email) . '|' . $request->ip());
        RateLimiter::clear($throttleKey);

        return redirect()->route('login')->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan masuk dengan kata sandi baru.');
    }
}
