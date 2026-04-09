@echo off
echo ========================================
echo Testing TasBagus Features
echo ========================================
echo.

echo [1/4] Clearing cache...
php artisan optimize:clear
echo.

echo [2/4] Checking routes...
php artisan route:list --path=products
php artisan route:list --path=cart
echo.

echo [3/4] Checking database...
php artisan tinker --execute="echo 'Products: ' . \App\Models\Product::count() . PHP_EOL; echo 'Categories: ' . \App\Models\Category::count() . PHP_EOL;"
echo.

echo [4/4] Starting server...
echo.
echo ========================================
echo Server akan dimulai...
echo ========================================
echo.
echo Buka browser dan test:
echo.
echo 1. Homepage: http://localhost:8000
echo 2. Login: http://localhost:8000/login
echo    Email: test@example.com
echo    Password: password
echo.
echo 3. Products: http://localhost:8000/products
echo 4. Cart: http://localhost:8000/cart
echo 5. Profile: http://localhost:8000/profile
echo.
echo ========================================
echo.

php artisan serve
