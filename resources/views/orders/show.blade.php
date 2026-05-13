<x-main-layout>
    <x-slot name="title">Detail Pesanan #{{ $order->order_number }} - Tas NoonaHnB</x-slot>

    <!-- Header with Modern Design -->
    <section class="hero-gradient text-white py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500 opacity-5 rounded-full -mr-32 -mt-32 float-animation"></div>
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
                <div class="alert-success border border-green-500 px-6 py-4 rounded-2xl mb-6 shadow-lg">
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
                    <div class="card-dark p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-white">Status Pesanan</h2>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($order->status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-400 border border-yellow-300
                                @elseif($order->status === 'processing') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-300
                                @elseif($order->status === 'shipped') bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border border-orange-300
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
                                    <p class="font-semibold text-white">Pesanan Dibuat</p>
                                    <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
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
                                    <p class="font-semibold text-white">Pembayaran Dikonfirmasi</p>
                                    <p class="text-sm text-gray-400">Pesanan sedang diproses</p>
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
                                    <p class="font-semibold text-white">Pesanan Berhasil</p>
                                    <p class="text-sm text-gray-400">Pesanan sedang menuju perjalanan Anda</p>
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
                                    <p class="font-semibold text-white">Pesanan Diterima</p>
                                    <p class="text-sm text-gray-400">Terima kasih atas pesanan Anda!</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($order->status === 'pending')
                        <div class="mt-6">
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold w-full">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        </div>
                        @endif

                        @if($order->status === 'delivered')
                        <div class="mt-6">
                            <form action="{{ route('orders.complete', $order) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin pesanan sudah diterima dan sesuai?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold w-full flex justify-center items-center space-x-2">
                                    <svg class="w-5 h-5 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Terima Pesanan</span>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="card-dark p-6">
                        <h2 class="text-2xl font-bold mb-6 text-white">Produk yang Dipesan</h2>
                        
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                            <div class="flex items-center space-x-4 pb-4 border-b border-gray-800 last:border-0">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded-xl shadow-md">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-white">{{ $item->product_name }}</h3>
                                    <p class="text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-lg text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="card-dark p-6">
                        <h2 class="text-2xl font-bold mb-6 text-white">Informasi Pengiriman</h2>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-1">Nama Penerima</p>
                                <p class="font-semibold text-white">{{ $order->shipping_name }}</p>
                            </div>
                            <div class="bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-1">Nomor Telepon</p>
                                <p class="font-semibold text-white">{{ $order->shipping_phone }}</p>
                            </div>
                            <div class="md:col-span-2 bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-1">Alamat Lengkap</p>
                                <p class="font-semibold text-white">{{ $order->shipping_address }}</p>
                                <p class="font-semibold text-white">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                            </div>
                            @if($order->notes)
                            <div class="md:col-span-2 bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-1">Catatan</p>
                                <p class="font-semibold text-white">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Payment & Summary -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Payment Information -->
                    <div class="card-dark p-6 sticky top-24">
                        <h2 class="text-xl font-bold mb-4 text-white">Informasi Pembayaran</h2>
                        
                        <div class="space-y-4">
                            <div class="bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-1">Metode Pembayaran</p>
                                <p class="font-semibold text-lg text-white">{{ $order->payment_method }}</p>
                            </div>
                            
                            <div class="bg-[#1e2d3d] p-4 rounded-xl border border-gray-700">
                                <p class="text-sm text-gray-400 font-semibold mb-2">Status Pembayaran</p>
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
                        <div class="mt-6 p-4 bg-[rgba(234,179,8,0.1)] border border-[rgba(234,179,8,0.3)] rounded-xl">
                            <p class="font-semibold text-yellow-400 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Instruksi Pembayaran:
                            </p>
                            
                            @if($order->payment_method === 'COD')
                                <p class="text-sm text-yellow-200">Pembayaran akan dilakukan saat barang diterima. Pastikan menyiapkan uang pas.</p>

                            @elseif($order->payment_method === 'DANA')
                                <div class="text-sm text-yellow-200 space-y-2">
                                    <p>Transfer ke nomor DANA: <strong>0812-3456-7890</strong></p>
                                    <p>a.n. Tas NoonaHnB</p>
                                    <p class="mt-2">Setelah transfer, konfirmasi pembayaran melalui WhatsApp: <strong>0812-3456-7890</strong></p>
                                </div>
                            @elseif($order->payment_method === 'QRIS')
                                <div class="bg-[#1e2d3d] p-6 rounded-2xl border border-gray-700 shadow-md text-center mt-4">
                                    <h3 class="font-extrabold text-xl text-white mb-2">Pindai Kode QRIS</h3>
                                    <p class="text-gray-400 text-sm mb-6">Gunakan aplikasi DANA, OVO, GoPay, ShopeePay, atau m-Banking pilihan Anda.</p>
                                    
                                    @if(\Storage::disk('public')->exists('settings/qris.png'))
                                        <div class="bg-white p-2 rounded-2xl inline-block border-2 border-orange-500 shadow-lg mb-4">
                                            <img src="{{ asset('storage/settings/qris.png') }}?v={{ time() }}" alt="QRIS Penjual" class="w-full max-w-sm h-auto mx-auto object-contain rounded-xl">
                                        </div>
                                    @else
                                        <div class="bg-yellow-200 text-yellow-400 p-4 rounded-lg border border-yellow-400 font-semibold italic text-center mb-4">QRIS belum dipasang oleh Admin. Harap hubungi WhatsApp: 0812-3456-7890.</div>
                                    @endif
                                    
                                    <div class="flex justify-center items-center mt-4 border-t border-gray-700 pt-4">
                                        <p class="text-sm font-semibold text-gray-300">Setelah transfer sukses, konfirmasi ke WhatsApp: <span class="text-orange-500">0812-3456-7890</span></p>
                                    </div>
                                </div>
                            @elseif($order->payment_method === 'GoPay')
                                <div class="text-sm text-yellow-200 space-y-2">
                                    <p>Transfer ke nomor GoPay: <strong>0812-3456-7890</strong></p>
                                    <p>a.n. Tas NoonaHnB</p>
                                    <p class="mt-2">Setelah transfer, konfirmasi pembayaran melalui WhatsApp: <strong>0812-3456-7890</strong></p>
                                </div>
                            @endif
                        </div>
                        @endif

                        <!-- Order Summary -->
                        <div class="mt-6 pt-6 border-t border-gray-800">
                            <h3 class="font-bold mb-4 text-white">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Subtotal</span>
                                    <span class="font-semibold text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Ongkir</span>
                                    @if($order->shipping_cost == 0)
                                        <span class="font-semibold text-green-600">GRATIS</span>
                                    @else
                                        <span class="font-semibold text-white">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                @if($order->discount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Diskon</span>
                                    <span class="font-semibold text-green-600">- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                <div class="border-t border-gray-800 pt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-white">Total</span>
                                        <span class="text-2xl font-bold text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
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
                            <a href="{{ route('orders.index') }}" class="block w-full text-center btn-orange text-white py-3 rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold">
                                Lihat Semua Pesanan
                            </a>
                            <a href="{{ route('products.index') }}" class="block w-full text-center border-2 border-orange-600 text-gray-400 py-3 rounded-xl hover:bg-orange-50 transition-all duration-300 hover:scale-105 font-semibold">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function printReceipt() {
            var now    = new Date();
            var days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            var months = ['Januari','Februari','Maret','April','Mei','Juni',
                          'Juli','Agustus','September','Oktober','November','Desember'];

            var dayName   = days[now.getDay()];
            var dateStr   = ("0"+now.getDate()).slice(-2) + " " + months[now.getMonth()] + " " + now.getFullYear();
            var timeStr   = ("0"+now.getHours()).slice(-2) + ":" + ("0"+now.getMinutes()).slice(-2) + ":" + ("0"+now.getSeconds()).slice(-2);
            var printedAt = dayName + ", " + dateStr + "  " + timeStr + " WIB";

            var html = `<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Struk - {{ $order->order_number }}</title>
<style>
  @page { size: 80mm auto; margin: 4mm; }
  @media print { body { margin:0; } }
  * { box-sizing: border-box; }
  body {
    font-family: 'Courier New', Courier, monospace;
    font-size: 11px;
    color: #000;
    width: 72mm;
    margin: 0 auto;
    padding: 4px;
    line-height: 1.6;
  }
  .center { text-align: center; }
  .right  { text-align: right; }
  .bold   { font-weight: bold; }
  .big    { font-size: 16px; font-weight: bold; letter-spacing: 2px; margin: 4px 0; }
  .small  { font-size: 10px; }
  hr.dash { border: none; border-top: 1px dashed #000; margin: 7px 0; }
  hr.solid{ border: none; border-top: 2px solid #000; margin: 7px 0; }
  table   { width: 100%; border-collapse: collapse; }
  td, th  { padding: 2px 1px; vertical-align: top; }
  /* Info rows */
  .lbl  { width: 36%; font-size: 11px; }
  .sep  { width: 4%;  font-size: 11px; }
  .val  { width: 60%; font-size: 11px; }
  /* Item table */
  .i-name  { width: 40%; font-size: 10px; }
  .i-qty   { width: 8%;  font-size: 10px; text-align: center; }
  .i-price { width: 24%; font-size: 10px; text-align: right; }
  .i-sub   { width: 28%; font-size: 10px; text-align: right; }
  /* Summary */
  .s-lbl { width: 58%; text-align: right; padding-right: 4px; font-size: 11px; }
  .s-val { width: 42%; text-align: right; font-size: 11px; }
  .total-lbl { font-size: 13px; font-weight: bold; text-align: right; padding-right: 4px; padding-top: 5px; }
  .total-val { font-size: 13px; font-weight: bold; text-align: right; padding-top: 5px; }
  .section-title { font-weight: bold; font-size: 11px; margin: 5px 0 3px 0; }
  .footer-note { font-size: 10px; margin: 2px 0; color: #222; }
</style>
</head>
<body>

<!-- HEADER -->
<div class="center">
  <p class="big">TASBAGUS</p>
  <p style="margin:1px 0;font-size:11px;">Toko Tas Premium Terpercaya</p>
  <p style="margin:1px 0;font-size:10px;">Jl. Raya Tas No. 123, Jakarta Selatan</p>
  <p style="margin:1px 0;font-size:10px;">DKI Jakarta 12345</p>
  <p style="margin:1px 0;font-size:10px;">Telp/WA: 0812-3456-7890</p>
</div>

<hr class="solid">

<!-- INFO PESANAN -->
<table>
  <tr><td class="lbl">No. Pesanan</td><td class="sep">:</td><td class="val bold">{{ $order->order_number }}</td></tr>
  <tr><td class="lbl">Tgl Pesan</td><td class="sep">:</td><td class="val">{{ $order->created_at->locale('id')->isoFormat('DD MMM YYYY, HH:mm') }} WIB</td></tr>
  <tr><td class="lbl">Tgl Cetak</td><td class="sep">:</td><td class="val" id="pt">-</td></tr>
  <tr><td class="lbl">Pelanggan</td><td class="sep">:</td><td class="val">{{ $order->user->name }}</td></tr>
  <tr><td class="lbl">Pembayaran</td><td class="sep">:</td><td class="val">{{ $order->payment_method }}</td></tr>
  <tr><td class="lbl">Status</td><td class="sep">:</td><td class="val bold">{{ $order->payment_status === 'paid' ? 'LUNAS' : 'BELUM BAYAR' }}</td></tr>
</table>

<hr class="dash">

<!-- DETAIL PRODUK -->
<p class="section-title">DETAIL PRODUK</p>
<table>
  <thead>
    <tr>
      <th class="i-name" style="text-align:left;border-bottom:1px solid #000;padding-bottom:3px;">Produk</th>
      <th class="i-qty"  style="border-bottom:1px solid #000;padding-bottom:3px;">Qty</th>
      <th class="i-price"style="border-bottom:1px solid #000;padding-bottom:3px;">Harga</th>
      <th class="i-sub"  style="border-bottom:1px solid #000;padding-bottom:3px;">Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order->items as $item)
    <tr>
      <td class="i-name" style="padding-right:2px;">{{ $item->product_name }}</td>
      <td class="i-qty">{{ $item->quantity }}</td>
      <td class="i-price">{{ number_format($item->price, 0, ',', '.') }}</td>
      <td class="i-sub">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<hr class="dash">

<!-- RINGKASAN HARGA -->
<table>
  <tr><td class="s-lbl">Subtotal</td><td class="s-val">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td></tr>
  <tr>
    <td class="s-lbl">Ongkos Kirim</td>
    <td class="s-val">@if($order->shipping_cost == 0)GRATIS@else Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}@endif</td>
  </tr>
  @if($order->discount > 0)
  <tr><td class="s-lbl">Diskon</td><td class="s-val">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td></tr>
  @endif
</table>

<hr class="solid">

<table>
  <tr>
    <td class="total-lbl">TOTAL BAYAR</td>
    <td class="total-val">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
  </tr>
</table>

<hr class="dash">

<!-- ALAMAT PENGIRIMAN -->
<p class="section-title">ALAMAT PENGIRIMAN</p>
<table>
  <tr><td class="lbl">Penerima</td><td class="sep">:</td><td class="val">{{ $order->shipping_name }}</td></tr>
  <tr><td class="lbl">Telepon</td><td class="sep">:</td><td class="val">{{ $order->shipping_phone }}</td></tr>
  <tr><td class="lbl" style="vertical-align:top">Alamat</td><td class="sep" style="vertical-align:top">:</td><td class="val">{{ $order->shipping_address }}</td></tr>
  <tr><td class="lbl">Kota</td><td class="sep">:</td><td class="val">{{ $order->shipping_city }}</td></tr>
  <tr><td class="lbl">Provinsi</td><td class="sep">:</td><td class="val">{{ $order->shipping_province }}</td></tr>
  <tr><td class="lbl">Kode Pos</td><td class="sep">:</td><td class="val">{{ $order->shipping_postal_code }}</td></tr>
  @if($order->notes)
  <tr><td class="lbl" style="vertical-align:top">Catatan</td><td class="sep" style="vertical-align:top">:</td><td class="val">{{ $order->notes }}</td></tr>
  @endif
</table>

<hr class="solid">

<!-- FOOTER -->
<div class="center">
  <p style="font-size:12px;font-weight:bold;margin:4px 0;">Terima kasih telah berbelanja!</p>
  <p class="footer-note">Simpan struk ini sebagai bukti pembelian.</p>
  <p class="footer-note">Barang yang sudah dibeli tidak dapat dikembalikan.</p>
  <p class="footer-note">Hubungi kami: 0812-3456-7890 (WhatsApp)</p>
  <p style="margin:6px 0 2px 0;font-size:10px;">- - - - - - - - - - - - - - - - - - - -</p>
  <p style="font-size:10px;font-weight:bold;margin:2px 0;">www.tasbagus.com</p>
  <p class="footer-note" id="ft">Dicetak: -</p>
</div>

<script>
  document.getElementById('pt').innerText = '${printedAt}';
  document.getElementById('ft').innerText = 'Dicetak: ${printedAt}';
<\/script>
</body>
</html>`;

            var pw = window.open('', '_blank', 'width=420,height=750');
            pw.document.open();
            pw.document.write(html);
            pw.document.close();
            pw.onload = function() {
                pw.focus();
                pw.print();
                setTimeout(function() { pw.close(); }, 600);
            };
        }
    </script>
    @endpush
</x-main-layout>
