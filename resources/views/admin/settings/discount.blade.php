<x-admin-layout>
    <x-slot name="title">Pengaturan Diskon - Tas NoonaHnB</x-slot>

    <div class="px-6 py-6 border-b border-gray-800 bg-[#162030]">
        <h1 class="text-2xl font-bold text-white">Pengaturan <span style="color:var(--orange)">Diskon</span></h1>
        <p class="text-sm text-gray-400 mt-1">Atur event diskon tanpa keluar dari panel admin.</p>
    </div>

    <div class="p-6">
        <div class="card-dark p-8">
                <h2 class="text-xl font-bold text-white mb-6">Konfigurasi Diskon Event</h2>

                <form method="POST" action="{{ route('admin.settings.discount.update') }}">
                    @csrf

                    <div class="space-y-5">
                        <!-- Aktifkan Diskon -->
                        <div class="flex items-center justify-between p-4 rounded-xl" style="background:rgba(249,115,22,0.05);border:1px solid rgba(249,115,22,0.1)">
                            <div>
                                <p class="text-white font-semibold">Aktifkan Diskon</p>
                                <p class="text-gray-500 text-sm">Aktifkan atau nonaktifkan diskon event</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="enabled" value="1" class="sr-only peer"
                                    {{ $discountSettings['enabled'] ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                            </label>
                        </div>

                        <!-- Label Diskon -->
                        <div>
                            <label class="block text-gray-400 text-sm font-semibold mb-2">Nama / Label Diskon</label>
                            <input type="text" name="label" value="{{ old('label', $discountSettings['label']) }}"
                                   class="input-dark w-full px-4 py-3 rounded-xl text-sm"
                                   placeholder="Contoh: Diskon Lebaran">
                            @error('label')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Minimum Pembelian -->
                        <div>
                            <label class="block text-gray-400 text-sm font-semibold mb-2">Minimum Pembelian (Rp)</label>
                            <input type="number" name="threshold" value="{{ old('threshold', $discountSettings['threshold']) }}"
                                   class="input-dark w-full px-4 py-3 rounded-xl text-sm" min="0"
                                   placeholder="Contoh: 200000">
                            @error('threshold')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Persentase Diskon -->
                        <div>
                            <label class="block text-gray-400 text-sm font-semibold mb-2">Persentase Diskon (%)</label>
                            <input type="number" name="percentage" value="{{ old('percentage', $discountSettings['percentage']) }}"
                                   class="input-dark w-full px-4 py-3 rounded-xl text-sm" min="0" max="100"
                                   placeholder="Contoh: 10">
                            @error('percentage')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center space-x-3">
                        <button type="submit" class="btn-orange px-8 py-3 rounded-xl font-semibold">
                            Simpan Pengaturan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline-orange px-6 py-3 rounded-xl font-semibold text-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-main-layout>
