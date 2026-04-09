<section>
    <p class="text-gray-500 text-sm mb-5">Setelah akun dihapus, semua data akan dihapus secara permanen. Pastikan Anda sudah mengunduh data yang diperlukan.</p>
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-6 py-3 rounded-xl font-semibold text-sm text-white flex items-center space-x-2" style="background:linear-gradient(135deg,#ef4444,#b91c1c)">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        <span>Hapus Akun</span>
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8" style="background:#162030">
            @csrf @method('delete')
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(239,68,68,0.15)">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-white">Hapus Akun?</h2>
            </div>
            <p class="text-gray-400 text-sm mb-6">Tindakan ini tidak dapat dibatalkan. Masukkan password untuk konfirmasi.</p>
            <div class="mb-6">
                <label class="block text-gray-400 text-sm font-medium mb-2">Password</label>
                <input id="password" name="password" type="password" class="w-full px-4 py-3 rounded-xl text-sm input-dark" placeholder="Masukkan password Anda">
                @if($errors->userDeletion->get('password'))<p class="mt-1 text-red-400 text-xs">{{ $errors->userDeletion->first('password') }}</p>@endif
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl text-sm font-semibold text-gray-400 transition-colors hover:text-white" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1)">Batal</button>
                <button type="submit" class="px-6 py-3 rounded-xl text-sm font-semibold text-white" style="background:linear-gradient(135deg,#ef4444,#b91c1c)">Hapus Akun</button>
            </div>
        </form>
    </x-modal>
</section>
