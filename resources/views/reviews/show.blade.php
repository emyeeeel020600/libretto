@extends('layouts.app')

@section('title', 'Review Details')

@section('create-button')
<div class="d-flex gap-2">
        <a href="{{ route('reviews.index') }}" class="btn btn-outline-primary btn-sm">&larr; Back to Reviews</a>
        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning btn-sm">Edit</a>

        <form action="{{ route('reviews.destroy', $review) }}" method="POST">
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
    <h2 class="fw-bold mb-4">Review for <span class="fst-italic">"{{ $review->book->title }}"</span></h2>

    <div class="mb-3">
        <h5>Rating:</h5>
        <p class="text-warning fs-4">
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
            @endfor
            <span class="ms-2 text-muted fs-5">{{ $review->rating }} / 5</span>
        </p>
    </div>

    <div class="mb-4">
        <h5>Review Content:</h5>
        <p class="fs-6">{{ $review->content }}</p>
    </div>
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
                Are you sure you want to delete this review? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form action="{{ route('reviews.destroy', $review) }}" method="POST">
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
