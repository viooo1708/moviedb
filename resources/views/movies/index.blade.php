@extends('layouts.main')

@section('title', 'Daftar Film')
@section('navMovies', 'active')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Film</h1>

    {{-- Flash message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Tombol Input Data --}}
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Input Film</a>

    {{-- Tabel Data Film --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Actors</th>
                    <th>Cover Image</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movies->firstItem() + $loop->index }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->category->category_name }}</td>
                        <td>{{ $movie->year }}</td>
                        <td>{{ $movie->actors }}</td>
                        <td><img src="{{ $movie->cover_image }}" alt="{{ $movie->title }}" width="100" class="img-fluid"></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Aksi">
                                {{-- Edit --}}
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning me-2" title="Edit Film">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                {{-- Detail --}}
                                <a href="#" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#detailModal{{ $movie->id }}" title="Lihat Detail">
                                    <i class="bi bi-eye fs-5"></i>
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Film">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Detail Film --}}
    @foreach ($movies as $movie)
        <div class="modal fade" id="detailModal{{ $movie->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $movie->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $movie->id }}">Detail Film</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Judul Film:</strong> {{ $movie->title }}</p>
                        <p><strong>Slug:</strong> {{ $movie->slug }}</p>
                        <p><strong>Kategori:</strong> {{ $movie->category->category_name }}</p>
                        <p><strong>Tahun:</strong> {{ $movie->year }}</p>
                        <p><strong>Actors:</strong> {{ $movie->actors }}</p>
                        <p><strong>Sinopsis:</strong> {{ $movie->synopsis }}</p>
                        <p><strong>Cover Image:</strong></p>
                        <img src="{{ $movie->cover_image }}" alt="{{ $movie->title }}" class="img-fluid" style="max-width: 100px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Navigasi Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $movies->links() }}
    </div>
</div>
@endsection
