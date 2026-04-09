# Dashboard & Layout Update - TasBagus

## ✅ Perubahan yang Dilakukan

### 1. Layout Baru (Main Layout)
**File:** `resources/views/layouts/main.blade.php`

Layout utama untuk halaman setelah login dengan fitur:
- **Navigation Bar** dengan dropdown user menu
- **Cart Icon** dengan counter real-time
- **User Menu** (Dashboard, Pesanan, Profil, Logout)
- **Alert Messages** untuk success/error notifications
- **Footer** lengkap dengan newsletter
- **Alpine.js** untuk interaktivitas dropdown
- **Responsive Design** untuk mobile & desktop

### 2. Dashboard Baru
**File:** `resources/views/dashboard.blade.php`

Dashboard yang menarik dengan:

#### Hero Section
- Welcome message dengan nama user
- Gradient purple background

#### Statistics Cards (4 cards)
- **Total Pesanan** - Jumlah semua pesanan
- **Menunggu** - Pesanan pending
- **Diproses** - Pesanan processing
- **Keranjang** - Total item di cart

#### Quick Actions (3 cards)
- **Belanja Sekarang** - Link ke products
- **Lihat Keranjang** - Link ke cart
- **Pesanan Saya** - Link ke orders

#### Recent Orders Table
- Tabel 5 pesanan terbaru
- Menampilkan: Order number, tanggal, total, status
- Status badges dengan warna berbeda
- Link ke detail pesanan
- Empty state jika belum ada pesanan

#### Featured Products
- Grid 4 produk unggulan
- Card dengan gambar, nama, harga
- Discount badge jika ada
- Link ke detail produk

### 3. Component MainLayout
**File:** `app/View/Components/MainLayout.php`

Component untuk menggunakan layout main:
- Accept parameter `title` untuk page title
- Render view `layouts.main`

### 4. User Model Update
**File:** `app/Models/User.php`

Menambahkan relationships:
```php
public function carts(): HasMany
public function orders(): HasMany
```

### 5. Welcome Page Update
**File:** `resources/views/welcome.blade.php`

Update navigation untuk konsistensi:
- Tambah cart icon untuk user yang login
- Link ke dashboard untuk authenticated users

## 🎨 Design Features

### Color Scheme
- Primary: Purple (#667eea, #764ba2)
- Success: Green
- Warning: Yellow
- Info: Blue
- Danger: Red

### Components
- **Cards** dengan hover effect (translateY & shadow)
- **Badges** untuk status dengan warna berbeda
- **Icons** dari Heroicons
- **Gradients** untuk hero sections
- **Shadows** untuk depth

### Responsive
- Mobile-first approach
- Breakpoints: md (768px), lg (1024px)
- Hidden elements pada mobile
- Flexible grids

## 📊 Dashboard Statistics

Dashboard menampilkan data real-time dari database:

```php
// Total Orders
Auth::user()->orders()->count()

// Pending Orders
Auth::user()->orders()->where('status', 'pending')->count()

// Processing Orders
Auth::user()->orders()->where('status', 'processing')->count()

// Cart Items
Auth::user()->carts()->sum('quantity')

// Recent Orders
Auth::user()->orders()->with('items')->latest()->take(5)->get()

// Featured Products
Product::where('is_featured', true)->where('is_active', true)->take(4)->get()
```

## 🔧 Cara Menggunakan Layout

### Untuk Halaman Baru:

```blade
<x-main-layout>
    <x-slot name="title">Judul Halaman - TasBagus</x-slot>

    <!-- Content di sini -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <h1>Konten Halaman</h1>
        </div>
    </section>
</x-main-layout>
```

### Fitur Layout:

1. **Navigation** - Otomatis muncul di semua halaman
2. **Footer** - Otomatis muncul di semua halaman
3. **Cart Counter** - Update otomatis via AJAX
4. **User Dropdown** - Alpine.js dropdown menu
5. **Alert Messages** - Session flash messages

## 📱 Navigation Menu

### Public (Not Logged In):
- Beranda
- Produk
- Unggulan
- Tentang
- Kontak
- Login
- Daftar

### Authenticated (Logged In):
- Beranda
- Produk
- Unggulan
- Tentang
- Kontak
- Cart Icon (with counter)
- User Dropdown:
  - Dashboard
  - Pesanan Saya
  - Profil
  - Logout

## 🎯 Status Badges

Dashboard menggunakan color-coded badges untuk status pesanan:

- **Menunggu** (pending) - Yellow badge
- **Diproses** (processing) - Blue badge
- **Dikirim** (shipped) - Purple badge
- **Selesai** (delivered) - Green badge
- **Dibatalkan** (cancelled) - Red badge

## 🚀 JavaScript Features

### Cart Counter
```javascript
// Auto-update cart count on page load
fetch('/cart/count')
    .then(response => response.json())
    .then(data => {
        document.getElementById('cart-count').textContent = data.count;
    });
```

### User Dropdown
```html
<!-- Alpine.js dropdown -->
<div x-data="{ open: false }">
    <button @click="open = !open">Menu</button>
    <div x-show="open" @click.away="open = false">
        <!-- Dropdown items -->
    </div>
</div>
```

## 📦 Dependencies

### External Libraries:
- **Tailwind CSS** - Styling framework
- **Alpine.js** - Lightweight JavaScript framework
- **Heroicons** - Icon set (via SVG)

### Laravel Components:
- Blade Components
- Blade Directives (@auth, @guest, etc.)
- Route helpers
- Session flash messages

## ✨ Highlights

1. **Modern UI/UX** - Clean, professional design
2. **Real-time Data** - Statistics dari database
3. **Interactive** - Hover effects, dropdowns
4. **Responsive** - Mobile & desktop friendly
5. **Consistent** - Sama di semua halaman
6. **User-friendly** - Easy navigation
7. **Informative** - Clear status indicators

## 🔄 Flow Setelah Login

1. User login → Redirect ke `/dashboard`
2. Dashboard menampilkan:
   - Welcome message
   - Statistics cards
   - Quick actions
   - Recent orders
   - Featured products
3. User bisa navigasi ke:
   - Products (belanja)
   - Cart (keranjang)
   - Orders (pesanan)
   - Profile (profil)

## 📝 Next Steps

Untuk melengkapi, buat views untuk:
1. Products listing (`products/index.blade.php`)
2. Product detail (`products/show.blade.php`)
3. Cart page (`cart/index.blade.php`)
4. Checkout page (`orders/checkout.blade.php`)
5. Orders listing (`orders/index.blade.php`)
6. Order detail (`orders/show.blade.php`)

Semua views bisa menggunakan `<x-main-layout>` untuk konsistensi!

## 🎉 Selesai!

Dashboard dan layout sudah siap digunakan. Tampilan setelah login sekarang konsisten dengan tema website tas dan tidak lagi menggunakan tampilan default Laravel Breeze.
