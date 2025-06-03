<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MovieDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <!-- Always show Home -->
                    <li class="nav-item">
                        <a class="nav-link @yield('navHome')" href="{{ route('home') }}">Home</a>
                    </li>

                    <!-- Login/User Dropdown di sebelah Home jika belum login -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        <!-- Categories (only for logged in user) -->
                        <li class="nav-item">
                            <a class="nav-link @yield('navCategories')" href="{{ route('categories.index') }}">Categories</a>
                        </li>

                        <!-- Movies (only for logged in user) -->
                        <li class="nav-item">
                            <a class="nav-link @yield('navMovies')" href="{{ route('movies.index') }}">Movies</a>
                        </li>

                        <!-- User Dropdown di sebelah Movies -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                <!-- Search Bar -->
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
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari judul film..." value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>
</header>
