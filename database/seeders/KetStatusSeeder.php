<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\KetStatus;

class KetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KetStatus::insert([
            [
                'nama_status'       => 'active',
                'user_id'           => 1,
            ],

            [
                'nama_status'       => 'inactive',
                'user_id'           => 2,
            ]
        ]);
    }
}
