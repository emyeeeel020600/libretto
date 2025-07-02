<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Libretto Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional Custom Styles --}}
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .dashboard-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 2rem 1rem;
        }

        .main-content {
            flex-grow: 1;
            background-color: white;
            padding: 2rem;
            border-radius: 0.375rem; /* rounded corners */
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
        }

        /* Navbar improvements */
        nav.navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
            box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
            background-color: #212529; /* Slightly darker for contrast */
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            margin-left: 1.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.3rem;
            transition: background-color 0.3s ease;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background-color: #495057;
            color: #fff !important;
        }

        /* Navbar toggler spacing */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        /* Responsive adjustments */
        @media (min-width: 992px) {
            .dashboard-wrapper {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    </style>
</head>
<body>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('authors.index') }}">📚 Libretto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav me-auto align-items-lg-center">
                    <li class="nav-item">
                        <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                            Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('authors.index') }}" class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
                            Authors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('genres.index') }}" class="nav-link {{ request()->routeIs('genres.*') ? 'active' : '' }}">
                            Genres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reviews.index') }}" class="nav-link {{ request()->routeIs('reviews.*') ? 'active' : '' }}">
                            Reviews
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <span class="nav-link">Hello, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="cursor:pointer;">Logout</button>
                        </form>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                            Register
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

    {{-- Dashboard Layout --}}
    <div class="dashboard-wrapper">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page Title and CRUD Button --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">@yield('title', 'Dashboard')</h2>

            {{-- Optional CRUD button --}}
            @hasSection('create-button')
                @yield('create-button')
            @endif
        </div>

        {{-- Main Content --}}
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
