<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin & Kasir Default jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Laundry',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Kasir Laundry',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );

        // 2. Panggil Seeder Layanan & Transaksi
        $this->call([
            LaundryItemSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
