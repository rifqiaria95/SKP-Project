<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Absensi::all();
    }

    public function map($absensi): array
    {
        return [
            $absensi->status,
            $absensi->karyawan->nama_depan,
            $absensi->created_at,
            $absensi->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Status',
            'Nama Karyawan',
            'Created at',
            'Updated at',
        ];
    }
}
