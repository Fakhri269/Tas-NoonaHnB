<x-owner-layout>
    <x-slot name="title">Log Aktivitas - Owner Panel</x-slot>

    <div class="px-6 py-6 border-b bg-[#162030] relative overflow-hidden" style="border-color:rgba(249,115,22,0.1)">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-[0.03]"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-white">Log <span class="text-orange-400">Aktivitas</span></h1>
            <p class="text-sm text-gray-400 mt-1">Catatan semua aktivitas yang dilakukan oleh Owner.</p>
        </div>
    </div>

    <div class="p-6">
        <!-- Filter -->
        <form method="GET" action="{{ route('owner.activities.index') }}" class="card-dark p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select name="action" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">-- Semua Aksi --</option>
                    <option value="login" {{ request('action')=='login'?'selected':'' }}>Login</option>
                    <option value="tambah_produk" {{ request('action')=='tambah_produk'?'selected':'' }}>Tambah Produk</option>
                    <option value="edit_produk" {{ request('action')=='edit_produk'?'selected':'' }}>Edit Produk</option>
                    <option value="hapus_produk" {{ request('action')=='hapus_produk'?'selected':'' }}>Hapus Produk</option>
                    <option value="ubah_role" {{ request('action')=='ubah_role'?'selected':'' }}>Ubah Role</option>
                    <option value="hapus_user" {{ request('action')=='hapus_user'?'selected':'' }}>Hapus User</option>
                </select>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="input-dark w-full px-4 py-3 rounded-xl text-sm" style="color-scheme:dark">
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="input-dark w-full px-4 py-3 rounded-xl text-sm" style="color-scheme:dark">
                <div class="flex space-x-2">
                    <button type="submit" class="btn-orange flex-1 py-3 rounded-xl text-sm font-semibold">Filter</button>
                    <a href="{{ route('owner.activities.index') }}" class="btn-outline-orange px-4 py-3 rounded-xl text-sm font-semibold">Reset</a>
                </div>
            </div>
        </form>

        <!-- Activity Table -->
        <div class="card-dark overflow-hidden">
            <div class="px-6 py-5" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                <h2 class="text-lg font-bold text-white">Riwayat Aktivitas <span class="text-orange-400 text-sm font-normal ml-2">({{ $activities->total() }})</span></h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left">Waktu</th>
                            <th class="px-6 py-4 text-left">Aksi</th>
                            <th class="px-6 py-4 text-left">Deskripsi</th>
                            <th class="px-6 py-4 text-left">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $act)
                        <tr>
                            <td class="px-6 py-4">
                                <p class="text-gray-300 text-sm">{{ $act->created_at->format('d M Y') }}</p>
                                <p class="text-gray-600 text-xs">{{ $act->created_at->format('H:i:s') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        'login'=>'bg-blue-500/15 text-blue-400 border-blue-500/30',
                                        'tambah_produk'=>'bg-green-500/15 text-green-400 border-green-500/30',
                                        'edit_produk'=>'bg-orange-500/15 text-orange-400 border-orange-500/30',
                                        'hapus_produk'=>'bg-red-500/15 text-red-400 border-red-500/30',
                                        'ubah_role'=>'bg-purple-500/15 text-purple-400 border-purple-500/30',
                                        'hapus_user'=>'bg-red-500/15 text-red-400 border-red-500/30',
                                    ];
                                    $cls = $colors[$act->action] ?? 'bg-gray-500/15 text-gray-400 border-gray-500/30';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $cls }} uppercase">{{ str_replace('_',' ',$act->action) }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300 text-sm">{{ $act->description }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm font-mono">{{ $act->ip_address }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                                    <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-gray-500">Belum ada aktivitas tercatat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($activities->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">{{ $activities->links() }}</div>
            @endif
        </div>
    </div>
</x-owner-layout>
