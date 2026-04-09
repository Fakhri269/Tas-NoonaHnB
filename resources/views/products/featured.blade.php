<x-main-layout>
    <x-slot name="title">Produk Unggulan - TasBagus</x-slot>

    <!-- Header -->
    <section class="hero-gradient text-white py-12">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold">Produk Unggulan</h1>
            <p class="text-gray-100 mt-2">Koleksi terbaik pilihan kami untuk Anda</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            @if($products->count() > 0)
                <div class="grid md:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg card-hover">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <h3 class="font-semibold text-lg mb-2 hover:text-purple-600">{{ $product->name }}</h3>
                                </a>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                                
                                <div class="flex items-center justify-between mb-3">
                                    @if($product->discount_price)
                                        <div>
                                            <span class="text-xl font-bold text-purple-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <span class="text-xl font-bold text-purple-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-purple-600 text-white text-center py-2 rounded-lg hover:bg-purple-700 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Produk Unggulan</h3>
                    <p class="text-gray-600 mb-6">Silakan cek kembali nanti</p>
                    <a href="{{ route('products.index') }}" class="bg-purple-600 text-white px-8 py-3 rounded-full hover:bg-purple-700 transition inline-block">
                        Lihat Semua Produk
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-main-layout>
