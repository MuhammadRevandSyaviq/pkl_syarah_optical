<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(12);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:100','unique:categories,name'],
            'description' => ['nullable','string','max:1000'],
        ]);
        Category::create($data);
        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function create()
    {
        // tampilkan form create (yang sudah kamu buat)
        return view('categories.create');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:100', Rule::unique('categories','name')->ignore($category->id)],
            'description' => ['nullable','string','max:1000'],
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // products.category_id -> null (nullOnDelete)
        return back()->with('success', 'Kategori dihapus.');
    }
}
