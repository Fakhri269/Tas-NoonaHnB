<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\OwnerActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OwnerProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('owner.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('owner.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255|unique:products,name',
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'image'          => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'brand'          => 'nullable|string|max:255',
            'material'       => 'nullable|string|max:255',
            'color'          => 'nullable|string|max:255',
            'size'           => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = '/storage/' . $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name) . '-' . uniqid(),
            'category_id'    => $request->category_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'image'          => $imagePath,
            'brand'          => $request->brand,
            'material'       => $request->material,
            'color'          => $request->color,
            'size'           => $request->size,
            'is_featured'    => $request->has('is_featured'),
            'is_active'      => $request->has('is_active'),
        ]);

        OwnerActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'tambah_produk',
            'description' => "Menambahkan produk baru: {$product->name}",
            'ip_address'  => $request->ip(),
        ]);

        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('owner.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'brand'          => 'nullable|string|max:255',
            'material'       => 'nullable|string|max:255',
            'color'          => 'nullable|string|max:255',
            'size'           => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && str_starts_with($product->image, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            $product->image = '/storage/' . $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'           => $request->name,
            'category_id'    => $request->category_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'brand'          => $request->brand,
            'material'       => $request->material,
            'color'          => $request->color,
            'size'           => $request->size,
            'is_featured'    => $request->has('is_featured'),
            'is_active'      => $request->has('is_active'),
        ]);

        OwnerActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'edit_produk',
            'description' => "Mengedit produk: {$product->name}",
            'ip_address'  => $request->ip(),
        ]);

        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Request $request, Product $product)
    {
        $productName = $product->name;

        if ($product->image && str_starts_with($product->image, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }

        $product->delete();

        OwnerActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'hapus_produk',
            'description' => "Menghapus produk: {$productName}",
            'ip_address'  => $request->ip(),
        ]);

        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
