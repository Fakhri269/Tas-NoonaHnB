<x-main-layout>
    <x-slot name="title">Detail Pesanan #{{ $order->order_number }} - TasBagus</x-slot>

    <!-- Header with Modern Design -->
    <section class="hero-gradient text-white py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32 float-animation"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex items-center space-x-3 mb-4">
                <a href="{{ route('orders.index') }}" class="text-white hover:text-gray-200 transition-all duration-300 hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold">Detail Pesanan</h1>
                    <p class="text-gray-100 mt-1">Pesanan #{{ $order->order_number }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Details -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <!-- Success Message -->
            @if(session('success'))
                <div class="glass-effect border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-6 shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-2 rounded-full mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Order Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Status -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-purple-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold gradient-text">Status Pesanan</h2>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($order->status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300
                                @elseif($order->status === 'processing') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300
                                @elseif($order->status === 'shipped') bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border border-purple-300
                                @elseif($order->status === 'delivered') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300
                                @elseif($order->status === 'cancelled') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300
                                @endif">
                                @if($order->status === 'pending') Menunggu Pembayaran
                                @elseif($order->status === 'processing') Diproses
                                @elseif($order->status === 'shipped') Dikirim
                                @elseif($order->status === 'delivered') Selesai
                                @elseif($order->status === 'cancelled') Dibatalkan
                                @endif
                            </span>
                        </div>

                        <!-- Order Timeline -->
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Pesanan Dibuat</p>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            @if($order->status !== 'pending' && $order->status !== 'cancelled')
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Pembayaran Dikonfirmasi</p>
                                    <p class="text-sm text-gray-600">Pesanan sedang diproses</p>
                                </div>
                            </div>
                            @endif

                            @if(in_array($order->status, ['shipped', 'delivered']))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Pesanan Dikirim</p>
                                    <p class="text-sm text-gray-600">Dalam perjalanan ke alamat Anda</p>
                                </div>
                            </div>
                            @endif

                            @if($order->status === 'delivered')
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Pesanan Diterima</p>
                                    <p class="text-sm text-gray-600">Terima kasih atas pesanan Anda!</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($order->status === 'pending')
                        <div class="mt-6">
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-purple-100">
                        <h2 class="text-2xl font-bold mb-6 gradient-text">Produk yang Dipesan</h2>
                        
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                            <div class="flex items-center space-x-4 pb-4 border-b border-purple-100 last:border-0">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded-xl shadow-md">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $item->product_name }}</h3>
                                    <p class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-lg gradient-text">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-purple-100">
                        <h2 class="text-2xl font-bold mb-6 gradient-text">Informasi Pengiriman</h2>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-1">Nama Penerima</p>
                                <p class="font-semibold text-gray-800">{{ $order->shipping_name }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-1">Nomor Telepon</p>
                                <p class="font-semibold text-gray-800">{{ $order->shipping_phone }}</p>
                            </div>
                            <div class="md:col-span-2 bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-1">Alamat Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $order->shipping_address }}</p>
                                <p class="font-semibold text-gray-800">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                            </div>
                            @if($order->notes)
                            <div class="md:col-span-2 bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-1">Catatan</p>
                                <p class="font-semibold text-gray-800">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment & Summary -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Payment Information -->
                    <div class="glass-effect rounded-2xl shadow-xl p-6 border border-purple-100 sticky top-24">
                        <h2 class="text-xl font-bold mb-4 gradient-text">Informasi Pembayaran</h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-1">Metode Pembayaran</p>
                                <p class="font-semibold text-lg text-gray-800">{{ $order->payment_method }}</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                <p class="text-sm text-purple-600 font-semibold mb-2">Status Pembayaran</p>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->payment_status === 'unpaid') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300
                                    @elseif($order->payment_status === 'paid') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300
                                    @endif">
                                    @if($order->payment_status === 'unpaid') Belum Dibayar
                                    @elseif($order->payment_status === 'paid') Sudah Dibayar
                                    @endif
                                </span>
                            </div>
                        </div>

                        @if($order->payment_status === 'unpaid' && ($order->status === 'pending' || $order->payment_method === 'COD'))
                        <div class="mt-6 p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-300 rounded-xl">
                            <p class="font-semibold text-yellow-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Instruksi Pembayaran:
                            </p>
                            
                            @if($order->payment_method === 'COD')
                                <p class="text-sm text-yellow-700">Pembayaran akan dilakukan saat barang diterima. Pastikan menyiapkan uang pas.</p>

                            @elseif($order->payment_method === 'DANA')
                                <div class="text-sm text-yellow-700 space-y-2">
                                    <p>Transfer ke nomor DANA: <strong>0812-3456-7890</strong></p>
                                    <p>a.n. TasBagus</p>
                                    <p class="mt-2">Setelah transfer, konfirmasi pembayaran melalui WhatsApp: <strong>0812-3456-7890</strong></p>
                                </div>
                            @elseif($order->payment_method === 'QRIS')
                                <div class="text-sm text-yellow-700 space-y-3 text-center md:text-left">
                                    <p>Silakan scan kode QRIS berikut menggunakan aplikasi DANA, OVO, GoPay, ShopeePay, atau Mobile Banking pilihan Anda:</p>
                                    @if(\Storage::disk('public')->exists('settings/qris.png'))
                                        <div class="bg-white p-4 rounded-2xl shadow-sm inline-block border border-yellow-300">
                                            <img src="{{ asset('storage/settings/qris.png') }}?v={{ time() }}" alt="QRIS Penjual" class="w-48 h-48 object-contain mx-auto">
                                        </div>
                                    @else
                                        <div class="bg-yellow-200 text-yellow-800 p-3 rounded-lg border border-yellow-400 font-semibold italic text-center text-xs">QRIS belum dipasang oleh Admin. Harap hubungi WhatsApp: 0812-3456-7890.</div>
                                    @endif
                                    <p class="mt-2">Setelah sukses scan dan transfer, konfirmasi pembayaran Anda melalui WhatsApp: <strong>0812-3456-7890</strong></p>
                                </div>
                            @elseif($order->payment_method === 'GoPay')
                                <div class="text-sm text-yellow-700 space-y-2">
                                    <p>Transfer ke nomor GoPay: <strong>0812-3456-7890</strong></p>
                                    <p>a.n. TasBagus</p>
                                    <p class="mt-2">Setelah transfer, konfirmasi pembayaran melalui WhatsApp: <strong>0812-3456-7890</strong></p>
                                </div>
                            @endif
                        </div>
                        @endif

                        <!-- Order Summary -->
                        <div class="mt-6 pt-6 border-t border-purple-200">
                            <h3 class="font-bold mb-4 text-gray-800">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold text-gray-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Ongkir</span>
                                    @if($order->shipping_cost == 0)
                                        <span class="font-semibold text-green-600">GRATIS</span>
                                    @else
                                        <span class="font-semibold text-gray-800">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                @if($order->discount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Diskon</span>
                                    <span class="font-semibold text-green-600">- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                <div class="border-t border-purple-200 pt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-gray-800">Total</span>
                                        <span class="text-2xl font-bold gradient-text">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 space-y-3">
                            <button onclick="printReceipt()" class="block w-full text-center bg-gradient-to-r from-green-500 to-green-700 text-white py-3 rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                <span>Cetak Struk</span>
                            </button>
                            <a href="{{ route('orders.index') }}" class="block w-full text-center btn-gradient text-white py-3 rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold">
                                Lihat Semua Pesanan
                            </a>
                            <a href="{{ route('products.index') }}" class="block w-full text-center border-2 border-purple-600 text-purple-600 py-3 rounded-xl hover:bg-purple-50 transition-all duration-300 hover:scale-105 font-semibold">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hidden Receipt for Printing -->
    <div id="receipt" style="display: none;">
        <div style="width: 80mm; font-family: 'Courier New', monospace; padding: 10px;">
            <!-- Header -->
            <div style="text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <h2 style="margin: 0; font-size: 20px; font-weight: bold;">TASBAGUS</h2>
                <p style="margin: 5px 0; font-size: 12px;">Toko Tas Premium Terpercaya</p>
                <p style="margin: 0; font-size: 11px;">Jl. Contoh No. 123, Jakarta</p>
                <p style="margin: 0; font-size: 11px;">Telp: 0812-3456-7890</p>
            </div>

            <!-- Order Info -->
            <div style="border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <table style="width: 100%; font-size: 11px;">
                    <tr>
                        <td style="width: 40%;">No. Pesanan</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 55%;">{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td>:</td>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td>:</td>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                </table>
            </div>

            <!-- Items -->
            <div style="border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <table style="width: 100%; font-size: 11px;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding-bottom: 5px;">Item</th>
                            <th style="text-align: center; padding-bottom: 5px;">Qty</th>
                            <th style="text-align: right; padding-bottom: 5px;">Harga</th>
                            <th style="text-align: right; padding-bottom: 5px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td style="padding: 3px 0;">{{ $item->product_name }}</td>
                            <td style="text-align: center; padding: 3px 0;">{{ $item->quantity }}</td>
                            <td style="text-align: right; padding: 3px 0;">{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td style="text-align: right; padding: 3px 0;">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div style="border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <table style="width: 100%; font-size: 11px;">
                    <tr>
                        <td style="text-align: right; padding: 2px 0;">Subtotal:</td>
                        <td style="text-align: right; padding: 2px 0; width: 35%;">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 2px 0;">Ongkir:</td>
                        <td style="text-align: right; padding: 2px 0;">
                            @if($order->shipping_cost == 0)
                                GRATIS
                            @else
                                Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                    @if($order->discount > 0)
                    <tr>
                        <td style="text-align: right; padding: 2px 0;">Diskon:</td>
                        <td style="text-align: right; padding: 2px 0;">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr style="font-weight: bold; font-size: 13px;">
                        <td style="text-align: right; padding-top: 5px; border-top: 1px solid #000;">TOTAL:</td>
                        <td style="text-align: right; padding-top: 5px; border-top: 1px solid #000;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <!-- Shipping Info -->
            <div style="border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <p style="margin: 0 0 5px 0; font-size: 11px; font-weight: bold;">INFORMASI PENGIRIMAN:</p>
                <table style="width: 100%; font-size: 10px;">
                    <tr>
                        <td style="width: 30%;">Nama</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $order->shipping_name }}</td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>:</td>
                        <td>{{ $order->shipping_phone }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Alamat</td>
                        <td style="vertical-align: top;">:</td>
                        <td>{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer -->
            <div style="text-align: center; font-size: 11px;">
                <p style="margin: 5px 0;">Terima kasih atas pembelian Anda!</p>
                <p style="margin: 5px 0;">Barang yang sudah dibeli tidak dapat dikembalikan</p>
                <p style="margin: 10px 0 5px 0; font-weight: bold;">www.tasbagus.com</p>
                <p style="margin: 5px 0; font-size: 10px;">{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function printReceipt() {
            // Get the receipt content
            var receiptContent = document.getElementById('receipt').innerHTML;
            
            // Create a new window for printing
            var printWindow = window.open('', '_blank', 'width=800,height=600');
            
            // Write the content to the new window
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Struk Pembayaran - {{ $order->order_number }}</title>
                    <style>
                        @media print {
                            body {
                                margin: 0;
                                padding: 0;
                            }
                            @page {
                                size: 80mm auto;
                                margin: 0;
                            }
                        }
                        body {
                            font-family: 'Courier New', monospace;
                            margin: 0;
                            padding: 0;
                        }
                    </style>
                </head>
                <body>
                    ${receiptContent}
                </body>
                </html>
            `);
            
            // Close the document and trigger print
            printWindow.document.close();
            
            // Wait for content to load then print
            printWindow.onload = function() {
                printWindow.focus();
                printWindow.print();
                // Close the window after printing
                setTimeout(function() {
                    printWindow.close();
                }, 250);
            };
        }
    </script>
    @endpush
</x-main-layout>
