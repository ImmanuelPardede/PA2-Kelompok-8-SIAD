<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan contoh pengguna dengan peran 'admin'
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => '0',
        ]);

        // Menambahkan contoh pengguna dengan peran 'guru'
        DB::table('users')->insert([
            'name' => 'Guru',
            'email' => 'guru@example.com',
            'password' => Hash::make('admin123'),
            'role' => '1',
        ]);

        // Menambahkan contoh pengguna dengan peran 'staff'
        DB::table('users')->insert([
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('admin123'),
            'role' => '2',
        ]);

        DB::table('agama')->insert([
            'agama' => 'Islam',
        ]);

        DB::table('jenis_kelamin')->insert([
            'jenis_kelamin' => 'Laki - Laki',
        ]);

        DB::table('golongan_darah')->insert([
            'golongan_darah' => 'O',
        ]);


        // Tambahkan data pengguna lainnya sesuai kebutuhan
    }
}
