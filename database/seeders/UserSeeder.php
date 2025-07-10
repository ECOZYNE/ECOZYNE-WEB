<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['username' => 'admin', 'email' => 'admin@gmail.com', 'role' => 'admin'],
            ['username' => 'nabil', 'email' => 'nabiladitya2203@gmail.com', 'role' => 'komunitas'],
            ['username' => 'justine', 'email' => 'justine@gmail.com', 'role' => 'komunitas'],
        ];

        foreach ($users as $user) {
            $userId = DB::table('user')->insertGetId([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make('123456'),
                'role' => $user['role'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}