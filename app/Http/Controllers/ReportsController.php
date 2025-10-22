<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Metrik harian & bulanan
        $today        = now()->toDateString();
        $monthStart   = now()->startOfMonth();
        $monthEnd     = now()->endOfMonth();

        $todayCount   = Sale::whereDate('sold_at', $today)->count();
        $todayRevenue = (float) Sale::whereDate('sold_at', $today)->sum('total_price');

        $monthCount   = Sale::whereBetween('sold_at', [$monthStart, $monthEnd])->count();
        $monthRevenue = (float) Sale::whereBetween('sold_at', [$monthStart, $monthEnd])->sum('total_price');

        // Grafik 7 hari terakhir (revenue per hari)
        $start = now()->subDays(6)->startOfDay();
        $end   = now()->endOfDay();

        $raw = Sale::select(DB::raw('DATE(sold_at) as d'), DB::raw('SUM(total_price) as rev'))
            ->whereBetween('sold_at', [$start, $end])
            ->groupBy('d')
            ->orderBy('d')
            ->pluck('rev', 'd')  // ["2025-09-29" => 2250000, ...]
            ->toArray();

        $labels = [];
        $series = [];
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::parse($start)->addDays($i)->toDateString();
            $labels[] = Carbon::parse($day)->format('d/m');
            $series[] = (float) ($raw[$day] ?? 0);
        }

        // Produk terlaris (berdasar revenue)
        $topProducts = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select(
                'sales.product_id',
                'products.name',
                DB::raw('SUM(sales.quantity) as qty'),
                DB::raw('COUNT(*) as tx'),
                DB::raw('SUM(sales.total_price) as revenue')
            )
            ->groupBy('sales.product_id', 'products.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        // Breakdown kategori (jika kolom category ada)
        $hasCategory = Schema::hasColumn('products', 'category');

        $catLabels = [];
        $catValues = [];
        $catRows   = collect();

        if ($hasCategory) {
            $catRows = Sale::join('products', 'products.id', '=', 'sales.product_id')
                ->select('products.category', DB::raw('SUM(sales.total_price) as revenue'))
                ->groupBy('products.category')
                ->orderByDesc('revenue')
                ->get();

            foreach ($catRows as $r) {
                $catLabels[] = $r->category ?? 'Lainnya';
                $catValues[] = (float) $r->revenue;
            }
        } else {
            // fallback: satu kategori "Semua"
            $sum = (float) Sale::sum('total_price');
            $catLabels = ['Semua'];
            $catValues = [$sum];
        }

        return view('reports.index', [
            'todayCount'   => $todayCount,
            'todayRevenue' => $todayRevenue,
            'monthCount'   => $monthCount,
            'monthRevenue' => $monthRevenue,
            'chartLabels'  => $labels,
            'chartSeries'  => $series,
            'topProducts'  => $topProducts,
            'catLabels'    => $catLabels,
            'catValues'    => $catValues,
        ]);
    }
}
