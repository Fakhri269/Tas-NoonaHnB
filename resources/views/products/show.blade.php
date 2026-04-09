<x-main-layout>
    <x-slot name="title">{{ $product->name }} - TasBagus</x-slot>

    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4 mt-20">
        <div class="container mx-auto px-6">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-purple-600">Produk</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-800 font-semibold">{{ $product->name }}</span>
            </div>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                    </div>
                    
                    @if($product->discount_price)
                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            <span class="font-semibold">Hemat {{ $product->discount_percentage }}%!</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                        
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $product->category->name }}
                            </span>
                            @if($product->is_featured)
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm font-semibold">
                                    Unggulan
                                </span>
                            @endif
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            @if($product->discount_price)
                                <div class="flex items-center space-x-3">
                                    <span class="text-4xl font-bold text-purple-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                    <span class="text-xl text-gray-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <span class="text-4xl font-bold text-purple-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-lg mb-2">Deskripsi</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Specifications -->
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            @if($product->brand)
                                <div>
                                    <span class="text-gray-600 text-sm">Brand:</span>
                                    <p class="font-semibold">{{ $product->brand }}</p>
                                </div>
                            @endif
                            @if($product->material)
                                <div>
                                    <span class="text-gray-600 text-sm">Material:</span>
                                    <p class="font-semibold">{{ $product->material }}</p>
                                </div>
                            @endif
                            @if($product->color)
                                <div>
                                    <span class="text-gray-600 text-sm">Warna:</span>
                                    <p class="font-semibold">{{ $product->color }}</p>
                                </div>
                            @endif
                            @if($product->size)
                                <div>
                                    <span class="text-gray-600 text-sm">Ukuran:</span>
                                    <p class="font-semibold">{{ $product->size }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Stock -->
                        <div class="mb-6">
                            @if($product->stock > 0)
                                <span class="text-green-600 font-semibold">✓ Stok Tersedia ({{ $product->stock }} pcs)</span>
                            @else
                                <span class="text-red-600 font-semibold">✗ Stok Habis</span>
                            @endif
                        </div>

                        <!-- Add to Cart Form -->
                        @auth
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Jumlah:</label>
                                        <div class="flex items-center space-x-4">
                                            <button type="button" onclick="decreaseQty()" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                                            <button type="button" onclick="increaseQty()" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">+</button>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <button type="submit" name="action" value="add_to_cart" class="w-full bg-white text-purple-600 border-2 border-purple-600 py-3 rounded-lg hover:bg-purple-50 transition font-semibold text-lg flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span>Keranjang</span>
                                        </button>
                                        <button type="submit" name="action" value="buy_now" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold text-lg flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span>Langsung Pesan</span>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-400 text-white py-4 rounded-lg cursor-not-allowed font-semibold text-lg">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-purple-600 text-white py-4 rounded-lg hover:bg-purple-700 transition font-semibold text-lg text-center">
                                Login untuk Membeli
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
                    <div class="grid md:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg card-hover">
                                <a href="{{ route('products.show', $related->slug) }}">
                                    <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                                </a>
                                <div class="p-4">
                                    <a href="{{ route('products.show', $related->slug) }}">
                                        <h3 class="font-semibold text-lg mb-2 hover:text-purple-600">{{ $related->name }}</h3>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        @if($related->discount_price)
                                            <span class="text-lg font-bold text-purple-600">Rp {{ number_format($related->discount_price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-lg font-bold text-purple-600">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                        @endif
                                        <a href="{{ route('products.show', $related->slug) }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">
                                            Lihat →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <script>
        const maxStock = {{ $product->stock }};
        
        function increaseQty() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
            }
        }
        
        function decreaseQty() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
    @endpush
</x-main-layout>
