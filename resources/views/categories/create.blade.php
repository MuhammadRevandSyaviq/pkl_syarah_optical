<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OptiStore – Tambah Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    :root { --soft: 0 10px 30px rgba(16,24,40,.06); }
    html,body{height:100%}
    body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#0f172a}
    .sidebar{width:280px}
    .soft{box-shadow:0 1px 1px rgba(16,24,40,.04),var(--soft)}
    .chip{border-radius:9999px;padding:.25rem .6rem;font-size:.75rem;font-weight:700}
    /* Base input polish (without changing markup elsewhere) */
    input[type="text"],
    textarea, select {
      width:100%;
      border:1px solid rgb(226 232 240);
      border-radius:0.75rem;
      padding:0.625rem 0.875rem;
      outline:none;
      background:#fff;
      transition:border-color .2s, box-shadow .2s;
      box-shadow: inset 0 1px 0 rgba(2,6,23,.03);
    }
    input:focus, textarea:focus, select:focus {
      border-color: rgb(5 150 105);
      box-shadow: 0 0 0 4px rgba(16,185,129,.18);
    }
  </style>
</head>
<body class="min-h-screen">
  <div class="min-h-screen flex gap-6">
    <!-- Sidebar -->
    <aside class="sidebar hidden md:flex flex-col justify-between bg-white border-r border-slate-200 p-6">
      <div>
        <div class="flex items-center gap-3 mb-8">
          <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-content-center soft flex items-center justify-center">
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
          <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 font-semibold">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            kategori
          </a>
          <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-50">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M20 7H4m16 5H4m16 5H4"/></svg>
            Produk
          </a>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-50">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M7 10h10M7 14h7M5 6h14M5 18h10"/></svg>
            Penjualan
          </a>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-50">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M12 6v12M6 12h12"/></svg>
            Kelola Stok
          </a>
          <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl text-slate-700 hover:bg-slate-50">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M3 3h18v14H3zM7 21h10"/></svg>
            Laporan
          </a>
        </nav>

        <div class="mt-8 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
          <p class="text-xs text-slate-500 mb-3">AKSI CEPAT</p>
          <a href="{{ route('categories.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 soft">
            Kembali ke Kategori
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
          <h1 class="text-3xl font-extrabold tracking-tight">Tambah Kategori</h1>
          <p class="text-slate-500 mt-2">Buat kategori baru untuk mengelompokkan produk.</p>
        </div>
      </header>

      <!-- Alerts -->
      @if (session('success'))
        <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3">
          {{ session('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 px-4 py-3">
          <div class="font-semibold mb-1">Ada yang perlu dicek:</div>
          <ul class="list-disc pl-5 space-y-0.5">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Card Form -->
      <div class="bg-white rounded-2xl border border-slate-200 soft p-6">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label class="block text-sm font-semibold mb-1">Nama Kategori <span class="text-rose-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Kacamata Pria" required>
            @error('name') <p class="mt-1 text-rose-600 text-sm">{{ $message }}</p> @enderror
          </div>

          <div class="flex items-center gap-3">
            <a href="{{ route('categories.index') }}" class="inline-flex justify-center px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-white soft">
              Batal
            </a>
            <button type="submit" class="inline-flex justify-center px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white soft">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
