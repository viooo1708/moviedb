@extends('layouts.main')

@section('title', 'Daftar Film')
@section('navMovies', 'active')
@section('searchAction', route('movies.index'))


@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Film</h1>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tombol Tambah --}}
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Input Film</a>

    {{-- Tabel Film --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Actors</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movies->firstItem() + $loop->index }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->category->category_name }}</td>
                        <td>{{ $movie->year }}</td>
                        <td>{{ $movie->actors }}</td>
                        <td>
                            <img src="{{ filter_var($movie->cover_image, FILTER_VALIDATE_URL) ? $movie->cover_image : asset('storage/' . $movie->cover_image) }}"
                                 alt="{{ $movie->title }}"
                                 width="100"
                                 class="img-fluid rounded">
                        </td>
                        <td>
                            <div class="btn-group">
                                {{-- Edit --}}
                                <a href="{{ route('movies.edit', $movie->id) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit Film">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>

                                {{-- Detail --}}
                                <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $movie->id }}"
                                        title="Lihat Detail">
                                    <i class="bi bi-eye fs-5"></i>
                                </button>

                                {{-- Hapus --}}
                                <form action="{{ route('movies.destroy', $movie->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Film">
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

    {{-- Modal Detail --}}
    @foreach ($movies as $movie)
        <div class="modal fade" id="detailModal{{ $movie->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $movie->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $movie->id }}">Detail Film</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <img src="{{ filter_var($movie->cover_image, FILTER_VALIDATE_URL) ? $movie->cover_image : asset('storage/' . $movie->cover_image) }}"
                                 alt="{{ $movie->title }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 200px;">
                        </div>
                        <p><strong>Judul:</strong> {{ $movie->title }}</p>
                        <p><strong>Slug:</strong> {{ $movie->slug }}</p>
                        <p><strong>Kategori:</strong> {{ $movie->category->category_name }}</p>
                        <p><strong>Tahun:</strong> {{ $movie->year }}</p>
                        <p><strong>Actors:</strong> {{ $movie->actors }}</p>
                        <p><strong>Sinopsis:</strong><br>{{ $movie->synopsis }}</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $movies->links() }}
    </div>
</div>
@endsection
