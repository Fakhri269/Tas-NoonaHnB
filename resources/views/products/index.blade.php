<x-main-layout>
    <x-slot name="title">Produk - Tas NoonaHnB</x-slot>

    <!-- Header -->
    <section class="hero-gradient py-14 relative">
        <div class="absolute top-0 right-0 w-64 h-64 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.07) 0%,transparent 70%);border-radius:50%;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Koleksi Kami</p>
            <h1 class="text-4xl font-bold text-white mb-2">Semua <span class="text-orange">Produk</span></h1>
            <div class="divider"></div>
        </div>
    </section>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar -->
                <div class="lg:w-64 flex-shrink-0">
                    <div class="card-dark p-6 sticky top-24">
                        <h3 class="text-white font-bold mb-5 flex items-center space-x-2">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path></svg>
                            <span>Filter</span>
                        </h3>

                        <!-- Search -->
                        <form method="GET" action="{{ route('products.index') }}" class="mb-6">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full px-4 py-3 pr-10 rounded-xl text-sm input-dark">
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-orange-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </div>
                        </form>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h4 class="text-gray-400 text-xs font-semibold uppercase tracking-widest mb-3">Kategori</h4>
                            <div class="space-y-1">
                                <a href="{{ route('products.index') }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-xl text-sm transition-all duration-200 {{ !request('category') ? 'text-orange-400 font-semibold' : 'text-gray-400 hover:text-white' }}"
                                   @if(!request('category')) style="background:rgba(249,115,22,0.1)" @endif>
                                    <span>Semua</span>
                                </a>
                                @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                   class="flex items-center justify-between px-3 py-2 rounded-xl text-sm transition-all duration-200 {{ request('category') == $category->slug ? 'text-orange-400 font-semibold' : 'text-gray-400 hover:text-white' }}"
                                   @if(request('category') == $category->slug) style="background:rgba(249,115,22,0.1)" @endif>
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs px-2 py-0.5 rounded-full" style="background:rgba(249,115,22,0.1);color:#f97316">{{ $category->products_count }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sort -->
                        <div>
                            <h4 class="text-gray-400 text-xs font-semibold uppercase tracking-widest mb-3">Urutkan</h4>
                            <form method="GET" action="{{ route('products.index') }}">
                                @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                                @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                                <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-xl text-sm input-dark">
                                    <option value="latest" {{ request('sort')=='latest'?'selected':'' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort')=='price_low'?'selected':'' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort')=='price_high'?'selected':'' }}>Harga Tertinggi</option>
                                    <option value="popular" {{ request('sort')=='popular'?'selected':'' }}>Terpopuler</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1">
                    @if($products->count() > 0)
                        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
                            @foreach($products as $product)
                            <div class="card-dark overflow-hidden group">
                                <div class="relative overflow-hidden h-52">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @if($product->discount_price)
                                    <div class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:linear-gradient(135deg,#f97316,#ea580c)">SALE</div>
                                    @endif
                                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('products.show', $product->slug) }}" class="w-9 h-9 rounded-full flex items-center justify-center text-white transition-colors" style="background:rgba(249,115,22,0.8)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <p class="text-gray-600 text-xs mb-1">{{ $product->brand }}</p>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <h3 class="text-white font-semibold mb-2 hover:text-orange-400 transition-colors leading-snug">{{ $product->name }}</h3>
                                    </a>
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            @if($product->discount_price)
                                                <span class="text-lg font-bold text-orange-400">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                <span class="text-xs text-gray-600 line-through ml-1">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-lg font-bold text-orange-400">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-600">Stok: {{ $product->stock }}</span>
                                    </div>
                                    @auth
                                        @if($product->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn-orange w-full py-3 rounded-xl text-sm font-semibold">+ Keranjang</button>
                                        </form>
                                        @else
                                        <button disabled class="w-full py-3 rounded-xl text-sm font-semibold text-gray-600 cursor-not-allowed" style="background:rgba(255,255,255,0.05)">Stok Habis</button>
                                        @endif
                                    @else
                                    <div class="grid grid-cols-2 gap-2">
                                        <a href="{{ route('login') }}" class="btn-orange py-3 rounded-xl text-sm font-semibold text-center">Login & Beli</a>
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn-outline-orange py-3 rounded-xl text-sm font-semibold text-center">Detail</a>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-8">{{ $products->links() }}</div>
                    @else
                    <div class="card-dark p-16 text-center">
                        <div class="w-20 h-20 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                            <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-white text-xl font-semibold mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian</p>
                        <a href="{{ route('products.index') }}" class="btn-orange px-8 py-3 rounded-xl font-semibold inline-block">Lihat Semua</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
