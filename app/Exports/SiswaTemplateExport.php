<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'Nama',
            'Email', // ✅ tambah ini
            'Jenis Kelamin',
            'NISN',
            'Kelas',
        ];
    }
}
