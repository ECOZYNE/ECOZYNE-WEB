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
            ['id_komunitas' => 1, 'expired_point' => '2026-05-02'],
            ['id_komunitas' => 2, 'expired_point' => '2026-05-02'],
            ['id_komunitas' => 3, 'expired_point' => '2026-05-04'],
            ['id_komunitas' => 4, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 5, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 6, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 7, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 8, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 9, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 10, 'expired_point' => '2026-05-07'],
            ['id_komunitas' => 11, 'expired_point' => '2026-05-21'],
            ['id_komunitas' => 12, 'expired_point' => '2026-05-26'],
            ['id_komunitas' => 13, 'expired_point' => '2026-05-26'],
            ['id_komunitas' => 14, 'expired_point' => '2026-05-28'],
            ['id_komunitas' => 15, 'expired_point' => '2026-05-28'],
            ['id_komunitas' => 16, 'expired_point' => '2026-05-31'],
            ['id_komunitas' => 17, 'expired_point' => '2026-06-05'],
            ['id_komunitas' => 18, 'expired_point' => '2026-06-07'],
            ['id_komunitas' => 19, 'expired_point' => '2026-06-07'],
        ];

        foreach ($points as $point) {
            DB::table('point')->insert([
                'id_komunitas' => $point['id_komunitas'],
                'point' => 0, // Default Point
                'expired_point' => $point['expired_point'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
