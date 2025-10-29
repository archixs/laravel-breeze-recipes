<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Arturs',
                'email' => 'arturshugo4@gmail.com',
                'usertype' => 'user',
                'password' => Hash::make('11111111'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'usertype' => 'admin',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
