<x-main-layout>
    <x-slot name="title">Checkout - TasBagus</x-slot>

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

                                <!-- DANA -->
                                <label class="flex items-start p-4 bg-[#1e2d3d] border-2 border-gray-700 rounded-xl cursor-pointer hover:border-orange-500 transition-all group">
                                    <input type="radio" name="payment_method" value="DANA" required class="mt-1 w-5 h-5 text-orange-500 focus:ring-orange-500 bg-gray-800 border-gray-600">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-lg text-white group-hover:text-orange-400 transition-colors">E-Wallet DANA</span>
                                            <span class="text-xs bg-blue-500 text-white px-3 py-1 rounded-lg font-bold">DANA</span>
                                        </div>
                                        <p class="text-gray-400 text-sm mt-1">Lakukan pembayaran praktis menggunakan saldo DANA Anda.</p>
                                    </div>
                                </label>

                                <!-- GoPay -->
                                <label class="flex items-start p-4 bg-[#1e2d3d] border-2 border-gray-700 rounded-xl cursor-pointer hover:border-orange-500 transition-all group">
                                    <input type="radio" name="payment_method" value="GoPay" required class="mt-1 w-5 h-5 text-orange-500 focus:ring-orange-500 bg-gray-800 border-gray-600">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-lg text-white group-hover:text-orange-400 transition-colors">E-Wallet GoPay</span>
                                            <span class="text-xs bg-green-500 text-white px-3 py-1 rounded-lg font-bold">GoPay</span>
                                        </div>
                                        <p class="text-gray-400 text-sm mt-1">Bayar dengan memotong saldo GoPay langsung dari handphone Anda.</p>
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

                            <a href="{{ route('cart.index') }}" class="block w-full text-center text-gray-400 hover:text-orange-400 transition-colors mt-4 text-sm font-semibold">
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
