<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Tas Ransel Urban Premium',
                'slug' => 'tas-ransel-urban-premium',
                'description' => 'Ransel modern dengan kompartemen laptop dan desain ergonomis. Cocok untuk aktivitas sehari-hari, kuliah, atau bekerja.',
                'price' => 450000,
                'discount_price' => 399000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&h=400&fit=crop',
                'brand' => 'UrbanBag',
                'material' => 'Polyester Premium',
                'color' => 'Hitam',
                'size' => '45 x 30 x 15 cm',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Tas Selempang Casual',
                'slug' => 'tas-selempang-casual',
                'description' => 'Tas selempang praktis untuk aktivitas sehari-hari. Desain minimalis dengan banyak kantong.',
                'price' => 250000,
                'discount_price' => 199000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=400&h=400&fit=crop',
                'brand' => 'CasualStyle',
                'material' => 'Canvas',
                'color' => 'Coklat',
                'size' => '25 x 20 x 8 cm',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Tas Tote Elegant',
                'slug' => 'tas-tote-elegant',
                'description' => 'Tote bag elegan untuk tampilan profesional. Material berkualitas tinggi dan desain timeless.',
                'price' => 350000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1564422170194-896b89110ef8?w=400&h=400&fit=crop',
                'brand' => 'ElegantBag',
                'material' => 'Synthetic Leather',
                'color' => 'Cream',
                'size' => '40 x 35 x 12 cm',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Tas Kulit Premium',
                'slug' => 'tas-kulit-premium',
                'description' => 'Tas kulit asli dengan desain klasik dan mewah. Investasi fashion yang tepat untuk jangka panjang.',
                'price' => 850000,
                'discount_price' => 750000,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?w=400&h=400&fit=crop',
                'brand' => 'LeatherLux',
                'material' => 'Genuine Leather',
                'color' => 'Coklat Tua',
                'size' => '35 x 28 x 10 cm',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Tas Travel Multifungsi',
                'slug' => 'tas-travel-multifungsi',
                'description' => 'Tas travel dengan banyak kompartemen untuk perjalanan. Tahan air dan sangat praktis.',
                'price' => 650000,
                'discount_price' => 599000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop',
                'brand' => 'TravelPro',
                'material' => 'Nylon Waterproof',
                'color' => 'Abu-abu',
                'size' => '55 x 35 x 25 cm',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'Tas Wanita Stylish',
                'slug' => 'tas-wanita-stylish',
                'description' => 'Tas wanita dengan desain trendy dan fashionable. Sempurna untuk melengkapi penampilan Anda.',
                'price' => 550000,
                'discount_price' => 499000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1591561954557-26941169b49e?w=400&h=400&fit=crop',
                'brand' => 'FashionBag',
                'material' => 'PU Leather',
                'color' => 'Merah Maroon',
                'size' => '30 x 25 x 12 cm',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
