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
            ['id_user' => 3, 'id_alamat' => 3, 'nama' => 'nabiladitya', 'no_telp' => '082385142237'],
            ['id_user' => 9, 'id_alamat' => 11, 'nama' => 'ahmad firdaus', 'no_telp' => '081278902330'],
            ['id_user' => 12, 'id_alamat' => 10, 'nama' => 'hisam', 'no_telp' => '098918919191'],
            ['id_user' => 13, 'id_alamat' => 11, 'nama' => 'nabil aditya p', 'no_telp' => '12345678101'],
            ['id_user' => 14, 'id_alamat' => 12, 'nama' => 'justinn', 'no_telp' => '096788888888'],
            ['id_user' => 15, 'id_alamat' => 13, 'nama' => 'asep', 'no_telp' => '09678888888'],
            ['id_user' => 16, 'id_alamat' => 14, 'nama' => 'bubu', 'no_telp' => '132553486547'],
            ['id_user' => 17, 'id_alamat' => 15, 'nama' => 'jono', 'no_telp' => '098765432111'],
            ['id_user' => 18, 'id_alamat' => 16, 'nama' => 'lol', 'no_telp' => '34243422322'],
            ['id_user' => 20, 'id_alamat' => 17, 'nama' => 'kiki', 'no_telp' => '166061525843'],
            ['id_user' => 21, 'id_alamat' => 18, 'nama' => 'nola', 'no_telp' => '43244234234'],
            ['id_user' => 22, 'id_alamat' => 19, 'nama' => 'akbari', 'no_telp' => '024895823244'],
        ];

        foreach ($data as $item) {
            DB::table('komunitas')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
