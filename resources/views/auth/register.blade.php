<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - TasBagus</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #0f1923; }
        .input-field {
            width: 100%;
            padding: 12px 16px;
            background: #0f1923;
            border: 1px solid #374151;
            color: #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
        }
        .input-field:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249,115,22,0.15); }
        .input-field::placeholder { color: #4b5563; }
        .btn-orange {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-orange:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(249,115,22,0.4); }
        .error-msg { color: #f87171; font-size: 12px; margin-top: 4px; }
        .side-panel { background: linear-gradient(135deg, #0f1923 0%, #162030 50%, #1a2a3a 100%); position: relative; overflow: hidden; }
        .side-panel::before { content:''; position:absolute; top:-30%; right:-20%; width:500px; height:500px; background:radial-gradient(circle,rgba(249,115,22,0.08) 0%,transparent 70%); border-radius:50%; }
    </style>
</head>
<body>
<div style="min-height:100vh;display:flex;">

    <!-- Kiri: Branding -->
    <div class="side-panel" style="display:none;width:50%;align-items:center;justify-content:center;padding:48px;position:relative;z-index:0;" id="leftPanel">
        <div style="max-width:420px;color:#fff;position:relative;z-index:1;">
            <h1 style="font-size:40px;font-weight:800;margin-bottom:16px;line-height:1.2;">
                Bergabung dengan<br><span style="color:#f97316">TasBagus</span>
            </h1>
            <p style="color:#94a3b8;font-size:16px;margin-bottom:32px;">Daftar sekarang dan dapatkan penawaran eksklusif untuk member baru.</p>
            <div style="background:rgba(22,32,48,0.6);border:1px solid rgba(249,115,22,0.15);border-radius:16px;padding:24px;">
                <p style="font-weight:700;font-size:16px;margin-bottom:16px;color:#f97316;">Keuntungan Member:</p>
                @foreach([
                    ['Diskon hingga 30% untuk member baru','M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['Gratis ongkir untuk pembelian pertama','M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                    ['Notifikasi produk terbaru via email','M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                    ['Poin reward setiap pembelian','M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                ] as $item)
                <div style="display:flex;align-items:center;margin-bottom:12px;">
                    <svg style="width:20px;height:20px;color:#f97316;flex-shrink:0;margin-right:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item[1] }}"></path>
                    </svg>
                    <span style="color:#cbd5e1;font-size:14px;">{{ $item[0] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Kanan: Form -->
    <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:32px;background:#0f1923;overflow-y:auto;">
        <div style="width:100%;max-width:460px;background:#162030;border:1px solid rgba(249,115,22,0.12);border-radius:20px;padding:40px;box-shadow:0 25px 60px rgba(0,0,0,0.5);">

            <!-- Logo -->
            <div style="text-align:center;margin-bottom:28px;">
                <a href="{{ route('home') }}" style="font-size:28px;font-weight:800;color:#fff;text-decoration:none;">
                    Tas<span style="color:#f97316">Bagus</span>
                </a>
                <p style="color:#64748b;font-size:14px;margin-top:6px;">Buat akun baru Anda</p>
            </div>

            <!-- Error umum -->
            @if($errors->any())
            <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:12px 16px;margin-bottom:20px;">
                <p style="color:#fca5a5;font-size:13px;font-weight:600;margin-bottom:6px;">Mohon periksa kembali data Anda:</p>
                <ul style="color:#fca5a5;font-size:12px;padding-left:16px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Pendaftaran -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#94a3b8;margin-bottom:8px;">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        autofocus
                        autocomplete="name"
                        class="input-field"
                        placeholder="Masukkan nama lengkap Anda"
                    >
                    @error('name')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#94a3b8;margin-bottom:8px;">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        class="input-field"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#94a3b8;margin-bottom:8px;">
                        Kata Sandi
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        value="{{ old('password') }}"
                        autocomplete="new-password"
                        class="input-field"
                        placeholder="Minimal 8 karakter"
                    >
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div style="margin-bottom:24px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#94a3b8;margin-bottom:8px;">
                        Konfirmasi Kata Sandi
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        value="{{ old('password_confirmation') }}"
                        autocomplete="new-password"
                        class="input-field"
                        placeholder="Ulangi kata sandi"
                    >
                    @error('password_confirmation')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Daftar -->
                <button type="submit" class="btn-orange">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div style="display:flex;align-items:center;margin:24px 0;">
                <div style="flex:1;height:1px;background:#1e2d3d;"></div>
                <span style="padding:0 16px;color:#4b5563;font-size:13px;">atau</span>
                <div style="flex:1;height:1px;background:#1e2d3d;"></div>
            </div>

            <!-- Link Login -->
            <p style="text-align:center;color:#64748b;font-size:14px;">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:#f97316;font-weight:700;text-decoration:none;margin-left:4px;">
                    Masuk di sini
                </a>
            </p>

            <!-- Kembali ke Beranda -->
            <div style="text-align:center;margin-top:20px;">
                <a href="{{ route('home') }}" style="color:#4b5563;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 0.3s;" onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#4b5563'">
                    <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Tampilkan panel kiri di layar besar
    if (window.innerWidth >= 1024) {
        document.getElementById('leftPanel').style.display = 'flex';
    }
    window.addEventListener('resize', function() {
        document.getElementById('leftPanel').style.display = window.innerWidth >= 1024 ? 'flex' : 'none';
    });
</script>
</body>
</html>
