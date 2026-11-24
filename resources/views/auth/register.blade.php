<x-guest-layout :raw="true">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-[0_25px_70px_-15px_rgba(0,18,60,0.45)] border border-slate-100 p-6 sm:p-8 relative overflow-hidden transition-all my-auto">
        
        <!-- Header: Washing Machine with Spinning Drum Animation + Title (Vertical Stack) -->
        <div class="flex flex-col items-center text-center mb-6">
            <!-- Animated Washing Machine Badge -->
            <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-700 via-blue-600 to-indigo-600 p-2.5 shadow-lg shadow-blue-500/30 flex items-center justify-center mb-3 group hover:scale-105 transition-transform duration-300">
                <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="3" y="2" width="18" height="20" rx="3.5" stroke="currentColor" stroke-width="1.8" fill="rgba(255,255,255,0.15)" />
                    <line x1="3" y1="7" x2="21" y2="7" stroke="currentColor" stroke-width="1.4" />
                    <circle cx="6.5" cy="4.5" r="1" fill="currentColor" />
                    <circle cx="9.5" cy="4.5" r="1" fill="currentColor" />
                    <circle cx="12" cy="14.5" r="5" stroke="currentColor" stroke-width="1.6" />
                    <g class="animate-spin" style="transform-origin: 12px 14.5px; animation-duration: 3s;">
                        <circle cx="12" cy="14.5" r="3" stroke="currentColor" stroke-width="1" stroke-dasharray="2.5 1.5" />
                        <path d="M12 11.8C13.3 11.8 14.5 13 14.5 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                        <path d="M12 17.2C10.7 17.2 9.5 16 9.5 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                    </g>
                </svg>
            </div>
            
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Laundry Rey</h1>
            <p class="text-xs text-slate-500 mt-1 font-medium">Pendaftaran Akun Petugas Baru</p>
        </div>

        <!-- Session Status / Errors -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Registrasi Vertikal -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input id="name" 
                           class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 pl-10 pr-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name" 
                           placeholder="Nama lengkap petugas" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input id="email" 
                           class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 pl-10 pr-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username" 
                           placeholder="email@laundryrey.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
            </div>

            <!-- Peran Akun -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Peran Akun</label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="relative flex items-center p-2.5 border border-slate-200 rounded-xl cursor-pointer bg-slate-50/60 hover:bg-white has-checked:border-blue-600 has-checked:bg-blue-50/50 has-checked:ring-1 has-checked:ring-blue-600 transition">
                        <input type="radio" name="role" value="kasir" class="sr-only" checked>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <div>
                                <div class="text-xs font-bold text-slate-800 leading-tight">Kasir</div>
                                <div class="text-[10px] text-slate-400">Operasional</div>
                            </div>
                        </div>
                    </label>

                    <label class="relative flex items-center p-2.5 border border-slate-200 rounded-xl cursor-pointer bg-slate-50/60 hover:bg-white has-checked:border-indigo-600 has-checked:bg-indigo-50/50 has-checked:ring-1 has-checked:ring-indigo-600 transition">
                        <input type="radio" name="role" value="admin" class="sr-only">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            <div>
                                <div class="text-xs font-bold text-slate-800 leading-tight">Admin</div>
                                <div class="text-[10px] text-slate-400">Akses Penuh</div>
                            </div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" 
                           class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 pl-10 pr-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition"
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password" 
                           placeholder="Minimal 8 karakter" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <input id="password_confirmation" 
                           class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 pl-10 pr-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition"
                           type="password"
                           name="password_confirmation"
                           required 
                           autocomplete="new-password" 
                           placeholder="Ulangi kata sandi" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white text-xs font-bold rounded-xl shadow-md shadow-blue-500/25 transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                    <span>Daftar Akun Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Link ke Halaman Login -->
        <div class="mt-5 text-center">
            <p class="text-xs text-slate-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition">
                    Masuk di sini
                </a>
            </p>
        </div>

        <!-- Footer Card Note -->
        <div class="mt-6 pt-4 border-t border-slate-100 text-center">
            <p class="text-[11px] text-slate-400">
                Laundry Rey &bull; Sistem Kasir & Rekap Transaksi
            </p>
        </div>
    </div>
</x-guest-layout>
