<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Tas NoonaHnB</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #0f1923 0%, #162030 50%, #1a2a3a 100%); position:relative; overflow:hidden; }
        .hero-gradient::before { content:''; position:absolute; top:-50%; right:-20%; w-600px; h-600px; background:radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%); border-radius:50%; }
        .hero-gradient::after { content:''; position:absolute; bottom:-30%; left:-10%; w-400px; h-400px; background:radial-gradient(circle, rgba(249,115,22,0.05) 0%, transparent 70%); border-radius:50%; }
    </style>
</head>
<body class="bg-[#0f1923]">
    <div class="min-h-screen flex">
        <!-- Left Side - Image & Branding -->
        <div class="hidden lg:flex lg:w-1/2 hero-gradient items-center justify-center p-12 relative z-0">
            <div class="max-w-md text-white relative z-10">
                <h1 class="text-5xl font-bold mb-6">Selamat Datang di Tas NoonaHnB</h1>
                <p class="text-xl mb-8 text-gray-400">Temukan koleksi tas premium terbaik untuk menemani aktivitas Anda setiap hari</p>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-lg">Produk 100% Original</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-lg">Gratis Ongkir Seluruh Indonesia</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-lg">Garansi Resmi 1 Tahun</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f1923]">
            <div class="max-w-md w-full bg-[#162030] p-8 rounded-2xl border border-gray-800 shadow-2xl">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="/" class="text-4xl font-bold text-white">Tas <span class="text-orange-500">NoonaHnB</span></a>
                    <p class="text-gray-400 mt-2">Masuk ke akun Anda</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 bg-green-900/50 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="w-full px-4 py-3 bg-[#0f1923] border border-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            placeholder="nama@email.com"
                        />
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 bg-[#0f1923] border border-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 text-orange-500 border-gray-700 bg-[#0f1923] rounded focus:ring-orange-500 focus:ring-offset-gray-900"
                            />
                            <span class="ml-2 text-sm text-gray-400">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-orange-500 hover:text-orange-400 font-medium transition-colors">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 rounded-lg hover:from-orange-600 hover:to-orange-700 transition font-bold text-lg shadow-lg hover:shadow-orange-500/30 transform hover:-translate-y-0.5"
                    >
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-[#162030] text-gray-500">atau</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-400">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-400 font-bold transition-colors">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="/" class="text-sm text-gray-500 hover:text-gray-300 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
