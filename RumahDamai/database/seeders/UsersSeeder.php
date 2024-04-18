<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    }
}
