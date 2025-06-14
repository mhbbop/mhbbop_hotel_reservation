<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun admin baru
        User::create([
            'name' => 'Admin Hotel',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'admin',
        ]);
    }
}