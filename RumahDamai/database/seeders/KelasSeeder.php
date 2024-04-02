<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelas')->insert([
            'nama_kelas' => 'Spritualitas',
            'tahun_kurikulum_id' => 1
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Karya Seni dan Budaya',
            'tahun_kurikulum_id' => 1
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Bahasa Inggris',
            'tahun_kurikulum_id' => 1
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Musik Tradisional',
            'tahun_kurikulum_id' => 1
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Futsal',
            'tahun_kurikulum_id' => 1
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Pendampingan Anak Berkebutuhan Khusus',
            'tahun_kurikulum_id' => 1
        ]);
    }
}
