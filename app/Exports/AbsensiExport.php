<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Absensi::all();
    // }

    use Exportable;
    
    protected $tanggal_awal;
    protected $tanggal_akhir;

    function __construct($tanggal_awal, $tanggal_akhir) {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function query()
    {
        $absensi = DB::table('absensi')
        ->whereBetween('created_at',[ $this->tanggal_awal,$this->tanggal_akhir])
        ->orderBy('id');
            
        // dd($absensi);
            
        return $absensi;
    }

    public function map($absensi): array
    {
        return [
            $absensi->karyawan->nama_lengkap(),
            $absensi->status,
            Carbon::parse($absensi->created_at)->toFormattedDateString(),
            Carbon::parse($absensi->updated_at)->toFormattedDateString()
            // $absensi->created_at,
            // $absensi->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Status',
            'Created at',
            'Updated at',
        ];
    }
}
