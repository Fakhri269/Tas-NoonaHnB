<x-owner-layout>
    <x-slot name="title">Dashboard Owner - Tas NoonaHnB</x-slot>

    @push('styles')
    <style>
        @keyframes countUp { from { opacity:0; transform:translateY(10px) } to { opacity:1; transform:translateY(0) } }
        .animate-count { animation: countUp 0.6s ease-out forwards; }
        .delay-1 { animation-delay: 0.1s; opacity:0; }
        .delay-2 { animation-delay: 0.2s; opacity:0; }
        .delay-3 { animation-delay: 0.3s; opacity:0; }
        .delay-4 { animation-delay: 0.4s; opacity:0; }
    </style>
    @endpush

    <!-- Header -->
    <div class="px-6 py-6 border-b bg-[#162030] relative overflow-hidden" style="border-color:rgba(249,115,22,0.1)">
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-[0.03]"></div>
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-1">
                <svg class="w-6 h-6 text-orange-400 crown-glow" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/></svg>
                <h1 class="text-2xl font-bold text-white">Dashboard <span class="text-orange-400 text-glow">Owner</span></h1>
            </div>
            <p class="text-sm text-gray-400 mt-1">Selamat datang kembali, <span class="text-orange-300 font-medium">{{ Auth::user()->name }}</span>. Berikut ringkasan toko Anda.</p>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <!-- Stat Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $stats = [
                    ['label'=>'Total User', 'value'=>number_format($totalUsers), 'icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'color'=>'from-blue-500 to-cyan-500', 'bg'=>'bg-blue-500/10', 'text'=>'text-blue-400'],
                    ['label'=>'Total Admin', 'value'=>number_format($totalAdmins), 'icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color'=>'from-orange-500 to-amber-500', 'bg'=>'bg-orange-500/10', 'text'=>'text-orange-400'],
                    ['label'=>'Total Produk', 'value'=>number_format($totalProducts), 'icon'=>'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color'=>'from-emerald-500 to-green-500', 'bg'=>'bg-emerald-500/10', 'text'=>'text-emerald-400'],
                    ['label'=>'Total Transaksi', 'value'=>number_format($totalOrders), 'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color'=>'from-violet-500 to-purple-500', 'bg'=>'bg-violet-500/10', 'text'=>'text-violet-400'],
                ];
            @endphp
            @foreach($stats as $i => $s)
            <div class="stat-card p-5 rounded-2xl transition-all duration-300 animate-count delay-{{ $i+1 }}">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl {{ $s['bg'] }} flex items-center justify-center">
                        <svg class="w-5 h-5 {{ $s['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"></path></svg>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br {{ $s['color'] }} opacity-20 blur-sm"></div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $s['value'] }}</p>
                <p class="text-gray-500 text-xs uppercase tracking-wider font-medium">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Omzet & Pending -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="card-dark p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 rounded-full mix-blend-multiply filter blur-[60px] opacity-10"></div>
                <div class="relative z-10">
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-gray-400 text-sm font-medium">Total Omzet Keseluruhan</p>
                    </div>
                    <p class="text-3xl font-bold text-orange-400 text-glow">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="card-dark p-6">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-400 text-sm font-medium">Pesanan Menunggu</p>
                </div>
                <p class="text-3xl font-bold text-yellow-400">{{ $pendingOrders }}</p>
                <p class="text-xs text-gray-500 mt-1">Belum diproses</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="card-dark p-6">
                <h3 class="text-white font-bold mb-1">Penjualan 7 Hari Terakhir</h3>
                <p class="text-gray-500 text-xs mb-4">Omzet dan jumlah pesanan harian</p>
                <canvas id="dailyChart" height="200"></canvas>
            </div>
            <div class="card-dark p-6">
                <h3 class="text-white font-bold mb-1">Omzet Bulanan {{ now()->year }}</h3>
                <p class="text-gray-500 text-xs mb-4">Perbandingan omzet per bulan</p>
                <canvas id="monthlyChart" height="200"></canvas>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="card-dark overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                <div>
                    <h2 class="text-lg font-bold text-white">Aktivitas Terbaru</h2>
                    <p class="text-gray-500 text-xs mt-0.5">Catatan aktivitas owner terkini</p>
                </div>
                <a href="{{ route('owner.activities.index') }}" class="text-orange-400 text-sm hover:text-orange-300 transition-colors font-medium">Lihat Semua &rarr;</a>
            </div>
            <div class="p-6">
                @forelse($recentActivities as $activity)
                <div class="flex items-start space-x-4 mb-5 last:mb-0 group">
                    <div class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 mt-1.5 flex-shrink-0 shadow-sm shadow-orange-500/30 group-hover:shadow-orange-500/60 transition-shadow"></div>
                    <div class="flex-1">
                        <p class="text-gray-300 text-sm leading-relaxed">{{ $activity->description }}</p>
                        <div class="flex items-center space-x-3 mt-1.5">
                            <span class="text-gray-600 text-xs">{{ $activity->created_at->diffForHumans() }}</span>
                            <span class="text-orange-500/40 text-xs">•</span>
                            <span class="text-orange-400/60 text-xs uppercase tracking-wider font-medium">{{ str_replace('_', ' ', $activity->action) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                        <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-gray-500 text-sm">Belum ada aktivitas tercatat.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartOpts = {
            responsive: true,
            plugins: { legend: { labels: { color: '#94a3b8', font: { size: 11, family: 'Plus Jakarta Sans' }, usePointStyle: true, pointStyle: 'circle', padding: 20 } } },
            scales: {
                x: { ticks: { color: '#64748b', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.03)', drawBorder: false } },
                y: { ticks: { color: '#64748b', font: { size: 10 } }, grid: { color: 'rgba(255,255,255,0.03)', drawBorder: false } }
            }
        };

        new Chart(document.getElementById('dailyChart'), {
            type: 'bar',
            data: {
                labels: @json($dailyLabels),
                datasets: [
                    { label:'Omzet (Rp)', data:@json($dailyRevenue), backgroundColor:'rgba(249,115,22,0.25)', borderColor:'#f97316', borderWidth:2, borderRadius:8, hoverBackgroundColor:'rgba(249,115,22,0.4)' },
                    { label:'Pesanan', data:@json($dailyOrders), type:'line', borderColor:'#22c55e', backgroundColor:'rgba(34,197,94,0.08)', tension:0.4, pointBackgroundColor:'#22c55e', pointRadius:4, pointHoverRadius:6 }
                ]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label:'Omzet (Rp)', data:@json($monthlyRevenue),
                    backgroundColor: function(ctx) {
                        const g = ctx.chart.ctx.createLinearGradient(0,0,0,300);
                        g.addColorStop(0,'rgba(249,115,22,0.4)'); g.addColorStop(1,'rgba(249,115,22,0.05)');
                        return g;
                    },
                    borderColor:'#f97316', borderWidth:2, borderRadius:8
                }]
            },
            options: chartOpts
        });
    </script>
    @endpush
</x-owner-layout>
