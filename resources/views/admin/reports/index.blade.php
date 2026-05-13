<x-admin-layout>
    <x-slot name="title">Laporan Penjualan - Tas NoonaHnB</x-slot>

    @push('styles')
    <style>
        /* Fix input date di dark theme — teks tidak terlihat */
        .date-input {
            color-scheme: dark;
            color: #e2e8f0 !important;
        }
        .date-input::-webkit-datetime-edit { color: #e2e8f0; }
        .date-input::-webkit-datetime-edit-fields-wrapper { color: #e2e8f0; }
        .date-input::-webkit-datetime-edit-text { color: #94a3b8; }
        .date-input::-webkit-datetime-edit-month-field { color: #e2e8f0; }
        .date-input::-webkit-datetime-edit-day-field   { color: #e2e8f0; }
        .date-input::-webkit-datetime-edit-year-field  { color: #e2e8f0; }
        .date-input::-webkit-calendar-picker-indicator {
            filter: invert(0.8) sepia(0.3) saturate(3) hue-rotate(10deg);
            cursor: pointer;
            opacity: 0.8;
        }
        .date-input::-webkit-calendar-picker-indicator:hover { opacity: 1; }
    </style>
    @endpush

    <!-- Header -->
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030]">
        <h1 class="text-2xl font-bold text-white">Laporan <span style="color:var(--orange)">Penjualan</span></h1>
        <p class="text-sm text-gray-400 mt-1">Analisis data penjualan dan laporan omzet toko Anda.</p>
    </div>

    <div class="p-6">
        <div class="space-y-6">

            <!-- ── RINGKASAN ── -->
            <div class="grid grid-cols-3 gap-5 mb-8">
                <div class="card-dark p-5 text-center">
                    <p class="text-3xl font-bold text-white">{{ $totalOrder }}</p>
                    <p class="text-gray-500 text-sm mt-1">Total Pesanan</p>
                </div>
                <div class="card-dark p-5 text-center">
                    <p class="text-3xl font-bold text-white">{{ $totalItem }}</p>
                    <p class="text-gray-500 text-sm mt-1">Total Item Terjual</p>
                </div>
                <div class="card-dark p-5 text-center">
                    <p class="text-2xl font-bold text-orange-400">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm mt-1">Total Omzet</p>
                </div>
            </div>

            <!-- ── FILTER ── -->
            <form method="GET" action="{{ route('admin.reports.index') }}" class="card-dark p-6 mb-8">
                <h3 class="text-white font-bold mb-5 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path>
                    </svg>
                    <span>Filter Laporan</span>
                </h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <!-- Pencarian -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="No. pesanan / nama pelanggan..."
                               class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                    </div>

                    <!-- Tanggal Dari -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tanggal Dari</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                    </div>

                    <!-- Tanggal Sampai -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tanggal Sampai</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                    </div>

                    <!-- Tanggal Tunggal -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Per Tanggal</label>
                        <input type="date" name="single_date" value="{{ request('single_date') }}"
                               class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                    </div>

                    <!-- Bulan -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Bulan</label>
                        <select name="month" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                            <option value="">-- Semua Bulan --</option>
                            @foreach($monthNames as $num => $name)
                            <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tahun</label>
                        <select name="year" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Kategori Produk</label>
                        <select name="category_id" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                            <option value="">-- Semua Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="btn-orange flex-1 py-3 rounded-xl text-sm font-semibold">
                            Tampilkan
                        </button>
                        <a href="{{ route('admin.reports.index') }}" class="btn-outline-orange px-4 py-3 rounded-xl text-sm font-semibold">
                            Reset
                        </a>
                    </div>
                </div>

                <!-- Tombol Download -->
                <div class="border-t pt-4 mt-2 flex flex-wrap gap-3" style="border-color:rgba(249,115,22,0.1)">
                    <p class="text-gray-500 text-xs self-center w-full mb-1">Unduh laporan sesuai filter aktif:</p>

                    <a href="{{ route('admin.reports.pdf', request()->query()) }}" target="_blank"
                       class="flex items-center space-x-2 px-5 py-2 rounded-xl text-sm font-semibold text-white transition-all hover:scale-105"
                       style="background:linear-gradient(135deg,#ef4444,#b91c1c)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>Cetak / PDF</span>
                    </a>

                    <a href="{{ route('admin.reports.excel', request()->query()) }}"
                       class="flex items-center space-x-2 px-5 py-2 rounded-xl text-sm font-semibold text-white transition-all hover:scale-105"
                       style="background:linear-gradient(135deg,#16a34a,#15803d)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span>Unduh CSV/Excel</span>
                    </a>
                </div>
            </form>

            <!-- ── TABEL DATA ── -->
            <div class="card-dark overflow-hidden">
                <div class="px-6 py-5 flex justify-between items-center" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                    <h2 class="text-lg font-bold text-white">
                        Daftar Laporan
                        <span class="text-orange-400 text-sm font-normal ml-2">({{ $orders->total() }} data)</span>
                    </h2>
                </div>

                @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-dark">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">No. Pesanan</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Pelanggan</th>
                                <th class="px-4 py-3 text-left">Produk</th>
                                <th class="px-4 py-3 text-left">Metode Bayar</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $i => $order)
                            <tr>
                                <td class="px-4 py-3 text-gray-500 text-sm">{{ $orders->firstItem() + $i }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('orders.show', $order) }}" class="text-orange-400 font-semibold text-sm hover:text-orange-300 transition-colors">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-300 text-sm">{{ $order->created_at->format('d M Y') }}</p>
                                    <p class="text-gray-600 text-xs">{{ $order->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-300 text-sm">{{ $order->user->name ?? $order->shipping_name }}</p>
                                    <p class="text-gray-600 text-xs">{{ $order->shipping_city }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-gray-400 text-xs">{{ $order->items->count() }} produk</p>
                                    <p class="text-gray-600 text-xs">{{ $order->items->sum('quantity') }} item</p>
                                </td>
                                <td class="px-4 py-3 text-gray-300 text-sm">{{ $order->payment_method }}</td>
                                <td class="px-4 py-3">
                                    @if($order->payment_status === 'paid')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold badge-delivered">Lunas</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold badge-pending">Belum Bayar</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <p class="text-white font-bold text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="border-top:2px solid rgba(249,115,22,0.3)">
                                <td colspan="7" class="px-4 py-4 text-right text-gray-400 font-semibold text-sm">Total Omzet (halaman ini):</td>
                                <td class="px-4 py-4 text-right text-orange-400 font-bold">
                                    Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="p-6">{{ $orders->links() }}</div>
                @else
                <div class="p-16 text-center">
                    <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500">Tidak ada data laporan untuk filter yang dipilih.</p>
                </div>
                @endif
            </div>

        </div>
    </section>
</x-main-layout>
