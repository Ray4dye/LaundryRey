<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laundry Rey — Sistem Operasional Laundry & Rekap Transaksi Modern</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-mono-code {
            font-family: 'JetBrains Mono', monospace;
        }
        .sapphire-canvas {
            background: radial-gradient(circle at 50% 0%, #0d2a6b 0%, #08173d 50%, #040c24 100%);
        }
        .grid-mesh {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.035) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.035) 1px, transparent 1px);
        }
        .hero-glow {
            background: radial-gradient(ellipse 600px 350px at 50% 20%, rgba(59, 130, 246, 0.25), transparent);
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-float {
            animation: floatSlow 6s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.8; }
        }
        .animate-glow {
            animation: pulseGlow 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="sapphire-canvas text-slate-100 min-h-screen antialiased selection:bg-blue-600 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Grid & Glows -->
    <div class="fixed inset-0 pointer-events-none grid-mesh z-0"></div>
    <div class="fixed top-0 left-0 right-0 h-[600px] hero-glow pointer-events-none z-0"></div>
    <div class="fixed top-[-150px] right-[-150px] w-[500px] h-[500px] rounded-full bg-blue-600/15 blur-[140px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[-150px] left-[-150px] w-[500px] h-[500px] rounded-full bg-indigo-600/15 blur-[140px] pointer-events-none z-0"></div>

    <!-- Navigation Bar -->
    <header class="relative z-30 pt-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <nav class="bg-white/10 backdrop-blur-xl border border-white/15 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.3)] rounded-full px-5 sm:px-7 py-3 flex items-center justify-between">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 p-0.5 shadow-md shadow-blue-500/30 group-hover:scale-105 transition-transform">
                    <div class="w-full h-full bg-[#071638] rounded-[10px] flex items-center justify-center text-white">
                        <svg class="w-5 h-5 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="4" />
                            <circle cx="12" cy="12" r="5" />
                            <path d="M12 9a3 3 0 0 1 3 3" />
                            <circle cx="6" cy="7" r="1" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <div>
                    <span class="font-extrabold text-white text-base tracking-tight">LAUNDRY REY</span>
                    <span class="hidden sm:inline-block text-[10px] font-bold text-blue-400 bg-blue-500/15 px-2 py-0.5 rounded-full ml-1.5 border border-blue-400/20">SISTEM RESMI</span>
                </div>
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex items-center gap-6 text-xs font-semibold text-slate-300">
                <a href="#fitur" class="hover:text-white transition">Fitur Utama</a>
                <a href="#layanan" class="hover:text-white transition">Kategori Layanan</a>
                <a href="#pratinjau" class="hover:text-white transition">Konsol Laundry Rey</a>
                <a href="#keunggulan" class="hover:text-white transition">Keandalan</a>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-xs font-bold bg-blue-600 hover:bg-blue-500 text-white shadow-md shadow-blue-600/30 transition transform hover:scale-105">
                        Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-xs font-bold text-white bg-white/10 hover:bg-white/20 border border-white/20 transition">
                        Masuk Petugas
                    </a>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-xs font-bold bg-blue-600 hover:bg-blue-500 text-white shadow-md shadow-blue-600/30 transition transform hover:scale-105">
                        Buka Aplikasi
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 pt-16 sm:pt-24 pb-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto text-center">
        <!-- Badge Pill -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/15 border border-blue-400/30 text-blue-300 text-xs font-semibold mb-6 shadow-sm backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-blue-400 animate-ping"></span>
            <span>SISTEM LAUNDRY REY • HIGH-PRECISION LAUNDRY PLATFORM</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] max-w-4xl mx-auto">
            Operasional Laundry Presisi.<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-sky-400">
                Pantau Real-Time, Rekap Sekali Klik.
            </span>
        </h1>

        <!-- Subtitle -->
        <p class="mt-6 text-sm sm:text-base text-slate-300/90 max-w-2xl mx-auto leading-relaxed font-normal">
            Sistem informasi operasional dan kasir terintegrasi. Entri kiloan instan, cetak struk termal 80mm dengan barcode presisi, serta pantauan performa mesin cuci harian dalam satu layar.
        </p>

        <!-- CTA Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3.5">
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-full bg-blue-600 hover:bg-blue-500 text-white text-xs sm:text-sm font-extrabold shadow-lg shadow-blue-600/35 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <span>Masuk ke Konsol Kasir</span>
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <a href="#fitur" class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/15 text-slate-200 hover:text-white text-xs sm:text-sm font-bold border border-white/15 transition backdrop-blur-sm">
                Pelajari Fitur Sistem
            </a>
        </div>

        <!-- Metric Badges Row -->
        <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-3xl mx-auto text-left">
            <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Durasi Kilat</div>
                <div class="text-lg font-black text-white mt-0.5">5 Jam Selesai</div>
                <div class="text-[10px] text-emerald-400 mt-0.5">Superkilat Ready</div>
            </div>
            <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Akurasi Timbangan</div>
                <div class="text-lg font-black text-white mt-0.5">100% Presisi</div>
                <div class="text-[10px] text-blue-400 mt-0.5">Kalkulasi Otomatis</div>
            </div>
            <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Kecepatan Struk</div>
                <div class="text-lg font-black text-white mt-0.5">&lt; 1 Detik</div>
                <div class="text-[10px] text-indigo-400 mt-0.5">Thermal Barcode 80mm</div>
            </div>
            <div class="p-3.5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Efisiensi Mesin</div>
                <div class="text-lg font-black text-white mt-0.5">98.2% Uptime</div>
                <div class="text-[10px] text-emerald-400 mt-0.5">Pantauan Utilisasi</div>
            </div>
        </div>
    </section>

    <!-- Live Interactive / Laundry Rey Dashboard Preview Graphic -->
    <section id="pratinjau" class="relative z-20 py-10 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="text-center mb-6">
            <span class="text-[11px] font-bold text-blue-400 uppercase tracking-widest">Tampilan Antarmuka Asli</span>
            <h2 class="text-xl sm:text-2xl font-extrabold text-white mt-1">Konsol Operasional Laundry Rey Terpadu</h2>
        </div>

        <!-- Master Floating Card Graphic Frame -->
        <div class="rounded-[2.2rem] bg-white border border-white/70 shadow-[0_30px_90px_-20px_rgba(0,10,50,0.7)] p-4 sm:p-6 text-slate-800 overflow-hidden transform transition-all duration-500 hover:scale-[1.01]">
            
            <!-- Window Bar -->
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                    <span class="ml-2 text-xs font-bold text-slate-700 font-mono-code">app.laundryrey.local/transaksi</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-semibold text-slate-500">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                        ● Sistem Aktif
                    </span>
                    <span class="hidden sm:inline">Kasir Shift: Pagi</span>
                </div>
            </div>

            <!-- Dashboard Metric Row Graphic -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-5">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                    <div class="text-[10px] font-bold text-slate-400 uppercase">Total Transaksi</div>
                    <div class="text-base font-extrabold text-slate-900 mt-0.5">142 Order</div>
                    <div class="text-[9px] text-emerald-600 font-semibold mt-0.5">▲ +12.5% bln ini</div>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                    <div class="text-[10px] font-bold text-slate-400 uppercase">Efisiensi</div>
                    <div class="text-base font-extrabold text-blue-600 mt-0.5">94.8%</div>
                    <div class="text-[9px] text-blue-600 font-semibold mt-0.5">Target tercapai</div>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                    <div class="text-[10px] font-bold text-slate-400 uppercase">Dalam Proses</div>
                    <div class="text-base font-extrabold text-amber-600 mt-0.5">18 Antrean</div>
                    <div class="text-[9px] text-amber-600 font-semibold mt-0.5">12 kg Superkilat</div>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                    <div class="text-[10px] font-bold text-slate-400 uppercase">Omset Masuk</div>
                    <div class="text-base font-extrabold text-slate-900 mt-0.5">Rp 3.840.000</div>
                    <div class="text-[9px] text-emerald-600 font-semibold mt-0.5">▲ Kas hari ini</div>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 col-span-2 md:col-span-1">
                    <div class="text-[10px] font-bold text-slate-400 uppercase">Performa Mesin</div>
                    <div class="text-base font-extrabold text-emerald-600 mt-0.5">98.2% Uptime</div>
                    <div class="text-[9px] text-slate-500 font-semibold mt-0.5">6/6 Mesin Operasi</div>
                </div>
            </div>

            <!-- Simulated 3D Isometric Columns Graphic & Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-5">
                <!-- 3D Columns Output Graph -->
                <div class="lg:col-span-2 p-4 rounded-xl bg-slate-50/70 border border-slate-200/80">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <span class="text-xs font-bold text-slate-800">Volume Output Produksi Harian</span>
                            <span class="text-[10px] text-slate-400 block">Kapasitas pencucian 6 mesin cuci industri</span>
                        </div>
                        <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-lg border border-blue-200">Minggu 3 Puncak (1,480 kg)</span>
                    </div>

                    <!-- SVG 3D Isometric Columns -->
                    <div class="w-full h-44 flex items-end justify-between px-3 pt-4">
                        <!-- Column 1 -->
                        <div class="flex flex-col items-center gap-1.5 flex-1">
                            <svg class="w-12 h-28" viewBox="0 0 60 140" fill="none">
                                <path d="M30 10 L55 22 L55 120 L30 132 L5 120 L5 22 Z" fill="#e2e8f0" />
                                <path d="M30 10 L55 22 L30 34 L5 22 Z" fill="#cbd5e1" />
                                <path d="M30 34 L55 22 L55 120 L30 132 Z" fill="#94a3b8" />
                            </svg>
                            <span class="text-[9px] font-semibold text-slate-500">Mgg 1</span>
                        </div>
                        <!-- Column 2 -->
                        <div class="flex flex-col items-center gap-1.5 flex-1">
                            <svg class="w-12 h-32" viewBox="0 0 60 160" fill="none">
                                <path d="M30 10 L55 22 L55 140 L30 152 L5 140 L5 22 Z" fill="#e2e8f0" />
                                <path d="M30 10 L55 22 L30 34 L5 22 Z" fill="#cbd5e1" />
                                <path d="M30 34 L55 22 L55 140 L30 152 Z" fill="#94a3b8" />
                            </svg>
                            <span class="text-[9px] font-semibold text-slate-500">Mgg 2</span>
                        </div>
                        <!-- Column 3 - Featured Electric Blue 3D Prism -->
                        <div class="flex flex-col items-center gap-1.5 flex-1">
                            <svg class="w-14 h-40 transform hover:scale-105 transition-transform" viewBox="0 0 60 190" fill="none">
                                <path d="M30 8 L55 20 L55 170 L30 182 L5 170 L5 20 Z" fill="#2563eb" />
                                <path d="M30 8 L55 20 L30 32 L5 20 Z" fill="#60a5fa" />
                                <path d="M30 32 L55 20 L55 170 L30 182 Z" fill="#1d4ed8" />
                            </svg>
                            <span class="text-[9px] font-extrabold text-blue-600">Mgg 3 (Puncak)</span>
                        </div>
                        <!-- Column 4 -->
                        <div class="flex flex-col items-center gap-1.5 flex-1">
                            <svg class="w-12 h-32" viewBox="0 0 60 160" fill="none">
                                <path d="M30 10 L55 22 L55 140 L30 152 L5 140 L5 22 Z" fill="#e2e8f0" />
                                <path d="M30 10 L55 22 L30 34 L5 22 Z" fill="#cbd5e1" />
                                <path d="M30 34 L55 22 L55 140 L30 152 Z" fill="#94a3b8" />
                            </svg>
                            <span class="text-[9px] font-semibold text-slate-500">Mgg 4</span>
                        </div>
                        <!-- Column 5 -->
                        <div class="flex flex-col items-center gap-1.5 flex-1">
                            <svg class="w-12 h-36" viewBox="0 0 60 175" fill="none">
                                <path d="M30 10 L55 22 L55 155 L30 167 L5 155 L5 22 Z" fill="#e2e8f0" />
                                <path d="M30 10 L55 22 L30 34 L5 22 Z" fill="#cbd5e1" />
                                <path d="M30 34 L55 22 L55 155 L30 167 Z" fill="#94a3b8" />
                            </svg>
                            <span class="text-[9px] font-semibold text-slate-500">Mgg 5</span>
                        </div>
                    </div>
                </div>

                <!-- Right Speedometer & Donut Graphic -->
                <div class="p-4 rounded-xl bg-slate-50/70 border border-slate-200/80 flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-800">Efisiensi Siklus & Distribusi</span>
                        <div class="text-[10px] text-slate-400 mt-0.5">Proporsi layanan aktif</div>
                    </div>
                    
                    <!-- Speedometer SVG -->
                    <div class="py-3 flex flex-col items-center justify-center">
                        <svg class="w-32 h-20" viewBox="0 0 160 100">
                            <path d="M 20 85 A 60 60 0 0 1 140 85" fill="none" stroke="#e2e8f0" stroke-width="14" stroke-linecap="round" />
                            <path d="M 20 85 A 60 60 0 0 1 132 55" fill="none" stroke="#2563eb" stroke-width="14" stroke-linecap="round" />
                        </svg>
                        <div class="text-center -mt-8">
                            <div class="text-lg font-black text-slate-900">94.8%</div>
                            <div class="text-[9px] font-bold text-emerald-600">Sangat Optimal</div>
                        </div>
                    </div>

                    <!-- Categories breakdown -->
                    <div class="space-y-1.5 text-[10px] pt-2 border-t border-slate-200/80">
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-slate-600">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Superkilat (5 jam)
                            </span>
                            <span class="font-bold text-slate-800">32%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-slate-600">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Ekspres (1-2 hari)
                            </span>
                            <span class="font-bold text-slate-800">45%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5 text-slate-600">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                Reguler (3-4 hari)
                            </span>
                            <span class="font-bold text-slate-800">23%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simulated Rekap Table Graphic -->
            <div class="border border-slate-200/90 rounded-xl overflow-hidden">
                <div class="bg-slate-100/80 px-4 py-2.5 flex items-center justify-between text-xs font-bold text-slate-700">
                    <span>Rekap Transaksi Terkini</span>
                    <span class="text-[10px] font-normal text-slate-500">Menampilkan antrean aktif</span>
                </div>
                <div class="divide-y divide-slate-100 text-[11px]">
                    <div class="p-3 flex items-center justify-between bg-white hover:bg-slate-50">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">#01</span>
                            <div>
                                <div class="font-bold text-slate-900">Ibu Dian Ayu</div>
                                <div class="text-[10px] text-slate-400">Cuci Komplit Kilat • 4.5 kg</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-slate-900">Rp 54.000</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">Proses</span>
                        </div>
                    </div>
                    <div class="p-3 flex items-center justify-between bg-white hover:bg-slate-50">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-xs">#02</span>
                            <div>
                                <div class="font-bold text-slate-900">Bapak Hendra Wijaya</div>
                                <div class="text-[10px] text-slate-400">Bed Cover & Selimut • 8.0 kg</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-slate-900">Rp 96.000</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="relative z-10 py-20 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="text-center mb-14">
            <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Fitur Unggulan</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mt-2">Didesain Khusus untuk Operasional Kasir Cepat</h2>
            <p class="text-sm text-slate-300 mt-2 max-w-xl mx-auto">Semua alur kerja dirancang untuk meminimalkan waktu input dan mencegah kehilangan data transaksi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="p-7 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-xl hover:bg-white/[0.08] transition duration-200">
                <div class="w-12 h-12 rounded-2xl bg-blue-600/30 border border-blue-400/40 flex items-center justify-center text-blue-400 text-xl mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Entri 1 Halaman Cepat</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Kasir dapat menambah order baru, mengedit rincian kiloan, memperbarui status pengerjaan, dan mencetak nota langsung dalam satu layar rekap transaksi tanpa bolak-balik halaman.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="p-7 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-xl hover:bg-white/[0.08] transition duration-200">
                <div class="w-12 h-12 rounded-2xl bg-emerald-600/30 border border-emerald-400/40 flex items-center justify-center text-emerald-400 text-xl mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Struk Thermal 80mm Barcode</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Struk thermal siap cetak dengan barcode standar POS, identitas cabang, kontak WhatsApp, serta kode verifikasi hash untuk mencegah duplikasi nota fisik.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="p-7 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-xl hover:bg-white/[0.08] transition duration-200">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600/30 border border-indigo-400/40 flex items-center justify-center text-indigo-400 text-xl mb-5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Master Tarif Dinamis</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Admin memiliki kendali penuh atas master paket layanan. Atur tarif per kg untuk paket Reguler, Ekspres, hingga Superkilat lengkap dengan upload foto katalog.
                </p>
            </div>
        </div>
    </section>

    <!-- Services / Pricing Section -->
    <section id="layanan" class="relative z-10 py-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Kategori Layanan</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mt-2">Pilihan Paket Durasi Fleksibel</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="p-7 rounded-3xl bg-white/5 border border-white/10 flex flex-col justify-between">
                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-[11px] font-bold bg-blue-500/20 text-blue-300 border border-blue-400/30 mb-4">
                        Reguler
                    </div>
                    <h3 class="text-xl font-bold text-white">Cuci Reguler Bersih</h3>
                    <div class="text-2xl font-black text-white mt-3">Rp 7.000 <span class="text-xs font-normal text-slate-400">/ kg</span></div>
                    <p class="text-xs text-slate-300 mt-2">Estimasi selesai 3-4 hari kerja. Cucian wangi, rapi, dan disetrika uap.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-white/10 text-xs text-slate-400">
                    ✓ Deterjen Antibakteri • Setrika Uap
                </div>
            </div>

            <!-- Card 2 (Featured) -->
            <div class="p-7 rounded-3xl bg-gradient-to-b from-blue-900/60 to-indigo-950/80 border-2 border-blue-400/50 relative shadow-2xl flex flex-col justify-between">
                <span class="absolute -top-3 right-6 px-3 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-500 text-white uppercase tracking-wider shadow">Paling Laris</span>
                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-300 border border-amber-400/30 mb-4">
                        Ekspres Prioritas
                    </div>
                    <h3 class="text-xl font-bold text-white">Cuci Ekspres 1-2 Hari</h3>
                    <div class="text-2xl font-black text-white mt-3">Rp 12.000 <span class="text-xs font-normal text-slate-400">/ kg</span></div>
                    <p class="text-xs text-slate-300 mt-2">Selesai dalam 24-48 jam. Prioritas mesin cuci dan pengering mandiri.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-white/10 text-xs text-slate-300">
                    ✓ Parfum Grade A • Packaging Kedap Udara
                </div>
            </div>

            <!-- Card 3 -->
            <div class="p-7 rounded-3xl bg-white/5 border border-white/10 flex flex-col justify-between">
                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-[11px] font-bold bg-rose-500/20 text-rose-300 border border-rose-400/30 mb-4">
                        Superkilat 5 Jam
                    </div>
                    <h3 class="text-xl font-bold text-white">Cuci Kilat Darurat</h3>
                    <div class="text-2xl font-black text-white mt-3">Rp 20.000 <span class="text-xs font-normal text-slate-400">/ kg</span></div>
                    <p class="text-xs text-slate-300 mt-2">Selesai dalam 5 jam. Khusus pakaian dinas, traveling, atau kebutuhan mendesak.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-white/10 text-xs text-slate-400">
                    ✓ Antrean Jalur Khusus • Siap Antar Jemput
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10 py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-blue-600 text-white font-black flex items-center justify-center text-sm">LR</span>
                <div>
                    <div class="font-extrabold text-white text-sm">LAUNDRY REY</div>
                    <div class="text-[11px] text-slate-400">Sistem Operasional & Rekap Transaksi Kasir</div>
                </div>
            </div>
            <div class="flex items-center gap-6 text-xs text-slate-400">
                <a href="{{ route('login') }}" class="hover:text-white transition">Masuk Kasir</a>
                <a href="{{ route('login') }}" class="hover:text-white transition">Masuk Admin</a>
                <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
            </div>
            <div class="text-xs text-slate-500">
                &copy; {{ date('Y') }} Laundry Rey. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>
