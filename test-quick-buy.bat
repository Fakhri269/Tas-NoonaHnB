@echo off
echo ========================================
echo Testing Quick Buy Feature
echo ========================================
echo.

echo [1/2] Clearing cache...
php artisan optimize:clear
echo.

echo [2/2] Starting server...
echo.
echo ========================================
echo Test Quick Buy Feature
echo ========================================
echo.
echo Buka browser dan test:
echo.
echo TEST 1: Guest User
echo 1. Buka: http://localhost:8000
echo 2. Scroll ke section "Koleksi Terbaru"
echo 3. Lihat tombol "Login untuk Beli"
echo 4. Klik tombol tersebut
echo 5. Akan redirect ke login page
echo.
echo TEST 2: Logged In User
echo 1. Login: http://localhost:8000/login
echo    Email: test@example.com
echo    Password: password
echo 2. Kembali ke beranda
echo 3. Scroll ke section "Koleksi Terbaru"
echo 4. Lihat tombol "Beli Sekarang"
echo 5. Klik tombol tersebut
echo 6. Produk masuk ke cart
echo 7. Cart counter update
echo.
echo ========================================
echo.

php artisan serve
