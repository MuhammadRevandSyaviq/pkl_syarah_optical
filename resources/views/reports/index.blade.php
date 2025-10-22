<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Syarah_optical – Laporan Penjualan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#0f172a}
    .sidebar{width:280px}
    .soft{box-shadow:0 1px 1px rgba(16,24,40,.04),0 10px 30px rgba(16,24,40,.06)}
    .stat-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center}
    .chip{border-radius:9999px;padding:.2rem .6rem;font-size:.75rem;font-weight:700}
  </style>
</head>
<body>
<div class="min-h-screen flex">

  {{-- Sidebar (selaras halaman lain) --}}
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
        <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-semibold bg-indigo-50 text-indigo-700">
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
      <div class="stat-icon bg-purple-100 text-purple-600">
        <svg class="w-6 h-6" viewBox="0 0 24 24" stroke="currentColor" fill="none">
          <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M3 10h18M3 17h18"/>
        </svg>
      </div>
      <div>
        <h1 class="text-3xl font-extrabold tracking-tight">Laporan Penjualan</h1>
        <p class="text-sm text-slate-500">Analisis penjualan dan performa toko optik</p>
      </div>
    </div>

    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Penjualan Hari Ini</div>
        <div class="mt-3 text-3xl font-extrabold">{{ $todayCount }} <span class="text-base text-slate-500 font-semibold">transaksi</span></div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Pendapatan Hari Ini</div>
        <div class="mt-3 text-3xl font-extrabold">Rp {{ number_format($todayRevenue,0,',','.') }}</div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Penjualan Bulan Ini</div>
        <div class="mt-3 text-3xl font-extrabold">{{ $monthCount }} <span class="text-base text-slate-500 font-semibold">transaksi</span></div>
      </div>
      <div class="bg-white rounded-2xl p-5 soft border border-slate-100">
        <div class="text-slate-500 text-sm font-semibold">Pendapatan Bulan Ini</div>
        <div class="mt-3 text-3xl font-extrabold">Rp {{ number_format($monthRevenue,0,',','.') }}</div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
      {{-- Grafik 7 hari --}}
      <div class="bg-white rounded-2xl soft border border-slate-100 p-6">
        <h2 class="text-xl font-extrabold mb-4">Grafik Penjualan 7 Hari Terakhir</h2>
        <canvas id="sales7Chart" height="120"></canvas>
      </div>

      {{-- Produk terlaris --}}
      <div class="bg-white rounded-2xl soft border border-slate-100 p-6">
        <h2 class="text-xl font-extrabold mb-4">Produk Terlaris</h2>
        @forelse ($topProducts as $i => $tp)
          <div class="flex items-center justify-between border border-slate-100 rounded-xl p-4 mb-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-700 grid place-items-center font-bold">{{ $i+1 }}</div>
              <div>
                <div class="font-semibold">{{ $tp->name }}</div>
                <div class="flex items-center gap-2 text-xs text-slate-600 mt-1">
                  <span class="chip bg-slate-100 text-slate-700">{{ $tp->qty }} terjual</span>
                  <span class="chip bg-emerald-100 text-emerald-700">{{ $tp->tx }} transaksi</span>
                </div>
              </div>
            </div>
            <div class="text-emerald-600 font-extrabold">Rp {{ number_format($tp->revenue,0,',','.') }}</div>
          </div>
        @empty
          <p class="text-slate-500">Belum ada data penjualan.</p>
        @endforelse
      </div>
    </div>

    {{-- Pie kategori --}}
    <div class="bg-white rounded-2xl soft border border-slate-100 p-6 mt-6">
      <h2 class="text-xl font-extrabold mb-4">Breakdown Pendapatan per Kategori</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="min-h-[280px]">
          <canvas id="catPie" height="160"></canvas>
        </div>
        <div class="flex flex-col gap-3">
          @foreach ($catLabels as $idx => $label)
            <div class="flex items-center justify-between border border-slate-100 rounded-xl p-3">
              <div class="flex items-center gap-2">
                <span class="inline-block w-3 h-3 rounded-full" style="background-color: var(--c{{ $idx }});"></span>
                <span class="font-semibold">{{ $label ?? 'Lainnya' }}</span>
              </div>
              <div class="text-emerald-600 font-extrabold">
                Rp {{ number_format($catValues[$idx] ?? 0, 0, ',', '.') }}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  // Data dari controller
  const labels7 = @json($chartLabels);
  const series7 = @json($chartSeries);

  const catLabels = @json($catLabels);
  const catValues = @json($catValues);

  // Buat warna dinamis utk pie
  const colors = [
    '#60a5fa','#34d399','#f472b6','#f59e0b','#a78bfa',
    '#22d3ee','#fb7185','#84cc16','#38bdf8','#f97316'
  ];
  // mapping ke CSS var agar legend bisa pakai
  colors.forEach((c, i) => document.documentElement.style.setProperty(`--c${i}`, c));

  // Bar chart 7 hari
  const ctx7 = document.getElementById('sales7Chart').getContext('2d');
  new Chart(ctx7, {
    type: 'bar',
    data: {
      labels: labels7,
      datasets: [{
        label: 'Pendapatan (Rp)',
        data: series7,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
          }
        }
      }
    }
  });

  // Pie kategori
  const ctxPie = document.getElementById('catPie').getContext('2d');
  new Chart(ctxPie, {
    type: 'doughnut',
    data: {
      labels: catLabels,
      datasets: [{
        data: catValues,
        backgroundColor: catLabels.map((_, i) => colors[i % colors.length]),
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: (item) => {
              const val = item.raw || 0;
              return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
            }
          }
        }
      },
      cutout: '60%'
    }
  });
</script>
</body>
</html>
