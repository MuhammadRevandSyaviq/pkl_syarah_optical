<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>OptiStore – Manajemen Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#0f172a}
    .sidebar{width:280px}
    .soft{box-shadow:0 1px 1px rgba(16,24,40,.04),0 10px 30px rgba(16,24,40,.06)}
    .stat-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center}
    .chip{border-radius:9999px;padding:.25rem .6rem;font-size:.75rem;font-weight:700}
  </style>
</head>
<body>
<div class="min-h-screen flex">

  {{-- Sidebar ringkas --}}
  <aside class="sidebar bg-white border-r border-slate-100 p-5 flex flex-col justify-between">
    <div>
      <div class="flex items-center gap-3 mb-8">
        <div class="stat-icon bg-indigo-50 text-indigo-600">
          <svg class="w-6 h-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 7l9-4 9 4-9 4-9-4m0 6l9 4 9-4"/>
          </svg>
        </div>
        <div>
          <p class="text-lg font-extrabold">OptiStore</p>
          <p class="text-xs text-slate-500">Sistem Inventori Toko Optik</p>
        </div>
      </div>

      <nav class="space-y-1">
        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M3 10h18M3 17h18"/>
          </svg>
          kategori
        </a>
        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-semibold bg-indigo-50 text-indigo-700">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 4-8-4m16 5l-8 4-8-4"/>
          </svg>
          Produk
        </a>
        <a href="{{ route('sales.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12"/>
          </svg>
          Penjualan
        </a>
        <a href="{{ route('stock.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 4v16M4 12h16"/>
          </svg>
          Kelola Stok
        </a>
        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M3 10h18M3 17h18"/>
          </svg>
          Laporan
        </a>
      </nav>

      <div class="mt-8 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
        <p class="text-xs text-slate-500 mb-3">AKSI CEPAT</p>
        <a href="{{ route('products.create') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 soft">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/>
          </svg>
          Tambah Produk Baru
        </a>
      </div>
    </div>

    <div class="flex items-center p-3 bg-slate-50 rounded-xl">
      <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold grid place-items-center">A</div>
      <div class="ml-3">
        <p class="text-sm font-semibold">Admin</p>
        <p class="text-xs text-slate-500">Toko Optik</p>
      </div>
    </div>
  </aside>

  {{-- Main --}}
  <main class="flex-1 p-8">

    {{-- Header --}}
    <div class="flex items-center gap-3">
      <div class="stat-icon bg-indigo-100 text-indigo-600">
        <svg class="w-6 h-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
          <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 4-8-4m16 5l-8 4-8-4"/>
        </svg>
      </div>
      <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Manajemen Produk</h1>
        <p class="text-sm text-slate-500">Kelola produk dan stok barang toko optik</p>
      </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
      <div class="mt-4 bg-emerald-50 text-emerald-700 border border-emerald-200 p-3 rounded-xl">{{ session('success') }}</div>
    @endif

    {{-- Metrik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Total Produk</div>
        <div class="mt-3 text-3xl font-extrabold">{{ number_format($totalProducts) }}</div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Total Stok</div>
        <div class="mt-3 text-3xl font-extrabold">{{ number_format($totalStock) }} <span class="text-base text-slate-500 font-semibold">pcs</span></div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Nilai Inventori</div>
        <div class="mt-3 text-3xl font-extrabold">Rp {{ number_format($inventoryValue, 0, ',', '.') }}</div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Stok Menipis</div>
        <div class="mt-3 text-3xl font-extrabold">{{ number_format($lowStockCount) }} <span class="text-base font-semibold text-slate-500">item</span></div>
      </div>
    </div>

    {{-- Toolbar: Search + Filter Stok Menipis --}}
    <div class="mt-6 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
      <form action="{{ route('products.index') }}" method="GET" class="flex-1">
        <input type="hidden" name="low" value="{{ request('low') ? 1 : 0 }}">
        <div class="relative">
          <input type="text" name="q" value="{{ $search }}" placeholder="Cari produk, kode, merek..."
                 class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2 bg-white">
          <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/>
          </svg>
        </div>
      </form>

      <div class="flex items-center gap-2">
        @php $qs = request()->except('page'); @endphp
        <a href="{{ route('products.index', array_merge($qs, ['low' => request('low') ? 0 : 1])) }}"
           class="chip {{ request('low') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
          Stok Menipis
        </a>
      </div>
    </div>

    {{-- Grid Produk --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mt-6">
      @forelse ($products as $p)
        @php
          $stock = (int) ($p->stock_quantity ?? 0);
          $min   = (int) ($p->min_stock ?? 0);
          $isLow = !is_null($p->min_stock) && $stock <= $min;
        @endphp

        <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
          <div class="flex items-start justify-between">
            <div class="font-semibold text-lg">{{ $p->name }}</div>
            <div class="text-slate-400 text-xs">SKU: {{ $p->sku ?: '-' }}</div>
          </div>

          <div class="mt-2 flex flex-wrap gap-2 text-xs">
            @if($p->category)
              <span class="chip bg-slate-100 text-slate-700">{{ $p->category }}</span>
            @endif
            @if($p->brand)
              <span class="chip bg-slate-100 text-slate-700">{{ $p->brand }}</span>
            @endif
            @if($isLow)
              <span class="chip bg-rose-100 text-rose-700">Menipis</span>
            @endif
          </div>

          <div class="mt-3 text-sm text-slate-600">Harga:</div>
          <div class="text-xl font-extrabold">Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}</div>

          <div class="mt-3 text-sm text-slate-600">Stok:</div>
          <div class="flex items-center gap-2">
            <span class="font-semibold {{ $isLow ? 'text-rose-600' : 'text-emerald-600' }}">
              {{ number_format($stock) }} pcs
            </span>
            @if($isLow)
              <svg class="w-4 h-4 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
              </svg>
            @endif
            @if(!is_null($p->min_stock))
              <span class="text-slate-400 text-xs">Min: {{ $p->min_stock }}</span>
            @endif
          </div>

          <div class="mt-5 flex items-center gap-2">
            <a href="{{ route('products.edit', $p) }}" class="px-3 py-2 rounded-xl bg-slate-900 text-white text-sm">Edit</a>
            <form action="{{ route('products.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
              @csrf @method('DELETE')
              <button class="px-3 py-2 rounded-xl bg-rose-600 text-white text-sm">Hapus</button>
            </form>
          </div>
        </div>
      @empty
        <div class="col-span-full text-slate-500">Belum ada produk.</div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $products->links() }}
    </div>
  </main>
</div>
</body>
</html>
