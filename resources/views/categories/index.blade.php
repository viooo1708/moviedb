@extends('layouts.main')

@section('title', 'Data Kategori')
@section('navKategori', 'active')
@section('searchAction', route('categories.index'))


@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Kategori Film</h1>

    {{-- Flash message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Tombol Input Data --}}
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Input Kategori</a>

    {{-- Tabel Data Kategori --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Aksi">
                                @can('edit')
                                {{-- Edit --}}
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-2" title="Edit Kategori">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                @endcan
                                {{-- Detail --}}
                                <a href="#" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#detailModal{{ $category->id }}" title="Lihat Detail">
                                    <i class="bi bi-eye fs-5"></i>
                                </a>
                                @can('delete')
                                {{-- Hapus --}}
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Kategori">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Detail Kategori --}}
    @foreach ($categories as $category)
        <div class="modal fade" id="detailModal{{ $category->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $category->id }}">Detail Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama Kategori:</strong> {{ $category->category_name }}</p>
                        <p><strong>Deskripsi:</strong> {{ $category->description }}</p>
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
        {{ $categories->links() }}
    </div>
</div>
@endsection
