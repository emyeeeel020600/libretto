<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Libretto Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

<nav class="mb-4">
    <a href="{{ route('authors.index') }}" 
       class="btn {{ request()->routeIs('authors.index') ? 'btn-primary' : 'btn-secondary' }}">
       Authors
    </a>
    <a href="{{ route('books.index') }}" 
       class="btn {{ request()->routeIs('books.index') ? 'btn-primary' : 'btn-secondary' }}">
       Books
    </a>
    <a href="{{ route('genres.index') }}" 
       class="btn {{ request()->routeIs('genres.index') ? 'btn-primary' : 'btn-secondary' }}">
       Genres
    </a>
</nav>


    @yield('content')

</body>
</html>
