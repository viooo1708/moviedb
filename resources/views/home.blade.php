@extends('layouts.main')

@section('title', 'Daftar Film')
@section('navMovies', 'active')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Popular Movie</h1>

    {{-- Grid Card Film 2 kolom per baris, 2 baris total --}}
    @foreach ($movies->chunk(2) as $chunk)
        <div class="row mb-4">
            @foreach ($chunk as $movie)
                <div class="col-lg-6">
                    <div class="card mb-3 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ filter_var($movie->cover_image, FILTER_VALIDATE_URL) ? $movie->cover_image : asset('storage/' . $movie->cover_image) }}"
                                    alt="{{ $movie->title }}"
                                    class="img-fluid rounded-start"
                                    style="height: 100%; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie->title }}</h5>
                                    <p class="card-text text-muted"><small>{{ $movie->category->category_name }} - {{ $movie->year }}</small></p>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit($movie->synopsis, 100, '...') }}</p>
                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $movie->id }}">
                                        Lihat Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Detail --}}
                <div class="modal fade" id="detailModal{{ $movie->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $movie->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $movie->id }}">Detail Film</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ filter_var($movie->cover_image, FILTER_VALIDATE_URL) ? $movie->cover_image : asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <p><strong>Judul:</strong> {{ $movie->title }}</p>
                                        <p><strong>Kategori:</strong> {{ $movie->category->category_name }}</p>
                                        <p><strong>Tahun:</strong> {{ $movie->year }}</p>
                                        <p><strong>Actors:</strong> {{ $movie->actors }}</p>
                                        <p><strong>Sinopsis:</strong><br>{{ $movie->synopsis }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $movies->links() }}
    </div>
</div>
@endsection
