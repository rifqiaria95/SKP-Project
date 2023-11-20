<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KaryawanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Karyawan::all();
    }

    public function map($karyawan): array
    {
        return [
            $karyawan->nama_lengkap(),
            $karyawan->tempat_lahir,
            $karyawan->tanggal_lahir,
            $karyawan->jenis_kelamin,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
        ];
    }
}
