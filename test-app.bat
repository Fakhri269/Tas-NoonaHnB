@echo off
echo ========================================
echo Testing TasBagus Application
echo ========================================
echo.

echo [1/5] Clearing cache...
php artisan optimize:clear
echo.

echo [2/5] Checking migrations...
php artisan migrate:status
echo.

echo [3/5] Checking routes...
php artisan route:list --path=/ --columns=method,uri,name
echo.

echo [4/5] Checking database...
php artisan tinker --execute="echo 'Users: ' . \App\Models\User::count(); echo PHP_EOL; echo 'Products: ' . \App\Models\Product::count(); echo PHP_EOL; echo 'Categories: ' . \App\Models\Category::count();"
echo.

echo [5/5] Application info...
php artisan about
echo.

echo ========================================
echo Test selesai!
echo ========================================
echo.
echo Untuk menjalankan server:
echo php artisan serve
echo.
echo Lalu buka: http://localhost:8000
echo Login: test@example.com / password
echo.
pause
