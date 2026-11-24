<nav class="bg-white border-b border-slate-200 sticky top-0 z-30">
    <!-- Desktop & Mobile Top Bar (No 3-line hamburger menu) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            <!-- Left: Animated Washing Machine Logo + Brand -->
            <div class="flex items-center gap-6 sm:gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 sm:gap-3 group focus:outline-none shrink-0">
                    <!-- Washing Machine Icon with Smooth Spinning Inner Drum Animation -->
                    <div class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-blue-700 via-blue-600 to-indigo-600 shadow-sm flex items-center justify-center p-1.5 shrink-0 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <!-- Machine Outer Housing -->
                            <rect x="3" y="2" width="18" height="20" rx="3.5" stroke="currentColor" stroke-width="1.8" fill="rgba(255,255,255,0.15)" />
                            <!-- Machine Control Line & Buttons -->
                            <line x1="3" y1="7" x2="21" y2="7" stroke="currentColor" stroke-width="1.4" />
                            <circle cx="6.5" cy="4.5" r="1" fill="currentColor" />
                            <circle cx="9.5" cy="4.5" r="1" fill="currentColor" />
                            <line x1="14" y1="4.5" x2="18.5" y2="4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                            <!-- Circular Door Rim -->
                            <circle cx="12" cy="14.5" r="5" stroke="currentColor" stroke-width="1.6" />
                            <!-- Spinning Inner Drum & Water Swirl (Smooth CSS Rotation) -->
                            <g class="animate-spin" style="transform-origin: 12px 14.5px; animation-duration: 3s;">
                                <circle cx="12" cy="14.5" r="3" stroke="currentColor" stroke-width="1" stroke-dasharray="2.5 1.5" />
                                <path d="M12 11.8C13.3 11.8 14.5 13 14.5 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                                <path d="M12 17.2C10.7 17.2 9.5 16 9.5 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                            </g>
                        </svg>
                    </div>

                    <!-- Brand Typography -->
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-900 tracking-tight text-sm sm:text-base leading-tight">Laundry Rey</span>
                        <span class="text-[9px] sm:text-[10px] font-semibold text-slate-400 tracking-wider uppercase leading-none mt-0.5">Sistem Kasir & Rekap</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <!-- Rekap Transaksi -->
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold transition {{ request()->routeIs('dashboard') || request()->routeIs('kasir.dashboard') || request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('dashboard') || request()->routeIs('kasir.dashboard') || request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <span>Rekap Transaksi</span>
                    </a>

                    <!-- Data Pelanggan -->
                    <a href="{{ route('customers.index') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold transition {{ request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('customers.*') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Data Pelanggan</span>
                    </a>

                    <!-- Master Data Layanan (Admin Only) -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('laundry_items.index') }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold transition {{ request()->routeIs('laundry_items.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('laundry_items.*') ? 'text-blue-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span>Master Layanan</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: Date & User Profile Dropdown (Directly visible, no hamburger icon) -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Date Pill (Hidden on mobile) -->
                <div class="hidden lg:inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 border border-slate-200/80 rounded-lg text-xs font-medium text-slate-600">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ date('d M Y') }}</span>
                </div>

                <!-- Role Badge -->
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                    {{ Auth::user()->role }}
                </span>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition">
                            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center font-bold text-[10px] shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-xs">
                            Pengaturan Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-xs text-rose-600 hover:text-rose-700 font-semibold">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>

        <!-- Mobile Navigation Tabs (Directly accessible under header on mobile, NO 3-line hamburger menu) -->
        <div class="flex md:hidden items-center gap-1.5 pb-2.5 overflow-x-auto border-t border-slate-100 pt-2 no-scrollbar">
            <!-- Rekap Transaksi -->
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition {{ request()->routeIs('dashboard') || request()->routeIs('kasir.dashboard') || request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-slate-600 bg-slate-50' }}">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span>Rekap</span>
            </a>

            <!-- Data Pelanggan -->
            <a href="{{ route('customers.index') }}" 
               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition {{ request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-slate-600 bg-slate-50' }}">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Pelanggan</span>
            </a>

            <!-- Master Data Layanan (Admin Only) -->
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('laundry_items.index') }}" 
                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition {{ request()->routeIs('laundry_items.*') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-slate-600 bg-slate-50' }}">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Layanan</span>
                </a>
            @endif
        </div>

    </div>
</nav>
