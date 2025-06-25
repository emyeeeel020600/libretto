@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Book Details</h2>
    <form action="{{ route('books.store') }}" method="POST" novalidate>
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title') }}" 
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
                <option value="" disabled selected>Choose an author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
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
                               {{ (is_array(old('genres')) && in_array($genre->id, old('genres'))) ? 'checked' : '' }}>
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
        <div class="d-flex gap-2">
            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Back to Books</a>
            <button type="submit" class="btn btn-primary">Create Book</button>
        </div>
    </form>
</div>
@endsection
