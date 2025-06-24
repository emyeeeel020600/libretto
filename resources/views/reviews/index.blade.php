@extends('layouts.app')

@section('content')
    <h1>All Reviews</h1>
    <a href="{{ route('reviews.create') }}">Create New Review</a>

    @foreach($reviews as $review)
        <div>
            <h4>Book: {{ $review->book->title }}</h4>
            <p>Rating: {{ $review->rating }} / 5</p>
            <p>{{ $review->content }}</p>
            <a href="{{ route('reviews.show', $review) }}">View</a> |
            <a href="{{ route('reviews.edit', $review) }}">Edit</a>
        </div>
        <hr>
    @endforeach
@endsection
