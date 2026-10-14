<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('status', 'admin')->first();
        $pelapor = User::where('status', 'pelapor')->first();
        $teknisi = User::where('status', 'petugas')->first();

        $sampleLogs = [
            [
                'id_user'     => $admin?->id_user,
                'user_name'   => $admin?->nama ?? 'Admin Sarpras',
                'user_role'   => 'admin',
                'action'      => 'SYSTEM_INIT',
                'description' => 'Inisialisasi sistem SIPERFAS dan konfigurasi awal sarana prasarana.',
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at'  => Carbon::now()->subDays(3)->setTime(8, 0, 0),
            ],
            [
                'id_user'     => $admin?->id_user,
                'user_name'   => $admin?->nama ?? 'Admin Sarpras',
                'user_role'   => 'admin',
                'action'      => 'LOGIN',
                'description' => 'Admin Sarpras berhasil masuk ke sistem melalui portal login.',
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at'  => Carbon::now()->subDays(2)->setTime(8, 15, 0),
            ],
            [
                'id_user'     => $pelapor?->id_user,
                'user_name'   => $pelapor?->nama ?? 'Siswa Pelapor',
                'user_role'   => 'pelapor',
                'action'      => 'CREATE_REPORT',
                'description' => 'Membuat tiket laporan kerusakan: Stop Kontak Rusak di Ruang Lab Komputer 1.',
                'ip_address'  => '192.168.1.45',
                'user_agent'  => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)',
                'created_at'  => Carbon::now()->subDays(2)->setTime(9, 30, 0),
            ],
            [
                'id_user'     => $admin?->id_user,
                'user_name'   => $admin?->nama ?? 'Admin Sarpras',
                'user_role'   => 'admin',
                'action'      => 'ASSIGN_TECHNICIAN',
                'description' => 'Menugaskan teknisi listrik ke tiket perbaikan Stop Kontak Lab Komputer 1.',
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at'  => Carbon::now()->subDays(2)->setTime(10, 0, 0),
            ],
            [
                'id_user'     => $teknisi?->id_user,
                'user_name'   => $teknisi?->nama ?? 'Andi Saputra',
                'user_role'   => 'petugas',
                'action'      => 'SUBMIT_RAB',
                'description' => 'Mengajukan estimasi RAB perbaikan komponen kelistrikan sebesar Rp 150.000.',
                'ip_address'  => '192.168.1.88',
                'user_agent'  => 'Mozilla/5.0 (Linux; Android 14)',
                'created_at'  => Carbon::now()->subDays(1)->setTime(11, 20, 0),
            ],
            [
                'id_user'     => $admin?->id_user,
                'user_name'   => $admin?->nama ?? 'Admin Sarpras',
                'user_role'   => 'admin',
                'action'      => 'APPROVE_RAB',
                'description' => 'Menyetujui proposal anggaran RAB perbaikan kelistrikan Lab Komputer 1.',
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at'  => Carbon::now()->subDays(1)->setTime(13, 45, 0),
            ],
            [
                'id_user'     => $admin?->id_user,
                'user_name'   => $admin?->nama ?? 'Admin Sarpras',
                'user_role'   => 'admin',
                'action'      => 'LOGIN',
                'description' => 'Admin Sarpras berhasil masuk ke sesi baru dashboard manajemen.',
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at'  => Carbon::now()->subHours(2),
            ],
        ];

        foreach ($sampleLogs as $logData) {
            ActivityLog::create($logData);
        }
    }
}
