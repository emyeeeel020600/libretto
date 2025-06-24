@extends('layouts.app')

@section('title', 'Edit Book')

@section('create-button')
    <div class="d-flex gap-2">
        <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">
            &larr; Back to Books
        </a>

        {{-- Delete Button Trigger --}}
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Delete
        </button>
    </div>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fst-italic fw-normal">Edit Book</h2>

    <form action="{{ route('books.update', $book) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $book->title) }}" 
                   class="form-control @error('title') is-invalid @enderror" 
                   required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Author --}}
        <div class="mb-3">
            <label for="author_id" class="form-label fw-semibold">Author <span class="text-danger">*</span></label>
            <select id="author_id" 
                    name="author_id" 
                    class="form-select @error('author_id') is-invalid @enderror" 
                    required>
                <option value="" disabled>Choose an author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" 
                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Genres --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Genres</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach($genres as $genre)
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="genres[]" 
                               value="{{ $genre->id }}" 
                               id="genre-{{ $genre->id }}"
                               @php
                                    $checkedGenres = old('genres', $book->genres->pluck('id')->toArray());
                               @endphp
                               {{ in_array($genre->id, $checkedGenres) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre-{{ $genre->id }}">
                            {{ $genre->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('genres')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
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

{{-- Bootstrap JS (ensure it's loaded in layout or here) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
