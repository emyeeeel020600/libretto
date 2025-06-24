@extends('layouts.app')

@section('content')
    <h1>Review for "{{ $review->book->title }}"</h1>
    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
    <p><strong>Content:</strong> {{ $review->content }}</p>

    <a href="{{ route('reviews.edit', $review) }}">Edit Review</a>
    <form method="POST" action="{{ route('reviews.destroy', $review) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this review?')">Delete</button>
    </form>
    <br><br>
    <a href="{{ route('reviews.index') }}">Back to Reviews</a>
@endsection
