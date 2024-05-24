<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KodeLaporanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kode_laporan')->insert([
            'kode' => 'PPIB',
        ]);
    }
}
