@extends('layouts.app')

@section('title', 'Add New Author')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Author Details</h2>
    <form action="{{ route('authors.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Author Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary">Back to Authors</a>
            <button type="submit" class="btn btn-primary">Create Author</button>
        </div>
    </form>
</div>
@endsection
