<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'nama_lengkap' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => '0',
            'lokasi_penugasan_id' => '1',
            'tanggal_lahir' => '2022-01-01', // Example date of birth
        ];

        // Generate NIP for Admin
        $lokasi_penugasan_id = str_pad($admin['lokasi_penugasan_id'] ?? 0, 1, '0', STR_PAD_LEFT);
        $tahun_masuk = date('y');
        $tahun_lahir = substr(date('Y', strtotime($admin['tanggal_lahir'])), -2);
        $latest_user = User::latest()->first();
        $nomor_urut = $latest_user ? ((int) substr($latest_user->nip, -3)) + 1 : 1;
        $nip = $lokasi_penugasan_id . $tahun_masuk . $tahun_lahir . str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);

        // Insert Admin user with generated NIP
        DB::table('users')->insert([
            'nama_lengkap' => $admin['nama_lengkap'],
            'email' => $admin['email'],
            'password' => $admin['password'],
            'role' => $admin['role'],
            'lokasi_penugasan_id' => $admin['lokasi_penugasan_id'],
            'tanggal_lahir' => $admin['tanggal_lahir'],
            'nip' => $nip,
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => '1',
            'lokasi_penugasan_id' => '1',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role' => '2',
            'lokasi_penugasan_id' => '1',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Direktur',
            'email' => 'direktur@gmail.com',
            'password' => Hash::make('password'),
            'role' => '3',
            'lokasi_penugasan_id' => '1',
        ]);
    }
}
