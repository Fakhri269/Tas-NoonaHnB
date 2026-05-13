<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030] flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Edit <span class="text-orange-400">Produk</span></h1>
            <p class="text-sm text-gray-400 mt-1">Lakukan perubahan data untuk: <strong class="text-gray-300">{{ $product->name }}</strong></p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition border border-gray-700">
            &larr; Batal
        </a>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="card-dark overflow-hidden">
            @csrf
            @method('PUT')
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Nama Produk *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-700' }} text-white focus:outline-none focus:border-orange-500">
                        @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Kategori *</label>
                        <select name="category_id" required class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Harga Asli (Rp) *</label>
                            <input type="number" min="0" name="price" value="{{ old('price', (int)$product->price) }}" required class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Harga Diskon (Opsional)</label>
                            <input type="number" min="0" name="discount_price" value="{{ old('discount_price', $product->discount_price ? (int)$product->discount_price : '') }}" class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Stok Tersedia *</label>
                            <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Brand (Opsional)</label>
                            <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi Lengkap *</label>
                        <textarea name="description" rows="5" required class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Foto Produk Utama (Kosongkan jika tak diubah)</label>
                        @if($product->image)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                                <img src="{{ $product->image }}" class="w-32 h-32 object-cover rounded-lg border border-gray-700 bg-gray-800">
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-700 bg-gray-800/50 rounded-lg p-6 text-center hover:border-orange-500 transition cursor-pointer relative">
                            <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this, 'edit')">
                            <div id="placeholder-edit">
                                <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="mt-2 text-sm text-gray-400">Timpa gambar baru (klik/drag ke sini).</p>
                            </div>
                            <img id="preview-edit" src="" class="hidden mx-auto h-32 object-contain rounded-lg">
                        </div>
                        @error('image') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Material</label>
                            <input type="text" name="material" value="{{ old('material', $product->material) }}" class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Warna</label>
                            <input type="text" name="color" value="{{ old('color', $product->color) }}" class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Ukuran (Dimensi)</label>
                        <input type="text" name="size" value="{{ old('size', $product->size) }}" class="w-full input-dark rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                    </div>

                    <div class="bg-[#1e2d3d] p-4 rounded-lg border border-gray-700 space-y-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-orange-500 focus:ring-orange-500 focus:ring-offset-gray-900">
                            <div>
                                <p class="text-white font-medium text-sm">Jadikan Produk Unggulan</p>
                            </div>
                        </label>
                        
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-orange-500 focus:ring-orange-500 focus:ring-offset-gray-900">
                            <div>
                                <p class="text-white font-medium text-sm">Produk Aktif</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-800 bg-[#162030] flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg text-sm flex items-center space-x-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Perbarui Produk</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input, type) {
            const preview = document.getElementById('preview-' + type);
            const placeholder = document.getElementById('placeholder-' + type);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
            }
        }
    </script>
</x-admin-layout>
