<x-admin-layout>
    <x-slot name="title">Pengaturan QRIS - Admin Panel</x-slot>

    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Pengaturan QRIS</h1>
        </div>

        <div class="card-dark p-6 rounded-2xl border border-gray-800 shadow-xl max-w-2xl">
            <h2 class="text-xl font-bold mb-6 text-white border-b border-gray-800 pb-4">Upload QRIS Penjual</h2>
            
            <form action="{{ route('admin.settings.qris.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2 text-gray-300">Gambar QRIS Tersimpan</label>
                    @if(Storage::disk('public')->exists('settings/qris.png'))
                        <div class="mb-4">
                            <img src="{{ asset('storage/settings/qris.png') }}?v={{ time() }}" alt="QRIS" class="w-64 h-64 object-contain rounded-xl border border-gray-700 bg-white">
                        </div>
                    @else
                        <div class="mb-4 text-gray-500 italic">Belum ada QRIS yang diunggah.</div>
                    @endif
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2 text-gray-300">Unggah QRIS Baru <span class="text-red-500">*</span></label>
                    <input type="file" name="qris_image" required accept="image/*" class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100">
                    <p class="text-gray-500 text-xs mt-2">Format: JPG, JPEG, PNG, WEBP. Maks: 2MB.</p>
                </div>

                <button type="submit" class="btn-orange px-6 py-3 rounded-xl font-bold text-sm shadow-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Simpan QRIS</span>
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
