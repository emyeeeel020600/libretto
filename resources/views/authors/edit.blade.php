@extends('layouts.app')

@section('title', 'Edit Author')

@section('create-button')
    <a href="{{ route('authors.index') }}" class="btn btn-outline-primary btn-sm">&larr; Back to Authors</a>
@endsection

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

        <button type="submit" class="btn btn-primary">Update Author</button>
    </form>
</div>
@endsection
