@echo off
echo ========================================
echo Setup Database TasBagus
echo ========================================
echo.

echo [1/3] Menjalankan migrations...
php artisan migrate:fresh
echo.

echo [2/3] Menjalankan seeders...
php artisan db:seed
echo.

echo [3/3] Membersihkan cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
echo.

echo ========================================
echo Setup database selesai!
echo ========================================
echo.
echo Login credentials:
echo Email: test@example.com
echo Password: password
echo.
pause
