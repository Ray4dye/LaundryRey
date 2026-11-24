<?php

namespace App\Http\Controllers;

use App\Models\LaundryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaundryItemController extends Controller
{
    /**
     * Menampilkan daftar master data layanan
     */
    public function index()
    {
        $laundry_items = LaundryItem::latest()->paginate(10);
        if (view()->exists('admin.laundry_items.index')) {
            return view('admin.laundry_items.index', compact('laundry_items'));
        }
        return view('admin.index', compact('laundry_items'));
    }

    /**
     * Menampilkan form tambah layanan baru
     */
    public function create()
    {
        if (view()->exists('admin.laundry_items.create')) {
            return view('admin.laundry_items.create');
        }
        return view('admin.create');
    }

    /**
     * Menyimpan data layanan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:Reguler,Ekspres,Superkilat',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('laundry_items', 'public');
        }

        LaundryItem::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('laundry_items.index')->with('success', 'Data layanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data layanan
     */
    public function edit(LaundryItem $laundryItem)
    {
        if (view()->exists('admin.laundry_items.edit')) {
            return view('admin.laundry_items.edit', compact('laundryItem'));
        }
        return view('admin.edit', compact('laundryItem'));
    }

    /**
     * Memperbarui data layanan di database
     */
    public function update(Request $request, LaundryItem $laundryItem)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:Reguler,Ekspres,Superkilat',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $laundryItem->image;
        if ($request->hasFile('image')) {
            if ($laundryItem->image && Storage::disk('public')->exists($laundryItem->image)) {
                Storage::disk('public')->delete($laundryItem->image);
            }
            $imagePath = $request->file('image')->store('laundry_items', 'public');
        }

        $laundryItem->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('laundry_items.index')->with('success', 'Data layanan berhasil diperbarui!');
    }

    /**
     * Menghapus layanan dari database
     */
    public function destroy(LaundryItem $laundryItem)
    {
        if ($laundryItem->image && Storage::disk('public')->exists($laundryItem->image)) {
            Storage::disk('public')->delete($laundryItem->image);
        }
        $laundryItem->delete();

        return redirect()->route('laundry_items.index')->with('success', 'Data layanan berhasil dihapus!');
    }
}
