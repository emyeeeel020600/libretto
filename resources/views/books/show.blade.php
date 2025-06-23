@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ $book->title }}</h1>
    <p><strong>Author:</strong> 
    <a href="{{ route('authors.show', $book->author) }}">
        {{ $book->author->name }}
    </a>
    </p>


    <div class="mb-4">
        <h3>Genres</h3>
        @if ($book->genres->isEmpty())
            <p class="text-muted">No genres assigned.</p>
        @else
            <div>
                @foreach ($book->genres as $genre)
                    <a href="{{ route('genres.show', $genre) }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                        {{ $genre->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div>
        <h3>Reviews</h3>
        @if ($book->reviews->isEmpty())
            <p class="text-muted">No reviews yet.</p>
        @else
            <ul class="list-group">
                @foreach ($book->reviews as $review)
                    <li class="list-group-item">
                        <div>
                            <strong>Rating:</strong> 
                            <span class="badge bg-success">{{ $review->rating }}/5</span>
                        </div>
                        <p class="mb-0">{{ $review->content }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
