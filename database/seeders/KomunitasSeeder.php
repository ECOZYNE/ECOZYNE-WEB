<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class KomunitasSeeder extends Seeder
{
    public function run(): void
    {
        $komunitasData = [
            ['username' => 'nabil', 'alamat_index' => 0, 'nama' => 'nabil', 'no_telp' => '082385142237'],
            ['username' => 'justine', 'alamat_index' => 1, 'nama' => 'justine', 'no_telp' => '096788888888'],
        ];

        $alamatIds = DB::table('alamat')->pluck('id_alamat')->toArray(); 

        foreach ($komunitasData as $item) {
            $user = DB::table('user')->where('username', $item['username'])->first();

            if ($user) {
               
                $actualUserId = $user->id_user; 

                $initials = Str::lower(Str::substr(Str::slug($item['nama'], ''), 0, 2));
                $avatarUrl = 'https://api.dicebear.com/9.x/initials/svg?seed=' . $initials;

                $actualAlamatId = $alamatIds[$item['alamat_index']] ?? null;

                if ($actualAlamatId !== null) {
                    $komunitasId = DB::table('komunitas')->insertGetId([
                        'id_user' => $actualUserId,
                        'id_alamat' => $actualAlamatId,
                        'nama' => $item['nama'],
                        'no_telp' => $item['no_telp'],
                        'foto' => $avatarUrl,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    DB::table('point')->insert([
                        'id_komunitas' => $komunitasId, 
                        'point' => 0,
                        'expired_point' => Carbon::now()->addYears(1),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    $this->command->warn("Skipping komunitas for {$item['username']}: Alamat ID not found for index {$item['alamat_index']}.");
                }
            } else {
                $this->command->warn("Skipping komunitas entry for {$item['username']}: User not found in 'user' table.");
            }
        }
    }
}