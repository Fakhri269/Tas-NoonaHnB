<x-main-layout>
    <x-slot name="title">Dashboard - Tas NoonaHnB</x-slot>

    <!-- Hero -->
    <section class="hero-gradient py-16 relative">
        <div class="absolute top-0 right-0 w-80 h-80 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.06) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-2xl btn-orange flex items-center justify-center text-3xl font-bold text-white shadow-2xl">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Selamat datang kembali 👋</p>
                    <h1 class="text-3xl font-bold text-white">{{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            @php
                $totalOrders     = \App\Models\Order::where('user_id', Auth::id())->count();
                $pendingOrders   = \App\Models\Order::where('user_id', Auth::id())->where('status', 'pending')->count();
                $processingOrders= \App\Models\Order::where('user_id', Auth::id())->where('status', 'processing')->count();
                $cartItems       = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
            @endphp

            <!-- Stats Cards -->
            <div class="grid md:grid-cols-4 gap-5 -mt-8 mb-10">
                <!-- Total Pesanan -->
                <div class="card-dark p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-medium mb-1">Total Pesanan</p>
                            <p class="text-4xl font-bold text-white">{{ $totalOrders }}</p>
                            <p class="text-gray-600 text-xs mt-1">Semua waktu</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background:rgba(249,115,22,0.15);border:1px solid rgba(249,115,22,0.25)">
                            <svg class="w-7 h-7" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Menunggu -->
                <div class="card-dark p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-medium mb-1">Menunggu</p>
                            <p class="text-4xl font-bold text-white">{{ $pendingOrders }}</p>
                            <p class="text-gray-600 text-xs mt-1">Perlu pembayaran</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background:rgba(234,179,8,0.15);border:1px solid rgba(234,179,8,0.25)">
                            <svg class="w-7 h-7" style="color:#eab308" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Diproses -->
                <div class="card-dark p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-medium mb-1">Diproses</p>
                            <p class="text-4xl font-bold text-white">{{ $processingOrders }}</p>
                            <p class="text-gray-600 text-xs mt-1">Sedang disiapkan</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.25)">
                            <svg class="w-7 h-7" style="color:#3b82f6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Keranjang -->
                <div class="card-dark p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-medium mb-1">Keranjang</p>
                            <p class="text-4xl font-bold text-white">{{ $cartItems }}</p>
                            <p class="text-gray-600 text-xs mt-1">Item tersimpan</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.25)">
                            <svg class="w-7 h-7" style="color:#22c55e" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card-dark p-6 mb-8">
                <h2 class="text-lg font-bold text-white mb-5">Aksi Cepat</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('products.index') }}" class="flex flex-col items-center space-y-3 p-5 rounded-2xl transition-all duration-300 hover:scale-105 group" style="background:rgba(249,115,22,0.08);border:1px solid rgba(249,115,22,0.15)">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(249,115,22,0.2)">
                            <svg class="w-6 h-6" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-300">Belanja</span>
                    </a>

                    <a href="{{ route('cart.index') }}" class="flex flex-col items-center space-y-3 p-5 rounded-2xl transition-all duration-300 hover:scale-105 group" style="background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.15)">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(34,197,94,0.2)">
                            <svg class="w-6 h-6" style="color:#22c55e" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-300">Keranjang</span>
                    </a>

                    <a href="{{ route('orders.index') }}" class="flex flex-col items-center space-y-3 p-5 rounded-2xl transition-all duration-300 hover:scale-105 group" style="background:rgba(59,130,246,0.08);border:1px solid rgba(59,130,246,0.15)">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(59,130,246,0.2)">
                            <svg class="w-6 h-6" style="color:#3b82f6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-300">Pesanan</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center space-y-3 p-5 rounded-2xl transition-all duration-300 hover:scale-105 group" style="background:rgba(168,85,247,0.08);border:1px solid rgba(168,85,247,0.15)">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(168,85,247,0.2)">
                            <svg class="w-6 h-6" style="color:#a855f7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-300">Profil</span>
                    </a>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-2 card-dark overflow-hidden">
                    <div class="px-6 py-5 flex justify-between items-center" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                        <h2 class="text-lg font-bold text-white">Pesanan Terbaru</h2>
                        <a href="{{ route('orders.index') }}" class="text-orange-400 hover:text-orange-300 text-sm font-medium transition-colors flex items-center space-x-1">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>

                    @php
                        $recentOrders = \App\Models\Order::where('user_id', Auth::id())->with('items')->latest()->take(5)->get();
                    @endphp

                    @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-dark">
                            <thead>
                                <tr>
                                    <th class="px-6 py-4 text-left">No. Pesanan</th>
                                    <th class="px-6 py-4 text-left">Total</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-4">
                                        <p class="text-orange-400 font-semibold text-sm">#{{ $order->order_number }}</p>
                                        <p class="text-gray-600 text-xs">{{ $order->created_at->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-white font-semibold text-sm">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
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
                                    <td class="px-6 py-4">
                                        <a href="{{ route('orders.show', $order) }}" class="btn-orange px-4 py-2 rounded-lg text-xs font-semibold">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 mb-4">Belum ada pesanan</p>
                        <a href="{{ route('products.index') }}" class="btn-orange px-6 py-3 rounded-xl text-sm font-semibold inline-block">Mulai Belanja</a>
                    </div>
                    @endif
                </div>

                <!-- Featured Products -->
                <div class="card-dark overflow-hidden">
                    <div class="px-6 py-5" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                        <h2 class="text-lg font-bold text-white">Produk Unggulan</h2>
                    </div>
                    @php
                        $featuredProducts = \App\Models\Product::where('is_featured', true)->where('is_active', true)->take(4)->get();
                    @endphp
                    <div class="p-4 space-y-3">
                        @foreach($featuredProducts as $product)
                        <a href="{{ route('products.show', $product->slug) }}" class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-300 hover:scale-[1.02]" style="background:rgba(249,115,22,0.04);border:1px solid rgba(249,115,22,0.08)">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-14 h-14 object-cover rounded-xl flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold truncate">{{ $product->name }}</p>
                                <p class="text-orange-400 text-sm font-bold">Rp {{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                        @endforeach
                        <a href="{{ route('products.index') }}" class="block w-full text-center btn-orange py-3 rounded-xl text-sm font-semibold mt-2">Lihat Semua Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
