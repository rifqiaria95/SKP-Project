<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::insert([
            [
                'nama_vendor' => 'PT Awan Integrasi Sandidata',
                'alamat'      => 'Jakarta',
                'no_tlp'      => '0812656486',
                'pic'         => 'Kevin Louis Gunawan',
                'jabatan_pic' => 'Account Manager',
                'note'        => 'Tes',
            ],
        ]);
    }
}
