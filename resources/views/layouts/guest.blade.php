@props(['raw' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laundry Rey') }} - Operasional Presisi</title>

        <!-- Fonts: Plus Jakarta Sans for ultra-crisp modern aesthetic -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            }
            .sapphire-canvas {
                background: linear-gradient(135deg, #071739 0%, #0d2766 45%, #091c47 100%);
            }
            .grid-mesh {
                background-size: 32px 32px;
                background-image: 
                    linear-gradient(to right, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            }
        </style>
    </head>
    <body class="min-h-full sapphire-canvas text-slate-800 antialiased relative overflow-x-hidden selection:bg-blue-500 selection:text-white">
        <!-- Background Lighting Glows -->
        <div class="fixed inset-0 pointer-events-none grid-mesh z-0"></div>
        <div class="fixed top-[-10%] left-[20%] w-[500px] h-[500px] rounded-full bg-blue-600/20 blur-[130px] pointer-events-none"></div>
        <div class="fixed bottom-[-10%] right-[15%] w-[600px] h-[600px] rounded-full bg-indigo-600/15 blur-[150px] pointer-events-none"></div>

        <div class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
            @if($raw)
                {{ $slot }}
            @else
                <!-- Brand Mark Header (Standard Guest Layout) -->
                <div class="mb-6 text-center">
                    <a href="/" class="inline-flex items-center gap-3 group focus:outline-none">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 p-0.5 shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <div class="w-full h-full bg-[#081b44] rounded-[14px] flex items-center justify-center text-white p-2">
                                <svg class="w-full h-full text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <rect x="3" y="2" width="18" height="20" rx="3.5" stroke="currentColor" stroke-width="1.8" />
                                    <line x1="3" y1="7" x2="21" y2="7" stroke="currentColor" stroke-width="1.4" />
                                    <circle cx="6.5" cy="4.5" r="1" fill="currentColor" />
                                    <circle cx="9.5" cy="4.5" r="1" fill="currentColor" />
                                    <circle cx="12" cy="14.5" r="5" stroke="currentColor" stroke-width="1.6" />
                                    <g class="animate-spin" style="transform-origin: 12px 14.5px; animation-duration: 3s;">
                                        <circle cx="12" cy="14.5" r="3" stroke="currentColor" stroke-width="1" stroke-dasharray="2.5 1.5" />
                                        <path d="M12 11.8C13.3 11.8 14.5 13 14.5 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="text-left">
                            <span class="text-xl font-extrabold text-white tracking-tight">LAUNDRY REY</span>
                            <p class="text-[11px] text-blue-200/60 font-medium">Enterprise Laundry Operations & Rekap System</p>
                        </div>
                    </a>
                </div>

                <!-- Master Floating Card Container -->
                <div class="w-full sm:max-w-md bg-white/95 backdrop-blur-xl border border-white/60 shadow-[0_25px_60px_-15px_rgba(0,18,60,0.5)] rounded-[2.2rem] p-7 sm:p-9 transition-all">
                    {{ $slot }}
                </div>
            @endif

            <!-- Footer Badge -->
            <div class="mt-8 text-center text-xs text-blue-200/50 flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4">
                <span>&copy; {{ date('Y') }} Laundry Rey. All rights reserved.</span>
                <span class="hidden sm:inline opacity-30">&bull;</span>
                <span class="inline-flex items-center gap-1.5 text-blue-300/70">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Operasional Stabil
                </span>
            </div>
        </div>
    </body>
</html>
