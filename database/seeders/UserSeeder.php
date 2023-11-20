<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role'              => 'owner',
                'status_user'            => 1,
                'name'              => 'Rifqi Aria',
                'email'             => 'rbenity@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password
                'remember_token'    => Str::random(10)
            ]
        ]);
    }
}
