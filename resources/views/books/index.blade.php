@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Books</h1>

    @if ($books->isEmpty())
        <p class="text-muted">No books available.</p>
    @else
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                    {{ $book->title }}
                                </a>
                            </h5>
                            <p class="card-text">
                                <strong>Author:</strong> 
                                <a href="{{ route('authors.show', $book->author) }}">{{ $book->author->name }}</a>
                            </p>
                            <p>
                                <strong>Genres:</strong>
                                @foreach ($book->genres as $genre)
                                    <span class="badge bg-primary me-1">{{ $genre->name }}</span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
