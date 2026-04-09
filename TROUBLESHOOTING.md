# Troubleshooting Guide - TasBagus

## ✅ Langkah-langkah yang Sudah Dilakukan

1. ✅ Migrations dijalankan
2. ✅ Seeders dijalankan
3. ✅ Cache dibersihkan
4. ✅ Views dibersihkan
5. ✅ Routes dibersihkan

## 🔧 Jika Masih Ada Error

### 1. Clear All Cache
```bash
php artisan optimize:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### 2. Jalankan Migrations & Seeders
```bash
# Jika belum dijalankan
php artisan migrate
php artisan db:seed

# Atau reset ulang
php artisan migrate:fresh --seed
```

### 3. Check Database Connection
Pastikan file `.env` sudah benar:
```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\laragon\www\ujilvl18\database\database.sqlite
```

Atau untuk MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasbagus
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Regenerate Autoload
```bash
composer dump-autoload
```

### 5. Check Permissions (Linux/Mac)
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 6. Check Laravel Log
```bash
# Windows
Get-Content storage/logs/laravel.log -Tail 50

# Linux/Mac
tail -f storage/logs/laravel.log
```

## 🚀 Cara Menjalankan Aplikasi

### 1. Start Server
```bash
php artisan serve
```

### 2. Akses Website
- Homepage: http://localhost:8000
- Login: http://localhost:8000/login
- Dashboard: http://localhost:8000/dashboard (setelah login)

### 3. Test Account
```
Email: test@example.com
Password: password
```

## 🐛 Error Umum & Solusi

### Error: "View not found"
**Solusi:**
```bash
php artisan view:clear
php artisan optimize:clear
```

### Error: "Class not found"
**Solusi:**
```bash
composer dump-autoload
php artisan optimize:clear
```

### Error: "SQLSTATE[HY000]"
**Solusi:**
1. Pastikan database file ada: `database/database.sqlite`
2. Atau buat file baru:
```bash
# Windows
type nul > database/database.sqlite

# Linux/Mac
touch database/database.sqlite
```
3. Jalankan migrations:
```bash
php artisan migrate:fresh --seed
```

### Error: "Route not found"
**Solusi:**
```bash
php artisan route:clear
php artisan route:list
```

### Error: "Session store not set"
**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear
```

### Error: "Call to undefined method"
**Solusi:**
1. Pastikan relationships sudah ditambahkan di User model
2. Clear cache:
```bash
composer dump-autoload
php artisan optimize:clear
```

## 📋 Checklist Sebelum Menjalankan

- [ ] File `.env` sudah dikonfigurasi
- [ ] Database file/connection sudah ada
- [ ] Migrations sudah dijalankan (`php artisan migrate`)
- [ ] Seeders sudah dijalankan (`php artisan db:seed`)
- [ ] Cache sudah dibersihkan (`php artisan optimize:clear`)
- [ ] Composer autoload sudah di-regenerate (`composer dump-autoload`)

## 🔍 Debug Mode

Untuk melihat error lebih detail, pastikan di `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

## 📝 Jika Dashboard Masih Error

### Gunakan Dashboard Sederhana
Jika dashboard utama masih error, gunakan dashboard sederhana untuk test:

1. Edit `routes/web.php`:
```php
Route::get('/dashboard', function () {
    return view('dashboard-simple');  // Ganti 'dashboard' dengan 'dashboard-simple'
})->middleware(['auth', 'verified'])->name('dashboard');
```

2. Clear cache:
```bash
php artisan view:clear
```

3. Refresh browser

### Cek Error di Browser
1. Buka browser
2. Tekan F12 untuk Developer Tools
3. Lihat tab Console untuk JavaScript errors
4. Lihat tab Network untuk HTTP errors

## 🎯 Test Step by Step

### 1. Test Homepage
```
http://localhost:8000
```
Harus muncul halaman welcome dengan produk

### 2. Test Login
```
http://localhost:8000/login
```
Login dengan: test@example.com / password

### 3. Test Dashboard
```
http://localhost:8000/dashboard
```
Harus muncul dashboard dengan statistics

### 4. Test Products
```
http://localhost:8000/products
```
Harus muncul list produk (akan dibuat nanti)

## 💡 Tips

1. **Selalu clear cache** setelah mengubah code
2. **Check log** jika ada error
3. **Gunakan debug mode** untuk development
4. **Test step by step** untuk isolate error
5. **Backup database** sebelum migrate:fresh

## 📞 Jika Masih Bermasalah

1. Check Laravel log: `storage/logs/laravel.log`
2. Check browser console (F12)
3. Check network tab di browser
4. Pastikan semua dependencies terinstall: `composer install`
5. Pastikan Node modules terinstall (jika pakai Vite): `npm install`

## ✅ Verifikasi Setup

Jalankan command ini untuk verifikasi:
```bash
# Check migrations
php artisan migrate:status

# Check routes
php artisan route:list

# Check config
php artisan about

# Check database
php artisan tinker
>>> \App\Models\User::count()
>>> \App\Models\Product::count()
>>> \App\Models\Category::count()
```

Jika semua command di atas berhasil, aplikasi sudah siap digunakan!
