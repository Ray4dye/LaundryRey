<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laundry Rey') }} - Sistem Manajemen Transaksi</title>

        <!-- Premium Clean Fonts: Plus Jakarta Sans & Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50 min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">
        
        <!-- Navbar Atas Penuh (Clean Top Navigation, Full Width, Zero Clutter) -->
        @include('layouts.navigation')

        <!-- Area Judul Halaman -->
        @isset($header)
            <div class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Area Konten Utama (Full Width, Single Surface) -->
        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{ $slot }}
        </main>

        <!-- Footer Bersih -->
        <footer class="mt-auto border-t border-slate-200 bg-white py-4 px-4 sm:px-8 text-xs text-slate-500">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-800 tracking-tight">Laundry Rey</span>
                    <span class="text-slate-300">&bull;</span>
                    <span>Sistem Rekap Transaksi & Manajemen Layanan</span>
                </div>
                <div>
                    &copy; {{ date('Y') }} Laundry Rey &bull; Seluruh hak cipta dilindungi.
                </div>
            </div>
        </footer>

    </body>
</html>
