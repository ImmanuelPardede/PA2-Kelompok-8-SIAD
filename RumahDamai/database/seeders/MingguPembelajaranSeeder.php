<?php

namespace Database\Seeders;

use App\Models\LokasiPenugasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MingguPembelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 1',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 2',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 3',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 4',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 5',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 6',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 7',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 8',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 9',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 10',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 11',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 12',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 13',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 14',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 15',
        ]);
        DB::table('minggu_pembelajaran')->insert([
            'minggu_pembelajaran' => 'Minggu 16',
        ]);
    }
}
