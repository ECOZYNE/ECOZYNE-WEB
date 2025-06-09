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
            ['username' => 'nabiladitya', 'email' => 'nabiladitya2203@gmail.com', 'role' => 'komunitas'],
            ['username' => 'ahmad', 'email' => 'ahmad@gmail.com', 'role' => 'komunitas'],
            ['username' => 'hisam', 'email' => 'hisam@gmail.com', 'role' => 'komunitas'],
            ['username' => 'nabil', 'email' => 'mnabiladp2008@gmail.com', 'role' => 'komunitas'],
            ['username' => 'justin', 'email' => 'justin@gmail.com', 'role' => 'komunitas'],
            ['username' => 'asep', 'email' => 'asep@gmail.com', 'role' => 'komunitas'],
            ['username' => 'bubu', 'email' => 'bubu@gmail.com', 'role' => 'komunitas'],
            ['username' => 'jono', 'email' => 'jono@gmail.com', 'role' => 'komunitas'],
            ['username' => 'lol', 'email' => 'lol@gmail.com', 'role' => 'komunitas'],
            ['username' => 'kiki', 'email' => 'kiki@gmail.com', 'role' => 'komunitas'],
            ['username' => 'nola', 'email' => 'nola@gmail.com', 'role' => 'komunitas'],
            ['username' => 'akbari', 'email' => 'akbari@gmail.com', 'role' => 'komunitas'],
        ];

        foreach ($users as $user) {
            DB::table('user')->insert([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make('123456'), // semua default password
                'role' => $user['role'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
