<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tas Ransel',
                'slug' => 'tas-ransel',
                'description' => 'Koleksi tas ransel untuk berbagai aktivitas',
                'is_active' => true,
            ],
            [
                'name' => 'Tas Selempang',
                'slug' => 'tas-selempang',
                'description' => 'Tas selempang praktis untuk sehari-hari',
                'is_active' => true,
            ],
            [
                'name' => 'Tas Tote',
                'slug' => 'tas-tote',
                'description' => 'Tas tote elegan untuk berbagai keperluan',
                'is_active' => true,
            ],
            [
                'name' => 'Tas Kulit',
                'slug' => 'tas-kulit',
                'description' => 'Tas kulit premium dengan kualitas terbaik',
                'is_active' => true,
            ],
            [
                'name' => 'Tas Travel',
                'slug' => 'tas-travel',
                'description' => 'Tas travel untuk perjalanan Anda',
                'is_active' => true,
            ],
            [
                'name' => 'Tas Wanita',
                'slug' => 'tas-wanita',
                'description' => 'Koleksi tas wanita stylish dan fashionable',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
