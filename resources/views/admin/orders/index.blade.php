<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030]">
        <h1 class="text-2xl font-bold text-white">Manajemen <span style="color:var(--orange)">Pesanan</span></h1>
        <p class="text-sm text-gray-400 mt-1">Daftar semua pesanan yang masuk ke toko Anda.</p>
    </div>

    <div class="p-6">
        <div class="card-dark overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left">Order ID</th>
                            <th class="px-6 py-4 text-left">Pelanggan</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Total Pembayaran</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="font-bold text-orange-400">#{{ $order->order_number }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white font-medium text-sm">{{ $order->user->name ?? $order->shipping_name }}</p>
                                <p class="text-gray-500 text-xs">{{ $order->shipping_city }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-white">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                                @if($order->payment_status === 'paid')
                                    <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-green-500/20 text-green-400">PAID</span>
                                @else
                                    <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-orange-500/20 text-orange-400 border border-orange-500/30 uppercase">{{ $order->payment_status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($order->status === 'pending')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-pending">Menunggu</span>
                                @elseif($order->status === 'processing')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-processing">Diproses</span>
                                @elseif($order->status === 'shipped')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-shipped">Dikirim</span>
                                @elseif($order->status === 'delivered')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-delivered">Selesai</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-cancelled">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-[#1e2d3d] hover:bg-orange-500/20 text-gray-300 hover:text-orange-400 rounded-lg transition-colors text-sm font-medium border border-gray-700 hover:border-orange-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                Belum ada pesanan yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
