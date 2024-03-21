<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perusahaan::insert([
            [
                'nama_perusahaan'   => 'PT Santini Kelola Persada',
                'alamat_perusahaan' => 'Jakarta',
                'no_tlp_perusahaan' => '0812656486'
            ],
            [
                'nama_perusahaan'   => 'PT Santiniluwansa Properti Sentosa',
                'alamat_perusahaan' => 'Jakarta',
                'no_tlp_perusahaan' => '013248751'
            ],
            [
                'nama_perusahaan'   => 'PT Santiniluwansa Properti Indonesia',
                'alamat_perusahaan' => 'Jakarta',
                'no_tlp_perusahaan' => '021674846'
            ],
            [
                'nama_perusahaan'   => 'PT Santini Minahasa Lestari',
                'alamat_perusahaan' => 'Jakarta',
                'no_tlp_perusahaan' => '0215698765'
            ],
        ]);
    }
}
