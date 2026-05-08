<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel - Tas NoonaHnB' }}</title>
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
        body { background: var(--dark); color: #e2e8f0; overflow-x: hidden; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 3px; }

        /* Sidebar Item */
        .sidebar-item { transition: all 0.3s; color: #94a3b8; font-size: 0.875rem; font-weight: 500; border-left: 3px solid transparent; }
        .sidebar-item:hover, .sidebar-item.active { background: rgba(249,115,22,0.08); color: var(--orange); border-left-color: var(--orange); }

        /* Generic styles */
        .card-dark { background: var(--dark2); border: 1px solid rgba(255,255,255,0.06); transition: all 0.35s; border-radius: 1rem; }
        .btn-orange { background: linear-gradient(135deg, #f97316, #ea580c); color:#fff; transition:all 0.3s; position:relative; overflow:hidden; }
        .btn-orange:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(249,115,22,0.4); }
        .dropdown-item { color: #94a3b8; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(249,115,22,0.08); color: var(--orange); }
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #86efac; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }
    </style>
    @stack('styles')
</head>
<body class="antialiased flex h-screen" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed z-30 inset-y-0 left-0 w-64 transition-transform duration-300 transform bg-[#162030] border-r border-[#1e2d3d] lg:translate-x-0 lg:static lg:inset-auto">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-[#1e2d3d]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                <style>
                    .logo-adaptive { mix-blend-mode: multiply; }
                    .dark .logo-adaptive, [data-theme="dark"] .logo-adaptive { mix-blend-mode: screen; filter: invert(1) grayscale(1) brightness(1.5); }
                </style>
                <img src="{{ asset('logo.png') }}" alt="Noona H&B Logo" class="h-10 w-auto object-contain logo-adaptive" style="mix-blend-mode: screen; filter: invert(1) grayscale(1) brightness(1.5);">
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-6 px-4 space-y-2">
            <p class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="sidebar-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Pesanan</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span>Produk</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengguna</span>
            </a>

            <a href="{{ route('admin.settings.qris') }}" class="sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg mt-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengaturan QRIS</span>
            </a>

            <p class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6">Lainnya</p>

            <a href="{{ route('home') }}" target="_blank" class="sidebar-item flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Lihat Website</span>
            </a>
        </nav>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Topbar -->
        <header class="h-16 flex items-center justify-between px-6 bg-[#162030] border-b border-[#1e2d3d]">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-400 hover:text-white focus:outline-none lg:hidden mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <div class="w-8 h-8 rounded-full btn-orange flex items-center justify-center text-white font-bold text-sm shadow-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-medium text-gray-300 hidden sm:block">{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7-7-7-7"></path></svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-48 bg-[#1e2d3d] border border-gray-700 rounded-xl shadow-2xl py-2" style="display:none;">
                    
                    <a href="{{ route('profile.edit') }}" class="dropdown-item flex items-center space-x-3 px-4 py-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Profil Admin</span>
                    </a>
                    
                    <div class="border-t border-gray-700 my-1"></div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2 text-red-400 hover:bg-red-500 hover:bg-opacity-10 transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 min-h-screen">
            <!-- Alert Messages -->
            @if(session('success'))
            <div class="max-w-7xl mx-auto px-6 mt-6">
                <div class="alert-success px-5 py-3 rounded-xl flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="max-w-7xl mx-auto px-6 mt-6">
                <div class="alert-error px-5 py-3 rounded-xl flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
