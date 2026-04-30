<x-admin-layout>
    <x-slot name="title">Admin Dashboard - Tas NoonaHnB</x-slot>

    @push('styles')
    <style>
        .stat-card { transition: transform 0.3s, box-shadow 0.3s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .rank-1 { background: #f97316; }
        .rank-2 { background: #94a3b8; }
        .rank-3 { background: #cd7f32; }
        .rank-other { background: rgba(255,255,255,0.08); }
        select option { background: #162030; color: #e2e8f0; }
    </style>
    @endpush

    <!-- Header -->
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030] bg-opacity-50">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white">Dashboard <span class="text-orange-500">Statistik</span></h1>
                <p class="text-sm text-gray-400 mt-1">Ringkasan performa penjualan dan statistik Tas NoonaHnB.</p>
            </div>
            <a href="{{ route('dashboard') }}" target="_blank" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm font-semibold flex items-center space-x-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Lihat Website</span>
            </a>
        </div>
    </div>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">

            <!-- ── STATS ── -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
                <div class="stat-card card-dark p-5 lg:col-span-2">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(249,115,22,0.15);border:1px solid rgba(249,115,22,0.3)">
                        <svg class="w-5 h-5" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-xs mt-1">Total Pendapatan</p>
                </div>

                <div class="stat-card card-dark p-5">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(249,115,22,0.12);border:1px solid rgba(249,115,22,0.2)">
                        <svg class="w-5 h-5" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-xs mt-1">Bulan Ini</p>
                </div>

                <div class="stat-card card-dark p-5">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3)">
                        <svg class="w-5 h-5" style="color:#3b82f6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">{{ $totalOrders }}</p>
                    <p class="text-gray-500 text-xs mt-1">Total Pesanan</p>
                </div>

                <div class="stat-card card-dark p-5">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(168,85,247,0.15);border:1px solid rgba(168,85,247,0.3)">
                        <svg class="w-5 h-5" style="color:#a855f7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">{{ $totalProducts }}</p>
                    <p class="text-gray-500 text-xs mt-1">Produk Aktif</p>
                </div>

                <div class="stat-card card-dark p-5">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.3)">
                        <svg class="w-5 h-5" style="color:#22c55e" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
                    <p class="text-gray-500 text-xs mt-1">Total User</p>
                </div>

                <div class="stat-card card-dark p-5">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:rgba(234,179,8,0.15);border:1px solid rgba(234,179,8,0.3)">
                        <svg class="w-5 h-5" style="color:#eab308" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">{{ $pendingOrders }}</p>
                    <p class="text-gray-500 text-xs mt-1">Pending</p>
                </div>
            </div>

            <!-- ── FILTER ── -->
            <form method="GET" action="{{ route('admin.dashboard') }}" class="card-dark p-5 mb-8 flex flex-wrap items-center gap-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-400 text-sm font-medium">Filter Periode:</span>
                </div>
                <select name="month" class="input-dark px-4 py-2 rounded-xl text-sm">
                    @php
                        $fullMonthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    @endphp
                    @foreach($fullMonthNames as $i => $mn)
                    <option value="{{ $i+1 }}" {{ $month == $i+1 ? 'selected' : '' }}>{{ $mn }}</option>
                    @endforeach
                </select>
                <select name="year" class="input-dark px-4 py-2 rounded-xl text-sm">
                    @foreach($years as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-orange px-6 py-2 rounded-xl text-sm font-semibold">Tampilkan</button>
                <span class="text-gray-600 text-xs ml-auto">
                    Data: {{ $fullMonthNames[$month-1] }} {{ $year }}
                </span>
            </form>

            <!-- ── CHART HARIAN ── -->
            <div class="card-dark p-6 mb-8">
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <div>
                        <h2 class="text-lg font-bold text-white">Rekap Penjualan Harian</h2>
                        <p class="text-gray-500 text-sm">Tanggal 1 – {{ $daysInMonth }}, {{ $fullMonthNames[$month-1] }} {{ $year }}</p>
                    </div>
                    <div class="flex items-center space-x-4 text-xs">
                        <span class="flex items-center space-x-2">
                            <span class="w-4 h-3 rounded inline-block" style="background:#f97316"></span>
                            <span class="text-gray-400">Pendapatan (Rp)</span>
                        </span>
                        <span class="flex items-center space-x-2">
                            <span class="w-4 h-0.5 rounded inline-block" style="background:#3b82f6"></span>
                            <span class="text-gray-400">Jumlah Pesanan</span>
                        </span>
                    </div>
                </div>
                <div style="position:relative;height:320px">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>

            <!-- ── CHART BULANAN ── -->
            <div class="card-dark p-6 mb-8">
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <div>
                        <h2 class="text-lg font-bold text-white">Rekap Penjualan Bulanan</h2>
                        <p class="text-gray-500 text-sm">Januari – Desember {{ $year }}</p>
                    </div>
                    <span class="flex items-center space-x-2 text-xs">
                        <span class="w-4 h-3 rounded inline-block" style="background:#f97316"></span>
                        <span class="text-gray-400">Pendapatan per Bulan</span>
                    </span>
                </div>
                <div style="position:relative;height:320px">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <!-- ── BOTTOM ROW ── -->
            <div class="grid lg:grid-cols-2 gap-8">

                <!-- Top Products -->
                <div class="card-dark overflow-hidden">
                    <div class="px-6 py-5" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                        <h2 class="text-lg font-bold text-white">Produk Terlaris</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @php $maxQty = $topProducts->max('total_qty') ?: 1; @endphp
                        @forelse($topProducts as $i => $p)
                        @php
                            $barPct = round(($p->total_qty / $maxQty) * 100);
                            if ($i === 0)      $rankClass = 'rank-1';
                            elseif ($i === 1)  $rankClass = 'rank-2';
                            elseif ($i === 2)  $rankClass = 'rank-3';
                            else               $rankClass = 'rank-other';
                        @endphp
                        <div class="flex items-center space-x-4">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold text-white flex-shrink-0 {{ $rankClass }}">
                                {{ $i + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-semibold truncate">{{ $p->product_name }}</p>
                                <div class="flex items-center space-x-3 mt-1">
                                    <div class="flex-1 h-1.5 rounded-full" style="background:rgba(255,255,255,0.06)">
                                        <div class="h-1.5 rounded-full" style="width:{{ $barPct }}%;background:linear-gradient(90deg,#f97316,#ea580c)"></div>
                                    </div>
                                    <span class="text-gray-500 text-xs flex-shrink-0">{{ $p->total_qty }} terjual</span>
                                </div>
                            </div>
                            <p class="text-orange-400 text-sm font-bold flex-shrink-0">
                                Rp {{ number_format($p->total_revenue, 0, ',', '.') }}
                            </p>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-sm">Belum ada data penjualan</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card-dark overflow-hidden">
                    <div class="px-6 py-5 flex justify-between items-center" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                        <h2 class="text-lg font-bold text-white">Pesanan Terbaru</h2>
                        <a href="{{ route('orders.index') }}" class="text-orange-400 hover:text-orange-300 text-xs font-medium transition-colors">Lihat Semua →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full table-dark">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left">Pesanan</th>
                                    <th class="px-4 py-3 text-left">User</th>
                                    <th class="px-4 py-3 text-left">Total</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="text-orange-400 text-xs font-semibold">#{{ $order->order_number }}</p>
                                        <p class="text-gray-600 text-xs">{{ $order->created_at->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-gray-300 text-xs">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-white text-xs font-semibold">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($order->status === 'pending')
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold badge-pending">Pending</span>
                                        @elseif($order->status === 'processing')
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold badge-processing">Proses</span>
                                        @elseif($order->status === 'shipped')
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold badge-shipped">Kirim</span>
                                        @elseif($order->status === 'delivered')
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold badge-delivered">Selesai</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold badge-cancelled">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';
        Chart.defaults.font.family = 'Poppins, sans-serif';

        // Data passed from PHP
        var dailyLabels    = {{ Js::from($dailyLabels) }};
        var dailyRevenue   = {{ Js::from($dailyRevenue) }};
        var dailyOrders    = {{ Js::from($dailyOrders) }};
        var monthlyLabels  = {{ Js::from($monthlyLabels) }};
        var monthlyRevenue = {{ Js::from($monthlyRevenue) }};
        var monthlyOrders  = {{ Js::from($monthlyOrders) }};

        function fmtRp(v) {
            if (v >= 1000000) return 'Rp ' + (v / 1000000).toFixed(1) + 'jt';
            if (v >= 1000)    return 'Rp ' + (v / 1000).toFixed(0) + 'rb';
            return 'Rp ' + v;
        }

        var ttStyle = {
            backgroundColor: 'rgba(15,25,35,0.97)',
            borderColor: 'rgba(249,115,22,0.4)',
            borderWidth: 1,
            padding: 12,
            titleColor: '#f97316',
            bodyColor: '#e2e8f0',
            cornerRadius: 10,
        };

        // ── Daily Chart ────────────────────────────────────────
        var dCtx = document.getElementById('dailyChart').getContext('2d');
        var dGrad = dCtx.createLinearGradient(0, 0, 0, 320);
        dGrad.addColorStop(0, 'rgba(249,115,22,0.9)');
        dGrad.addColorStop(1, 'rgba(249,115,22,0.25)');

        new Chart(dCtx, {
            type: 'bar',
            data: {
                labels: dailyLabels.map(function(d) { return 'Tgl ' + d; }),
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: dailyRevenue,
                        backgroundColor: dGrad,
                        borderColor: '#f97316',
                        borderWidth: 1,
                        borderRadius: 5,
                        borderSkipped: false,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Pesanan',
                        data: dailyOrders,
                        type: 'line',
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.07)',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#162030',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: Object.assign({}, ttStyle, {
                        callbacks: {
                            label: function(ctx) {
                                if (ctx.datasetIndex === 0)
                                    return '  Pendapatan: Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                                return '  Pesanan: ' + ctx.parsed.y + ' order';
                            }
                        }
                    })
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(255,255,255,0.04)' },
                        ticks: { color: '#64748b', font: { size: 10 }, maxRotation: 45 }
                    },
                    y: {
                        position: 'left',
                        grid: { color: 'rgba(255,255,255,0.04)' },
                        ticks: { color: '#f97316', font: { size: 11 }, callback: fmtRp }
                    },
                    y1: {
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { color: '#3b82f6', font: { size: 11 } }
                    }
                }
            }
        });

        // ── Monthly Chart ──────────────────────────────────────
        var mCtx = document.getElementById('monthlyChart').getContext('2d');
        var mGrad = mCtx.createLinearGradient(0, 0, 0, 320);
        mGrad.addColorStop(0, 'rgba(249,115,22,0.95)');
        mGrad.addColorStop(1, 'rgba(249,115,22,0.3)');

        new Chart(mCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: monthlyRevenue,
                    backgroundColor: mGrad,
                    borderColor: '#f97316',
                    borderWidth: 1,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: Object.assign({}, ttStyle, {
                        callbacks: {
                            label: function(ctx) {
                                return '  Pendapatan: Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                            },
                            afterLabel: function(ctx) {
                                return '  Pesanan: ' + monthlyOrders[ctx.dataIndex] + ' order';
                            }
                        }
                    })
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(255,255,255,0.04)' },
                        ticks: { color: '#94a3b8', font: { size: 12 } }
                    },
                    y: {
                        grid: { color: 'rgba(255,255,255,0.04)' },
                        ticks: { color: '#f97316', font: { size: 11 }, callback: fmtRp }
                    }
                }
            }
        });
    </script>
    @endpush
</x-admin-layout>
