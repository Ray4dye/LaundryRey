<?php

namespace Tests\Feature;

use App\Models\LaundryItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaundryAppTest extends TestCase
{
    use RefreshDatabase;

    public function test_kasir_can_manage_transactions_in_single_rekap_page()
    {
        $kasir = User::factory()->create(['role' => 'kasir']);
        $item1 = LaundryItem::create([
            'name' => 'Cuci Kilat Test',
            'category' => 'Ekspres',
            'price' => 12000,
            'description' => '1-2 hari selesai',
        ]);
        $item2 = LaundryItem::create([
            'name' => 'Cuci Reguler Test',
            'category' => 'Reguler',
            'price' => 7000,
            'description' => '3-4 hari selesai',
        ]);

        // 1. Kasir membuka halaman rekap transaksi
        $rekapResponse = $this->actingAs($kasir)->get(route('kasir.dashboard'));
        $rekapResponse->assertStatus(200);
        $rekapResponse->assertSee('Rekap Transaksi Laundry');
        $rekapResponse->assertSee('Tambah Transaksi Baru');

        // 2. Kasir menambah transaksi baru
        $postResponse = $this->actingAs($kasir)->post(route('orders.store'), [
            'customer_name' => 'Budi Santoso',
            'phone_number' => '081234567890',
            'status' => 'Proses',
            'items' => [
                $item1->id => 2, // 2 x 12.000 = 24.000
            ],
        ]);

        $postResponse->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Budi Santoso',
            'phone_number' => '081234567890',
            'total_price' => 24000,
            'status' => 'Proses',
        ]);

        $order = Order::where('customer_name', 'Budi Santoso')->first();
        $this->assertNotNull($order);
        $this->assertCount(1, $order->orderDetails);

        // 3. Kasir mengedit transaksi langsung
        $editResponse = $this->actingAs($kasir)->put(route('orders.update', $order->id), [
            'customer_name' => 'Budi Santoso Edit',
            'phone_number' => '08999999999',
            'status' => 'Proses',
            'items' => [
                $item1->id => 1, // 1 x 12.000 = 12.000
                $item2->id => 2, // 2 x 7.000  = 14.000 -> Total: 26.000
            ],
        ]);

        $editResponse->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'customer_name' => 'Budi Santoso Edit',
            'phone_number' => '08999999999',
            'total_price' => 26000,
        ]);

        // 4. Kasir memperbarui status ke Selesai
        $statusResponse = $this->actingAs($kasir)->patch(route('orders.updateStatus', $order->id), [
            'status' => 'Selesai',
        ]);
        $statusResponse->assertSessionHas('success');
        $this->assertEquals('Selesai', $order->fresh()->status);

        // 5. Kasir mencetak struk transaksi
        $cetakResponse = $this->actingAs($kasir)->get(route('orders.cetak', $order->id));
        $cetakResponse->assertStatus(200);
        $cetakResponse->assertSee('LAUNDRY REY');
        $cetakResponse->assertSee('Budi Santoso Edit');
        $cetakResponse->assertSee('26.000');

        // 6. Kasir menghapus transaksi
        $deleteResponse = $this->actingAs($kasir)->delete(route('orders.destroy', $order->id));
        $deleteResponse->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_kasir_cannot_access_crud_layanan()
    {
        $kasir = User::factory()->create(['role' => 'kasir']);

        // Kasir dilarang mengakses CRUD Layanan (403 Forbidden)
        $layananResponse = $this->actingAs($kasir)->get(route('laundry_items.index'));
        $layananResponse->assertStatus(403);
    }

    public function test_admin_can_access_crud_layanan()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Admin dapat mengakses CRUD Layanan
        $layananResponse = $this->actingAs($admin)->get(route('laundry_items.index'));
        $layananResponse->assertStatus(200);
        $layananResponse->assertSee('Master Data Layanan');
    }

    public function test_both_kasir_and_admin_can_access_data_pelanggan()
    {
        $kasir = User::factory()->create(['role' => 'kasir']);
        $admin = User::factory()->create(['role' => 'admin']);

        // Kasir dapat melihat data pelanggan
        $kasirResponse = $this->actingAs($kasir)->get(route('customers.index'));
        $kasirResponse->assertStatus(200);
        $kasirResponse->assertSee('Data Pelanggan');

        // Admin dapat melihat data pelanggan
        $adminResponse = $this->actingAs($admin)->get(route('customers.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Data Pelanggan');
    }
}
