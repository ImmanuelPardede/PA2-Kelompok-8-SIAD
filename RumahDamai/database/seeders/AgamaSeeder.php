<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = [
            'Islam',
            'Kristen',
            'Hindu',
            'Buddha',
            'Yahudi',
            'Sikhisme',
            'Taoisme',
            'Shinto',
            'Baha\'i',
            'Jainisme',
            'Zoroastrianisme',
            'Konfusianisme',
            'Mormonisme',
            'Wicca',
            'Animisme',
            'Shintoisme Neo-Jepang',
            'Caodaisme',
            'Tenrikyo',
            'Cheondoisme',
            'Bahá\'í Faith',
            'Eckankar',
            'Deisme',
            'Panteisme',
        ];

        foreach ($agama as $nama_agama) {
            DB::table('agama')->insert([
                'agama' => $nama_agama,
            ]);
        }
    }
}
