@extends('layouts.app')

@section('title', 'Genre Details')

@section('create-button')
<div class="d-flex gap-2">
        <a href="{{ route('genres.index') }}" class="btn btn-outline-primary btn-sm">&larr; Back to Genres</a>
        <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning btn-sm">Edit</a>

        <form action="{{ route('genres.destroy', $genre) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                Delete
            </button>
        </form>
    </div>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Books in <span class="fst-italic">"{{ $genre->name }}"</span></h2>

    @if ($genre->books->isEmpty())
        <p class="text-muted fst-italic">No books found in this genre.</p>
    @else
        <div class="row g-4">
            @foreach ($genre->books as $book)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 transition-hover p-4">
                        {{-- Book Title --}}
                        <h4 class="card-title mb-1">
                            <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">
                                {{ $book->title }}
                            </a>
                        </h4>

                        {{-- Ratings --}}
                        <div class="d-flex align-items-center mb-3">
                            @php
                                $fullStars = floor($book->average_rating);
                                $halfStar = ($book->average_rating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp
                            <div class="me-2" title="{{ $book->average_rating }} average rating">
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

                        {{-- Genre Tags --}}
                        <div>
                            @foreach ($book->genres as $genreTag)
                                <span class="badge bg-secondary me-1 mb-1">{{ $genreTag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Author</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this genre? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form action="{{ route('genres.destroy', $genre) }}" method="POST">
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
