@extends('layouts.app')

@section('content')
    <h1>Create Review</h1>

    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <label for="book_id">Book:</label>
        <select name="book_id" required>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br><br>

        <label for="content">Review:</label><br>
        <textarea name="content" rows="5" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('reviews.index') }}">Back</a>
@endsection
