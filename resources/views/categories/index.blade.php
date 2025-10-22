<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OptiStore – Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    :root { --soft: 0 10px 30px rgba(16,24,40,.06); }
    html,body{height:100%}
    body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#0f172a}
    .sidebar{width:280px}
    .soft{box-shadow:0 1px 1px rgba(16,24,40,.04),var(--soft)}
    .chip{border-radius:9999px;padding:.25rem .6rem;font-size:.75rem;font-weight:700}
  </style>
</head>
<body class="min-h-screen">
  <div class="min-h-screen flex gap-6">
    <!-- Sidebar -->
    <aside class="sidebar hidden md:flex flex-col justify-between bg-white border-r border-slate-200 p-6">
      <div>
        <div class="flex items-center gap-3 mb-8">
          <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center soft">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-width="2" stroke-linecap="round" d="M4 6h16M4 12h10M4 18h7"/>
            </svg>
          </div>
          <div>
            <div class="font-extrabold leading-none">OptiStore</div>
            <div class="text-[11px] text-slate-500">Sistem Inventori Toko Optik</div>
          </div>
        </div>

        <nav class="space-y-1">
        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl font-semibold bg-indigo-50 text-indigo-700">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 4-8-4m16 5l-8 4-8-4"/>
          </svg>
          kategori
        </a>
        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-600 hover:bg-slate-50">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M3 3h16l2 4H3zM3 7h18M6 21h12"/>
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
          <a href="{{ route('categories.create') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 soft">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Kategori Baru
          </a>
        </div>
      </div>

      <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
        <div class="w-8 h-8 rounded-xl bg-slate-200"></div>
        <div>
          <div class="text-sm font-bold">Admin</div>
          <div class="text-xs text-slate-500">Toko</div>
        </div>
      </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 px-5 md:px-0 md:pr-8">
      <!-- Top Navbar / Header -->
      <header class="flex items-start justify-between py-6">
        <div>
          <h1 class="text-3xl font-extrabold tracking-tight">Manajemen Kategori</h1>
          <p class="text-slate-500 mt-2">Kelola kategori untuk pengelompokan produk di toko optik Anda.</p>
        </div>
        <div class="hidden sm:flex gap-2">
          <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 soft">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
            Kategori Baru
          </a>
        </div>
      </header>

      <!-- Search -->
      <div class="flex items-center gap-2 mb-5">
        <div class="flex-1 relative">
          <input id="search" type="text" placeholder="Cari kategori..." class="w-full pl-10 pr-3 py-2.5 rounded-2xl bg-white border border-slate-200 soft outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-200/50">
          <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="2" stroke-linecap="round" d="M11 5a6 6 0 100 12 6 6 0 000-12zm0 0l6 6"/>
          </svg>
        </div>
      </div>

      <!-- Alerts -->
      @if (session('success'))
        <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 px-4 py-3">
          {{ session('error') }}
        </div>
      @endif

      <!-- Categories List -->
      <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4" id="category-list">
        @forelse ($categories as $category)
          <div class="bg-white rounded-2xl border border-slate-200 soft p-5 category-item">
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-lg font-extrabold leading-snug category-name">{{ $category->name }}</h3>
              </div>
              <span class="chip bg-slate-100 text-slate-700">Kategori</span>
            </div>
            <div class="mt-4 flex items-center gap-2">
              <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M12 20h9"/></svg>
                Edit
              </a>
              <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-rose-600 text-white hover:bg-rose-700">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M6 7h12M9 7V5h6v2m-8 0l1 12a2 2 0 002 2h4a2 2 0 002-2l1-12"/></svg>
                  Hapus
                </button>
              </form>
            </div>
          </div>
        @empty
          <div class="text-slate-500">Belum ada kategori.</div>
        @endforelse
      </section>

      <!-- Pagination -->
      <div class="mt-6">
        {{ $categories->links() }}
      </div>
    </main>
  </div>

  <script>
    // simple client-side filter
    const search = document.getElementById('search');
    const items = document.querySelectorAll('.category-item');
    const names = document.querySelectorAll('.category-name');
    search && search.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      items.forEach((card, i) => {
        const name = names[i]?.textContent?.toLowerCase() ?? '';
        card.style.display = name.includes(q) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
