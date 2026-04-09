<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf @method('put')
        @foreach([['update_password_current_password','current_password','current-password','Password Saat Ini'],['update_password_password','password','new-password','Password Baru'],['update_password_password_confirmation','password_confirmation','new-password','Konfirmasi Password Baru']] as $f)
        <div>
            <label class="block text-gray-400 text-sm font-medium mb-2">{{ $f[3] }}</label>
            <input id="{{ $f[0] }}" type="password" name="{{ $f[1] }}" autocomplete="{{ $f[2] }}" class="w-full px-4 py-3 rounded-xl text-sm input-dark">
            @if($errors->updatePassword->get($f[1]))<p class="mt-1 text-red-400 text-xs">{{ $errors->updatePassword->first($f[1]) }}</p>@endif
        </div>
        @endforeach
        <div class="flex items-center space-x-4 pt-2">
            <button type="submit" class="px-8 py-3 rounded-xl font-semibold text-sm text-white" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">Ubah Password</button>
            @if(session('status') === 'password-updated')
            <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)" class="text-green-400 text-sm flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>Password berhasil diubah!</span>
            </p>
            @endif
        </div>
    </form>
</section>
