<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf @method('patch')
        <div>
            <label class="block text-gray-400 text-sm font-medium mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 rounded-xl text-sm input-dark">
            @if($errors->get('name'))<p class="mt-1 text-red-400 text-xs">{{ $errors->first('name') }}</p>@endif
        </div>
        <div>
            <label class="block text-gray-400 text-sm font-medium mb-2">Alamat Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl text-sm input-dark">
            @if($errors->get('email'))<p class="mt-1 text-red-400 text-xs">{{ $errors->first('email') }}</p>@endif
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 px-4 py-3 rounded-xl text-sm" style="background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); color:#fde047">
                Email belum diverifikasi.
                <button form="send-verification" class="underline font-semibold ml-1">Kirim ulang verifikasi</button>
                @if(session('status') === 'verification-link-sent')
                <p class="mt-1 text-green-400 text-xs">Link verifikasi telah dikirim!</p>
                @endif
            </div>
            @endif
        </div>
        <div class="flex items-center space-x-4 pt-2">
            <button type="submit" class="btn-orange px-8 py-3 rounded-xl font-semibold text-sm">Simpan Perubahan</button>
            @if(session('status') === 'profile-updated')
            <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)" class="text-green-400 text-sm flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>Tersimpan!</span>
            </p>
            @endif
        </div>
    </form>
</section>
