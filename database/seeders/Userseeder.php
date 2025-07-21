<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Siswa ',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa'
        ]);

        User::create([
            'name' => 'Orangtua ',
            'email' => 'orangtua@example.com',
            'password' => Hash::make('password'),
            'role' => 'orangtua'
        ]);
    }
}