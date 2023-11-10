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
        DB::table('karyawan')->insert([
            'nama_depan' => 'Rifqi',
            'nama_belakang' => 'Aria',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '17 September 1995',
            'jenis_kelamin' => 'Laki-Laki',
            'user_id' => '1'
        ]);
    }
}
