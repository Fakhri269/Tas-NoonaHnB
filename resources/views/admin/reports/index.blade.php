<x-admin-layout>
    <x-slot name="title">Laporan Bulanan - Admin Panel</x-slot>

    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Cetak Laporan Bulanan</h1>
        </div>

        <div class="card-dark p-6 rounded-2xl border border-gray-800 shadow-xl max-w-2xl">
            <h2 class="text-xl font-bold mb-6 text-white border-b border-gray-800 pb-4">Pilih Periode Laporan</h2>
            
            <form action="{{ route('admin.reports.pdf') }}" method="GET" target="_blank" class="space-y-6">
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Bulan <span class="text-red-500">*</span></label>
                        <select name="month" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                            @php
                                $months = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                            @endphp
                            @foreach($months as $value => $label)
                                <option value="{{ $value }}" {{ date('n') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Tahun <span class="text-red-500">*</span></label>
                        <select name="year" required class="w-full px-4 py-3 bg-[#1e2d3d] border border-gray-700 rounded-xl text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
                            @php $currentYear = date('Y'); @endphp
                            @for($i = $currentYear; $i >= $currentYear - 5; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <button type="submit" class="btn-orange px-6 py-3 rounded-xl font-bold text-sm shadow-lg flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        <span>Cetak PDF</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
