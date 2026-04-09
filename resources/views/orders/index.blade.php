<x-main-layout>
    <x-slot name="title">Pesanan Saya - TasBagus</x-slot>

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
            <div class="card-dark p-16 text-center max-w-lg mx-auto">
                <div class="w-24 h-24 rounded-2xl mx-auto mb-6 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                    <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-white text-2xl font-bold mb-3">Belum Ada Pesanan</h2>
                <p class="text-gray-500 mb-8">Mulai belanja sekarang dan temukan tas impian Anda!</p>
                <a href="{{ route('products.index') }}" class="btn-orange px-8 py-4 rounded-xl font-semibold inline-block">Mulai Belanja</a>
            </div>
            @else
            <div class="card-dark overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full table-dark">
                        <thead><tr>
                            <th class="px-6 py-4 text-left">No. Pesanan</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Produk</th>
                            <th class="px-6 py-4 text-left">Total</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Pembayaran</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr></thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="text-orange-400 font-semibold text-sm">#{{ $order->order_number }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-300 text-sm">{{ $order->created_at->format('d M Y') }}</p>
                                    <p class="text-gray-600 text-xs">{{ $order->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        @if($order->items->first() && $order->items->first()->product)
                                        <img src="{{ $order->items->first()->product->image }}" class="w-10 h-10 object-cover rounded-lg">
                                        @endif
                                        <div>
                                            <p class="text-gray-300 text-sm font-medium">{{ $order->items->count() }} Produk</p>
                                            <p class="text-gray-600 text-xs">{{ $order->items->sum('quantity') }} Item</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-white font-bold text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                    <p class="text-gray-600 text-xs">{{ $order->payment_method }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-{{ $order->status }}">
                                        @if($order->status==='pending') Pending
                                        @elseif($order->status==='processing') Diproses
                                        @elseif($order->status==='shipped') Dikirim
                                        @elseif($order->status==='delivered') Selesai
                                        @else Dibatalkan @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-{{ $order->payment_status }}">
                                        {{ $order->payment_status === 'unpaid' ? 'Belum Bayar' : 'Lunas' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('orders.show', $order) }}" class="btn-orange px-4 py-2 rounded-lg text-xs font-semibold">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($orders->hasPages())
            <div class="mt-6">{{ $orders->links() }}</div>
            @endif
            @endif
        </div>
    </section>
</x-main-layout>
