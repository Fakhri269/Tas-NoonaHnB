<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Owner Panel - Tas NoonaHnB' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        :root { --dark:#0f1923; --dark2:#162030; --dark3:#1e2d3d; --orange:#f97316; --orange2:#ea580c; }
        body { background: var(--dark); color: #e2e8f0; overflow-x: hidden; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 3px; }

        /* Sidebar */
        .sidebar-owner { background: linear-gradient(180deg, #162030 0%, #0f1923 100%); }
        .sidebar-item { transition: all 0.3s; color: #94a3b8; font-size: 0.875rem; font-weight: 500; border-left: 3px solid transparent; }
        .sidebar-item:hover, .sidebar-item.active { background: rgba(249,115,22,0.08); color: var(--orange); border-left-color: var(--orange); }

        /* Cards */
        .card-dark { background: var(--dark2); border: 1px solid rgba(255,255,255,0.06); transition: all 0.35s; border-radius: 1rem; }
        .card-dark:hover { border-color: rgba(249,115,22,0.15); }
        .card-glass { background: rgba(22,32,48,0.7); backdrop-filter: blur(20px); border: 1px solid rgba(249,115,22,0.1); border-radius: 1rem; }

        /* Buttons */
        .btn-orange { background: linear-gradient(135deg, #f97316, #ea580c); color:#fff; transition:all 0.3s; position:relative; overflow:hidden; }
        .btn-orange::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent); transition:left 0.5s; }
        .btn-orange:hover::before { left:100%; }
        .btn-orange:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(249,115,22,0.4); }
        .btn-outline-orange { border:2px solid var(--orange); color:var(--orange); transition:all 0.3s; }
        .btn-outline-orange:hover { background:var(--orange); color:#fff; transform:translateY(-2px); }

        /* Dropdown */
        .dropdown-item { color: #94a3b8; transition: all 0.2s; }
        .dropdown-item:hover { background: rgba(249,115,22,0.08); color: var(--orange); }

        /* Alerts */
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #86efac; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; }

        /* Input */
        .input-dark { background: var(--dark3); border: 1px solid rgba(255,255,255,0.08); color: #e2e8f0; transition: border-color 0.3s; }
        .input-dark:focus { outline: none; border-color: var(--orange); box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
        .input-dark::placeholder { color: #4b5563; }

        /* Table */
        .table-dark thead { background: rgba(249,115,22,0.08); }
        .table-dark th { color: #f97316; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .table-dark tr { border-bottom: 1px solid rgba(255,255,255,0.04); }
        .table-dark tr:hover { background: rgba(249,115,22,0.04); }

        /* Badges */
        .badge-owner { background: linear-gradient(135deg, rgba(249,115,22,0.2), rgba(234,88,12,0.2)); color: #fb923c; border: 1px solid rgba(249,115,22,0.4); }
        .badge-admin { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.3); }
        .badge-user { background: rgba(107,114,128,0.2); color: #d1d5db; border: 1px solid rgba(107,114,128,0.3); }
        .badge-success { background: rgba(34,197,94,0.15); color: #86efac; border: 1px solid rgba(34,197,94,0.3); }
        .badge-warning { background: rgba(234,179,8,0.15); color: #fde047; border: 1px solid rgba(234,179,8,0.3); }

        /* Stat Card */
        .stat-card {
            background: linear-gradient(135deg, var(--dark2), var(--dark3));
            border: 1px solid rgba(249,115,22,0.1);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .stat-card:hover {
            border-color: rgba(249,115,22,0.35);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3), 0 0 20px rgba(249,115,22,0.05);
        }

        /* Glow Effects */
        .glow-orange { box-shadow: 0 0 20px rgba(249,115,22,0.15), 0 0 60px rgba(249,115,22,0.05); }
        .text-glow { text-shadow: 0 0 20px rgba(249,115,22,0.3); }

        /* Sidebar Crown Icon Animation */
        @keyframes crownPulse { 0%,100%{filter:drop-shadow(0 0 3px rgba(249,115,22,0.4))} 50%{filter:drop-shadow(0 0 10px rgba(249,115,22,0.8))} }
        .crown-glow { animation: crownPulse 2s ease-in-out infinite; }

        /* Animated gradient border */
        @keyframes borderGlow {
            0% { border-color: rgba(249,115,22,0.2); }
            50% { border-color: rgba(249,115,22,0.5); }
            100% { border-color: rgba(249,115,22,0.2); }
        }
        .animate-border { animation: borderGlow 3s ease-in-out infinite; }

        /* Topbar gradient */
        .topbar-owner { background: linear-gradient(90deg, #162030, #1a2535, #162030); border-bottom: 1px solid rgba(249,115,22,0.1); }
    </style>
    @stack('styles')
</head>
<body class="antialiased flex h-screen" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-60 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed z-30 inset-y-0 left-0 w-64 transition-transform duration-300 transform sidebar-owner border-r border-[#1e2d3d] lg:translate-x-0 lg:static lg:inset-auto">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-[#1e2d3d] relative">
            <a href="{{ route('owner.dashboard') }}" class="flex items-center space-x-3">
                <div class="relative">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center shadow-lg glow-orange">
                        <svg class="w-5 h-5 text-white crown-glow" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/></svg>
                    </div>
                </div>
                <div>
                    <span class="text-white font-bold text-base">Owner</span>
                    <span class="text-orange-400 font-bold text-base"> Panel</span>
                    <p class="text-gray-500 text-[10px] -mt-0.5 tracking-widest uppercase">Kontrol Penuh</p>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-6 px-4 space-y-1">
            <p class="px-3 text-[10px] font-bold text-orange-500/60 uppercase tracking-[0.2em] mb-3">Menu Utama</p>

            <a href="{{ route('owner.dashboard') }}" class="sidebar-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('owner.users.index') }}" class="sidebar-item {{ request()->routeIs('owner.users.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Pengguna</span>
            </a>

            <a href="{{ route('owner.products.index') }}" class="sidebar-item {{ request()->routeIs('owner.products.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span>Produk</span>
            </a>

            <a href="{{ route('owner.reports.index') }}" class="sidebar-item {{ request()->routeIs('owner.reports.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Laporan</span>
            </a>

            <a href="{{ route('owner.activities.index') }}" class="sidebar-item {{ request()->routeIs('owner.activities.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Aktivitas</span>
            </a>

            <div class="pt-4 mt-4" style="border-top:1px solid rgba(249,115,22,0.08)">
                <p class="px-3 text-[10px] font-bold text-orange-500/60 uppercase tracking-[0.2em] mb-3">Lainnya</p>

                <a href="{{ route('home') }}" target="_blank" class="sidebar-item flex items-center space-x-3 px-3 py-2.5 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Website</span>
                </a>
            </div>
        </nav>

        <!-- Sidebar Bottom Badge -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="rounded-xl p-3 text-center animate-border" style="background:linear-gradient(135deg,rgba(249,115,22,0.05),rgba(234,88,12,0.08)); border:1px solid rgba(249,115,22,0.2)">
                <p class="text-orange-400 text-[10px] font-bold uppercase tracking-widest">⚡ Akses Tertinggi</p>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar -->
        <header class="h-16 flex items-center justify-between px-6 topbar-owner relative z-10">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-400 hover:text-white focus:outline-none lg:hidden mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="hidden sm:flex items-center space-x-3">
                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider badge-owner flex items-center space-x-1.5">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"/></svg>
                        <span>Owner</span>
                    </span>
                    <span class="text-gray-500 text-sm">Kontrol Penuh Sistem</span>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-white leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-orange-400/70 uppercase tracking-wider">Owner</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-52 bg-[#1e2d3d] border border-gray-700/50 rounded-xl shadow-2xl py-2 backdrop-blur-xl" style="display:none;">

                    <div class="px-4 py-2 border-b border-gray-700/50">
                        <p class="text-xs text-gray-500">Masuk sebagai</p>
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item flex items-center space-x-3 px-4 py-2.5 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Profil</span>
                    </a>

                    <div class="border-t border-gray-700/50 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-red-400 hover:bg-red-500 hover:bg-opacity-10 transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto min-h-screen" style="background: var(--dark)">
            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({ icon:'success', title:'Berhasil!', text:@json(session('success')), timer:2500, showConfirmButton:false, background:'#1e2d3d', color:'#e2e8f0', iconColor:'#f97316' });
                });
            </script>
            @endif
            @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({ icon:'error', title:'Gagal!', text:@json(session('error')), timer:3000, showConfirmButton:false, background:'#1e2d3d', color:'#e2e8f0' });
                });
            </script>
            @endif

            {{ $slot }}
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
