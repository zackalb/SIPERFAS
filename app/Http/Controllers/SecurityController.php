<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\File;

class SecurityController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $twoFactorEnabled = $user->hasEnabledTwoFactorAuthentication();
        $twoFactorPending = !is_null($user->two_factor_secret) && is_null($user->two_factor_confirmed_at);
        
        $qrCodeSvg = null;
        $setupKey = null;
        $recoveryCodes = [];

        if ($twoFactorPending || $twoFactorEnabled) {
            try {
                $qrCodeSvg = $user->twoFactorQrCodeSvg();
                $setupKey = Fortify::currentEncrypter()->decrypt($user->two_factor_secret);
            } catch (\Exception $e) {
                // Ignore decryption errors if secret was invalid
            }
        }

        if ($twoFactorEnabled) {
            try {
                $recoveryCodes = $user->recoveryCodes() ?? [];
            } catch (\Exception $e) {
                $recoveryCodes = [];
            }
        }

        $role = strtolower(trim($user->status ?? 'pelapor'));
        session(['active_role' => $role]);

        $isAdmin = in_array($role, ['admin', 'sarpras', 'admin_sarpras']);

        $currentLogo = Setting::getLogo();
        $isCustomLogo = !empty(Setting::get('app_logo'));

        $activityLogs = collect();
        $logStats = [
            'total' => 0,
            'today' => 0,
            'unique_users' => 0,
        ];

        $activeTab = $request->query('tab', 'security');

        if ($isAdmin) {
            $query = ActivityLog::query()->latest();

            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                      ->orWhere('user_name', 'like', "%{$search}%")
                      ->orWhere('action', 'like', "%{$search}%")
                      ->orWhere('ip_address', 'like', "%{$search}%");
                });
            }

            if ($request->filled('action_filter')) {
                $query->where('action', $request->action_filter);
            }

            if ($request->filled('role_filter')) {
                $query->where('user_role', $request->role_filter);
            }

            if ($request->filled('date_filter')) {
                $query->whereDate('created_at', $request->date_filter);
            }

            $activityLogs = $query->paginate(12)->withQueryString();

            $logStats = [
                'total' => ActivityLog::count(),
                'today' => ActivityLog::whereDate('created_at', today())->count(),
                'unique_users' => ActivityLog::distinct('user_name')->count('user_name'),
            ];
        }

        return view('settings.security', compact(
            'user',
            'twoFactorEnabled',
            'twoFactorPending',
            'qrCodeSvg',
            'setupKey',
            'recoveryCodes',
            'role',
            'isAdmin',
            'currentLogo',
            'isCustomLogo',
            'activityLogs',
            'logStats',
            'activeTab'
        ));
    }

    /**
     * Upload & Ganti Logo Aplikasi (Khusus Admin)
     */
    public function updateLogo(Request $request)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->status ?? ''));

        if (!in_array($role, ['admin', 'sarpras', 'admin_sarpras'])) {
            abort(403, 'Hanya Admin yang berwenang mengubah logo aplikasi.');
        }

        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ], [
            'logo.required' => 'Silakan pilih berkas gambar logo terlebih dahulu.',
            'logo.image'    => 'Berkas yang diunggah harus berupa file gambar valid.',
            'logo.mimes'    => 'Format logo hanya diperbolehkan: PNG, JPG, JPEG, SVG, atau WebP.',
            'logo.max'      => 'Ukuran gambar logo tidak boleh melebihi 2MB.',
        ]);

        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = 'logo_' . time() . '.' . $extension;

        $targetDir = public_path('uploads/logos');
        if (!File::isDirectory($targetDir)) {
            File::makeDirectory($targetDir, 0755, true, true);
        }

        // Hapus logo kustom lama jika ada
        $oldCustom = Setting::get('app_logo');
        if (!empty($oldCustom) && File::exists(public_path($oldCustom))) {
            @unlink(public_path($oldCustom));
        }

        $file->move($targetDir, $filename);
        $relativePath = 'uploads/logos/' . $filename;

        Setting::set('app_logo', $relativePath);

        ActivityLog::record(
            'UPDATE_LOGO',
            'Admin ' . ($user->nama ?? $user->email) . ' berhasil memperbarui logo sistem aplikasi.',
            $user,
            ['file_path' => $relativePath, 'original_name' => $file->getClientOriginalName()]
        );

        return redirect()->route('settings.security', ['tab' => 'logo'])
            ->with('status', 'logo-updated')
            ->with('success', 'Logo aplikasi berhasil diperbarui!');
    }

    /**
     * Reset Logo Aplikasi ke Default (Khusus Admin)
     */
    public function resetLogo(Request $request)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->status ?? ''));

        if (!in_array($role, ['admin', 'sarpras', 'admin_sarpras'])) {
            abort(403, 'Hanya Admin yang berwenang mereset logo aplikasi.');
        }

        $oldCustom = Setting::get('app_logo');
        if (!empty($oldCustom) && File::exists(public_path($oldCustom))) {
            @unlink(public_path($oldCustom));
        }

        Setting::set('app_logo', null);

        ActivityLog::record(
            'RESET_LOGO',
            'Admin ' . ($user->nama ?? $user->email) . ' mereset logo aplikasi kembali ke logo default sistem.',
            $user
        );

        return redirect()->route('settings.security', ['tab' => 'logo'])
            ->with('status', 'logo-reset')
            ->with('success', 'Logo aplikasi berhasil dikembalikan ke default!');
    }
}
