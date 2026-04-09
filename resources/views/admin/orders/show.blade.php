<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030] flex justify-between items-center flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Detail Pesanan <span class="text-orange-400">#{{ $order->order_number }}</span></h1>
            <p class="text-sm text-gray-400 mt-1">{{ $order->created_at->format('l, d F Y - H:i') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition border border-gray-700">
            &larr; Kembali
        </a>
    </div>

    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column: Items and Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="card-dark overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white flex items-center space-x-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Produk yang Dipesan</span>
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center space-x-4 border-b border-gray-800 pb-4 last:border-0 last:pb-0">
                            <img src="{{ $item->product->image ?? '' }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-lg bg-gray-800">
                            <div class="flex-1">
                                <h3 class="text-white font-medium">{{ $item->product_name }}</h3>
                                <p class="text-gray-400 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }} &times; {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-white font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-gray-900/50 p-6 space-y-2 border-t border-gray-800">
                    <div class="flex justify-between text-gray-400 text-sm">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400 text-sm">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    @if($order->discount > 0)
                    <div class="flex justify-between text-orange-400 text-sm">
                        <span>Diskon</span>
                        <span>- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="border-t border-gray-800 my-2 pt-2 flex justify-between items-center">
                        <span class="text-white font-bold text-lg">Total Pembayaran</span>
                        <span class="text-orange-500 font-bold text-xl">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card-dark overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white flex items-center space-x-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Informasi Pengiriman</span>
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Nama Penerima</p>
                        <p class="text-white font-medium">{{ $order->shipping_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Telepon / WA</p>
                        <p class="text-white font-medium">{{ $order->shipping_phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Kota / Provinsi</p>
                        <p class="text-white font-medium">{{ $order->shipping_city }}, {{ $order->shipping_province }} ({{ $order->shipping_postal_code }})</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Alamat Lengkap</p>
                        <p class="text-white font-medium leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                    @if($order->notes)
                    <div class="md:col-span-2 bg-gray-800/50 p-4 rounded-lg border border-gray-700">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Catatan Pesanan</p>
                        <p class="text-white italic">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Status Update -->
        <div class="space-y-6">
            <div class="card-dark overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white flex items-center space-x-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span>Persetujuan (ACC)</span>
                    </h2>
                </div>
                
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Ubah Status Pesanan</label>
                        <div class="relative">
                            <select name="status" class="w-full input-dark appearance-none rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing (Sedang Diproses)</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (Dalam Pengiriman)</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered (Selesai/Diterima)</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Ubah Status Pembayaran</label>
                        <div class="relative">
                            <select name="payment_status" class="w-full input-dark appearance-none rounded-lg px-4 py-3 bg-[#1e2d3d] border border-gray-700 text-white focus:outline-none focus:border-orange-500">
                                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid (Belum Lunas)</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                                <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed (Gagal)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-orange px-4 py-3 rounded-lg font-bold text-white flex justify-center items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Simpan Perubahan (ACC)</span>
                    </button>
                    
                </form>
            </div>
            
            <div class="card-dark p-6">
                <h3 class="text-sm font-bold text-gray-400 mb-3 uppercase tracking-wider">Metode Pembayaran</h3>
                <p class="text-white font-medium capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                <div class="mt-4 pt-4 border-t border-gray-800">
                    <p class="text-xs text-gray-500 mb-1">Waktu Dibuat:</p>
                    <p class="text-sm text-gray-300">{{ $order->created_at->format('d M Y, H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
