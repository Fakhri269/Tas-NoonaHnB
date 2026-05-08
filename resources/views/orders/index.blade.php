<x-main-layout>
    <x-slot name="title">Pesanan Saya - Tas NoonaHnB</x-slot>

    <section class="hero-gradient py-14 relative">
        <div class="absolute top-0 right-0 w-64 h-64 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.07) 0%,transparent 70%);border-radius:50%;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Riwayat</p>
            <h1 class="text-4xl font-bold text-white mb-2">Pesanan <span class="text-orange">Saya</span></h1>
            <div class="divider"></div>
        </div>
    </section>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            @if($orders->isEmpty())
            <div class="card-dark p-16 rounded-2xl shadow-lg border border-gray-800 text-center max-w-lg mx-auto">
                <div class="w-24 h-24 rounded-2xl mx-auto mb-6 flex items-center justify-center bg-[#1e2d3d]">
                    <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-white text-2xl font-bold mb-3">Belum Ada Pesanan</h2>
                <p class="text-gray-400 mb-8">Mulai belanja sekarang dan temukan tas impian Anda!</p>
                <a href="{{ route('products.index') }}" class="btn-orange px-8 py-4 rounded-xl font-semibold inline-block transition-transform hover:scale-105">Mulai Belanja</a>
            </div>
            @else
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="card-dark p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                    <!-- Header Card -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-800 pb-4 mb-4 gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-orange-500 font-bold">#{{ $order->order_number }}</span>
                                <span class="text-gray-600 text-sm">|</span>
                                <span class="text-gray-400 text-sm flex items-center">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold badge-{{ $order->status }}">
                                    @if($order->status==='pending') Pending
                                    @elseif($order->status==='processing') Diproses
                                    @elseif($order->status==='shipped') Dikirim
                                    @elseif($order->status==='delivered') Selesai
                                    @else Dibatalkan @endif
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold badge-{{ $order->payment_status }}">
                                    {{ $order->payment_status === 'unpaid' ? 'Belum Bayar' : 'Lunas' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-left md:text-right">
                            <p class="text-gray-400 text-xs mb-1">Total Belanja</p>
                            <p class="text-white font-bold text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            <p class="text-gray-400 text-xs mt-1">via {{ strtoupper($order->payment_method) }}</p>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex items-center gap-4 flex-1 w-full">
                            @if($order->items->first() && $order->items->first()->product)
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-[#1e2d3d] border border-gray-800 flex-shrink-0">
                                <img src="{{ $order->items->first()->product->image }}" alt="Product" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg line-clamp-1">{{ $order->items->first()->product->name }}</h3>
                                <p class="text-gray-400 text-sm mt-1">
                                    {{ $order->items->first()->quantity }} barang
                                    @if($order->items->count() > 1)
                                    <span class="text-gray-400 text-xs ml-2">+{{ $order->items->count() - 1 }} produk lainnya</span>
                                    @endif
                                </p>
                            </div>
                            @else
                            <div class="w-20 h-20 rounded-xl bg-[#1e2d3d] border border-gray-800 flex-shrink-0 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">Produk Tidak Tersedia</h3>
                                <p class="text-gray-400 text-sm mt-1">
                                    {{ $order->items->sum('quantity') }} barang
                                </p>
                            </div>
                            @endif
                        </div>
                        
                        <div class="w-full md:w-auto mt-4 md:mt-0 flex justify-end">
                            <a href="{{ route('orders.show', $order) }}" class="btn-orange text-white px-6 py-3 rounded-xl font-semibold text-sm w-full md:w-auto text-center flex items-center justify-center gap-2 transition-transform hover:scale-105">
                                <span>Lihat Detail Pesanan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($orders->hasPages())
            <div class="mt-6">{{ $orders->links() }}</div>
            @endif
            @endif
        </div>
    </section>
</x-main-layout>
