<?php

use App\Http\Controllers\LaundryItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Halaman Awal Web: Langsung Arahkan ke Login (Jika Belum Login)
|    atau Arahkan ke Dashboard Sesuai Role (Jika Sudah Login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('kasir.dashboard');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| 2. Rute Rekap Transaksi (Role: kasir & admin)
|    Bisa Tambah, Edit, Hapus, Update Status, dan Cetak Struk dalam 1 Rekap
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir,admin'])->group(function () {
    Route::get('/transaksi', [OrderController::class, 'index'])->name('kasir.dashboard');
    Route::post('/transaksi', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/transaksi/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}/cetak', [OrderController::class, 'cetakStruk'])->name('orders.cetak');
    Route::get('/pelanggan', [OrderController::class, 'customers'])->name('customers.index');
});

/*
|--------------------------------------------------------------------------
| 3. Rute Khusus Admin (Hanya Role: admin)
|    Dashboard Admin dan CRUD Master Layanan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // CRUD Master Layanan
    Route::resource('/admin/laundry_items', LaundryItemController::class)->except(['show']);
});

/*
|--------------------------------------------------------------------------
| 4. Alias Dashboard Breeze (Pengalihan Otomatis Berdasarkan Role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('kasir.dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| 5. Rute Profil Akun (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
