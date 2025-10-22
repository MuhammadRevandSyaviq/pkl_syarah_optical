<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk – OptiStore</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root { --ring-emerald: 16 185 129; }
    html, body { min-height: 100%; }
    body {
      background: linear-gradient(135deg, #f8fafc 0%, #ecfdf5 100%);
    }
    /* Card polish for the existing container */
    .max-w-3xl.mx-auto.p-6 {
      background: rgba(255,255,255,.92);
      backdrop-filter: saturate(180%) blur(8px);
      border: 1px solid rgb(226 232 240);      /* slate-200 */
      border-radius: 1rem;                      /* rounded-2xl */
      box-shadow: 0 10px 30px rgba(2,6,23,.06);
      margin-top: 1.25rem;
    }
    /* Typography tweaks */
    h1.text-2xl {
      letter-spacing: -0.01em;
      color: rgb(30 41 59);                     /* slate-800 */
    }
    /* Inputs: keep HTML intact, just better defaults */
    input[type="text"],
    input[type="number"],
    input[type="file"],
    input[type="date"],
    input[type="email"],
    input[type="tel"],
    select,
    textarea {
      width: 100%;
      border: 1px solid rgb(226 232 240);       /* slate-200 */
      border-radius: 0.75rem;                   /* rounded-xl */
      padding: 0.625rem 0.875rem;               /* px-3.5 py-2.5 */
      outline: none;
      background: #fff;
      transition: border-color .2s, box-shadow .2s, transform .05s, background-color .2s;
      box-shadow: inset 0 1px 0 rgba(2,6,23,.03);
    }
    input::placeholder,
    textarea::placeholder {
      color: rgb(148 163 184);                  /* slate-400 */
    }
    input:focus,
    select:focus,
    textarea:focus {
      border-color: rgb(5 150 105);             /* emerald-600 */
      box-shadow: 0 0 0 4px rgba(16,185,129,.18);
    }
    label.block {
      color: rgb(51 65 85);                     /* slate-700 */
    }
    /* File input button */
    input[type="file"]::-webkit-file-upload-button {
      border: 0;
      background: rgb(226 232 240);
      padding: 0.5rem 0.75rem;
      border-radius: 0.5rem;
      margin-right: 0.75rem;
      cursor: pointer;
      transition: filter .2s;
    }
    input[type="file"]::file-selector-button {
      border: 0;
      background: rgb(226 232 240);
      padding: 0.5rem 0.75rem;
      border-radius: 0.5rem;
      margin-right: 0.75rem;
      cursor: pointer;
      transition: filter .2s;
    }
    input[type="file"]::-webkit-file-upload-button:hover,
    input[type="file"]::file-selector-button:hover {
      filter: brightness(0.97);
    }
    /* Buttons (keep existing classes; just nicer interactions) */
    button,
    a.px-4 {
      transition: background-color .2s, box-shadow .2s, transform .05s, opacity .2s;
    }
    button:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(2,6,23,.08);
    }
    button:active { transform: translateY(0); box-shadow: none; }
    a.bg-slate-200:hover { background: rgb(226 232 240); }
    .bg-emerald-600:hover { filter: brightness(0.95); }
    /* Lists in error box */
    ul.list-disc li { margin: 2px 0; }
    /* Textarea behavior */
    textarea { resize: vertical; }
  </style>

</head>
<body class="bg-slate-50">
<div class="max-w-3xl mx-auto p-6">
  <h1 class="text-2xl font-extrabold mb-4">Edit Produk</h1>

  @if ($errors->any())
    <div class="mb-4 bg-rose-50 text-rose-700 border border-rose-200 p-3 rounded-lg">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm space-y-4">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-semibold mb-1">Nama *</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-xl border-slate-200" required>
      </div>
      <div>
        <label class="block text-sm font-semibold mb-1">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full rounded-xl border-slate-200">
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Kategori</label>
        <div class="flex gap-2">
          <select name="category_id" class="w-full rounded-xl border-slate-200">
            <option value="">— Pilih kategori —</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                @selected(old('category_id', $product->category_id) == $cat->id)>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 text-slate-700 text-sm">Kelola</a>
        </div>
      </div>
      <div>
        <label class="block text-sm font-semibold mb-1">Merek</label>
        <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full rounded-xl border-slate-200">
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Harga</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" class="w-full rounded-xl border-slate-200">
      </div>
      <div>
        <label class="block text-sm font-semibold mb-1">Stok *</label>
        <input type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full rounded-xl border-slate-200" required>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Stok Minimum</label>
        <input type="number" min="0" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}" class="w-full rounded-xl border-slate-200">
      </div>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Deskripsi</label>
      <textarea name="description" rows="4" class="w-full rounded-xl border-slate-200">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-800">Batal</a>
      <button class="px-4 py-2 rounded-xl bg-emerald-600 text-white">Simpan Perubahan</button>
    </div>
  </form>
</div>
</body>
</html>
