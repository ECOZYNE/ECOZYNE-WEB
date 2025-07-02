<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KomunitasSeeder extends Seeder
{
  public function run(): void
    {
        $data = [
            ['id_user' => 2, 'id_alamat' => 2, 'nama' => 'nabil', 'no_telp' => '082385142237', 'foto' => 'default.jpg'], // Added a default foto
            ['id_user' => 3, 'id_alamat' => 3, 'nama' => 'justine', 'no_telp' => '096788888888', 'foto' => 'default.jpg'], // Added a default foto
        ];

        foreach ($data as $item) {
            DB::table('komunitas')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
