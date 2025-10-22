<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    // alasan bawaan
    private array $reasonsIn  = ['Pembelian baru','Penyesuaian (+)','Retur pelanggan (+)','Koreksi'];
    private array $reasonsOut = ['Penyesuaian (-)','Rusak/Hilang','Retur ke supplier','Koreksi'];

    public function index(Request $request)
    {
        $hasMinStock = Schema::hasColumn('products', 'min_stock');
        $fallbackMin = 5; // dipakai jika min_stock tidak ada

        // produk untuk dropdown
        $products = Product::orderBy('name')
            ->get(['id','name','sku','price','stock_quantity', $hasMinStock ? 'min_stock' : DB::raw('0 as min_stock')]);

        // peringatan stok menipis
        if ($hasMinStock) {
            $lowStocks = Product::whereNotNull('min_stock')
                ->whereColumn('stock_quantity', '<=', 'min_stock')
                ->orderBy('stock_quantity')
                ->get(['id','name','sku','stock_quantity','min_stock']);
        } else {
            $lowStocks = Product::where('stock_quantity', '<=', $fallbackMin)
                ->orderBy('stock_quantity')
                ->get(['id','name','sku','stock_quantity'])
                ->map(function ($p) use ($fallbackMin) {
                    $p->min_stock = $fallbackMin;
                    return $p;
                });
        }

        // riwayat terbaru
        $movements = StockMovement::with('product')
            ->orderByDesc('moved_at')->limit(12)->get();

        return view('stock.index', [
            'products'     => $products,
            'lowStocks'    => $lowStocks,
            'movements'    => $movements,
            'reasonsIn'    => $this->reasonsIn,
            'reasonsOut'   => $this->reasonsOut,
            'hasMinStock'  => $hasMinStock,
        ]);
    }

    public function increase(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','exists:products,id'],
            'quantity'   => ['required','integer','min:1'],
            'reason'     => ['nullable','string','max:255'],
            'note'       => ['nullable','string','max:2000'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $before  = (int) $product->stock_quantity;
            $qty     = (int) $data['quantity'];

            $product->increment('stock_quantity', $qty);
            $after   = $before + $qty;

            StockMovement::create([
                'product_id'   => $product->id,
                'type'         => 'in',
                'quantity'     => $qty,
                'reason'       => $data['reason'] ?? 'Penambahan',
                'note'         => $data['note'] ?? null,
                'before_stock' => $before,
                'after_stock'  => $after,
                'moved_at'     => now(),
            ]);
        });

        return back()->with('success', 'Stok berhasil ditambah.');
    }

    public function decrease(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','exists:products,id'],
            'quantity'   => ['required','integer','min:1'],
            'reason'     => ['nullable','string','max:255'],
            'note'       => ['nullable','string','max:2000'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $before  = (int) $product->stock_quantity;
            $qty     = (int) $data['quantity'];

            if ($before < $qty) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak mencukupi. Stok tersedia: {$before}."
                ]);
            }

            $product->decrement('stock_quantity', $qty);
            $after   = $before - $qty;

            StockMovement::create([
                'product_id'   => $product->id,
                'type'         => 'out',
                'quantity'     => $qty,
                'reason'       => $data['reason'] ?? 'Pengurangan',
                'note'         => $data['note'] ?? null,
                'before_stock' => $before,
                'after_stock'  => $after,
                'moved_at'     => now(),
            ]);
        });

        return back()->with('success', 'Stok berhasil dikurangi.');
    }
}
