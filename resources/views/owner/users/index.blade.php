<x-owner-layout>
    <x-slot name="title">Manajemen Pengguna - Owner Panel</x-slot>

    <div class="px-6 py-6 border-b bg-[#162030] relative overflow-hidden" style="border-color:rgba(249,115,22,0.1)">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-[100px] opacity-[0.03]"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-bold text-white">Manajemen <span class="text-orange-400">Pengguna</span></h1>
            <p class="text-sm text-gray-400 mt-1">Kelola semua akun pengguna, admin, dan atur perannya.</p>
        </div>
    </div>

    <div class="p-6">
        <!-- Search & Filter -->
        <form method="GET" action="{{ route('owner.users.index') }}" class="card-dark p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                       class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                <select name="role" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                    <option value="">-- Semua Role --</option>
                    <option value="user" {{ request('role')=='user'?'selected':'' }}>User</option>
                    <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                    <option value="owner" {{ request('role')=='owner'?'selected':'' }}>Owner</option>
                </select>
                <div class="flex space-x-2">
                    <button type="submit" class="btn-orange flex-1 py-3 rounded-xl text-sm font-semibold">Cari</button>
                    <a href="{{ route('owner.users.index') }}" class="btn-outline-orange px-4 py-3 rounded-xl text-sm font-semibold">Reset</a>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <div class="card-dark overflow-hidden">
            <div class="px-6 py-5" style="border-bottom:1px solid rgba(249,115,22,0.1)">
                <h2 class="text-lg font-bold text-white">Daftar Pengguna <span class="text-orange-400 text-sm font-normal ml-2">({{ $users->total() }} akun)</span></h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-dark">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Role</th>
                            <th class="px-6 py-4 text-left">Terdaftar</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $users->firstItem() + $i }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg {{ $user->role==='owner' ? 'bg-gradient-to-br from-orange-500 to-amber-600' : ($user->role==='admin' ? 'bg-gradient-to-br from-blue-500 to-cyan-500' : 'bg-gray-700') }} flex items-center justify-center text-white font-bold text-xs">
                                        {{ substr($user->name,0,1) }}
                                    </div>
                                    <span class="font-bold text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->role === 'owner')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold badge-owner uppercase">Owner</span>
                                @elseif($user->role === 'admin')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold badge-admin uppercase">Admin</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold badge-user uppercase">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role !== 'owner')
                                <div class="flex items-center justify-center space-x-2">
                                    <form method="POST" action="{{ route('owner.users.updateRole', $user) }}" class="inline">
                                        @csrf @method('PATCH')
                                        <select name="role" onchange="this.form.submit()" class="input-dark px-3 py-1.5 rounded-lg text-xs cursor-pointer">
                                            <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                        </select>
                                    </form>
                                    <form method="POST" action="{{ route('owner.users.destroy', $user) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span class="text-gray-600 text-xs italic">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data pengguna.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-800">{{ $users->links() }}</div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(btn) {
            Swal.fire({ title:'Yakin hapus akun ini?', text:'Data tidak bisa dikembalikan!', icon:'warning', showCancelButton:true, confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280', confirmButtonText:'Ya, Hapus!', cancelButtonText:'Batal', background:'#1e2d3d', color:'#e2e8f0' }).then((r) => { if(r.isConfirmed) btn.closest('form').submit(); });
        }
    </script>
    @endpush
</x-owner-layout>
