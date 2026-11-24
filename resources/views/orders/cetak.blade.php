<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }} - LAUNDRY REY</title>
    
    <!-- Fonts: Plus Jakarta Sans & JetBrains Mono for crisp receipt typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .font-sans-title {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .receipt-container {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                max-width: 80mm !important;
                margin: 0 auto !important;
                padding: 2mm !important;
            }
            @page {
                size: 80mm auto;
                margin: 0;
            }
        }
        .barcode-strip {
            display: flex;
            align-items: stretch;
            justify-content: center;
            height: 38px;
            gap: 1.5px;
        }
        .b-bar {
            background-color: #0f172a;
            border-radius: 0.5px;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 px-4 flex flex-col items-center justify-start font-mono text-slate-900 antialiased selection:bg-blue-200">

    <!-- Action Toolbar (Hidden when printing) -->
    <div class="no-print mb-6 flex flex-wrap items-center justify-center gap-2.5 max-w-sm w-full bg-white/90 backdrop-blur-md p-2.5 rounded-2xl border border-slate-200 shadow-sm">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold font-sans-title transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Rekap Transaksi
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold font-sans-title shadow-md shadow-slate-900/15 hover:shadow-lg transition transform active:scale-95">
            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Struk (80mm)
        </button>
    </div>

    <!-- Thermal Receipt Card -->
    <div class="receipt-container bg-white w-full max-w-[360px] rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200 p-6 text-[11px] leading-relaxed text-slate-900 relative">
        
        <!-- Header -->
        <div class="text-center pb-3 border-b-2 border-dashed border-slate-300">
            <div class="flex items-center justify-center gap-1.5 mb-1">
                <span class="w-6 h-6 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-xs font-sans-title">LR</span>
                <span class="font-extrabold text-base tracking-widest font-sans-title uppercase text-slate-950">LAUNDRY REY</span>
            </div>
            <div class="text-[10px] font-semibold text-slate-600 tracking-wider uppercase">Sistem Operasional Laundry Presisi</div>
            <div class="text-[10px] text-slate-500 mt-0.5">Jl. Pelajar No. 06 &bull; WA: 0812-3456-7890</div>
            <div class="text-[9px] text-slate-400 mt-0.5">NPWP: 89.231.402.1-402.000 &bull; Cabang Utama</div>
        </div>

        <!-- Simulated Barcode Header -->
        <div class="py-2.5 border-b-2 border-dashed border-slate-300 text-center">
            <div class="barcode-strip my-1">
                <span class="b-bar w-1"></span><span class="b-bar w-0.5"></span><span class="b-bar w-1.5"></span>
                <span class="b-bar w-0.5"></span><span class="b-bar w-2"></span><span class="b-bar w-1"></span>
                <span class="b-bar w-0.5"></span><span class="b-bar w-1.5"></span><span class="b-bar w-0.5"></span>
                <span class="b-bar w-2"></span><span class="b-bar w-1"></span><span class="b-bar w-0.5"></span>
                <span class="b-bar w-1"></span><span class="b-bar w-2"></span><span class="b-bar w-0.5"></span>
                <span class="b-bar w-1.5"></span><span class="b-bar w-1"></span><span class="b-bar w-0.5"></span>
                <span class="b-bar w-2"></span><span class="b-bar w-0.5"></span><span class="b-bar w-1"></span>
                <span class="b-bar w-1.5"></span><span class="b-bar w-0.5"></span><span class="b-bar w-2"></span>
                <span class="b-bar w-1"></span><span class="b-bar w-0.5"></span><span class="b-bar w-1.5"></span>
                <span class="b-bar w-2"></span><span class="b-bar w-0.5"></span><span class="b-bar w-1"></span>
                <span class="b-bar w-0.5"></span><span class="b-bar w-1.5"></span><span class="b-bar w-2"></span>
                <span class="b-bar w-1"></span><span class="b-bar w-0.5"></span><span class="b-bar w-1.5"></span>
            </div>
            <div class="text-[10px] font-bold tracking-wider text-slate-600">
                *REY-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}*
            </div>
        </div>

        <!-- Order Meta -->
        <div class="py-3 border-b-2 border-dashed border-slate-300 space-y-1 text-[11px]">
            <div class="flex justify-between">
                <span class="text-slate-500">No. Nota</span>
                <span class="font-bold text-slate-950">#REY-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Waktu Masuk</span>
                <span class="tabular-nums font-medium">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Pelanggan</span>
                <span class="font-bold text-slate-950">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">No. Telp / WA</span>
                <span class="tabular-nums font-semibold">{{ $order->phone_number }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-500">Petugas Kasir</span>
                <span>{{ Auth::user()->name ?? 'Petugas Kasir' }}</span>
            </div>
            <div class="flex justify-between items-center pt-1">
                <span class="text-slate-500">Status Pengerjaan</span>
                <span class="font-extrabold uppercase text-[10px] px-2 py-0.5 rounded border {{ strtolower($order->status) === 'selesai' ? 'bg-emerald-50 text-emerald-800 border-emerald-300' : (strtolower($order->status) === 'batal' ? 'bg-rose-50 text-rose-800 border-rose-300' : 'bg-blue-50 text-blue-800 border-blue-300') }}">
                    ● {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Items Table -->
        <div class="py-3 border-b-2 border-dashed border-slate-300">
            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2 flex justify-between">
                <span>Rincian Layanan</span>
                <span>Tarif & Qty</span>
            </div>
            <table class="w-full text-left text-[11px]">
                <thead>
                    <tr class="border-b border-slate-200 text-slate-500 text-[10px]">
                        <th class="pb-1 font-semibold">Layanan</th>
                        <th class="pb-1 text-center font-semibold">Qty</th>
                        <th class="pb-1 text-right font-semibold">Tarif</th>
                        <th class="pb-1 text-right font-semibold">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td class="py-1.5 pr-1">
                                <div class="font-bold text-slate-900">{{ $detail->laundryItem->name ?? 'Layanan' }}</div>
                                <div class="text-[9px] text-slate-400 uppercase tracking-tight">{{ $detail->laundryItem->category ?? '-' }}</div>
                            </td>
                            <td class="py-1.5 text-center text-slate-700 whitespace-nowrap tabular-nums font-medium">{{ $detail->quantity }} kg</td>
                            <td class="py-1.5 text-right tabular-nums text-slate-500 text-[10px]">{{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="py-1.5 text-right tabular-nums font-bold text-slate-900">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Breakdown Calculation -->
        <div class="py-3 border-b-2 border-dashed border-slate-300 space-y-1.5">
            <div class="flex justify-between text-slate-600">
                <span>Subtotal Jasa</span>
                <span class="tabular-nums">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-slate-500 text-[10px]">
                <span>PPN (0% UMKM)</span>
                <span class="tabular-nums">Rp 0</span>
            </div>
            <div class="flex justify-between text-slate-500 text-[10px]">
                <span>Diskon Paket</span>
                <span class="tabular-nums">Rp 0</span>
            </div>
            <div class="pt-1.5 border-t border-slate-200 flex justify-between items-center text-sm font-extrabold text-slate-950 font-sans-title">
                <span>TOTAL PEMBAYARAN</span>
                <span class="tabular-nums text-base">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-[10px] text-slate-500 pt-0.5">
                <span>Metode Pembayaran</span>
                <span class="font-bold text-slate-800 uppercase">LUNAS / KASIR CASH</span>
            </div>
        </div>

        <!-- Security Stamp & Verification -->
        <div class="py-3 border-b-2 border-dashed border-slate-300 text-center">
            <div class="text-[9px] text-slate-400">Kode Verifikasi Keaslian Struk:</div>
            <div class="font-bold text-[10px] tracking-widest text-slate-700 uppercase mt-0.5 font-mono">
                SEC-{{ strtoupper(substr(md5($order->id . $order->customer_name . $order->created_at), 0, 10)) }}
            </div>
        </div>

        <!-- Footer Notice -->
        <div class="pt-3 text-center text-[10px] text-slate-500 space-y-1">
            <div class="font-bold text-slate-900 font-sans-title uppercase tracking-wider">TERIMA KASIH ATAS KUNJUNGAN ANDA</div>
            <div class="text-[9px] text-slate-400 leading-tight">
                1. Struk fisik ini adalah bukti sah serah terima cucian.<br>
                2. Kerusakan/luntur wajib klaim dalam 1x24 jam.<br>
                3. Cucian tidak diambil lebih dari 30 hari di luar jaminan kami.
            </div>
            <div class="text-[8px] text-slate-400 pt-1 border-t border-slate-100 font-mono">
                Dicetak pada: {{ date('d/m/Y H:i:s') }} &bull; Laundry Rey POS System
            </div>
        </div>

    </div>

</body>
</html>
