<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PointSeeder extends Seeder
{
      public function run(): void
    {
        $points = [
            ['id_komunitas' => 2, 'expired_point' => '2026-05-02'],
            ['id_komunitas' => 3, 'expired_point' => '2026-05-04'],
        ];

        foreach ($points as $point) {
            DB::table('point')->insert([
                'id_komunitas' => $point['id_komunitas'],
                'point' => 0, // Default Point saat seeding, sesuai skema migrasi
                'expired_point' => $point['expired_point'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
