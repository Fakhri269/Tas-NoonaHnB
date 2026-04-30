<x-main-layout>
    <x-slot name="title">{{ $product->name }} - Tas NoonaHnB</x-slot>

    <!-- Breadcrumb -->
    <section class="py-4 mt-20 border-b border-gray-800" style="background:var(--dark2)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-orange-400">Beranda</a>
                <span class="text-gray-600">/</span>
                <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-orange-400">Produk</a>
                <span class="text-gray-600">/</span>
                <span class="text-white font-semibold">{{ $product->name }}</span>
            </div>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div>
                    <div class="card-dark overflow-hidden rounded-2xl">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                    </div>
                    
                    @if($product->discount_price)
                        <div class="mt-4" style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); color:#fca5a5; padding:0.75rem 1rem; border-radius:0.5rem;">
                            <span class="font-semibold">Hemat {{ $product->discount_percentage }}%!</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <div class="card-dark rounded-2xl p-8">
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $product->name }}</h1>
                        
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold" style="background:rgba(249,115,22,0.1); color:var(--orange)">
                                {{ $product->category->name }}
                            </span>
                            @if($product->is_featured)
                                <span class="bg-yellow-500/20 text-yellow-500 px-3 py-1 rounded-full text-sm font-semibold border border-yellow-500/30">
                                    Unggulan
                                </span>
                            @endif
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            @if($product->discount_price)
                                <div class="flex items-center space-x-3">
                                    <span class="text-4xl font-bold text-orange-400">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                    <span class="text-xl text-gray-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <span class="text-4xl font-bold text-orange-400">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-white text-lg mb-2">Deskripsi</h3>
                            <p class="text-gray-400 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Specifications -->
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            @if($product->brand)
                                <div>
                                    <span class="text-gray-500 text-sm">Brand:</span>
                                    <p class="text-white font-semibold">{{ $product->brand }}</p>
                                </div>
                            @endif
                            @if($product->material)
                                <div>
                                    <span class="text-gray-500 text-sm">Material:</span>
                                    <p class="text-white font-semibold">{{ $product->material }}</p>
                                </div>
                            @endif
                            @if($product->color)
                                <div>
                                    <span class="text-gray-500 text-sm">Warna:</span>
                                    <p class="text-white font-semibold">{{ $product->color }}</p>
                                </div>
                            @endif
                            @if($product->size)
                                <div>
                                    <span class="text-gray-500 text-sm">Ukuran:</span>
                                    <p class="text-white font-semibold">{{ $product->size }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Stock -->
                        <div class="mb-6">
                            @if($product->stock > 0)
                                <span class="text-green-400 font-semibold">✓ Stok Tersedia ({{ $product->stock }} pcs)</span>
                            @else
                                <span class="text-red-400 font-semibold">✗ Stok Habis</span>
                            @endif
                        </div>

                        <!-- Add to Cart Form -->
                        @auth
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div>
                                        <label class="block text-sm text-gray-300 font-semibold mb-2">Jumlah:</label>
                                        <div class="flex items-center space-x-4">
                                            <button type="button" onclick="decreaseQty()" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 text-center bg-[#131b26] border border-gray-700 text-white rounded-lg py-2 focus:outline-none focus:border-orange-500">
                                            <button type="button" onclick="increaseQty()" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">+</button>
                                        </div>
                                    </div>

                                    <div id="normal-order-actions" class="grid grid-cols-2 gap-4">
                                        <button type="submit" name="action" value="add_to_cart" class="w-full bg-transparent text-orange-400 border-2 border-orange-500 py-3 rounded-xl hover:bg-orange-500/10 transition font-semibold text-lg flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span>Keranjang</span>
                                        </button>
                                        <button type="submit" formaction="{{ route('cart.buy-now') }}" class="w-full btn-orange py-3 rounded-xl transition font-semibold text-lg flex items-center justify-center space-x-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span>Langsung Pesan</span>
                                        </button>
                                    </div>
                                    
                                    <div id="reseller-order-actions" style="display: none;">
                                        <div class="mb-3 px-3 py-2 bg-green-500/10 border border-green-500/30 text-green-400 rounded-lg text-sm font-semibold flex items-center shadow-sm">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Pesanan 50+ pcs berhak mendapatkan harga GROSIR (Reseller).
                                        </div>
                                        <a href="#" id="wa-reseller-link" target="_blank" class="w-full bg-[#25D366] text-white py-3 rounded-xl hover:bg-[#128C7E] transition font-semibold text-lg flex items-center justify-center space-x-2 shadow-lg hover:-translate-y-1">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                            </svg>
                                            <span>Pesan via WhatsApp (Reseller)</span>
                                        </a>
                                    </div>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-800 border border-gray-700 text-gray-500 py-4 rounded-xl cursor-not-allowed font-semibold text-lg">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full btn-orange py-4 rounded-xl transition font-semibold text-lg text-center">
                                Login untuk Membeli
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-white mb-6">Produk Terkait</h2>
                    <div class="grid md:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <div class="card-dark rounded-2xl overflow-hidden group">
                                <a href="{{ route('products.show', $related->slug) }}" class="block relative overflow-hidden h-48">
                                    <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </a>
                                <div class="p-5">
                                    <a href="{{ route('products.show', $related->slug) }}">
                                        <h3 class="font-semibold text-white text-lg mb-2 hover:text-orange-400 transition-colors">{{ $related->name }}</h3>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        @if($related->discount_price)
                                            <span class="text-lg font-bold text-orange-400">Rp {{ number_format($related->discount_price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-lg font-bold text-orange-400">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                        @endif
                                        <a href="{{ route('products.show', $related->slug) }}" class="text-orange-400 hover:text-orange-500 text-sm font-semibold flex items-center">
                                            Lihat <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
        const productName = {!! json_encode($product->name) !!};
        
        let hasAlertedReseller = false;
        function toggleReseller() {
            const input = document.getElementById('quantity');
            if(!input) return;
            const qty = parseInt(input.value) || 1;
            const normalActions = document.getElementById('normal-order-actions');
            const resellerActions = document.getElementById('reseller-order-actions');
            const waLink = document.getElementById('wa-reseller-link');
            
            if (qty >= 50) {
                if(normalActions) normalActions.style.display = 'none';
                if(resellerActions) resellerActions.style.display = 'block';
                if(waLink) {
                    const msg = encodeURIComponent(`Halo Admin, saya tertarik menjadi Reseller Tas NoonaHnB. Saya ingin memesan ${qty} buah produk "${productName}".`);
                    waLink.href = `https://wa.me/6289616392586?text=${msg}`;
                }
                
                if(!hasAlertedReseller) {
                    hasAlertedReseller = true;
                    setTimeout(() => {
                        if(confirm("Pemesanan Grosir/Reseller (50++ pcs) otomatis ditangani melalui WhatsApp Admin untuk mendapatkan penawaran spesial!\n\nKlik 'OK' untuk langsung memulai obrolan WhatsApp.")) {
                            if(waLink) window.open(waLink.href, '_blank');
                        }
                    }, 50);
                }
            } else {
                if(normalActions) normalActions.style.display = 'grid';
                if(resellerActions) resellerActions.style.display = 'none';
                hasAlertedReseller = false;
            }
        }

        function increaseQty() {
            const input = document.getElementById('quantity');
            if(!input) return;
            const currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
                toggleReseller();
            }
        }
        
        function decreaseQty() {
            const input = document.getElementById('quantity');
            if(!input) return;
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                toggleReseller();
            }
        }
        
        // Listen to direct input changes
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput = document.getElementById('quantity');
            if(qtyInput) {
                qtyInput.addEventListener('input', function() {
                    let val = parseInt(this.value) || 1;
                    if(val > maxStock) val = maxStock;
                    if(val < 1) val = 1;
                    this.value = val;
                    toggleReseller();
                });
                toggleReseller(); // Check on initial load
            }
        });
    </script>
    @endpush
</x-main-layout>
