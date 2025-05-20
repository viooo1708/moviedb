@extends('layouts.template')
@section('content')
    <h1>Latest Movie</h1>

    <div class="row">
        {{-- Looping data movie --}}
        @foreach ($movies as $movie)

        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="{{$movie->cover_image}}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                    </div>
                </div>
                </div>
        </div>
        @endforeach
    </div>
@endsection
