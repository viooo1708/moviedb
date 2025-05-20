<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MovieDB</a> <!-- Nama yang sudah disesuaikan -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <!-- Home -->
                    <li class="nav-item">
                         <a class="nav-link @yield('navHome')" href="{{ route('home') }}">Home</a>
                    </li>
                    <!-- Categories -->
                    <li class="nav-item">
                        <a class="nav-link @yield('navCategories')" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <!-- Movies -->
                    <li class="nav-item">
                        <a class="nav-link @yield('navMovies')" href="{{ route('movies.index') }}">Movies</a>
                    </li>
                </ul>

                @php
                    use Illuminate\Support\Facades\Route;
                    $currentRoute = Route::currentRouteName();

                    switch ($currentRoute) {
                        case 'home':
                            $searchAction = route('home');
                            break;
                        case 'categories.index':
                            $searchAction = route('categories.index');
                            break;
                        case 'movies.index':
                        default:
                            $searchAction = route('movies.index');
                            break;
                    }
                @endphp

                <form class="d-flex mb-3" role="search" method="GET" action="{{ $searchAction }}">
                    <input class="form-control me-2"
                           type="search"
                           name="search"
                           placeholder="Cari judul film..."
                           value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>
</header>
