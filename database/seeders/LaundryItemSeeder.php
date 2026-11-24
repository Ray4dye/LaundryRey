<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('laundry_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('laundry_items')->insert([
            [
                'id' => 1,
                'name' => 'Cuci Baju Reguler',
                'category' => 'Reguler',
                'price' => 7000,
                'description' => 'Cuci bersih, kering & wangi standar 3-4 hari pengerjaan.',
                'image' => 'services/cuci-komplit.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Cuci Baju Ekspres',
                'category' => 'Ekspres',
                'price' => 12000,
                'description' => 'Cuci kilat selesai 1-2 hari, prioritas antrean pengerjaan.',
                'image' => 'services/cuci-kilat.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Paket Cuci Super Cepat',
                'category' => 'Superkilat',
                'price' => 18000,
                'description' => 'Selesai 5 jam, langsung kering, disetrika & dikemas rapi.',
                'image' => 'services/super-kilat.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Cuci Kering Lipat',
                'category' => 'Reguler',
                'price' => 5000,
                'description' => 'Cuci bersih dan lipat rapi tanpa setrika.',
                'image' => 'services/cuci-lipat.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Cuci Bed Cover & Selimut',
                'category' => 'Reguler',
                'price' => 25000,
                'description' => 'Perawatan khusus bahan tebal dan wangi higienis tahan lama.',
                'image' => 'services/bed-cover.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Cuci Sepatu & Sneaker Premium',
                'category' => 'Ekspres',
                'price' => 30000,
                'description' => 'Deep cleaning sepatu luar dalam, anti-bakteri dan un-yellowing.',
                'image' => 'services/sepatu.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Dry Clean Jas & Blazer Formal',
                'category' => 'Ekspres',
                'price' => 35000,
                'description' => 'Pembersihan kimiawi khusus jas & gaun tanpa merusak serat kain.',
                'image' => 'services/jas-blazer.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Cuci Karpet & Gorden Rumah',
                'category' => 'Reguler',
                'price' => 20000,
                'description' => 'Cuci karpet lantai & gorden rumah bersih tuntas bebas debu tungau.',
                'image' => 'services/karpet.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
