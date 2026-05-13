<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030]">
        <h1 class="text-2xl font-bold text-white">Data <span style="color:var(--orange)">Pengguna</span></h1>
        <p class="text-sm text-gray-400 mt-1">Daftar semua pengguna dan pembeli terdaftar di toko Anda.</p>
    </div>

    <div class="p-6">
        <div class="card-dark overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Peran</th>
                            <th class="px-6 py-4 text-left">Terdaftar Sejak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="font-bold text-white">{{ $user->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'owner')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 uppercase">Owner</span>
                                @elseif($user->role === 'admin')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-500/20 text-orange-400 border border-orange-500/30 uppercase">Admin</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-700 text-gray-300 uppercase">Pelanggan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
