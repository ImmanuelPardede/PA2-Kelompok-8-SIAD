<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foundation_histories')->insert([
            'user_id' => 1,
            'gambar' => 'uploads/visitor/history/dummy2.jpg',
            'sejarah_singkat' => 'YPARD didirikan di Balige pada Januari 2022 dengan misi memberikan pendidikan kepada anak-anak dengan hambatan. Terinspirasi dari pengalaman pribadi dan studi di HKBP Laguboti, YPARD fokus pada memberikan pendidikan inklusif melalui Rumah Damai di Lumban Silintong dan YPA Rumah Damai di Andam Dewi untuk anak disabilitas.',
            'tujuan_utama' => 'Berdirinya YPARD didasarkan pada keinginan Pendiri sejak duduk di Sekolah Menengah Pertama.',
            'dibangun' => '2022-01-25'
        ]);

    }
}
