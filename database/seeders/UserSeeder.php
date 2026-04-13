<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa',
                'password' => Hash::make('password'),
                'role' => 'siswa'
            ]
        );

        User::updateOrCreate(
            ['email' => 'orangtua@example.com'],
            [
                'name' => 'Orangtua',
                'password' => Hash::make('password'),
                'role' => 'orangtua'
            ]
        );
    }
}
