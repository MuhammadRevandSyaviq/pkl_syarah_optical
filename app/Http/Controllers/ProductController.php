<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $hasMinStock = Schema::hasColumn('products', 'min_stock');
        $search = trim((string) $request->get('q'));

        $query = Product::with('categoryRef');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->boolean('low') && $hasMinStock) {
            $query->whereNotNull('min_stock')
                  ->whereColumn('stock_quantity', '<=', 'min_stock');
        }

        $products = $query->orderBy('name')->paginate(12)->withQueryString();

        $totalProducts = Product::count();
        $totalStock    = (int) Product::sum('stock_quantity');
        $inventoryValue = (float) Product::select(DB::raw('SUM(COALESCE(stock_quantity,0) * COALESCE(price,0)) as v'))->value('v');

        $lowStockCount = 0;
        if ($hasMinStock) {
            $lowStockCount = (int) Product::whereNotNull('min_stock')
                ->whereColumn('stock_quantity', '<=', 'min_stock')
                ->count();
        }

        return view('products.index', compact(
            'products','totalProducts','totalStock','inventoryValue',
            'lowStockCount','hasMinStock','search'
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => ['required','string','max:255'],
            'sku'            => ['nullable','string','max:100','unique:products,sku'],
            'category_id'    => ['nullable','exists:categories,id'],
            'brand'          => ['nullable','string','max:100'],
            'price'          => ['nullable','numeric','min:0'],
            'stock_quantity' => ['required','integer','min:0'],
            'min_stock'      => ['nullable','integer','min:0'],
            'description'    => ['nullable','string','max:5000'],
        ]);

        if (!empty($data['category_id'])) {
            $cat = Category::find($data['category_id']);
            $data['category'] = $cat?->name; // isi kolom string 'category' agar kompatibel
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'           => ['required','string','max:255'],
            'sku'            => ['nullable','string','max:100', Rule::unique('products','sku')->ignore($product->id)],
            'category_id'    => ['nullable','exists:categories,id'],
            'brand'          => ['nullable','string','max:100'],
            'price'          => ['nullable','numeric','min:0'],
            'stock_quantity' => ['required','integer','min:0'],
            'min_stock'      => ['nullable','integer','min:0'],
            'description'    => ['nullable','string','max:5000'],
        ]);

        if (!empty($data['category_id'])) {
            $cat = Category::find($data['category_id']);
            $data['category'] = $cat?->name;
        } else {
            $data['category'] = null;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
