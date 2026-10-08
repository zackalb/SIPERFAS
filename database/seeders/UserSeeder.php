<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pelapor (Siswa & Guru)
        User::updateOrCreate(
            ['email' => 'pelapor@sekolah.com'],
            [
                'nama'     => 'Pelapor',
                'password' => Hash::make('password123'),
                'status'   => 'pelapor',
                'role'     => 'pelapor',
            ]
        );

        User::updateOrCreate(
            ['email' => 'siswa@sekolah.com'],
            [
                'nama'     => 'Siswa',
                'password' => Hash::make('password123'),
                'status'   => 'pelapor',
                'role'     => 'pelapor',
            ]
        );

        User::updateOrCreate(
            ['email' => 'guru@sekolah.com'],
            [
                'nama'     => 'Guru',
                'password' => Hash::make('password123'),
                'status'   => 'pelapor',
                'role'     => 'pelapor',
            ]
        );

        // Akun Petugas Sarpras (Teknisi Lapangan dengan Spesialisasi Kategori)
        // 1. Teknisi Listrik
        User::updateOrCreate(
            ['email' => 'andi.petugas@sekolah.com'],
            [
                'nama'        => 'Andi Saputra',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 1, // Listrik
            ]
        );

        // 2. Teknisi Air
        User::updateOrCreate(
            ['email' => 'budi.petugas@sekolah.com'],
            [
                'nama'        => 'Budi Pratama',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 2, // Air
            ]
        );

        // 3. Teknisi Bangunan
        User::updateOrCreate(
            ['email' => 'joko.petugas@sekolah.com'],
            [
                'nama'        => 'Joko Susilo',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 3, // Bangunan
            ]
        );

        // 4. Teknisi IT
        User::updateOrCreate(
            ['email' => 'deni.petugas@sekolah.com'],
            [
                'nama'        => 'Deni Kurniawan',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 4, // IT
            ]
        );

        // 5. Teknisi Jaringan
        User::updateOrCreate(
            ['email' => 'zaja.petugas@sekolah.com'],
            [
                'nama'        => 'ZAJA S.KOM',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 6, // Jaringan
            ]
        );

        // 6. Teknisi Jaringan (Alternatif)
        User::updateOrCreate(
            ['email' => 'bayu.petugas@sekolah.com'],
            [
                'nama'        => 'Bayu S.T',
                'password'    => Hash::make('password123'),
                'status'      => 'petugas',
                'role'        => 'petugas',
                'category_id' => 6, // Jaringan
            ]
        );

        // Akun Admin Sarpras (Koordinator & Manajemen)
        User::updateOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'nama'     => 'Admin Sarpras',
                'password' => Hash::make('password123'),
                'status'   => 'admin',
                'role'     => 'admin',
            ]
        );
    }
}
