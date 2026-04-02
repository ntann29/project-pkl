<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class OrangtuaTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'Nama',
            'No HP',
            'Email',
            'Alamat',
        ];
    }
}