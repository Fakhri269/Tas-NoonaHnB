<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Fix duplicate slugs before adding unique constraint
        $products = DB::table('products')->orderBy('id')->get();
        $seen = [];
        foreach ($products as $product) {
            $base = Str::slug($product->name);
            $slug = $base;
            $i = 1;
            while (in_array($slug, $seen)) {
                $slug = $base . '-' . $i++;
            }
            $seen[] = $slug;
            if ($slug !== $product->slug) {
                DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
            }
        }

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->unique('slug', 'products_slug_unique');
            });
        } catch (\Exception $e) {
            // Index might already exist
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique('products_slug_unique');
        });
    }
};
