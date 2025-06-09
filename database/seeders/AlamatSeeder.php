<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_kelurahan' => 2, 'alamat' => 'Bida Asri 2', 'kode_pos' => '26504'],
            ['id_kelurahan' => 3, 'alamat' => 'Bida Asri 2 Blok H No 9', 'kode_pos' => '29464'],
        ];

        foreach ($data as $item) {
            DB::table('alamat')->insert([
                'id_kelurahan' => $item['id_kelurahan'],
                'alamat' => $item['alamat'],
                'kode_pos' => $item['kode_pos'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
