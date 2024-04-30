<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => '0',
            'lokasi_penugasan_id' => '1',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => '1',
            'lokasi_penugasan_id' => '1',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Guru2',
            'email' => 'guru2@gmail.com',
            'password' => Hash::make('password'),
            'role' => '1',
            'lokasi_penugasan_id' => '2',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role' => '2',
            'lokasi_penugasan_id' => '1',
        ]);

        DB::table('users')->insert([
            'nama_lengkap' => 'Staff2',
            'email' => 'staff2@gmail.com',
            'password' => Hash::make('password'),
            'role' => '2',
            'lokasi_penugasan_id' => '2',
        ]);


        $now = Carbon::now();

        DB::table('users')->insert([
            'nama_lengkap' => 'direktur',
            'email' => 'direktur@gmail.com',
            'password' => Hash::make('password'),
            'role' => '3',
            'lokasi_penugasan_id' => '1',
            'tanggal_lahir' => '2024-12-31',
            'created_at' => $now,
            'updated_at' => $now,
        ]);


         // Generate NIP for direktur
         $lokasi_penugasan_id = '1'; // Lokasi Penugasan ID
         $tahun_masuk = date('y');
         $tahun_lahir = substr(date('Y', strtotime('2024-12-31')), -2); // Ambil tahun dari tanggal lahir
         $latest_user = DB::table('users')->latest()->first(); // Ambil user terakhir untuk mendapatkan nomor urut terakhir
         $nomor_urut = $latest_user ? ((int) substr($latest_user->nip, -3)) + 1 : 1; // Jika tidak ada user sebelumnya, nomor urut dimulai dari 1
         $nip = $lokasi_penugasan_id . $tahun_masuk . $tahun_lahir . str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
 
         // Update NIP for direktur
         DB::table('users')->where('email', 'direktur@gmail.com')->update(['nip' => $nip]);
    }
}
