@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Genres</h1>

    <div class="row">
        @foreach ($genres as $genre)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">{{ $genre->name }}</h2>
                        <h5 class="card-subtitle mb-3 text-muted">Books:</h5>
                        @if ($genre->books->isEmpty())
                            <p class="text-muted">No books found.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($genre->books as $book)
                                    <li class="list-group-item px-0">
                                        <a href="{{ route('books.show', $book) }}">
                                            {{ $book->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
