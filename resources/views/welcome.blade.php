<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TasBagus - Koleksi Tas Premium</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        :root {
            --dark: #0f1923;
            --dark2: #162030;
            --dark3: #1e2d3d;
            --orange: #f97316;
            --orange2: #ea580c;
        }
        body { background: var(--dark); color: #e2e8f0; }

        /* Navbar */
        .navbar { background: rgba(15,25,35,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(249,115,22,0.15); }
        .nav-link { position: relative; color: #94a3b8; transition: color 0.3s; }
        .nav-link::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:var(--orange); transition:width 0.3s; }
        .nav-link:hover { color: #fff; }
        .nav-link:hover::after { width:100%; }
        .btn-orange { background: linear-gradient(135deg, #f97316, #ea580c); color:#fff; transition: all 0.3s; position:relative; overflow:hidden; }
        .btn-orange::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent); transition:left 0.5s; }
        .btn-orange:hover::before { left:100%; }
        .btn-orange:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(249,115,22,0.4); }
        .btn-outline { border:2px solid var(--orange); color:var(--orange); transition:all 0.3s; }
        .btn-outline:hover { background:var(--orange); color:#fff; transform:translateY(-2px); }

        /* Hero */
        .hero-bg { background: linear-gradient(135deg, #0f1923 0%, #162030 50%, #1a2a3a 100%); position:relative; overflow:hidden; }
        .hero-bg::before { content:''; position:absolute; top:-50%; right:-20%; width:600px; height:600px; background:radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%); border-radius:50%; }
        .hero-bg::after { content:''; position:absolute; bottom:-30%; left:-10%; width:400px; height:400px; background:radial-gradient(circle, rgba(249,115,22,0.05) 0%, transparent 70%); border-radius:50%; }
        .hero-img-wrap { position:relative; }
        .hero-img-wrap::before { content:''; position:absolute; inset:-3px; background:linear-gradient(135deg,var(--orange),transparent,var(--orange)); border-radius:20px; z-index:0; opacity:0.5; }
        .hero-img-wrap img { position:relative; z-index:1; border-radius:18px; }
        .badge-orange { background:linear-gradient(135deg,#f97316,#ea580c); }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
        @keyframes pulse-ring { 0%{transform:scale(1);opacity:0.8} 100%{transform:scale(1.5);opacity:0} }
        .float { animation: float 5s ease-in-out infinite; }
        .float-delay { animation: float 5s ease-in-out 1.5s infinite; }

        /* Cards */
        .card-dark { background: var(--dark2); border:1px solid rgba(255,255,255,0.06); transition:all 0.4s; }
        .card-dark:hover { transform:translateY(-8px); border-color:rgba(249,115,22,0.3); box-shadow:0 20px 50px rgba(0,0,0,0.4), 0 0 30px rgba(249,115,22,0.1); }
        .card-dark:hover .card-img { transform:scale(1.05); }
        .card-img { transition: transform 0.5s; }
        .price-tag { color: var(--orange); }
        .sale-badge { background:linear-gradient(135deg,#f97316,#ea580c); }

        /* Section */
        .section-dark { background: var(--dark); }
        .section-dark2 { background: var(--dark2); }
        .section-title span { color: var(--orange); }
        .divider { width:60px; height:4px; background:linear-gradient(90deg,var(--orange),transparent); border-radius:2px; }

        /* Stats */
        .stat-card { background:linear-gradient(135deg,var(--dark2),var(--dark3)); border:1px solid rgba(249,115,22,0.15); }

        /* Features */
        .feature-icon { background:linear-gradient(135deg,rgba(249,115,22,0.15),rgba(249,115,22,0.05)); border:1px solid rgba(249,115,22,0.2); }

        /* Footer */
        .footer-dark { background: #080f16; border-top:1px solid rgba(249,115,22,0.1); }

        /* Scrollbar */
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:var(--dark); }
        ::-webkit-scrollbar-thumb { background:var(--orange); border-radius:3px; }

        /* Category pills */
        .cat-pill { background:rgba(249,115,22,0.1); border:1px solid rgba(249,115,22,0.2); color:#f97316; transition:all 0.3s; }
        .cat-pill:hover { background:var(--orange); color:#fff; }

        /* Testimonial */
        .testi-card { background:var(--dark2); border:1px solid rgba(255,255,255,0.06); }
        .stars { color:#f97316; }
    </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <div class="w-9 h-9 rounded-lg btn-orange flex items-center justify-center font-bold text-lg">T</div>
            <span class="text-xl font-bold text-white">Tas<span style="color:#f97316">Bagus</span></span>
        </a>

        <div class="hidden md:flex items-center space-x-8">
            <a href="#home" class="nav-link text-sm font-medium">Beranda</a>
            <a href="#products" class="nav-link text-sm font-medium">Produk</a>
            <a href="#about" class="nav-link text-sm font-medium">Tentang</a>
            <a href="#contact" class="nav-link text-sm font-medium">Kontak</a>
        </div>

        <div class="flex items-center space-x-3">
            @auth
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-orange-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 w-5 h-5 btn-orange text-white text-xs rounded-full flex items-center justify-center">0</span>
                </a>
                <a href="{{ url('/dashboard') }}" class="btn-orange px-5 py-2 rounded-full text-sm font-semibold hidden md:inline-block">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm font-medium transition-colors hidden md:inline-block">Masuk</a>
                <a href="{{ route('register') }}" class="btn-orange px-5 py-2 rounded-full text-sm font-semibold hidden md:inline-block">Daftar</a>
            @endauth
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-300 hover:text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu Content -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-900 border-t border-gray-800">
        <div class="px-6 py-4 flex flex-col space-y-4">
            <a href="#home" class="text-gray-400 hover:text-white text-sm font-medium mobile-link">Beranda</a>
            <a href="#products" class="text-gray-400 hover:text-white text-sm font-medium mobile-link">Produk</a>
            <a href="#about" class="text-gray-400 hover:text-white text-sm font-medium mobile-link">Tentang</a>
            <a href="#contact" class="text-gray-400 hover:text-white text-sm font-medium mobile-link">Kontak</a>
            <div class="border-t border-gray-800 pt-4 flex flex-col space-y-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-orange-400 font-semibold mobile-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white mobile-link">Masuk</a>
                    <a href="{{ route('register') }}" class="text-orange-400 font-semibold mobile-link">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section id="home" class="hero-bg min-h-screen flex items-center pt-20">
    <div class="max-w-7xl mx-auto px-6 py-20 w-full">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left -->
            <div class="relative z-10">
                <div class="inline-flex items-center space-x-2 badge-orange px-4 py-2 rounded-full text-sm font-semibold text-white mb-6">
                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    <span>Koleksi Terbaru 2026</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-white mb-6">
                    Temukan Tas<br>
                    <span style="color:#f97316">Premium</span> Impian<br>
                    <span class="text-gray-300 text-3xl md:text-4xl font-light">Anda Disini</span>
                </h1>
                <p class="text-gray-400 md:text-lg leading-relaxed mb-8 max-w-lg">
                    Koleksi tas berkualitas tinggi dengan desain modern dan elegan. Dari ransel hingga tas kulit premium, semua ada di TasBagus.
                </p>
                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="#products" class="btn-orange px-8 py-4 rounded-full font-semibold text-lg flex items-center space-x-2">
                        <span>Belanja Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#about" class="btn-outline px-8 py-4 rounded-full font-semibold text-lg">Pelajari Lebih</a>
                </div>
                <!-- Stats -->
                <div class="flex space-x-8">
                    <div>
                        <p class="text-3xl font-bold text-white">5K+</p>
                        <p class="text-gray-500 text-sm">Pelanggan</p>
                    </div>
                    <div class="border-l border-gray-700 pl-8">
                        <p class="text-3xl font-bold text-white">200+</p>
                        <p class="text-gray-500 text-sm">Produk</p>
                    </div>
                    <div class="border-l border-gray-700 pl-8">
                        <p class="text-3xl font-bold text-white">4.9★</p>
                        <p class="text-gray-500 text-sm">Rating</p>
                    </div>
                </div>
            </div>

            <!-- Right - Hero Image -->
            <div class="relative flex justify-center mt-10 lg:mt-0">
                <div class="hero-img-wrap float w-64 sm:w-80 lg:w-96">
                    <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=500&h=600&fit=crop" alt="Tas Premium" class="w-full object-cover shadow-2xl">
                </div>
                <!-- Floating cards -->
                <div class="absolute top-8 -left-4 bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20 rounded-2xl p-4 float-delay">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 btn-orange rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-xs font-semibold">Kualitas Premium</p>
                            <p class="text-gray-400 text-xs">100% Original</p>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-12 -right-4 bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20 rounded-2xl p-4 float">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-xs font-semibold">Gratis Ongkir</p>
                            <p class="text-gray-400 text-xs">Min. Rp 500.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CATEGORIES ===== -->
<section class="section-dark2 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('products.index') }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Semua</a>
            <a href="{{ route('products.index', ['category' => 'tas-ransel']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Ransel</a>
            <a href="{{ route('products.index', ['category' => 'tas-selempang']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Selempang</a>
            <a href="{{ route('products.index', ['category' => 'tas-tote']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Tote</a>
            <a href="{{ route('products.index', ['category' => 'tas-kulit']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Kulit</a>
            <a href="{{ route('products.index', ['category' => 'tas-travel']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Travel</a>
            <a href="{{ route('products.index', ['category' => 'tas-wanita']) }}" class="cat-pill px-6 py-2 rounded-full text-sm font-medium">Tas Wanita</a>
        </div>
    </div>
</section>

<!-- ===== FEATURES ===== -->
<section class="section-dark py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="flex items-center space-x-4 p-6 rounded-2xl" style="background:rgba(249,115,22,0.05); border:1px solid rgba(249,115,22,0.1)">
                <div class="feature-icon w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-1">100% Original</h3>
                    <p class="text-gray-500 text-sm">Garansi keaslian produk</p>
                </div>
            </div>
            <div class="flex items-center space-x-4 p-6 rounded-2xl" style="background:rgba(249,115,22,0.05); border:1px solid rgba(249,115,22,0.1)">
                <div class="feature-icon w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-1">Gratis Ongkir</h3>
                    <p class="text-gray-500 text-sm">Pembelian min. Rp 500.000</p>
                </div>
            </div>
            <div class="flex items-center space-x-4 p-6 rounded-2xl" style="background:rgba(249,115,22,0.05); border:1px solid rgba(249,115,22,0.1)">
                <div class="feature-icon w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-1">Mudah Return</h3>
                    <p class="text-gray-500 text-sm">Garansi 7 hari return</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PRODUCTS ===== -->
<section id="products" class="section-dark2 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Koleksi Kami</p>
                <h2 class="text-4xl font-bold text-white">Produk <span style="color:#f97316">Terpopuler</span></h2>
                <div class="divider mt-3"></div>
            </div>
            <a href="{{ route('products.index') }}" class="btn-outline px-6 py-3 rounded-full text-sm font-semibold hidden md:flex items-center space-x-2">
                <span>Lihat Semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

        @php $featuredProducts = \App\Models\Product::where('is_active', true)->take(6)->get(); @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProducts as $product)
            <div class="card-dark rounded-2xl overflow-hidden group">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img w-full h-full object-cover">
                    @if($product->discount_price)
                        <div class="absolute top-3 left-3 sale-badge text-white text-xs font-bold px-3 py-1 rounded-full">SALE</div>
                    @endif
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('products.show', $product->slug) }}" class="w-9 h-9 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-orange-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-gray-500 text-xs mb-1">{{ $product->brand }}</p>
                    <h3 class="text-white font-semibold mb-3 leading-snug">{{ $product->name }}</h3>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            @if($product->discount_price)
                                <span class="text-xl font-bold price-tag">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                <span class="text-gray-600 text-sm line-through ml-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-xl font-bold price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <span class="text-xs text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    @auth
                        @if($product->stock > 0)
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <!-- Add to Cart -->
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" title="Tambah ke Keranjang" class="btn-outline w-full py-3 rounded-xl font-semibold text-sm flex items-center justify-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="text-xs">Keranjang</span>
                                    </button>
                                </form>
                                <!-- Buy Now -->
                                <form action="{{ route('cart.buy-now') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" title="Beli Langsung" class="btn-orange w-full py-3 rounded-xl font-semibold text-sm flex items-center justify-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <span class="text-xs">Beli Langsung</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <button disabled class="w-full py-3 rounded-xl font-semibold text-sm bg-gray-700 text-gray-500 cursor-not-allowed">Stok Habis</button>
                        @endif
                    @else
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('login') }}" class="btn-orange py-3 rounded-xl font-semibold text-sm text-center">Login & Beli</a>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn-outline py-3 rounded-xl font-semibold text-sm text-center">Detail</a>
                        </div>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10 md:hidden">
            <a href="{{ route('products.index') }}" class="btn-orange px-8 py-4 rounded-full font-semibold inline-block">Lihat Semua Produk</a>
        </div>
    </div>
</section>

<!-- ===== ABOUT ===== -->
<section id="about" class="section-dark py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1591561954557-26941169b49e?w=300&h=350&fit=crop" class="rounded-2xl w-full object-cover shadow-2xl h-40 sm:h-52">
                    <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=300&h=250&fit=crop" class="rounded-2xl w-full object-cover shadow-2xl mt-4 sm:mt-8 h-40 sm:h-52">
                    <img src="https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?w=300&h=250&fit=crop" class="rounded-2xl w-full object-cover shadow-2xl -mt-4 sm:-mt-8 h-40 sm:h-52">
                    <img src="https://images.unsplash.com/photo-1564422170194-896b89110ef8?w=300&h=350&fit=crop" class="rounded-2xl w-full object-cover shadow-2xl h-40 sm:h-52">
                </div>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 btn-orange rounded-full flex items-center justify-center shadow-2xl">
                        <span class="text-white font-bold text-[10px] sm:text-xs text-center leading-tight">5+<br>Tahun</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-3">Tentang Kami</p>
                <h2 class="text-4xl font-bold text-white mb-6">Kami Hadir untuk <span style="color:#f97316">Gaya Hidup</span> Anda</h2>
                <div class="divider mb-6"></div>
                <p class="text-gray-400 leading-relaxed mb-4">TasBagus adalah toko online terpercaya yang menyediakan berbagai koleksi tas berkualitas premium. Kami berkomitmen memberikan produk terbaik dengan pelayanan memuaskan.</p>
                <p class="text-gray-400 leading-relaxed mb-8">Dengan pengalaman lebih dari 5 tahun, kami telah melayani ribuan pelanggan di seluruh Indonesia dengan kepuasan tertinggi.</p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach([['5K+','Pelanggan Puas'],['200+','Koleksi Produk'],['50+','Brand Partner'],['99%','Kepuasan']] as $s)
                    <div class="stat-card p-4 rounded-2xl">
                        <p class="text-2xl font-bold" style="color:#f97316">{{ $s[0] }}</p>
                        <p class="text-gray-500 text-sm">{{ $s[1] }}</p>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('products.index') }}" class="btn-orange px-8 py-4 rounded-full font-semibold inline-flex items-center space-x-2">
                    <span>Lihat Koleksi</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="section-dark2 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Testimoni</p>
            <h2 class="text-4xl font-bold text-white">Kata <span style="color:#f97316">Pelanggan</span> Kami</h2>
            <div class="divider mx-auto mt-3"></div>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['Siti Rahayu','Tas Ransel Urban Premium','Kualitasnya luar biasa! Bahan tebal dan jahitan rapi. Sudah 6 bulan dipakai masih bagus banget. Recommended!','5'],
                ['Budi Santoso','Tas Kulit Formal Pria','Tas briefcase-nya sangat profesional. Cocok banget untuk meeting. Pengiriman cepat dan packaging aman.','5'],
                ['Dewi Lestari','Tas Wanita Stylish','Desainnya cantik dan modern. Banyak yang nanya beli dimana. Harga terjangkau untuk kualitas premium!','5'],
            ] as $t)
            <div class="testi-card p-6 rounded-2xl">
                <div class="stars text-lg mb-3">{{ str_repeat('★', $t[3]) }}</div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">"{{ $t[2] }}"</p>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 btn-orange rounded-full flex items-center justify-center font-bold text-white">{{ substr($t[0],0,1) }}</div>
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $t[0] }}</p>
                        <p class="text-gray-500 text-xs">Pembeli {{ $t[1] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<section id="contact" class="section-dark py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16">
            <div>
                <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-3">Hubungi Kami</p>
                <h2 class="text-4xl font-bold text-white mb-6">Ada <span style="color:#f97316">Pertanyaan?</span></h2>
                <div class="divider mb-8"></div>
                <div class="space-y-6">
                    @foreach([
                        ['M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z','Jl. Raya Tas No. 123, Jakarta Selatan 12345','Alamat'],
                        ['M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','info@tasbagus.com','Email'],
                    ] as $c)
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(249,115,22,0.1); border:1px solid rgba(249,115,22,0.2)">
                            <svg class="w-5 h-5" style="color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $c[0] }}"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs mb-1">{{ $c[2] }}</p>
                            <p class="text-white font-medium">{{ $c[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- WhatsApp Admin -->
                    <a href="https://wa.me/6289616392586?text=Halo%20Admin%20TasBagus,%20saya%20ingin%20bertanya..." target="_blank" class="flex items-start space-x-4 p-3 -ml-3 rounded-xl hover:bg-[#1e2d3d] transition-all group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-[rgba(37,211,102,0.15)] border border-[rgba(37,211,102,0.3)] shadow-[0_0_15px_rgba(37,211,102,0.2)] group-hover:bg-[#25D366] transition-all">
                            <svg class="w-6 h-6 text-[#25D366] group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-green-400 font-bold text-xs mb-1 uppercase tracking-wide">WhatsApp Admin</p>
                            <p class="text-white font-bold text-lg group-hover:text-[#25D366] transition-colors">+62 896-1639-2586</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="rounded-2xl p-10 flex flex-col items-center justify-center text-center relative overflow-hidden" style="background:linear-gradient(135deg, var(--dark2), #111a24); border:1px solid rgba(249,115,22,0.1)">
                <!-- Decorative background ring -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#25D366] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"></div>
                
                <h3 class="text-2xl font-bold text-white mb-4 relative z-10">Chat Langsung via WhatsApp</h3>
                <p class="text-gray-400 text-sm mb-8 relative z-10 max-w-sm">Punya pertanyaan seputar produk, stok grosir, atau ingin bertanya langsung pada tim kami? Jangan sungkan, klik tombol di bawah ini!</p>
                <a href="https://wa.me/6289616392586?text=Halo%20Admin%20TasBagus,%20saya%20punya%20pertanyaan..." target="_blank" class="bg-[#25D366] hover:bg-[#1fbb59] text-white px-8 py-4 rounded-xl font-bold text-lg flex items-center space-x-3 shadow-[0_10px_30px_rgba(37,211,102,0.3)] hover:shadow-[0_15px_40px_rgba(37,211,102,0.4)] transition-all hover:-translate-y-1 relative z-10">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                    </svg>
                    <span>Mulai Chat Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer-dark py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-9 h-9 rounded-lg btn-orange flex items-center justify-center font-bold text-lg">T</div>
                    <span class="text-xl font-bold text-white">Tas<span style="color:#f97316">Bagus</span></span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">Toko tas online terpercaya dengan koleksi premium dan harga terjangkau untuk semua kalangan.</p>
                <div class="flex space-x-3">
                    @foreach(['M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z','M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'] as $icon)
                    <a href="#" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all hover:scale-110" style="background:rgba(249,115,22,0.1); border:1px solid rgba(249,115,22,0.2)">
                        <svg class="w-4 h-4" style="color:#f97316" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $icon }}"/></svg>
                    </a>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Menu</h4>
                <ul class="space-y-2">
                    @foreach([['#home','Beranda'],['#products','Produk'],['#about','Tentang'],['#contact','Kontak']] as $m)
                    <li><a href="{{ $m[0] }}" class="text-gray-500 hover:text-orange-400 text-sm transition-colors">{{ $m[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Kategori</h4>
                <ul class="space-y-2">
                    @foreach([['tas-ransel','Tas Ransel'],['tas-selempang','Tas Selempang'],['tas-tote','Tas Tote'],['tas-travel','Tas Travel'],['tas-wanita','Tas Wanita']] as $c)
                    <li><a href="{{ route('products.index', ['category' => $c[0]]) }}" class="text-gray-500 hover:text-orange-400 text-sm transition-colors">{{ $c[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Newsletter</h4>
                <p class="text-gray-500 text-sm mb-4">Dapatkan info produk & promo terbaru</p>
                <div class="flex">
                    <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-3 rounded-l-xl text-sm focus:outline-none" style="background:var(--dark3); border:1px solid rgba(255,255,255,0.08); color:#e2e8f0; border-right:none">
                    <button class="btn-orange px-4 py-3 rounded-r-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t pt-8 flex flex-col md:flex-row justify-between items-center" style="border-color:rgba(249,115,22,0.1)">
            <p class="text-gray-600 text-sm">&copy; 2026 TasBagus. All rights reserved.</p>
            <p class="text-gray-600 text-sm mt-2 md:mt-0">Made with ❤️ for fashion lovers</p>
        </div>
    </div>
</footer>

@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("cart.count") }}')
            .then(r => r.json())
            .then(d => {
                const el = document.getElementById('cart-count');
                if (el) el.textContent = d.count || 0;
            }).catch(() => {});
    });
</script>
@endauth

<script>
    // Mobile Menu Toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Close mobile menu when a link is clicked
    document.querySelectorAll('.mobile-link').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });
</script>
</body>
</html>
