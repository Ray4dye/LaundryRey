<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <!-- Washing machine logo with spinning drum animation -->
                <div class="relative w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/25">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="2" width="18" height="20" rx="3" stroke-width="1.8"/>
                        <circle cx="8" cy="6" r="1" fill="currentColor"/>
                        <circle cx="11" cy="6" r="1" fill="currentColor"/>
                        <line x1="15" y1="6" x2="18" y2="6" stroke-width="1.5"/>
                        <circle cx="12" cy="14" r="5" stroke-width="1.8"/>
                    </svg>
                    <!-- Spinning inner drum circle -->
                    <div class="absolute inset-0 flex items-center justify-center pt-2 pointer-events-none">
                        <svg class="w-4 h-4 text-sky-200 animate-spin" style="animation-duration: 3s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="6 5">
                            <circle cx="12" cy="12" r="5"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Laundry Rey</span>
                        <span class="text-xs text-slate-300">•</span>
                        <h1 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">Rekap Transaksi Laundry</h1>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola pencatatan order masuk, update status cucian, dan cetak struk pembayaran.</p>
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 rounded-lg text-xs font-semibold text-slate-600">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ date('d F Y') }}</span>
                </div>
                <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Transaksi Baru</span>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- NOTIFIKASI ALERT -->
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

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-rose-600 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-xs uppercase tracking-wider block">Peringatan</span>
                        <span class="text-xs">{{ session('error') }}</span>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 font-bold p-1 text-sm">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-xs">
                <div class="font-bold text-xs uppercase tracking-wider mb-1">Terdapat kesalahan input:</div>
                <ul class="list-disc list-inside text-xs space-y-0.5 ml-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 4 KARTU METRIK STATISTIK (Clean, Interaktif saat disentuh/hover) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Transaksi -->
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</span>
                    <span class="p-1.5 rounded-lg bg-blue-50 text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </span>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-slate-900 tabular-nums">{{ $totalOrders }}</div>
                    <span class="text-xs font-medium text-slate-400">Semua Order</span>
                </div>
            </div>

            <!-- Dalam Proses -->
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Dalam Proses</span>
                    <span class="p-1.5 rounded-lg bg-amber-50 text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-amber-600 tabular-nums">{{ $totalProses }}</div>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        Antrean Cuci
                    </span>
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Selesai Siap Ambil</span>
                    <span class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <div class="text-2xl font-extrabold text-emerald-600 tabular-nums">{{ $totalSelesai }}</div>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Siap Diambil
                    </span>
                </div>
            </div>

            <!-- Total Pendapatan Kas -->
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kas Masuk</span>
                    <span class="p-1.5 rounded-lg bg-indigo-50 text-indigo-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <div class="mt-2.5 flex items-baseline justify-between">
                    <div class="text-xl sm:text-2xl font-extrabold text-slate-900 tabular-nums">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    <span class="text-xs font-medium text-slate-400">Omset Bersih</span>
                </div>
            </div>
        </div>

        <!-- 2 GRAFIK INTERAKTIF RESPONSIF (Bergerak saat disentuh / hover) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Grafik 1: Tren Volume Transaksi 7 Hari Terakhir (Interactive Bar Chart) -->
            <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex flex-col justify-between"
                 x-data="{ 
                     hoveredDay: null,
                     stats: {{ json_encode($dailyStats) }}
                 }">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Volume Transaksi 7 Hari Terakhir</h2>
                        <p class="text-[11px] text-slate-400">Sentuh atau arahkan kursor ke batang grafik untuk melihat rincian.</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-extrabold text-blue-600" x-text="hoveredDay ? hoveredDay.day + ' (' + hoveredDay.date + '): Rp ' + Number(hoveredDay.revenue).toLocaleString('id-ID') + ' (' + hoveredDay.count + ' order)' : 'Sentuh batang grafik'"></span>
                    </div>
                </div>

                <!-- Canvas Visualisasi Batang Interaktif -->
                @php
                    $maxRevenue = collect($dailyStats)->max('revenue');
                    if ($maxRevenue == 0) $maxRevenue = 100000;
                @endphp
                <div class="pt-6 pb-2">
                    <div class="h-44 flex items-end justify-between gap-3 px-2">
                        @foreach($dailyStats as $idx => $stat)
                            @php
                                $heightPercent = $stat['revenue'] > 0 ? max(15, min(100, (int)(($stat['revenue'] / $maxRevenue) * 100))) : 8;
                            @endphp
                            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer relative"
                                 @mouseenter="hoveredDay = stats[{{ $idx }}]"
                                 @mouseleave="hoveredDay = null"
                                 @touchstart="hoveredDay = stats[{{ $idx }}]">
                                
                                <!-- Tooltip Floating saat Hover / Touch -->
                                <div class="absolute -top-10 opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none z-10 bg-slate-900 text-white text-[10px] py-1 px-2 rounded-md whitespace-nowrap shadow-md">
                                    Rp {{ number_format($stat['revenue'], 0, ',', '.') }} ({{ $stat['count'] }} order)
                                </div>

                                <!-- Batang Grafik dengan Animasi Transform -->
                                <div class="w-full max-w-[42px] rounded-t-lg transition-all duration-300 transform group-hover:scale-y-105 origin-bottom shadow-xs {{ $stat['revenue'] > 0 ? 'bg-gradient-to-t from-blue-700 to-blue-500 group-hover:from-blue-600 group-hover:to-blue-400' : 'bg-slate-100 group-hover:bg-slate-200' }}"
                                     style="height: {{ $heightPercent }}%;">
                                </div>

                                <!-- Label Hari -->
                                <div class="mt-2 text-center">
                                    <span class="block text-[11px] font-bold text-slate-700 group-hover:text-blue-600 transition">{{ $stat['day'] }}</span>
                                    <span class="block text-[9px] text-slate-400 font-medium">{{ $stat['date'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Grafik 2: Komposisi Status Pesanan (Interactive Ring Donut) -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex flex-col justify-between"
                 x-data="{
                     activeStatus: 'Semua',
                     activeCount: {{ $totalOrders }},
                     activeLabel: 'Total Pesanan'
                 }">
                <div class="pb-3 border-b border-slate-100">
                    <h2 class="text-sm font-bold text-slate-900">Komposisi Status Pesanan</h2>
                    <p class="text-[11px] text-slate-400">Interaktif: sentuh kategori untuk melihat proporsi.</p>
                </div>

                <div class="py-4 flex flex-col items-center justify-center">
                    <!-- Donut SVG Interaktif 3 Warna (Selesai, Proses, Batal) -->
                    @php
                        $tot = max(1, $totalOrders);
                        $circ = 238.76;
                        $lenSelesai = round(($totalSelesai / $tot) * $circ, 2);
                        $lenProses = round(($totalProses / $tot) * $circ, 2);
                        $lenBatal = max(0, round($circ - $lenSelesai - $lenProses, 2));
                        if ($totalBatal === 0) {
                            $lenBatal = 0;
                        }
                    @endphp
                    <div class="relative w-36 h-36 flex items-center justify-center">
                        <svg class="w-full h-full -rotate-90 transform" viewBox="0 0 100 100">
                            <!-- Background Track -->
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#F1F5F9" stroke-width="12" />
                            
                            <!-- 1. Selesai (Emerald #10B981) -->
                            @if($lenSelesai > 0)
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#10B981" stroke-width="12"
                                    stroke-dasharray="{{ $lenSelesai }} {{ $circ - $lenSelesai }}"
                                    stroke-dashoffset="0"
                                    class="transition-all duration-300 hover:stroke-[15px] cursor-pointer"
                                    @mouseenter="activeStatus = 'Selesai'; activeCount = {{ $totalSelesai }}; activeLabel = 'Selesai Diambil'"
                                    @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'" />
                            @endif

                            <!-- 2. Proses (Amber #F59E0B) -->
                            @if($lenProses > 0)
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#F59E0B" stroke-width="12"
                                    stroke-dasharray="{{ $lenProses }} {{ $circ - $lenProses }}"
                                    stroke-dashoffset="{{ -$lenSelesai }}"
                                    class="transition-all duration-300 hover:stroke-[15px] cursor-pointer"
                                    @mouseenter="activeStatus = 'Proses'; activeCount = {{ $totalProses }}; activeLabel = 'Dalam Proses Cuci'"
                                    @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'" />
                            @endif

                            <!-- 3. Batal (Rose #EF4444) -->
                            @if($lenBatal > 0)
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#EF4444" stroke-width="12"
                                    stroke-dasharray="{{ $lenBatal }} {{ $circ - $lenBatal }}"
                                    stroke-dashoffset="{{ -($lenSelesai + $lenProses) }}"
                                    class="transition-all duration-300 hover:stroke-[15px] cursor-pointer"
                                    @mouseenter="activeStatus = 'Batal'; activeCount = {{ $totalBatal }}; activeLabel = 'Pesanan Dibatalkan'"
                                    @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'" />
                            @endif
                        </svg>

                        <!-- Pusat Donut -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
                            <span class="text-2xl font-extrabold text-slate-900 tabular-nums" x-text="activeCount"></span>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider" x-text="activeStatus"></span>
                        </div>
                    </div>
                </div>

                <!-- Legend Interaktif -->
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-100 text-center">
                    <div class="p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer transition"
                         @mouseenter="activeStatus = 'Selesai'; activeCount = {{ $totalSelesai }}; activeLabel = 'Siap Diambil'"
                         @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'">
                        <div class="flex items-center justify-center gap-1 text-[10px] font-bold text-emerald-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai
                        </div>
                        <div class="text-xs font-extrabold text-slate-800 mt-0.5">{{ $totalSelesai }}</div>
                    </div>

                    <div class="p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer transition"
                         @mouseenter="activeStatus = 'Proses'; activeCount = {{ $totalProses }}; activeLabel = 'Dalam Pengerjaan'"
                         @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'">
                        <div class="flex items-center justify-center gap-1 text-[10px] font-bold text-amber-700">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Proses
                        </div>
                        <div class="text-xs font-extrabold text-slate-800 mt-0.5">{{ $totalProses }}</div>
                    </div>

                    <div class="p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer transition"
                         @mouseenter="activeStatus = 'Batal'; activeCount = {{ $totalBatal }}; activeLabel = 'Order Dibatalkan'"
                         @mouseleave="activeStatus = 'Semua'; activeCount = {{ $totalOrders }}; activeLabel = 'Total Pesanan'">
                        <div class="flex items-center justify-center gap-1 text-[10px] font-bold text-rose-700">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Batal
                        </div>
                        <div class="text-xs font-extrabold text-slate-800 mt-0.5">{{ $totalBatal }}</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABEL REKAP TRANSAKSI (Fokus & Bebas Elemen Menumpuk) -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
            <!-- Toolbar Pencarian & Filter -->
            <div class="p-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/60">
                <div class="relative w-full sm:w-80">
                    <input type="text" 
                           id="searchInput" 
                           onkeyup="filterTable()" 
                           placeholder="Cari pelanggan / nomor WhatsApp / ID..." 
                           class="w-full text-xs pl-9 pr-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 bg-white shadow-xs">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-slate-500">Status:</span>
                    <div class="relative inline-block">
                        <select id="statusFilter" onchange="filterTable()" class="appearance-none text-xs py-1.5 pl-3.5 pr-9 rounded-lg border border-slate-300 bg-white font-medium text-slate-700 focus:outline-none focus:ring-1 focus:ring-blue-600 shadow-xs cursor-pointer">
                            <option value="all">Semua Status</option>
                            <option value="proses">Dalam Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="batal">Batal</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontainer Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="ordersTable">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3 px-4">No. Order</th>
                            <th class="py-3 px-4">Pelanggan</th>
                            <th class="py-3 px-4">Rincian Layanan Cucian</th>
                            <th class="py-3 px-4 text-right">Total Biaya</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center">Ubah Status</th>
                            <th class="py-3 px-4 text-center">Aksi / Cetak</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition order-row"
                                data-customer="{{ strtolower($order->customer_name) }}"
                                data-phone="{{ strtolower($order->phone_number) }}"
                                data-id="{{ $order->id }}"
                                data-status="{{ strtolower($order->status) }}">
                                
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <div class="font-bold text-slate-900 font-mono text-xs">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}</div>
                                </td>

                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-900 text-xs sm:text-sm">{{ $order->customer_name }}</div>
                                    <div class="text-xs text-slate-500 font-mono mt-0.5">{{ $order->phone_number }}</div>
                                </td>

                                <td class="py-3.5 px-4">
                                    <div class="space-y-1">
                                        @foreach($order->orderDetails as $detail)
                                            <div class="text-xs flex items-center gap-2">
                                                <span class="font-medium text-slate-800">{{ $detail->laundryItem->name ?? 'Layanan' }}</span>
                                                <span class="text-slate-300">&bull;</span>
                                                <span class="text-slate-600 font-semibold">{{ $detail->quantity }} kg/pcs</span>
                                                <span class="text-slate-400 tabular-nums">(@ Rp {{ number_format($detail->price, 0, ',', '.') }})</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="font-bold text-slate-900 tabular-nums">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    @if(strtolower($order->status) === 'proses')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Proses
                                        </span>
                                    @elseif(strtolower($order->status) === 'selesai')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Batal
                                        </span>
                                    @endif
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="relative inline-block">
                                            <select name="status" onchange="this.form.submit()" class="appearance-none text-xs py-1.5 pl-3.5 pr-9 rounded-lg border border-slate-300 bg-white font-semibold text-slate-700 hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer shadow-2xs transition">
                                                <option value="Proses" {{ $order->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ $order->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="Batal" {{ $order->status === 'Batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </form>
                                </td>

                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5">
                                        <!-- Tombol Cetak Struk Langsung -->
                                        <a href="{{ route('orders.cetak', $order->id) }}" 
                                           target="_blank" 
                                           title="Cetak Struk Transaksi" 
                                           class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-md text-xs font-semibold shadow-2xs transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            <span>Cetak</span>
                                        </a>

                                        <!-- Tombol Edit Modal -->
                                        <button type="button"
                                            onclick="openEditModal({{ json_encode([
                                                'id' => $order->id,
                                                'customer_name' => $order->customer_name,
                                                'phone_number' => $order->phone_number,
                                                'status' => $order->status,
                                                'items' => $order->orderDetails->pluck('quantity', 'laundry_item_id')
                                            ]) }})"
                                            title="Edit Transaksi"
                                            class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-md border border-slate-200 transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi #{{ $order->id }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Transaksi" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-md border border-transparent hover:border-rose-200 transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="max-w-xs mx-auto">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-700 text-sm">Belum ada transaksi</p>
                                        <p class="text-xs text-slate-400 mt-1">Gunakan tombol "Tambah Transaksi Baru" untuk mencatat order laundry pelanggan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- MODAL 1: TAMBAH TRANSAKSI BARU (DENGAN FOTO LAYANAN & STEPPER BERAT) -->
    <div id="createModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-xs overflow-y-auto">
        <div class="min-h-screen px-4 flex items-center justify-center py-8">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl border border-slate-200 relative">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Tambah Transaksi Baru</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Input data pelanggan dan pilih layanan cucian.</p>
                    </div>
                    <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-slate-700 p-1 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form Tambah -->
                <form action="{{ route('orders.store') }}" method="POST" id="createForm" class="mt-4 space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Pelanggan *</label>
                            <input type="text" name="customer_name" required placeholder="Contoh: Budi Santoso" class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="text" name="phone_number" required placeholder="Contoh: 081234567890" class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status Pengerjaan Awal</label>
                        <select name="status" class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none bg-white">
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <!-- Pilih Layanan & Input Berat Lengkap dengan Foto Layanan -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Pilih Layanan & Berat/Jumlah *</label>
                        <div class="space-y-2 border border-slate-200 rounded-xl p-3 max-h-64 overflow-y-auto bg-slate-50/50">
                            @foreach($laundry_items as $item)
                                <div class="flex items-center justify-between gap-3 bg-white p-2.5 rounded-lg border border-slate-200 hover:border-slate-300 transition">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <!-- Foto Thumbnail Layanan -->
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-200 shrink-0">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">
                                                LR
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <div class="text-xs font-bold text-slate-900 truncate">{{ $item->name }}</div>
                                            <div class="text-[11px] text-slate-500">
                                                <span class="inline-block px-1.5 py-0.2 rounded text-[10px] bg-slate-100 text-slate-600 font-semibold">{{ $item->category }}</span>
                                                &bull; Rp {{ number_format($item->price, 0, ',', '.') }}/kg
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stepper Input Qty -->
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <button type="button" 
                                                onclick="adjustQty('create_qty_{{ $item->id }}', -1); calcTotal('create');"
                                                class="w-7 h-7 rounded border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center transition">
                                            -
                                        </button>
                                        <input type="number"
                                            id="create_qty_{{ $item->id }}"
                                            name="items[{{ $item->id }}]"
                                            min="0"
                                            value="0"
                                            data-price="{{ $item->price }}"
                                            oninput="calcTotal('create')"
                                            class="create-item-qty w-14 text-xs text-center font-bold rounded border border-slate-300 py-1 focus:ring-1 focus:ring-blue-600 outline-none">
                                        <button type="button" 
                                                onclick="adjustQty('create_qty_{{ $item->id }}', 1); calcTotal('create');"
                                                class="w-7 h-7 rounded border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center transition">
                                            +
                                        </button>
                                        <span class="text-xs text-slate-400">kg</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ringkasan Total Live -->
                    <div class="p-3.5 bg-blue-50/70 border border-blue-200/80 rounded-xl flex items-center justify-between text-xs font-bold text-slate-900">
                        <span>Total Biaya Transaksi:</span>
                        <span id="createGrandTotal" class="text-base font-extrabold text-blue-700 tabular-nums">Rp 0</span>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-lg text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white shadow-xs transition">
                            Simpan Transaksi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- MODAL 2: EDIT TRANSAKSI (DENGAN FOTO LAYANAN & STEPPER BERAT) -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-xs overflow-y-auto">
        <div class="min-h-screen px-4 flex items-center justify-center py-8">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl border border-slate-200 relative">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-900" id="editModalTitle">Edit Transaksi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Perbarui data pelanggan, layanan, atau status pengerjaan.</p>
                    </div>
                    <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-700 p-1 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form Edit -->
                <form action="" method="POST" id="editForm" class="mt-4 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Pelanggan *</label>
                            <input type="text" name="customer_name" id="edit_customer_name" required class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="text" name="phone_number" id="edit_phone_number" required class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status Pengerjaan</label>
                        <select name="status" id="edit_status" class="w-full text-xs rounded-lg border border-slate-300 px-3 py-2 focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none bg-white">
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>

                    <!-- Pilih Layanan & Input Berat -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Rincian Layanan & Berat/Jumlah *</label>
                        <div class="space-y-2 border border-slate-200 rounded-xl p-3 max-h-64 overflow-y-auto bg-slate-50/50">
                            @foreach($laundry_items as $item)
                                <div class="flex items-center justify-between gap-3 bg-white p-2.5 rounded-lg border border-slate-200 hover:border-slate-300 transition">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <!-- Foto Thumbnail Layanan -->
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-200 shrink-0">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">
                                                LR
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <div class="text-xs font-bold text-slate-900 truncate">{{ $item->name }}</div>
                                            <div class="text-[11px] text-slate-500">
                                                <span class="inline-block px-1.5 py-0.2 rounded text-[10px] bg-slate-100 text-slate-600 font-semibold">{{ $item->category }}</span>
                                                &bull; Rp {{ number_format($item->price, 0, ',', '.') }}/kg
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stepper Input Qty Edit -->
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <button type="button" 
                                                onclick="adjustQty('edit_item_{{ $item->id }}', -1); calcTotal('edit');"
                                                class="w-7 h-7 rounded border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center transition">
                                            -
                                        </button>
                                        <input type="number"
                                            name="items[{{ $item->id }}]"
                                            id="edit_item_{{ $item->id }}"
                                            min="0"
                                            value="0"
                                            data-price="{{ $item->price }}"
                                            oninput="calcTotal('edit')"
                                            class="edit-item-qty w-14 text-xs text-center font-bold rounded border border-slate-300 py-1 focus:ring-1 focus:ring-blue-600 outline-none">
                                        <button type="button" 
                                                onclick="adjustQty('edit_item_{{ $item->id }}', 1); calcTotal('edit');"
                                                class="w-7 h-7 rounded border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center transition">
                                            +
                                        </button>
                                        <span class="text-xs text-slate-400">kg</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ringkasan Total Live -->
                    <div class="p-3.5 bg-blue-50/70 border border-blue-200/80 rounded-xl flex items-center justify-between text-xs font-bold text-slate-900">
                        <span>Total Biaya Transaksi:</span>
                        <span id="editGrandTotal" class="text-base font-extrabold text-blue-700 tabular-nums">Rp 0</span>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-lg text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white shadow-xs transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK MODAL, FILTER, STEPPER & LIVE KALKULASI -->
    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            calcTotal('create');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function openEditModal(orderData) {
            document.getElementById('editModalTitle').textContent = 'Edit Transaksi #' + String(orderData.id).padStart(4, '0');
            document.getElementById('editForm').action = '/transaksi/' + orderData.id;
            document.getElementById('edit_customer_name').value = orderData.customer_name;
            document.getElementById('edit_phone_number').value = orderData.phone_number;
            document.getElementById('edit_status').value = orderData.status;

            // Reset all qty fields
            document.querySelectorAll('.edit-item-qty').forEach(input => {
                input.value = 0;
            });

            // Set existing qty
            if (orderData.items) {
                for (const [itemId, qty] of Object.entries(orderData.items)) {
                    const input = document.getElementById('edit_item_' + itemId);
                    if (input) {
                        input.value = qty;
                    }
                }
            }

            document.getElementById('editModal').classList.remove('hidden');
            calcTotal('edit');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Stepper tambah / kurang kuantitas
        function adjustQty(inputId, delta) {
            const input = document.getElementById(inputId);
            if (input) {
                let val = parseInt(input.value) || 0;
                val = Math.max(0, val + delta);
                input.value = val;
            }
        }

        // Hitung total harga transaksi secara langsung saat kuantitas berubah
        function calcTotal(type) {
            const inputs = document.querySelectorAll(`.${type}-item-qty`);
            let grandTotal = 0;
            inputs.forEach(input => {
                const qty = parseInt(input.value) || 0;
                const price = parseFloat(input.getAttribute('data-price')) || 0;
                grandTotal += qty * price;
            });
            const targetEl = document.getElementById(`${type}GrandTotal`);
            if (targetEl) {
                targetEl.textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            }
        }

        // Filter tabel pencarian dan status
        function filterTable() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.order-row');

            rows.forEach(row => {
                const customer = row.getAttribute('data-customer') || '';
                const phone = row.getAttribute('data-phone') || '';
                const id = row.getAttribute('data-id') || '';
                const status = row.getAttribute('data-status') || '';

                const matchesQuery = !query || customer.includes(query) || phone.includes(query) || id.includes(query);
                const matchesStatus = (statusFilter === 'all') || (status === statusFilter);

                row.style.display = (matchesQuery && matchesStatus) ? '' : 'none';
            });
        }

        // Tutup modal jika tombol Escape ditekan
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
            }
        });
    </script>
</x-app-layout>
