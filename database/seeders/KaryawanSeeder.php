<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::insert([
            [
                'nama_depan'    => 'Rifqi',
                'nama_belakang' => 'Aria',
                'tempat_lahir'  => 'Jakarta',
                'tanggal_lahir' => '17 September 1995',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Karyawan',
                'job_title'     => 'IT',
                'user_id'       => '1'
            ],
            [
                'nama_depan'    => 'Budi',
                'nama_belakang' => 'Utomo Al Sunardi',
                'tempat_lahir'  => 'Surabaya',
                'tanggal_lahir' => '10 Maret 1980',
                'jenis_kelamin' => 'Laki-Laki',
                'status'        => 'Karyawan',
                'job_title'     => 'IT',
                'user_id'       => '2'
            ],
            [
                'nama_depan'    => 'Nila',
                'nama_belakang' => 'Anggraini',
                'tempat_lahir'  => 'Bandung',
                'tanggal_lahir' => '11 Januari 2000',
                'jenis_kelamin' => 'Perempuan',
                'status'        => 'Karyawan',
                'job_title'     => 'Finance',
                'user_id'       => '3'
            ],
            [
                'nama_depan'    => 'Non Karyawan',
                'nama_belakang' => '',
                'tempat_lahir'  => '-',
                'tanggal_lahir' => '-',
                'jenis_kelamin' => 'Pilih Jenis Kelamin',
                'status'        => 'Non Karyawan',
                'job_title'     => '-',
                'user_id'       => '4'
            ],
        ]);
    }
}
