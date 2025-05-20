<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $movies = Movie::latest()->paginate(6); // Sesuaikan jumlah film yang ingin ditampilkan per halaman
        return view('home', compact('movies'));
    }
    // public function homepage()
    // {
    //     $movies = Movie::latest()->paginate(6);
    //     return view('homepage', compact('movies'));
    // }


    public function index(Request $request)
    {
        $query = Movie::query();

        // Pencarian berdasarkan judul atau sinopsis film
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('synopsis', 'like', '%' . $search . '%');
        }

        $movies = $query->latest()->paginate(10);
        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('movies.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255|unique:movies',
        'slug' => 'nullable|max:255|unique:movies',
        'synopsis' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'year' => 'required|integer',
        'actors' => 'nullable|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cover_image_url' => 'nullable|url',
    ]);

    // Simpan gambar jika diupload dari file
    if ($request->hasFile('cover_image')) {
        $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
    } elseif ($request->filled('cover_image_url')) {
        $validated['cover_image'] = $request->input('cover_image_url');
    }

    // Hapus cover_image_url dari validasi agar tidak error
    unset($validated['cover_image_url']);

    Movie::create($validated);

    session()->flash('success', 'Film berhasil ditambahkan.');
    return redirect()->route('movies.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('movies.edit', compact('movie', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|max:255|unique:movies,title,' . $id,
            'slug' => 'nullable|max:255|unique:movies,slug,' . $id,
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer',
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image_url' => 'nullable|url',
        ]);

        // Proses cover image
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada dan bukan URL
            if ($movie->cover_image && !filter_var($movie->cover_image, FILTER_VALIDATE_URL)) {
                Storage::delete('public/' . $movie->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        } elseif ($request->filled('cover_image_url')) {
            // Hapus gambar lama jika ada dan bukan URL
            if ($movie->cover_image && !filter_var($movie->cover_image, FILTER_VALIDATE_URL)) {
                Storage::delete('public/' . $movie->cover_image);
            }
            // Gunakan URL gambar sebagai cover_image
            $validated['cover_image'] = $request->input('cover_image_url');
        } else {
            // Jika tidak upload file dan tidak isi URL,
            // jangan ubah kolom cover_image, hapus dari validated supaya tidak overwrite dengan null
            unset($validated['cover_image']);
        }

        // Hapus key cover_image_url dari validated agar tidak error
        unset($validated['cover_image_url']);

        $movie->update($validated);

        session()->flash('success', 'Film berhasil diperbarui.');
        return redirect()->route('movies.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus gambar terkait
        if ($movie->cover_image) {
            Storage::delete('public/' . $movie->cover_image);
        }

        $movie->delete();

        session()->flash('success', 'Film berhasil dihapus.');
        return redirect()->route('movies.index');
    }
}
