<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kategori – OptiStore</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root { --ring-emerald: 16 185 129; }
    html, body { min-height: 100%; }
    body {
      background: linear-gradient(135deg, #f8fafc 0%, #ecfdf5 100%);
    }
    /* Card container polish (keeps existing structure) */
    .max-w-3xl.mx-auto.p-6 {
      background: rgba(255,255,255,.92);
      backdrop-filter: saturate(180%) blur(8px);
      border: 1px solid rgb(226 232 240);
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(2,6,23,.06);
      margin-top: 1.25rem;
    }
    h1.text-2xl { letter-spacing: -0.01em; color: rgb(30 41 59); }
    /* Inputs */
    input[type="text"], input[type="number"], input[type="file"],
    input[type="date"], input[type="email"], input[type="tel"],
    select, textarea {
      width: 100%;
      border: 1px solid rgb(226 232 240);
      border-radius: 0.75rem;
      padding: 0.625rem 0.875rem;
      outline: none;
      background: #fff;
      transition: border-color .2s, box-shadow .2s, transform .05s, background-color .2s;
      box-shadow: inset 0 1px 0 rgba(2,6,23,.03);
    }
    input::placeholder, textarea::placeholder { color: rgb(148 163 184); }
    input:focus, select:focus, textarea:focus {
      border-color: rgb(5 150 105);
      box-shadow: 0 0 0 4px rgba(16,185,129,.18);
    }
    label.block { color: rgb(51 65 85); }
    /* File input button */
    input[type="file"]::-webkit-file-upload-button,
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
    input[type="file"]::file-selector-button:hover { filter: brightness(0.97); }
    /* Buttons */
    button, a.px-4 { transition: background-color .2s, box-shadow .2s, transform .05s, opacity .2s; }
    button:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(2,6,23,.08); }
    button:active { transform: translateY(0); box-shadow: none; }
    a.bg-slate-200:hover { background: rgb(226 232 240); }
    .bg-emerald-600:hover { filter: brightness(0.95); }
    /* Error list spacing */
    ul.list-disc li { margin: 2px 0; }
    textarea { resize: vertical; }
  </style>

</head>
<body class="bg-slate-50">
<div class="max-w-3xl mx-auto p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-extrabold">Edit Kategori</h1>
    <a href="{{ route('categories.index') }}" class="text-sm text-slate-600 hover:underline">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="mb-4 bg-rose-50 text-rose-700 border border-rose-200 p-3 rounded-lg">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm space-y-3">
    @csrf @method('PUT')
    <div>
      <label class="block text-sm font-semibold mb-1">Nama *</label>
      <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-xl border-slate-200" required>
    </div>
    <div>
      <label class="block text-sm font-semibold mb-1">Deskripsi</label>
      <textarea name="description" rows="3" class="w-full rounded-xl border-slate-200">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-xl bg-slate-200 text-slate-800">Batal</a>
      <button class="px-4 py-2 rounded-xl bg-emerald-600 text-white">Simpan</button>
    </div>
  </form>
</div>
</body>
</html>
