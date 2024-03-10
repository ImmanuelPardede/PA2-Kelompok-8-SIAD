<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AgamaSeeder::class,
        ]);
        $this->call([
            LokasiSeeder::class,
        ]);
        $this->call([
            GolonganDarahSeeder::class,
        ]);
        $this->call([
            JenisKelaminSeeder::class,
        ]);
        $this->call([
            UsersSeeder::class,
        ]);
        $this->call([
            TingkatPendidikanSeeder::class,
        ]);
        $this->call([
            KebutuhanSeeder::class,
        ]);
        $this->call([
            PekerjaanSeeder::class,
        ]);
        $this->call([
            DonasiSeeder::class,
        ]);
        $this->call([
            SponsorshipSeeder::class,
        ]);
        $this->call([
            PenyakitSeeder::class,
        ]);
    }
}
