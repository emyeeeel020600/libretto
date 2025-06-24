@extends('layouts.app')

@section('title', 'Books')

@section('create-button')
    <div class="d-flex gap-2">
        <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">
            &larr; Back to Books
        </a>

        {{-- Edit Button --}}
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">
            Edit
        </a>

        {{-- Trigger Delete Modal --}}
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete
        </button>
    </div>
@endsection

@section('content')
<div class="container py-4">
    {{-- Title --}}
    <h2 class="fst-italic fw-normal mb-3">{{ $book->title }}</h2>

    {{-- Author --}}
    <p class="mb-4 text-muted small">
        by 
        <a href="{{ route('authors.show', $book->author) }}" class="link-primary fw-semibold">
            {{ $book->author->name }}
        </a>
    </p>

    {{-- Ratings --}}
    <div class="d-flex align-items-center mb-4">
        <div class="me-3" title="{{ $book->average_rating }} average rating">
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
        <small class="text-muted">
            {{ number_format($book->average_rating, 1) }} ({{ number_format($book->ratings_count) }} ratings)
        </small>
    </div>

    {{-- Genres --}}
    <div class="mb-4">
        <h4 class="mb-3">Genres</h4>
        @if ($book->genres->isEmpty())
            <p class="text-muted fst-italic">No genres assigned.</p>
        @else
            <div>
                @foreach ($book->genres as $genre)
                    <a href="{{ route('genres.show', $genre) }}" class="btn btn-outline-secondary btn-sm me-2 mb-2 rounded-pill">
                        {{ $genre->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Reviews --}}
    <div>
        <h4 class="mb-3">Reviews</h4>
        @if ($book->reviews->isEmpty())
            <p class="text-muted fst-italic">No reviews yet.</p>
        @else
            <div class="list-group">
                @foreach ($book->reviews as $review)
                    @php
                        $fullStars = floor($review->rating);
                        $emptyStars = 5 - $fullStars;
                    @endphp
                    <div class="list-group-item rounded-3 shadow-sm mb-3 p-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge 
                                @if($review->rating >= 4) bg-success
                                @elseif($review->rating >= 2) bg-warning text-dark
                                @else bg-danger
                                @endif
                                me-2 fs-6">
                                {{ $review->rating }}/5
                            </span>
                            <div>
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="bi bi-star text-warning"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="mb-0 text-secondary fst-italic">{{ $review->content }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the book "<strong>{{ $book->title }}</strong>"? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
@endsection
