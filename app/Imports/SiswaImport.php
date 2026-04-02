<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || empty($row['nama'])) {
            return null;
        }

        if (!isset($row['nisn']) || empty($row['nisn'])) {
            return null;
        }

        if (!isset($row['email']) || empty($row['email'])) {
            return null;
        }

        $nama  = trim($row['nama']);
        $nisn  = trim($row['nisn']);
        $email = strtolower(trim($row['email']));

        // cek kalau nisn sudah ada -> skip
        if (Siswa::where('nisn', $nisn)->exists()) {
            return null;
        }

        // cek kalau email sudah ada -> STOP
        if (User::where('email', $email)->exists()) {
            throw new \Exception("Import gagal email sudah terdaftar");
        }

        // bikin akun user
        $user = User::create([
            'name'     => $nama,
            'email'    => $email,
            'password' => Hash::make('siswa123'),
            'role'     => 'siswa',
        ]);

        // bikin data siswa baru
        return new Siswa([
            'nama'          => $nama,
            'email'         => $email, // ✅ kalau di tabel siswas ada kolom email
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'nisn'          => $nisn,
            'kelas'         => $row['kelas'] ?? null,
            'id_user'       => $user->id,
        ]);
    }
}
