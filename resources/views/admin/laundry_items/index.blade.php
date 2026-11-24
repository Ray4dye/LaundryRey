<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Master Data Layanan</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola paket cucian, kategori pengerjaan, dan tarif per kilogram.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 shadow-xs transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Rekap Transaksi</span>
                </a>
                <a href="{{ route('laundry_items.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-lg text-xs font-semibold shadow-xs transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Layanan Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-xs uppercase tracking-wider block">Berhasil</span>
                        <span class="text-xs">{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold p-1 text-sm">&times;</button>
            </div>
        @endif

        <!-- Quick Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Layanan</div>
                <div class="text-2xl font-extrabold text-slate-900 mt-2 tabular-nums">{{ $laundry_items->total() }} <span class="text-xs font-medium text-slate-400">Paket</span></div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Paket Reguler</div>
                <div class="text-2xl font-extrabold text-blue-600 mt-2 tabular-nums">
                    {{ $laundry_items->where('category', 'Reguler')->count() }} <span class="text-xs font-medium text-slate-400">Paket</span>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Paket Ekspres</div>
                <div class="text-2xl font-extrabold text-amber-600 mt-2 tabular-nums">
                    {{ $laundry_items->where('category', 'Ekspres')->count() }} <span class="text-xs font-medium text-slate-400">Paket</span>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Paket Superkilat</div>
                <div class="text-2xl font-extrabold text-rose-600 mt-2 tabular-nums">
                    {{ $laundry_items->where('category', 'Superkilat')->count() }} <span class="text-xs font-medium text-slate-400">Paket</span>
                </div>
            </div>
        </div>

        <!-- Tabel Layanan dengan Foto Masing-Masing -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3 px-4 text-center">Foto Layanan</th>
                            <th class="py-3 px-4">Nama Layanan</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4 text-right">Tarif / Harga</th>
                            <th class="py-3 px-4">Deskripsi / Estimasi</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($laundry_items as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 object-cover mx-auto rounded-lg border border-slate-200 shadow-xs">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 border border-blue-200 flex items-center justify-center font-bold text-xs mx-auto">
                                        LR
                                    </div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900 text-xs sm:text-sm">
                                {{ $item->name }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($item->category === 'Superkilat')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        Superkilat (5 Jam)
                                    </span>
                                @elseif($item->category === 'Ekspres')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        Ekspres (1-2 Hari)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        Reguler (3-4 Hari)
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap font-bold text-slate-900 tabular-nums">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-500 max-w-xs truncate">
                                {{ $item->description }}
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('laundry_items.edit', $item->id) }}" 
                                       title="Edit Layanan"
                                       class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-md border border-slate-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('laundry_items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Layanan" 
                                                class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-md border border-transparent hover:border-rose-200 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Belum ada data layanan laundry.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $laundry_items->links() }}</div>

    </div>
</x-app-layout>
