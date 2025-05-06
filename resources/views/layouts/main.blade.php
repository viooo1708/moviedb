<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Sistem Informasi MovieDB')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        main > .container {
            padding: 60px 15px 0;
        }
        .footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e7e7e7;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    @include('layouts.header')

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="my-4">
                @yield('content')
                @yield('container')
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Bootstrap Bundle with Popper.js (for Modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
