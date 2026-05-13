<x-owner-layout>
    <x-slot name="title">Laporan Penjualan - Owner Panel</x-slot>

    @push('styles')
    <style>
        .date-input { color-scheme: dark; color: #e2e8f0 !important; }
        .date-input::-webkit-calendar-picker-indicator { filter: invert(0.7); cursor: pointer; }
    </style>
    @endpush

    <div class="px-6 py-6 border-b bg-[#162030] relative overflow-hidden" style="border-color:rgba(249,115,22,0.1)">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-[0.03]"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-white">Laporan <span class="text-orange-400">Penjualan</span></h1>
            <p class="text-sm text-gray-400 mt-1">Analisis seluruh data penjualan toko.</p>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <!-- Ringkasan -->
        <div class="grid grid-cols-3 gap-5">
            <div class="stat-card p-5 rounded-2xl text-center transition-all duration-300">
                <p class="text-3xl font-bold text-white">{{ $totalOrder }}</p>
                <p class="text-gray-500 text-xs mt-1 uppercase tracking-wider">Total Pesanan</p>
            </div>
            <div class="stat-card p-5 rounded-2xl text-center transition-all duration-300">
                <p class="text-3xl font-bold text-white">{{ $totalItem }}</p>
                <p class="text-gray-500 text-xs mt-1 uppercase tracking-wider">Item Terjual</p>
            </div>
            <div class="stat-card p-5 rounded-2xl text-center transition-all duration-300">
                <p class="text-2xl font-bold text-orange-400 text-glow">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-xs mt-1 uppercase tracking-wider">Total Omzet</p>
            </div>
        </div>

        <!-- Filter -->
        <form method="GET" action="{{ route('owner.reports.index') }}" class="card-dark p-6">
            <h3 class="text-white font-bold mb-5 flex items-center space-x-2">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path></svg>
                <span>Filter Laporan</span>
            </h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="No. pesanan / nama..." class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tanggal Dari</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tanggal Sampai</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Per Tanggal</label>
                    <input type="date" name="single_date" value="{{ request('single_date') }}" class="input-dark w-full px-4 py-3 rounded-xl text-sm date-input">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Bulan</label>
                    <select name="month" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                        <option value="">-- Semua --</option>
                        @foreach($monthNames as $num => $name)
                        <option value="{{ $num }}" {{ request('month')==$num?'selected':'' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Tahun</label>
                    <select name="year" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                        <option value="">-- Semua --</option>
                        @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('year')==$y?'selected':'' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">Kategori</label>
                    <select name="category_id" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                        <option value="">-- Semua --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="btn-orange flex-1 py-3 rounded-xl text-sm font-semibold">Tampilkan</button>
                    <a href="{{ route('owner.reports.index') }}" class="btn-outline-orange px-4 py-3 rounded-xl text-sm font-semibold">Reset</a>
                </div>
            </div>
            <div class="border-t pt-4 mt-2" style="border-color:rgba(249,115,22,0.1)">
                <a href="{{ route('owner.reports.pdf', request()->query()) }}" target="_blank" class="inline-flex items-center space-x-2 px-5 py-2 rounded-xl text-sm font-semibold text-white transition-all hover:scale-105" style="background:linear-gradient(135deg,#ef4444,#b91c1c)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Cetak / PDF</span>
                </a>
            </div>
        </form>

        <!-- Tabel -->
        <div class="card-dark overflow-hidden">
            <div class="px-6 py-5" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                <h2 class="text-lg font-bold text-white">Daftar Laporan <span class="text-orange-400 text-sm font-normal ml-2">({{ $orders->total() }} data)</span></h2>
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
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $i => $order)
                        <tr>
                            <td class="px-4 py-3 text-gray-500 text-sm">{{ $orders->firstItem()+$i }}</td>
                            <td class="px-4 py-3"><span class="text-orange-400 font-semibold text-sm">#{{ $order->order_number }}</span></td>
                            <td class="px-4 py-3">
                                <p class="text-gray-300 text-sm">{{ $order->created_at->format('d M Y') }}</p>
                                <p class="text-gray-600 text-xs">{{ $order->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="px-4 py-3 text-gray-300 text-sm">{{ $order->user->name ?? $order->shipping_name }}</td>
                            <td class="px-4 py-3 text-gray-400 text-xs">{{ $order->items->count() }} produk</td>
                            <td class="px-4 py-3">
                                @if($order->payment_status==='paid')
                                <span class="px-2 py-1 rounded-full text-xs font-semibold badge-success">Lunas</span>
                                @else
                                <span class="px-2 py-1 rounded-full text-xs font-semibold badge-warning">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right text-white font-bold text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="border-top:2px solid rgba(249,115,22,0.3)">
                            <td colspan="6" class="px-4 py-4 text-right text-gray-400 font-semibold text-sm">Total Omzet:</td>
                            <td class="px-4 py-4 text-right text-orange-400 font-bold">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="p-6">{{ $orders->links() }}</div>
            @else
            <div class="p-16 text-center">
                <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                    <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-gray-500">Tidak ada data laporan untuk filter yang dipilih.</p>
            </div>
            @endif
        </div>
    </div>
</x-owner-layout>
