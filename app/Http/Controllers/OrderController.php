<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\LaundryItem;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan Rekap Transaksi Laundry beserta form tambah, edit, statistik, dan aksi.
     */
    public function index()
    {
        $orders = Order::with('orderDetails.laundryItem')->latest()->get();
        $laundry_items = LaundryItem::all();

        // Ringkasan metrik statistik
        $totalOrders = $orders->count();
        $totalProses = $orders->where('status', 'Proses')->count();
        $totalSelesai = $orders->where('status', 'Selesai')->count();
        $totalBatal = $orders->where('status', 'Batal')->count();
        $totalPendapatan = $orders->where('status', '!=', 'Batal')->sum('total_price');

        // Statistik 7 hari terakhir untuk grafik responsif interaktif
        $dailyStats = [];
        $dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayOrders = $orders->filter(function ($o) use ($date) {
                return $o->created_at && $o->created_at->format('Y-m-d') === $date->format('Y-m-d');
            });
            $dailyStats[] = [
                'date' => $date->format('d M'),
                'day' => $dayNames[$date->dayOfWeek] ?? $date->format('D'),
                'revenue' => $dayOrders->where('status', '!=', 'Batal')->sum('total_price'),
                'count' => $dayOrders->count(),
            ];
        }

        return view('dashboard', compact(
            'orders',
            'laundry_items',
            'totalOrders',
            'totalProses',
            'totalSelesai',
            'totalBatal',
            'totalPendapatan',
            'dailyStats'
        ));
    }

    /**
     * Menampilkan data pelanggan yang pernah memesan
     */
    public function customers(Request $request)
    {
        $query = Order::select('customer_name', 'phone_number',
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(CASE WHEN status != "Batal" THEN total_price ELSE 0 END) as total_spent'),
            DB::raw('MAX(created_at) as last_order_at'),
            DB::raw('MIN(created_at) as first_order_at')
        )
        ->groupBy('customer_name', 'phone_number');

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', $search)
                  ->orWhere('phone_number', 'like', $search);
            });
        }

        $customers = $query->orderByDesc('last_order_at')->get();

        // Ambil status pesanan terakhir tiap pelanggan
        foreach ($customers as $c) {
            $lastOrder = Order::where('customer_name', $c->customer_name)
                ->where('phone_number', $c->phone_number)
                ->latest()
                ->first();
            $c->last_status = $lastOrder ? $lastOrder->status : '-';
            $c->last_order_id = $lastOrder ? $lastOrder->id : null;
        }

        $totalCustomers = $customers->count();
        $totalCustomerSpent = $customers->sum('total_spent');
        $avgSpent = $totalCustomers > 0 ? (int)($totalCustomerSpent / $totalCustomers) : 0;

        return view('customers.index', compact(
            'customers',
            'totalCustomers',
            'totalCustomerSpent',
            'avgSpent'
        ));
    }

    /**
     * Alias admin dashboard
     */
    public function adminDashboard()
    {
        return $this->index();
    }

    /**
     * Menyimpan transaksi laundry baru langsung dari rekap
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number'  => 'required|string|max:30',
            'status'        => 'nullable|in:Proses,Selesai,Batal',
            'items'         => 'required|array',
            'items.*'       => 'nullable|integer|min:0',
        ]);

        $orderedItems = array_filter($request->items, fn ($qty) => $qty > 0);

        if (empty($orderedItems)) {
            return back()->with('error', 'Pilih minimal satu layanan dengan jumlah/berat lebih dari 0!')->withInput();
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone_number'  => $request->phone_number,
                'total_price'   => 0,
                'status'        => $request->status ?? 'Proses',
            ]);

            $totalPrice = 0;

            foreach ($orderedItems as $laundryItemId => $quantity) {
                $laundryItem = LaundryItem::findOrFail($laundryItemId);
                $subtotal = $laundryItem->price * $quantity;
                $totalPrice += $subtotal;

                OrderDetail::create([
                    'order_id'        => $order->id,
                    'laundry_item_id' => $laundryItem->id,
                    'quantity'        => $quantity,
                    'price'           => $laundryItem->price,
                ]);
            }

            $order->update(['total_price' => $totalPrice]);
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Transaksi #' . $order->id . ' untuk pelanggan ' . $order->customer_name . ' berhasil dicatat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Memperbarui data transaksi (Nama, No HP, Status, dan Layanan)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number'  => 'required|string|max:30',
            'status'        => 'required|in:Proses,Selesai,Batal',
            'items'         => 'required|array',
            'items.*'       => 'nullable|integer|min:0',
        ]);

        $orderedItems = array_filter($request->items, fn ($qty) => $qty > 0);

        if (empty($orderedItems)) {
            return back()->with('error', 'Pilih minimal satu layanan dengan jumlah/berat lebih dari 0!')->withInput();
        }

        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $order->update([
                'customer_name' => $request->customer_name,
                'phone_number'  => $request->phone_number,
                'status'        => $request->status,
            ]);

            // Hapus rincian lama dan buat ulang
            $order->orderDetails()->delete();

            $totalPrice = 0;
            foreach ($orderedItems as $laundryItemId => $quantity) {
                $laundryItem = LaundryItem::findOrFail($laundryItemId);
                $subtotal = $laundryItem->price * $quantity;
                $totalPrice += $subtotal;

                OrderDetail::create([
                    'order_id'        => $order->id,
                    'laundry_item_id' => $laundryItem->id,
                    'quantity'        => $quantity,
                    'price'           => $laundryItem->price,
                ]);
            }

            $order->update(['total_price' => $totalPrice]);
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Transaksi #' . $order->id . ' berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui transaksi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Memperbarui status pengerjaan transaksi (Proses, Selesai, Batal)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Proses,Selesai,Batal',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status transaksi #' . $order->id . ' diubah ke ' . $order->status . '!');
    }

    /**
     * Menghapus transaksi
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi #' . $id . ' berhasil dihapus!');
    }

    /**
     * Menampilkan struk transaksi siap cetak
     */
    public function cetakStruk($id)
    {
        $order = Order::with('orderDetails.laundryItem')->findOrFail($id);
        return view('orders.cetak', compact('order'));
    }
}
