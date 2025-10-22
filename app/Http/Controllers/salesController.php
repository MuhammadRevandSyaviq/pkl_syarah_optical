<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // ambil produk untuk dropdown (yang stok > 0 ditaruh duluan)
        $products = Product::orderByDesc('stock_quantity')
            ->orderBy('name')
            ->get(['id','name','sku','price','stock_quantity']);

        // metrik
        $todayCount   = Sale::whereDate('sold_at', now()->toDateString())->count();
        $todayRevenue = (float) Sale::whereDate('sold_at', now()->toDateString())->sum('total_price');
        $totalTx      = Sale::count();
        $totalRevenue = (float) Sale::sum('total_price');

        // riwayat terbaru
        $recentSales = Sale::with('product')->orderByDesc('sold_at')->limit(10)->get();

        return view('sales.index', compact(
            'products','todayCount','todayRevenue','totalTx','totalRevenue','recentSales'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'    => ['required','exists:products,id'],
            'quantity'      => ['required','integer','min:1'],
            'customer_name' => ['nullable','string','max:255'],
            'note'          => ['nullable','string','max:2000'],
        ]);

        // pastikan kolom wajib ada
        if (! Schema::hasColumn('products', 'stock_quantity')) {
            throw ValidationException::withMessages([
                'product_id' => 'Kolom stock_quantity tidak ditemukan pada tabel products.'
            ]);
        }
        if (! Schema::hasColumn('products', 'price')) {
            throw ValidationException::withMessages([
                'product_id' => 'Kolom price tidak ditemukan pada tabel products.'
            ]);
        }

        DB::transaction(function () use ($data) {
            // kunci baris produk untuk mencegah oversell
            $product = Product::whereKey($data['product_id'])->lockForUpdate()->firstOrFail();

            if ($product->stock_quantity < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak mencukupi. Stok tersedia: {$product->stock_quantity}."
                ]);
            }

            $unit = (float) ($product->price ?? 0);
            $qty  = (int) $data['quantity'];
            $total = $unit * $qty;

            // catat transaksi
            Sale::create([
                'product_id'    => $product->id,
                'quantity'      => $qty,
                'unit_price'    => $unit,
                'total_price'   => $total,
                'customer_name' => $data['customer_name'] ?? null,
                'note'          => $data['note'] ?? null,
                'sold_at'       => now(),
            ]);

            // kurangi stok
            $product->decrement('stock_quantity', $qty);
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi penjualan dicatat.');
    }
}
