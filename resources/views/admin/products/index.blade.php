<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030] flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Manajemen <span style="color:var(--orange)">Produk</span></h1>
            <p class="text-sm text-gray-400 mt-1">Daftar semua produk yang tersedia di sistem.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-orange px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    <div class="p-6">
        <div class="card-dark overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left">Produk</th>
                            <th class="px-6 py-4 text-left">Kategori</th>
                            <th class="px-6 py-4 text-left">Harga</th>
                            <th class="px-6 py-4 text-left">Stok</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $product->image ?? '' }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded shadow-sm bg-gray-800">
                                    <div>
                                        <h3 class="text-white font-medium text-sm">{{ $product->name }}</h3>
                                        <p class="text-gray-500 text-xs mt-0.5">Brand: {{ $product->brand ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                {{ $product->category->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->discount_price)
                                    <p class="text-sm font-bold text-orange-400">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                @else
                                    <p class="text-sm font-bold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($product->stock > 0)
                                    <span class="text-green-400 font-semibold">{{ $product->stock }}</span>
                                @else
                                    <span class="text-red-400 font-semibold">Habis</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($product->is_active)
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Aktif</span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-gray-500/20 text-gray-400 border border-gray-500/30">Non-aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.products.edit', $product->slug) }}" class="text-blue-400 hover:text-blue-300 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                Belum ada produk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
