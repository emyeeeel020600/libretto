@extends('layouts.app')

@section('title', 'Create Review')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Review Details</h2>

    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf

        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
            <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a book</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" min="1" max="5" 
                   class="form-control @error('rating') is-invalid @enderror" 
                   value="{{ old('rating') }}" required>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="form-label">Review</label>
            <textarea name="content" id="content" rows="5" 
                      class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary">Back to Reviews</a>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>
    </form>
</div>
@endsection
