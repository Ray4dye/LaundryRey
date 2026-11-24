<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Data Pelanggan</h1>
                <p class="text-xs text-slate-500 mt-0.5">Daftar pelanggan yang pernah melakukan pemesanan di Laundry Rey.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 shadow-xs transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Rekap</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- Ringkasan Metrik Pelanggan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs hover:border-slate-300 transition-all duration-200">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pelanggan Terdaftar</div>
                <div class="mt-2 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-slate-900 tabular-nums">{{ $totalCustomers }}</div>
                    <span class="text-xs font-medium text-slate-400">Orang</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs hover:border-slate-300 transition-all duration-200">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Belanja Pelanggan</div>
                <div class="mt-2 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-blue-600 tabular-nums">Rp {{ number_format($totalCustomerSpent, 0, ',', '.') }}</div>
                    <span class="text-xs font-medium text-slate-400">Total Akumulasi</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs hover:border-slate-300 transition-all duration-200">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rata-rata Belanja / Pelanggan</div>
                <div class="mt-2 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-emerald-600 tabular-nums">Rp {{ number_format($avgSpent, 0, ',', '.') }}</div>
                    <span class="text-xs font-medium text-slate-400">Per Customer</span>
                </div>
            </div>
        </div>

        <!-- Tabel Data Pelanggan -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <!-- Toolbar Pencarian Pelanggan -->
            <div class="p-4 border-b border-slate-200 bg-slate-50/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="relative w-full sm:w-80">
                    <input type="text" 
                           id="customerSearchInput" 
                           onkeyup="filterCustomerTable()" 
                           placeholder="Cari nama atau nomor WhatsApp..." 
                           class="w-full text-xs pl-9 pr-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 bg-white">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="text-xs text-slate-500">
                    Menampilkan <span class="font-bold text-slate-800">{{ $customers->count() }}</span> data pelanggan
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="customersTable">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3 px-4">Nama Pelanggan</th>
                            <th class="py-3 px-4">Nomor WhatsApp / HP</th>
                            <th class="py-3 px-4 text-center">Total Order</th>
                            <th class="py-3 px-4 text-right">Total Belanja</th>
                            <th class="py-3 px-4 text-center">Status Terakhir</th>
                            <th class="py-3 px-4 text-center">Order Terakhir</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($customers as $c)
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $c->phone_number);
                                if (str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition customer-row"
                                data-name="{{ strtolower($c->customer_name) }}"
                                data-phone="{{ strtolower($c->phone_number) }}">
                                
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($c->customer_name, 0, 1)) }}
                                        </div>
                                        <div class="font-bold text-slate-900 text-xs sm:text-sm">
                                            {{ $c->customer_name }}
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <div class="text-xs font-mono text-slate-600">
                                        {{ $c->phone_number }}
                                    </div>
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $c->total_orders }}x Order
                                    </span>
                                </td>

                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <span class="font-bold text-slate-900 tabular-nums">
                                        Rp {{ number_format($c->total_spent, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    @if(strtolower($c->last_status) === 'proses')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Proses
                                        </span>
                                    @elseif(strtolower($c->last_status) === 'selesai')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $c->last_status }}
                                        </span>
                                    @endif
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap text-xs text-slate-500">
                                    {{ $c->last_order_at ? \Carbon\Carbon::parse($c->last_order_at)->format('d/m/Y H:i') : '-' }}
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($c->customer_name) }},%20kami%20dari%20Laundry%20Rey." 
                                       target="_blank" 
                                       title="Hubungi WhatsApp"
                                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-emerald-200 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold transition">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.97.531 1.951.815 2.796.815 3.183 0 5.769-2.586 5.77-5.767 0-3.18-2.587-5.766-5.77-5.766zm9.969 5.766c0 5.518-4.482 10-10 10-1.745 0-3.414-.45-4.887-1.282l-5.113 1.344 1.371-5.006c-.927-1.536-1.371-3.237-1.371-5.056 0-5.518 4.482-10 10-10 5.518 0 10 4.482 10 10z"/>
                                        </svg>
                                        <span>WhatsApp</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    Belum ada data pelanggan yang pernah memesan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function filterCustomerTable() {
            const query = document.getElementById('customerSearchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.customer-row');

            rows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const phone = row.getAttribute('data-phone') || '';
                const match = !query || name.includes(query) || phone.includes(query);
                row.style.display = match ? '' : 'none';
            });
        }
    </script>
</x-app-layout>
