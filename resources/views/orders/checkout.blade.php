<x-main-layout>
    <x-slot name="title">Checkout - Tas NoonaHnB</x-slot>

    <!-- Header -->
    <section class="hero-gradient text-white py-14 relative">
        <div class="absolute top-0 right-0 w-64 h-64 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.07) 0%,transparent 70%);border-radius:50%;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Pembayaran</p>
            <h1 class="text-4xl font-bold text-white mb-2">Checkout <span class="text-orange">Pesanan</span></h1>
            <div class="divider"></div>
            <p class="text-gray-400 mt-4 max-w-lg">Lengkapi data pengiriman Anda dengan teliti dan pilih metode pembayaran yang Anda inginkan.</p>
        </div>
    </section>

    <!-- Checkout Content -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                @foreach($cartItems as $item)
                    <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                @endforeach
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Left Column - Forms -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Information -->
                        <div class="card-dark p-8 rounded-2xl border border-gray-800 shadow-xl">
                            <h2 class="text-xl font-bold mb-6 text-white border-b border-gray-800 pb-4">Informasi Pengiriman</h2>
                            
                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_name" value="{{ old('shipping_name', Auth::user()->name) }}" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" placeholder="Masukkan nama penerima">
                                    @error('shipping_name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" placeholder="08xxxxxxxxxx">
                                    @error('shipping_phone')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Alamat Lengkap <span class="text-red-500">*</span></label>
                                    <textarea name="shipping_address" rows="3" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors resize-none" placeholder="Nama Jalan, Nomor Rumah, RT/RW, Patokan">{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Kota / Kabupaten <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" placeholder="Contoh: Jakarta Selatan">
                                    @error('shipping_city')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Provinsi <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_province" value="{{ old('shipping_province') }}" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" placeholder="Contoh: DKI Jakarta">
                                    @error('shipping_province')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Kode Pos <span class="text-red-500">*</span></label>
                                    <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" placeholder="12345">
                                    @error('shipping_postal_code')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-2 text-gray-300">Catatan (Opsional)</label>
                                    <textarea name="notes" rows="2" class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors resize-none" placeholder="Catatan khusus untuk kurir atau penjual">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="card-dark p-8 rounded-2xl border border-gray-800 shadow-xl">
                            <h2 class="text-xl font-bold mb-6 text-white border-b border-gray-800 pb-4">Metode Pembayaran</h2>
                            
                            <div class="space-y-4">
                                <!-- COD -->
                                <label class="flex items-start p-4 bg-[#1e2d3d] border-2 border-gray-700 rounded-xl cursor-pointer hover:border-orange-500 transition-all group">
                                    <input type="radio" name="payment_method" value="COD" required class="mt-1 w-5 h-5 text-orange-500 focus:ring-orange-500 bg-gray-800 border-gray-600">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-lg text-white group-hover:text-orange-400 transition-colors">Bayar di Tempat (COD)</span>
                                            <span class="px-3 py-1 bg-[rgba(34,197,94,0.1)] border border-[rgba(34,197,94,0.3)] text-[#86efac] text-xs font-bold rounded-lg uppercase tracking-wider">Tersedia</span>
                                        </div>
                                        <p class="text-gray-400 text-sm mt-1">Bayar secara tunai langsung kepada kurir saat barang tiba di alamat Anda.</p>
                                    </div>
                                </label>

                                <!-- QRIS -->
                                <label class="flex items-start p-4 bg-[#1e2d3d] border-2 border-gray-700 rounded-xl cursor-pointer hover:border-orange-500 transition-all group">
                                    <input type="radio" name="payment_method" value="QRIS" required class="mt-1 w-5 h-5 text-orange-500 focus:ring-orange-500 bg-gray-800 border-gray-600">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-lg text-white group-hover:text-orange-400 transition-colors">QRIS (Semua Pembayaran)</span>
                                            <span class="px-3 py-1 bg-[rgba(249,115,22,0.1)] border border-orange-500/30 text-orange-400 text-xs font-bold rounded-lg uppercase tracking-wider">QRIS</span>
                                        </div>
                                        <p class="text-gray-400 text-sm mt-1">Satu kode QR untuk semua aplikasi e-wallet dan mobile banking.</p>
                                    </div>
                                </label>

                            </div>

                            @error('payment_method')
                                <p class="mt-3 text-sm text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="card-dark p-6 rounded-2xl border border-gray-800 shadow-xl sticky top-24">
                            <h2 class="text-lg font-bold text-white mb-5 border-b border-gray-800 pb-4">Ringkasan Pesanan</h2>
                            
                            <!-- Cart Items -->
                            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($cartItems as $item)
                                    <div class="flex items-center space-x-3 pb-4 border-b border-gray-800 last:border-0 last:pb-0">
                                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-xl border border-gray-700">
                                        <div class="flex-1">
                                            <p class="font-bold text-sm text-white leading-tight">{{ $item->product->name }}</p>
                                            <p class="text-gray-400 text-xs mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-bold text-sm text-orange-400">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Price Summary -->
                            <div class="space-y-3 mb-5">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400 font-medium">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                                    <span class="text-white font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                
                                @if($discount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400 font-medium">Diskon 10% (Promo)</span>
                                    <span class="font-bold" style="color:#86efac">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400 font-medium">Ongkos Kirim</span>
                                    @if($shippingCost == 0)
                                        <span class="font-bold" style="color:#86efac">GRATIS</span>
                                    @else
                                        <span class="text-white font-bold">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                @if($subtotal >= 500000)
                                    <div class="mt-3 px-3 py-2 bg-[rgba(34,197,94,0.1)] border border-[rgba(34,197,94,0.2)] text-[#86efac] rounded-lg text-xs font-semibold flex items-center justify-center space-x-2">
                                        <span>🎉 Selamat, Anda mendapat gratis ongkir!</span>
                                    </div>
                                @endif
                            </div>

                            <div class="border-t border-gray-800 pt-5 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-white">Total Bayar</span>
                                    <span class="text-2xl font-bold text-orange-500 drop-shadow-md">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" class="btn-orange w-full py-4 rounded-xl font-bold text-lg shadow-lg">
                                Bayar Sekarang
                            </button>

                            <a href="https://wa.me/6289616392586?text=Halo%20Admin,%20saya%20berminat%20melakukan%20pembelian%20grosir/reseller." target="_blank" class="mt-4 flex items-center justify-center w-full py-4 rounded-xl border-2 border-[#25D366] text-[#25D366] hover:bg-[#25D366] hover:text-white transition-all font-bold text-lg group">
                                <svg class="w-6 h-6 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                </svg>
                                Checkout Grosir via WhatsApp
                            </a>

                            <a href="{{ route('cart.index') }}" class="block w-full text-center text-gray-400 hover:text-orange-400 transition-colors mt-5 text-sm font-semibold">
                                ← Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(249,115,22,0.3); border-radius: 2px; }
    </style>
</x-main-layout>
