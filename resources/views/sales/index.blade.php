<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Syarah_optical – Penjualan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#0f172a}
    .sidebar{width:280px}
    .soft{box-shadow:0 1px 1px rgba(16,24,40,.04),0 10px 30px rgba(16,24,40,.06)}
    .stat-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center}
    .chip{border-radius:9999px;padding:.2rem .55rem;font-size:.75rem;font-weight:700}
  </style>
</head>
<body>
<div class="min-h-screen flex">

  {{-- Sidebar (singkron dengan halaman produk) --}}
  <aside class="sidebar bg-white border-r border-slate-100 p-5 flex flex-col justify-between">
    <div>
      <div class="flex items-center gap-3 mb-8">
        <div class="stat-icon bg-indigo-50 text-indigo-600">
          <svg class="w-6 h-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 7l9-4 9 4-9 4-9-4m0 6l9 4 9-4"/>
          </svg>
        </div>
        <div>
          <p class="text-lg font-extrabold">Syarah_optical</p>
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
        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 4-8-4m16 5l-8 4-8-4"/>
          </svg>
          Produk
        </a>
        <a href="{{ route('sales.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-semibold bg-indigo-50 text-indigo-700">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12"/>
          </svg>
          Penjualan
        </a>
        <a href="{{ route('stock.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3v18"/>
          </svg>
          Kelola Stok
        </a>
        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v14H3zM7 21h10"/>
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
          Tambah Produk
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
      <div class="stat-icon bg-emerald-100 text-emerald-600">
        <svg class="w-6 h-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
          <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12"/>
        </svg>
      </div>
      <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Penjualan</h1>
        <p class="text-sm text-slate-500">Catat transaksi penjualan dan kelola stok otomatis</p>
      </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
      <div class="mt-4 bg-emerald-50 text-emerald-700 border border-emerald-200 p-3 rounded-xl">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="mt-4 bg-rose-50 text-rose-700 border border-rose-200 p-3 rounded-xl">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Penjualan Hari Ini</div>
        <div class="mt-3 text-3xl font-extrabold">{{ $todayCount }} <span class="text-base text-slate-500 font-semibold">transaksi</span></div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Pendapatan Hari Ini</div>
        <div class="mt-3 text-3xl font-extrabold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Total Transaksi</div>
        <div class="mt-3 text-3xl font-extrabold">{{ $totalTx }} <span class="text-base text-slate-500 font-semibold">transaksi</span></div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Total Pendapatan</div>
        <div class="mt-3 text-3xl font-extrabold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
      </div>
    </div>

    {{-- Body --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
      {{-- Form transaksi --}}
      <div class="bg-emerald-50/60 rounded-2xl border border-emerald-200 soft">
        <div class="px-6 py-4 border-b border-emerald-200/70 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-700" viewBox="0 0 24 24" stroke="currentColor" fill="none">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12"/>
          </svg>
          <h2 class="text-lg font-extrabold text-emerald-800">Transaksi Penjualan Baru</h2>
        </div>

        <form action="{{ route('sales.store') }}" method="POST" class="p-6">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-sm font-semibold mb-1">Pilih Produk *</label>
              <select name="product_id" class="w-full rounded-xl border-slate-200" required>
                <option value="">Pilih produk yang akan dijual</option>
                @foreach($products as $p)
                  <option value="{{ $p->id }}">
                    {{ $p->name }} ({{ $p->sku }}) — Stok: {{ $p->stock_quantity }} — Rp {{ number_format($p->price,0,',','.') }}
                  </option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="block text-sm font-semibold mb-1">Jumlah *</label>
              <input type="number" name="quantity" min="1" value="{{ old('quantity',1) }}" class="w-full rounded-xl border-slate-200" required>
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Nama Pelanggan</label>
              <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="w-full rounded-xl border-slate-200" placeholder="(opsional)">
            </div>

            <div class="md:col-span-2">
              <label class="block text-sm font-semibold mb-1">Catatan</label>
              <textarea name="note" rows="3" class="w-full rounded-xl border-slate-200" placeholder="Catatan tambahan untuk transaksi...">{{ old('note') }}</textarea>
            </div>
          </div>

          <div class="mt-6 flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12" />
              </svg>
              Catat Penjualan
            </button>
          </div>
        </form>
      </div>

      {{-- Riwayat terbaru --}}
      <div class="bg-blue-50/60 rounded-2xl border border-blue-200 soft">
        <div class="px-6 py-4 border-b border-blue-200/70 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-700" viewBox="0 0 24 24" stroke="currentColor" fill="none">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3M5 3h14v18H5z"/>
          </svg>
          <h2 class="text-lg font-extrabold text-blue-800">Riwayat Penjualan Terbaru</h2>
        </div>

        <div class="p-6 space-y-4">
          @forelse ($recentSales as $s)
            <div class="bg-white border border-slate-100 rounded-xl p-4 soft">
              <div class="flex items-start justify-between">
                <div class="font-semibold text-slate-800">
                  {{ $s->product->name ?? 'Produk terhapus' }}
                  <span class="chip bg-slate-100 text-slate-700 ml-2">{{ $s->quantity }}x</span>
                </div>
                <div class="text-emerald-600 font-extrabold">
                  Rp {{ number_format($s->total_price, 0, ',', '.') }}
                </div>
              </div>
              <div class="text-sm text-slate-500 mt-1">
                Rp {{ number_format($s->unit_price, 0, ',', '.') }}/pcs
              </div>
              <div class="flex items-center gap-4 text-xs text-slate-500 mt-2">
                <div>👤 {{ $s->customer_name ?: 'Pelanggan Umum' }}</div>
                <div>🕒 {{ $s->sold_at->format('d/m/Y H:i') }}</div>
              </div>
              @if($s->note)
                <div class="text-xs text-slate-600 mt-2 italic">“{{ $s->note }}”</div>
              @endif
            </div>
          @empty
            <div class="text-slate-500 text-sm">Belum ada transaksi.</div>
          @endforelse
        </div>
      </div>
    </div>
  </main>

</div>
</body>
</html>
