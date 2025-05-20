@extends('layouts.main')

@section('title','Tambah Movie')
@section('navMovie','active')
@section('content')
<div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12">
            <h1 class="h2">Input Data Movie</h1>
            <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Slug -->
                <div class="mb-3 row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tahun Rilis -->
                <div class="mb-3 row">
                    <label for="year" class="col-sm-2 col-form-label">Tahun Rilis</label>
                    <div class="col-sm-10">
                        <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" id="year" value="{{ old('year') }}">
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kategori -->
                <div class="mb-3 row">
                    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Sinopsis -->
                <div class="mb-3 row">
                    <label for="synopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <textarea name="synopsis" class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" rows="4">{{ old('synopsis') }}</textarea>
                        @error('synopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Aktor -->
                <div class="mb-3 row">
                    <label for="actors" class="col-sm-2 col-form-label">Aktor</label>
                    <div class="col-sm-10">
                        <input type="text" name="actors" class="form-control @error('actors') is-invalid @enderror" id="actors" value="{{ old('actors') }}">
                        @error('actors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Gambar Cover -->
                <div class="mb-3 row">
                    <label for="cover_image" class="col-sm-2 col-form-label">Gambar Cover</label>
                    <div class="col-sm-10">
                        <p class="text-muted mb-1">Upload Gambar (opsional jika pakai link)</p>
                        <input type="file" name="cover_image" class="form-control mb-2 @error('cover_image') is-invalid @enderror" id="cover_image">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <p class="text-muted mt-2 mb-1">Atau masukkan link gambar</p>
                        <input type="url" name="cover_image_url" class="form-control @error('cover_image_url') is-invalid @enderror" placeholder="https://example.com/image.jpg" value="{{ old('cover_image_url') }}">
                        @error('cover_image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
