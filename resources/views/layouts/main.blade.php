<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Tas NoonaHnB - Koleksi Tas Premium' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        :root { --dark:#0f1923; --dark2:#162030; --dark3:#1e2d3d; --orange:#f97316; --orange2:#ea580c; }
        body { background: var(--dark); color: #e2e8f0; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 3px; }

        /* Navbar */
        .navbar { background: rgba(15,25,35,0.97); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(249,115,22,0.12); }
        .nav-link { position: relative; color: #94a3b8; transition: color 0.3s; font-size: 0.875rem; font-weight: 500; }
        .nav-link::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:var(--orange); transition:width 0.3s; }
        .nav-link:hover { color: #fff; }
        .nav-link:hover::after { width: 100%; }

        /* Buttons */
        .btn-orange { background: linear-gradient(135deg, #f97316, #ea580c); color:#fff; transition:all 0.3s; position:relative; overflow:hidden; }
        .btn-orange::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent); transition:left 0.5s; }
        .btn-orange:hover::before { left: 100%; }
        .btn-orange:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(249,115,22,0.4); }
        .btn-outline-orange { border:2px solid var(--orange); color:var(--orange); transition:all 0.3s; }
        .btn-outline-orange:hover { background:var(--orange); color:#fff; transform:translateY(-2px); }

        /* Cards */
        .card-dark { background: var(--dark2); border: 1px solid rgba(255,255,255,0.06); transition: all 0.35s; border-radius: 1rem; }
        .card-dark:hover { transform: translateY(-6px); border-color: rgba(249,115,22,0.25); box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 25px rgba(249,115,22,0.08); }

        /* Hero gradient for section headers */
        .hero-gradient { background: linear-gradient(135deg, #0f1923 0%, #1a2a3a 100%); position:relative; overflow:hidden; }
        .hero-gradient::before { content:''; position:absolute; top:0; right:0; width:400px; height:400px; background:radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%); border-radius:50%; }

        /* Orange text */
        .text-orange { color: var(--orange); }
        .text-orange-400 { color: var(--orange) !important; }
        .hover\:text-orange-400:hover { color: var(--orange) !important; }
        .gradient-text { color: var(--orange); }

        /* Orange brand utilities */
        .bg-orange-500 { background-color: var(--orange) !important; }
        .border-orange-500 { border-color: var(--orange) !important; }
        .hover\:border-orange-500:hover { border-color: var(--orange) !important; }
        .focus\:border-orange-500:focus { border-color: var(--orange) !important; }
        .focus\:ring-orange-500:focus { box-shadow: 0 0 0 3px rgba(249,115,22,0.15) !important; }
        .hover\:bg-orange-500\/10:hover { background-color: rgba(249,115,22,0.1) !important; }
        .hover\:shadow-orange-500\/30:hover { box-shadow: 0 30px 50px rgba(249,115,22,0.3) !important; }

        /* Section divider */
        .divider { width:50px; height:3px; background:linear-gradient(90deg,var(--orange),transparent); border-radius:2px; }

        /* Dropdown */
        .dropdown-dark { background: var(--dark2); border: 1px solid rgba(249,115,22,0.15); backdrop-filter: blur(20px); }
        .dropdown-item { color: #94a3b8; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(249,115,22,0.08); color: var(--orange); }

        /* Alerts */
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #86efac; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }

        /* Form inputs */
        .input-dark { background: var(--dark3); border: 1px solid rgba(255,255,255,0.08); color: #e2e8f0; transition: border-color 0.3s; }
        .input-dark:focus { outline: none; border-color: var(--orange); box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
        .input-dark::placeholder { color: #4b5563; }

        /* Table */
        .table-dark thead { background: rgba(249,115,22,0.08); }
        .table-dark th { color: #f97316; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .table-dark tr { border-bottom: 1px solid rgba(255,255,255,0.04); }
        .table-dark tr:hover { background: rgba(249,115,22,0.04); }

        /* Badges */
        .badge-pending { background: rgba(234,179,8,0.15); color: #fde047; border: 1px solid rgba(234,179,8,0.3); }
        .badge-processing { background: rgba(59,130,246,0.15); color: #93c5fd; border: 1px solid rgba(59,130,246,0.3); }
        .badge-shipped { background: rgba(168,85,247,0.15); color: #d8b4fe; border: 1px solid rgba(168,85,247,0.3); }
        .badge-delivered { background: rgba(34,197,94,0.15); color: #86efac; border: 1px solid rgba(34,197,94,0.3); }
        .badge-cancelled { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .badge-unpaid { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .badge-paid { background: rgba(34,197,94,0.15); color: #86efac; border: 1px solid rgba(34,197,94,0.3); }

        /* Float animation */
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        .float-animation { animation: float 5s ease-in-out infinite; }

        /* Footer */
        .footer-dark { background: #080f16; border-top: 1px solid rgba(249,115,22,0.1); }
    </style>
    @stack('styles')
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav x-data="{ mobileMenuOpen: false }" class="navbar fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
            <img src="{{ asset('logo.png') }}" alt="Noona H&B Logo" style="mix-blend-mode: screen; filter: invert(1) grayscale(1) brightness(1.5);" class="h-12 w-auto object-contain transition-transform group-hover:scale-105">
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="{{ route('products.index') }}" class="nav-link">Produk</a>
            <a href="{{ route('products.featured') }}" class="nav-link">Unggulan</a>
            <a href="{{ route('home') }}#about" class="nav-link">Tentang</a>
            <a href="{{ route('home') }}#contact" class="nav-link">Kontak</a>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center space-x-3">
            @auth
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-orange-400 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 w-5 h-5 btn-orange text-white text-xs rounded-full flex items-center justify-center font-bold">0</span>
                </a>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                        <div class="w-9 h-9 rounded-full btn-orange flex items-center justify-center text-white font-bold text-sm shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="hidden md:block text-sm font-medium text-gray-300">{{ Str::limit(Auth::user()->name, 15) }}</span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute right-0 mt-3 w-56 dropdown-dark rounded-2xl shadow-2xl py-2"
                         style="display:none;">
                        <div class="px-4 py-3 border-b" style="border-color:rgba(249,115,22,0.1)">
                            <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-gray-500 text-xs">{{ Auth::user()->email }}</p>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item flex items-center space-x-3 px-4 py-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="text-sm">Admin Panel</span>
                            </a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="dropdown-item flex items-center space-x-3 px-4 py-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="text-sm">Pesanan Saya</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item flex items-center space-x-3 px-4 py-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm">Profil</span>
                        </a>
                        <div class="border-t mt-2 pt-2" style="border-color:rgba(249,115,22,0.1)">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-400 hover:bg-red-500 hover:bg-opacity-10 transition-colors text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm font-medium transition-colors hidden md:inline-block">Masuk</a>
                <a href="{{ route('register') }}" class="btn-orange px-5 py-2 rounded-full text-sm font-semibold hidden md:inline-block">Daftar</a>
            @endauth

            <!-- Hamburger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-300 hover:text-white p-2 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-gray-900 border-t border-gray-800 absolute w-full" style="display: none;">
        <div class="px-6 py-4 flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm font-medium">Beranda</a>
            <a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white text-sm font-medium">Produk</a>
            <a href="{{ route('products.featured') }}" class="text-gray-400 hover:text-white text-sm font-medium">Unggulan</a>
            <a href="{{ route('home') }}#about" class="text-gray-400 hover:text-white text-sm font-medium">Tentang</a>
            <a href="{{ route('home') }}#contact" class="text-gray-400 hover:text-white text-sm font-medium">Kontak</a>
            @guest
            <div class="border-t border-gray-800 pt-4 flex flex-col space-y-3">
                <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="text-orange-400 font-semibold text-sm">Daftar</a>
            </div>
            @endguest
        </div>
    </div>
</nav>

<!-- ===== MAIN CONTENT ===== -->
<main class="pt-20">
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <div class="alert-success px-5 py-3 rounded-xl flex items-center space-x-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
        <div class="alert-error px-5 py-3 rounded-xl flex items-center space-x-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-medium">{!! session('error') !!}</span>
        </div>
    </div>
    @endif

    {{ $slot }}
</main>

<!-- ===== FOOTER ===== -->
<footer class="footer-dark py-14 mt-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-10 mb-10">
            <div>
                <div class="flex items-center space-x-2 mb-4 group cursor-default">
                    <img src="{{ asset('logo.png') }}" alt="Noona H&B Logo" style="mix-blend-mode: screen; filter: invert(1) grayscale(1) brightness(1.5);" class="h-14 w-auto object-contain">
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">Toko tas online terpercaya dengan koleksi premium dan harga terjangkau.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Menu</h4>
                <ul class="space-y-2">
                    @foreach([[route('home'),'Beranda'],[route('products.index'),'Produk'],[route('home').'#about','Tentang'],[route('home').'#contact','Kontak']] as $m)
                    <li><a href="{{ $m[0] }}" class="text-gray-500 hover:text-orange-400 text-sm transition-colors">{{ $m[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Kategori</h4>
                <ul class="space-y-2">
                    @foreach([['tas-ransel','Tas Ransel'],['tas-selempang','Tas Selempang'],['tas-tote','Tas Tote'],['tas-travel','Tas Travel'],['tas-wanita','Tas Wanita']] as $c)
                    <li><a href="{{ route('products.index', ['category' => $c[0]]) }}" class="text-gray-500 hover:text-orange-400 text-sm transition-colors">{{ $c[1] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm">Newsletter</h4>
                <p class="text-gray-500 text-sm mb-4">Dapatkan info produk & promo terbaru</p>
                <div class="flex">
                    <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-3 rounded-l-xl text-sm input-dark">
                    <button class="btn-orange px-4 py-3 rounded-r-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t pt-8 flex flex-col md:flex-row justify-between items-center" style="border-color:rgba(249,115,22,0.1)">
            <p class="text-gray-600 text-sm">&copy; 2026 Tas NoonaHnB. All rights reserved.</p>
            <p class="text-gray-600 text-sm mt-2 md:mt-0">Made with ❤️ for fashion lovers</p>
        </div>
    </div>
</footer>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("cart.count") }}')
            .then(r => { if(!r.ok) throw new Error(); return r.json(); })
            .then(d => { const el = document.getElementById('cart-count'); if(el) el.textContent = d.count || 0; })
            .catch(() => {});
    });
</script>
@endauth
@stack('scripts')
</body>
</html>
