<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = [
            ['id_kecamatan' => 1, 'kecamatan' => 'batam kota'],
            ['id_kecamatan' => 2, 'kecamatan' => 'batu aji'],
            ['id_kecamatan' => 3, 'kecamatan' => 'batu ampar'],
            ['id_kecamatan' => 4, 'kecamatan' => 'belakang padang'],
            ['id_kecamatan' => 5, 'kecamatan' => 'bengkong'],
            ['id_kecamatan' => 6, 'kecamatan' => 'bulang'],
            ['id_kecamatan' => 7, 'kecamatan' => 'galang'],
            ['id_kecamatan' => 8, 'kecamatan' => 'lubuk baja'],
            ['id_kecamatan' => 9, 'kecamatan' => 'nongsa'],
            ['id_kecamatan' => 10, 'kecamatan' => 'sagulung'],
            ['id_kecamatan' => 11, 'kecamatan' => 'sei beduk'],
            ['id_kecamatan' => 12, 'kecamatan' => 'sekupang'],
        ];

        DB::table('kecamatan')->insert($kecamatan);
    }
}
