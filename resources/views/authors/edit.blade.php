@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
<div class="container py-4">
    <form action="{{ route('authors.update', $author) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Author Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $author->name) }}"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('authors.show', $author) }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-warning">Update Author</button>
        </div>
    </form>
</div>
@endsection
