<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrangtuaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // kalau nama kosong skip
        if (!isset($row['nama']) || empty($row['nama'])) {
            return null;
        }

        // kalau no_hp kosong skip
        if (!isset($row['no_hp']) || empty($row['no_hp'])) {
            return null;
        }

        // kalau email kosong skip
        if (!isset($row['email']) || empty($row['email'])) {
            return null;
        }

        $nama  = trim($row['nama']);
        $no_hp = trim($row['no_hp']);
        $email = strtolower(trim($row['email']));

        // ⛔ FIX: skip kalau email sudah ada (biar ga error)
        if (User::where('email', $email)->exists()) {
            return null;
        }

        return new User([
            'name'     => $nama,
            'email'    => $email,
            'no_hp'    => $no_hp,
            'alamat'   => $row['alamat'] ?? null,
            'password' => Hash::make('orangtua123'),
            'role'     => 'orangtua',
        ]);
    }
}