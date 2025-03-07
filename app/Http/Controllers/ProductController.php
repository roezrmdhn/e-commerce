<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantOption;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        $products = Product::with('variants')->latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Menampilkan halaman form tambah produk
     */
    public function create()
    {
        $variants = Variant::with('options')->get();
        return view('admin.product.create', compact('variants'));
    }

    /**
     * Menyimpan produk baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'variant_id' => 'nullable|exists:variants,id',
            'variant_options' => 'nullable|array',
            'variant_options.*' => 'string|max:255',
        ]);

        // Upload Image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Simpan produk
        $product = Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->is_active ? true : false,
            'image' => $imagePath,
        ]);

        // Simpan variant jika ada
        if ($request->variant_id && $request->variant_options) {
            foreach ($request->variant_options as $optionName) {
                // Cek apakah opsi varian sudah ada
                $variantOption = VariantOption::firstOrCreate([
                    'variant_id' => $request->variant_id,
                    'name' => $optionName
                ]);

                // Hubungkan produk dengan variant_option
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_option_id' => $variantOption->id,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Menampilkan halaman edit produk
     */
    public function edit(Product $product)
    {
        $variants = Variant::with('options')->get();
        $selectedOptions = $product->variantOptions()->pluck('variant_option_id')->toArray();

        return view('admin.product.edit', compact('product', 'variants', 'selectedOptions'));
    }

    /**
     * Update produk di database
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => "required|string|max:100|unique:products,sku,{$product->id}",
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'variant_id' => 'nullable|exists:variants,id',
            'variant_options' => 'nullable|array',
            'variant_options.*' => 'string|max:255',
        ]);

        // Update Image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => $request->is_active ? true : false,
            'image' => $imagePath,
        ]);

        // Update Variant Options
        if ($request->variant_id) {
            // Hapus varian lama
            ProductVariant::where('product_id', $product->id)->delete();

            if ($request->variant_options) {
                foreach ($request->variant_options as $optionName) {
                    $variantOption = VariantOption::firstOrCreate([
                        'variant_id' => $request->variant_id,
                        'name' => $optionName
                    ]);

                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_option_id' => $variantOption->id,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Menghapus produk dari database
     */
    public function destroy(Product $product)
    {
        // Hapus gambar jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus product dan variannya
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
    public function home()
    {
        $products = Product::where('is_active', true)->get();
        return view('home.product.index', compact('products'));
    }
    public function show($id)
    {
        $product = Product::with('productVariants.variantOption')->findOrFail($id);

        return view('home.product.detail', compact('product'));
    }
}
