<x-owner-layout>
    <x-slot name="title">Manajemen Produk - Owner Panel</x-slot>

    <div class="px-6 py-6 border-b bg-[#162030] flex justify-between items-center flex-wrap gap-4 relative overflow-hidden" style="border-color:rgba(249,115,22,0.1)">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-[0.03]"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-white">Manajemen <span class="text-orange-400">Produk</span></h1>
            <p class="text-sm text-gray-400 mt-1">Kelola semua produk toko dari sini.</p>
        </div>
        <a href="{{ route('owner.products.create') }}" class="btn-orange px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center space-x-2 relative z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    <div class="p-6">
        <form method="GET" action="{{ route('owner.products.index') }}" class="mb-6">
            <div class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="input-dark flex-1 px-4 py-3 rounded-xl text-sm">
                <button type="submit" class="btn-orange px-6 py-3 rounded-xl text-sm font-semibold">Cari</button>
            </div>
        </form>

        <div class="card-dark overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-4 py-4 text-left">Produk</th>
                            <th class="px-4 py-4 text-left">Kategori</th>
                            <th class="px-4 py-4 text-right">Harga</th>
                            <th class="px-4 py-4 text-center">Stok</th>
                            <th class="px-4 py-4 text-center">Status</th>
                            <th class="px-4 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover bg-gray-800 border border-gray-700">
                                    <div>
                                        <p class="text-white font-semibold text-sm">{{ Str::limit($product->name, 35) }}</p>
                                        <p class="text-gray-500 text-xs">{{ $product->brand }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-400">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-4 py-4 text-right">
                                @if($product->discount_price)
                                    <p class="text-orange-400 font-bold text-sm">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                                    <p class="text-gray-600 text-xs line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                @else
                                    <p class="text-white font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="text-sm {{ $product->stock > 0 ? 'text-green-400' : 'text-red-400' }} font-bold">{{ $product->stock }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if($product->is_active)
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold badge-success">Aktif</span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold badge-warning">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('owner.products.edit', $product) }}" class="p-2 rounded-lg bg-orange-500/10 text-orange-400 hover:bg-orange-500/20 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form method="POST" action="{{ route('owner.products.destroy', $product) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">{{ $products->links() }}</div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(btn) {
            Swal.fire({ title:'Hapus produk ini?', text:'Data tidak bisa dikembalikan!', icon:'warning', showCancelButton:true, confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280', confirmButtonText:'Ya, Hapus!', cancelButtonText:'Batal', background:'#1e2d3d', color:'#e2e8f0' }).then((r) => { if(r.isConfirmed) btn.closest('form').submit(); });
        }
    </script>
    @endpush
</x-owner-layout>
