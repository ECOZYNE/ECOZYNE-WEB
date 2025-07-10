<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AlamatSeeder;
use Database\Seeders\KecamatanSeeder;
use Database\Seeders\KelurahanSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\KomunitasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KecamatanSeeder::class, 
            KelurahanSeeder::class, 
            AlamatSeeder::class,    
            UserSeeder::class,   
            KomunitasSeeder::class, 
        ]);
    }
}