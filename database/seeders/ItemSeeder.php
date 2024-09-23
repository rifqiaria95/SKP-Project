<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            [
                'nama_item'        => 'Mouse Logitech',
                'spesifikasi_item' => 'MX Master 3',
                'harga'            => 60000,
                'note'             => '-',
            ],
            [
                'nama_item'        => 'Laptop Asus ROG',
                'spesifikasi_item' => 'Intel Core i7, Ram 8GB, SSD 1TB',
                'harga'            => 25000000,
                'note'             => '-',
            ],
            [
                'nama_item'        => 'Apple Iphone 15 Pro',
                'spesifikasi_item' => 'Layar 6.1", Ram 8GB, Internal 512GB',
                'harga'            => 90000,
                'note'             => '-',
            ],
        ]);
    }
}
