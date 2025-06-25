@extends('layouts.app')

@section('title', 'Book Reviews')

@section('create-button')
    <a href="{{ route('reviews.create') }}" class="btn btn-primary shadow-sm">
        + Add New Review
    </a>
@endsection

@section('content')
    @if ($reviews->isEmpty())
        <p class="text-muted">No reviews available.</p>
    @else
        <div class="row g-4">
            @foreach ($reviews as $review)
                <div class="col-md-6 col-lg-4">
                    <div 
                        class="card h-100 shadow-sm border-0 rounded-3 p-4 hover-shadow transition-hover" 
                        style="cursor: pointer;" 
                        onclick="window.location='{{ route('reviews.show', $review) }}'">

                        {{-- Book title --}}
                        <h5 class="card-title fw-semibold mb-2">
                            {{ $review->book->title }}
                        </h5>

                        {{-- Rating --}}
                        <p class="text-warning mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                            <span class="text-muted small ms-1">({{ $review->rating }}/5)</span>
                        </p>

                        {{-- Review content preview --}}
                        <p class="text-muted small mb-0">
                            {{ Str::limit($review->content, 100, '...') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    @endif

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    {{-- Optional Hover Styling --}}
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
