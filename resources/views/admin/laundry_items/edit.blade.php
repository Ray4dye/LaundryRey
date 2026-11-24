<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-blue-600 mb-1">
                    <a href="{{ route('laundry_items.index') }}" class="hover:underline">Master Data Layanan</a>
                    <span class="text-slate-300">•</span>
                    <span class="text-slate-500">Edit Layanan #{{ $laundryItem->id }}</span>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Edit Layanan Laundry</h1>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui nama paket, skema tarif per kg, atau spesifikasi pengerjaan.</p>
            </div>
            <a href="{{ route('laundry_items.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 shadow-sm transition">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>&larr; Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200/80 text-rose-800 text-xs mb-6 shadow-sm">
                <div class="font-bold flex items-center gap-2 mb-1.5 text-rose-900">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Periksa kembali data yang dimasukkan:
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-rose-700 ml-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('laundry_items.update', $laundryItem->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-7 sm:p-9 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama Layanan -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5">Nama Layanan Laundry <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <input type="text" id="name" name="name" value="{{ old('name', $laundryItem->name) }}" required class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition">
                </div>
            </div>

            <!-- Kategori Durasi & Tarif -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="category" class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Durasi Pengerjaan <span class="text-rose-500">*</span></label>
                    <select id="category" name="category" required class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition">
                        <option value="Reguler" {{ old('category', $laundryItem->category) == 'Reguler' ? 'selected' : '' }}>Reguler (3-4 hari)</option>
                        <option value="Ekspres" {{ old('category', $laundryItem->category) == 'Ekspres' ? 'selected' : '' }}>Ekspres (1-2 hari)</option>
                        <option value="Superkilat" {{ old('category', $laundryItem->category) == 'Superkilat' ? 'selected' : '' }}>Superkilat (5 jam)</option>
                    </select>
                </div>
                <div>
                    <label for="price" class="block text-xs font-bold text-slate-700 mb-1.5">Tarif per Kg (Rp) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-slate-400">Rp</span>
                        <input type="number" id="price" name="price" value="{{ old('price', $laundryItem->price) }}" min="0" step="500" required class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-3.5 py-2.5 text-slate-900 font-semibold focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Deskripsi Layanan -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi & Spesifikasi Layanan <span class="text-rose-500">*</span></label>
                <textarea id="description" name="description" rows="3" required class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-slate-900 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 outline-none transition">{{ old('description', $laundryItem->description) }}</textarea>
            </div>

            <!-- Image Upload with Current Preview -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Foto Layanan</label>
                <div class="flex items-center gap-4">
                    <div id="imagePreviewContainer" class="w-20 h-20 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                        @if($laundryItem->image)
                            <img id="imagePreview" src="{{ asset('storage/' . $laundryItem->image) }}" alt="Preview" class="w-full h-full object-cover">
                        @else
                            <img id="imagePreview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                            <div id="placeholderPreview" class="text-center text-slate-400 p-2">
                                <svg class="w-6 h-6 mx-auto opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[9px] block mt-0.5">No img</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" id="imageInput" name="image" accept="image/*" onchange="previewSelectedImage(this)" class="w-full text-xs border border-slate-200 rounded-xl file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition">
                        <span class="text-[10px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengganti foto saat ini.</span>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('laundry_items.index') }}" class="px-4 py-2.5 text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-xs font-bold bg-slate-900 hover:bg-slate-800 text-white rounded-xl shadow-md shadow-slate-900/10 hover:shadow-lg transition-all duration-150 transform active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Perbarui Layanan</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewSelectedImage(input) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('placeholderPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
