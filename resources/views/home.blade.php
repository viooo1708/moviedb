@extends('layouts.main')
@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Selamat Datang di Movie Database</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Aplikasi</h5>
                </div>
                <div class="card-body">
                    <p>Aplikasi ini memungkinkan Anda melihat, menambah, mengedit, dan menghapus data film favorit Anda.</p>
                    <a href="{{ route('movies.index') }}" class="btn btn-primary">Lihat Daftar Movie</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Fitur MovieDB</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Tambah Movie</li>
                        <li>Edit Movie</li>
                        <li>Hapus Movie</li>
                        <li>Lihat Daftar Movie</li>
                    </ul>
                    <a href="{{ route('movies.create') }}" class="btn btn-success">Tambah Movie Baru</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
