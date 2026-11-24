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
            <p class="text-xs text-slate-500 mt-1 font-medium">Sistem Kasir & Rekap Transaksi</p>
        </div>

        <!-- Quick Demo Account Access (No Abbreviations) -->
        <div class="mb-5 p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
            <div class="text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-2 flex items-center justify-between">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Akses Cepat Demo
                </span>
                <span class="text-[10px] text-slate-400 font-normal">Klik untuk mengisi</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <button type="button" 
                        onclick="fillCredentials('kasir@gmail.com', 'kasir123')"
                        class="p-2.5 bg-white hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 rounded-xl transition text-left shadow-2xs group cursor-pointer">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-blue-500 shrink-0"></span>
                        <div class="text-xs font-bold text-slate-800 group-hover:text-blue-700 leading-tight">Masuk sebagai Kasir</div>
                    </div>
                    <div class="text-[10px] text-slate-400 font-mono mt-1 pl-3.5 truncate">kasir@gmail.com</div>
                </button>
                <button type="button" 
                        onclick="fillCredentials('admin@gmail.com', 'admin123')"
                        class="p-2.5 bg-white hover:bg-indigo-50/80 border border-slate-200 hover:border-indigo-300 rounded-xl transition text-left shadow-2xs group cursor-pointer">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 shrink-0"></span>
                        <div class="text-xs font-bold text-slate-800 group-hover:text-indigo-700 leading-tight">Masuk sebagai Administrator</div>
                    </div>
                    <div class="text-[10px] text-slate-400 font-mono mt-1 pl-3.5 truncate">admin@gmail.com</div>
                </button>
            </div>
        </div>

        <!-- Divider -->
        <div class="relative flex items-center justify-center my-4">
            <div class="border-t border-slate-200 w-full"></div>
            <span class="bg-white px-3 text-[11px] text-slate-400 font-medium">atau masuk dengan kredensial</span>
            <div class="border-t border-slate-200 w-full"></div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Vertikal -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4" id="loginForm">
            @csrf

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
                           autofocus 
                           autocomplete="username" 
                           placeholder="kasir@gmail.com atau admin@gmail.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-700">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="text-[11px] font-medium text-blue-600 hover:text-blue-800 transition" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" 
                           class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 pl-10 pr-10 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition"
                           type="password"
                           name="password"
                           required 
                           autocomplete="current-password" 
                           placeholder="••••••••" />
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition focus:outline-none">
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-0.5">
                <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-xs focus:ring-blue-500 w-4 h-4" name="remember">
                    <span class="ms-2 text-xs text-slate-600">Ingat sesi ini di perangkat</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white text-xs font-bold rounded-xl shadow-md shadow-blue-500/25 transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Masuk ke Aplikasi</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Link ke Halaman Registrasi -->
        <div class="mt-5 text-center">
            <p class="text-xs text-slate-500">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 transition">
                    Daftar Akun Baru
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

    <script>
        function fillCredentials(email, password) {
            const emailInput = document.getElementById('email');
            const passInput = document.getElementById('password');
            emailInput.value = email;
            passInput.value = password;

            // Flash effect for feedback
            emailInput.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50/50');
            passInput.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50/50');
            setTimeout(() => {
                emailInput.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50/50');
                passInput.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50/50');
            }, 500);
        }

        function togglePasswordVisibility() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />`;
            } else {
                passInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</x-guest-layout>