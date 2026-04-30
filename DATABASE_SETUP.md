# Setup Database Tas NoonaHnB

## Struktur Database

### Tabel yang Dibuat:

1. **categories** - Kategori produk tas
   - id, name, slug, description, image, is_active, timestamps

2. **products** - Produk tas
   - id, category_id, name, slug, description, price, discount_price, stock, image, images, brand, material, color, size, is_featured, is_active, views, timestamps

3. **carts** - Keranjang belanja
   - id, user_id, product_id, quantity, price, timestamps

4. **orders** - Pesanan
   - id, user_id, order_number, subtotal, shipping_cost, discount, total, status, payment_status, payment_method, shipping details, timestamps

5. **order_items** - Item pesanan
   - id, order_id, product_id, product_name, price, quantity, subtotal, timestamps

## Cara Setup

### Otomatis (Windows):
```bash
setup-database.bat
```

### Manual:
```bash
# 1. Jalankan migrations
php artisan migrate:fresh

# 2. Jalankan seeders
php artisan db:seed

# 3. Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Data Awal (Seeder)

### Kategori:
- Tas Ransel
- Tas Selempang
- Tas Tote
- Tas Kulit
- Tas Travel
- Tas Wanita

### Produk:
6 produk sample dengan berbagai kategori, harga, dan stok

### User Test:
- Email: test@example.com
- Password: password

## Models & Relationships

### Category Model
- `hasMany` products
- `hasMany` activeProducts (filtered)

### Product Model
- `belongsTo` category
- `hasMany` carts
- `hasMany` orderItems
- Attributes: final_price, discount_percentage
- Methods: isInStock(), incrementViews()

### Cart Model
- `belongsTo` user
- `belongsTo` product
- Attribute: subtotal

### Order Model
- `belongsTo` user
- `hasMany` items (OrderItem)
- Static method: generateOrderNumber()
- Status methods: isPending(), isProcessing(), etc.

### OrderItem Model
- `belongsTo` order
- `belongsTo` product

## Controllers

### ProductController
- `index()` - List produk dengan filter & search
- `show($slug)` - Detail produk
- `featured()` - Produk unggulan

### CartController
- `index()` - Tampilkan keranjang
- `add()` - Tambah ke keranjang
- `update()` - Update quantity
- `remove()` - Hapus item
- `clear()` - Kosongkan keranjang
- `count()` - Hitung total item (API)

### OrderController
- `index()` - List pesanan user
- `show($order)` - Detail pesanan
- `checkout()` - Halaman checkout
- `store()` - Buat pesanan baru
- `cancel($order)` - Batalkan pesanan

## Routes

### Public Routes:
- `GET /` - Homepage
- `GET /products` - List produk
- `GET /products/featured` - Produk unggulan
- `GET /products/{slug}` - Detail produk

### Authenticated Routes:

**Cart:**
- `GET /cart` - Keranjang
- `POST /cart/add` - Tambah ke keranjang
- `PATCH /cart/{cart}` - Update keranjang
- `DELETE /cart/{cart}` - Hapus item
- `DELETE /cart` - Kosongkan keranjang
- `GET /cart/count` - Count items (API)

**Orders:**
- `GET /orders` - List pesanan
- `GET /orders/{order}` - Detail pesanan
- `GET /checkout` - Checkout
- `POST /orders` - Buat pesanan
- `PATCH /orders/{order}/cancel` - Batalkan pesanan

## Fitur Utama

1. **Manajemen Produk**
   - Filter by category
   - Search produk
   - Sort (latest, price, popular)
   - View counter
   - Featured products

2. **Keranjang Belanja**
   - Add to cart
   - Update quantity
   - Remove items
   - Auto calculate subtotal
   - Free shipping > Rp 500.000

3. **Checkout & Orders**
   - Shipping information
   - Payment method selection
   - Order tracking
   - Cancel order (pending only)
   - Auto stock management

4. **Validasi & Keamanan**
   - Stock validation
   - User authorization
   - Transaction rollback on error
   - Unique order numbers

## Database Configuration

Pastikan file `.env` sudah dikonfigurasi:

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\laragon\www\ujilvl18\database\database.sqlite
```

Atau untuk MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasnoonahnb
DB_USERNAME=root
DB_PASSWORD=
```

## Testing

Setelah setup, Anda bisa:
1. Login dengan test@example.com / password
2. Browse produk di homepage
3. Tambahkan produk ke keranjang
4. Lakukan checkout
5. Lihat pesanan di halaman orders

## Troubleshooting

**Error: SQLSTATE[HY000]**
- Pastikan database sudah dibuat
- Cek konfigurasi .env

**Error: Class not found**
- Jalankan: `composer dump-autoload`

**Error: Migration failed**
- Jalankan: `php artisan migrate:fresh`
- Atau hapus database dan buat ulang
