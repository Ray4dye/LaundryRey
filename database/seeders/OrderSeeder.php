<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        OrderDetail::truncate();
        Order::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sampleOrders = [
            [
                'customer_name' => 'Ahmad Hidayat',
                'phone_number' => '081234567890',
                'status' => 'Proses',
                'created_at' => Carbon::now()->subHours(2),
                'items' => [
                    ['laundry_item_id' => 1, 'quantity' => 4, 'price' => 7000], // 28.000
                    ['laundry_item_id' => 5, 'quantity' => 1, 'price' => 25000], // 25.000 -> 53.000
                ],
            ],
            [
                'customer_name' => 'Siti Rahmawati',
                'phone_number' => '081388776655',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subHours(5),
                'items' => [
                    ['laundry_item_id' => 3, 'quantity' => 3, 'price' => 18000], // 54.000
                ],
            ],
            [
                'customer_name' => 'Budi Santoso',
                'phone_number' => '085612349876',
                'status' => 'Proses',
                'created_at' => Carbon::now()->subHours(8),
                'items' => [
                    ['laundry_item_id' => 2, 'quantity' => 5, 'price' => 12000], // 60.000
                    ['laundry_item_id' => 6, 'quantity' => 2, 'price' => 30000], // 60.000 -> 120.000
                ],
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'phone_number' => '081977665544',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(1)->setHour(14),
                'items' => [
                    ['laundry_item_id' => 1, 'quantity' => 6, 'price' => 7000], // 42.000
                ],
            ],
            [
                'customer_name' => 'Rian Pratama',
                'phone_number' => '087755443322',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(1)->setHour(17),
                'items' => [
                    ['laundry_item_id' => 7, 'quantity' => 2, 'price' => 35000], // 70.000
                    ['laundry_item_id' => 4, 'quantity' => 4, 'price' => 5000],  // 20.000 -> 90.000
                ],
            ],
            [
                'customer_name' => 'Maya Anggraini',
                'phone_number' => '081299887766',
                'status' => 'Proses',
                'created_at' => Carbon::now()->subDays(2)->setHour(10),
                'items' => [
                    ['laundry_item_id' => 8, 'quantity' => 3, 'price' => 20000], // 60.000
                ],
            ],
            [
                'customer_name' => 'Hendra Wijaya',
                'phone_number' => '085211223344',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(3)->setHour(11),
                'items' => [
                    ['laundry_item_id' => 2, 'quantity' => 4, 'price' => 12000], // 48.000
                ],
            ],
            [
                'customer_name' => 'Fitri Handayani',
                'phone_number' => '081800998877',
                'status' => 'Batal',
                'created_at' => Carbon::now()->subDays(3)->setHour(16),
                'items' => [
                    ['laundry_item_id' => 1, 'quantity' => 3, 'price' => 7000], // 21.000
                ],
            ],
            [
                'customer_name' => 'Doni Setiawan',
                'phone_number' => '089655443321',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(4)->setHour(15),
                'items' => [
                    ['laundry_item_id' => 5, 'quantity' => 2, 'price' => 25000], // 50.000
                    ['laundry_item_id' => 1, 'quantity' => 5, 'price' => 7000],  // 35.000 -> 85.000
                ],
            ],
            [
                'customer_name' => 'Anita Permata',
                'phone_number' => '081344556677',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(5)->setHour(9),
                'items' => [
                    ['laundry_item_id' => 6, 'quantity' => 1, 'price' => 30000], // 30.000
                ],
            ],
            [
                'customer_name' => 'Ahmad Hidayat', // Repeat customer!
                'phone_number' => '081234567890',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(6)->setHour(13),
                'items' => [
                    ['laundry_item_id' => 1, 'quantity' => 5, 'price' => 7000], // 35.000
                ],
            ],
            [
                'customer_name' => 'Budi Santoso', // Repeat customer!
                'phone_number' => '085612349876',
                'status' => 'Selesai',
                'created_at' => Carbon::now()->subDays(7)->setHour(10),
                'items' => [
                    ['laundry_item_id' => 4, 'quantity' => 7, 'price' => 5000], // 35.000
                ],
            ],
        ];

        foreach ($sampleOrders as $data) {
            $totalPrice = 0;
            foreach ($data['items'] as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'customer_name' => $data['customer_name'],
                'phone_number' => $data['phone_number'],
                'status' => $data['status'],
                'total_price' => $totalPrice,
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at'],
            ]);

            foreach ($data['items'] as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'laundry_item_id' => $item['laundry_item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['created_at'],
                ]);
            }
        }
    }
}
