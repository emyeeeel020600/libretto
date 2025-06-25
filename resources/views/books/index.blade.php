@extends('layouts.app')

@section('title', 'Books')

@section('create-button')
    <a href="{{ route('books.create') }}" class="btn btn-primary shadow-sm">
        + Add New Book
    </a>
@endsection

@section('content')
    @if ($books->isEmpty())
        <p class="text-muted">No books available.</p>
    @else
        <div class="row g-4">
            @foreach ($books as $book)
                <div class="col-md-6 col-lg-4">
                    <div 
                        class="card h-100 shadow-sm border-0 rounded-3 transition-hover p-4" 
                        style="cursor: pointer;" 
                        onclick="window.location='{{ route('books.show', $book) }}'">
                        <h4 class="card-title mb-1 fst-italic fw-normal">
                            {{ $book->title }}
                        </h4>

                        @if(!empty($book->subtitle))
                            <p class="text-secondary fst-italic mb-2">{{ $book->subtitle }}</p>
                        @endif

                        <p class="mb-3 text-muted small">
                            by 
                            <a href="{{ route('authors.show', $book->author) }}" class="link-primary fw-semibold" onclick="event.stopPropagation();">
                                {{ $book->author->name }}
                            </a>
                        </p>

                        <div class="d-flex align-items-center mb-3">
                            <div class="me-2" title="{{ $book->average_rating }} average rating">
                                @php
                                    $fullStars = floor($book->average_rating);
                                    $halfStar = ($book->average_rating - $fullStars) >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="bi bi-star-half text-warning"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="bi bi-star text-warning"></i>
                                @endfor
                            </div>

                            <small class="text-muted me-3">
                                {{ number_format($book->average_rating, 1) }} ({{ number_format($book->ratings_count) }} ratings)
                            </small>
                        </div>

                        <div>
                            @foreach ($book->genres as $genre)
                                <span class="badge bg-secondary me-1 mb-1">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        .transition-hover {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .transition-hover:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }
    </style>
@endsection
