@extends('layouts.main')

@section('title','Tambah Kategori')
@section('navCategory','active') {{-- Tambahkan ini di layout jika pakai sidebar nav --}}
@section('content')
<div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12">
            <h1 class="h2">Input Data Kategori</h1>
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-3 row">
                    <label for="category_name" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name" value="{{ old('category_name') }}">
                        @error('category_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
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
