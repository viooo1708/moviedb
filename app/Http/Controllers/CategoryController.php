<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Pencarian berdasarkan nama kategori atau deskripsi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('category_name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        $categories = $query->latest()->paginate(10);
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        session()->flash('success', 'Kategori berhasil ditambahkan.');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'category_name' => 'required|max:255|unique:categories,category_name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        session()->flash('success', 'Kategori berhasil diperbarui.');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('success', 'Kategori berhasil dihapus.');
        return redirect()->route('categories.index');
    }
}
