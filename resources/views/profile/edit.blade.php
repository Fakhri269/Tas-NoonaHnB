@if(Auth::user()->isAdmin())
<x-admin-layout>
    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030] flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-white">Profil <span class="text-orange-400">Admin</span></h1>
            <p class="text-sm text-gray-400 mt-1">Kelola data login dan privasi akun Anda.</p>
        </div>
    </div>

    <div class="p-6">
        <div class="max-w-4xl space-y-6">
            <!-- Profile Info Form -->
            <div class="card-dark p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(249,115,22,0.15)">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Informasi Profil</h2>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Password Form -->
            <div class="card-dark p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(59,130,246,0.15)">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Ubah Password</h2>
                </div>
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</x-admin-layout>
@else
<x-main-layout>
    <x-slot name="title">Profil Saya - TasBagus</x-slot>

    <section class="hero-gradient py-14 relative">
        <div class="absolute top-0 right-0 w-64 h-64 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.07) 0%,transparent 70%);border-radius:50%;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 flex items-center space-x-4">
            <div class="w-16 h-16 rounded-2xl btn-orange flex items-center justify-center text-3xl font-bold text-white shadow-2xl">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-1">Akun Saya</p>
                <h1 class="text-3xl font-bold text-white">{{ Auth::user()->name }}</h1>
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="max-w-4xl mx-auto px-6 space-y-6">
            <!-- User Info Card -->
            <div class="card-dark p-6 flex items-center space-x-5">
                <div class="w-20 h-20 rounded-2xl btn-orange flex items-center justify-center text-4xl font-bold text-white shadow-2xl flex-shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-400">{{ Auth::user()->email }}</p>
                    <div class="flex items-center space-x-3 mt-2">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold badge-delivered">✓ Terverifikasi</span>
                        <span class="text-gray-600 text-xs">Bergabung {{ Auth::user()->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Profile Info Form -->
            <div class="card-dark p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(249,115,22,0.15)">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Informasi Profil</h2>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Password Form -->
            <div class="card-dark p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(59,130,246,0.15)">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Ubah Password</h2>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="card-dark p-6" style="border-color:rgba(239,68,68,0.2)">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(239,68,68,0.15)">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-red-400">Zona Berbahaya</h2>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </section>
</x-main-layout>
@endif
