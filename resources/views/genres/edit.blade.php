@extends('layouts.app')

@section('title', 'Edit Genre')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Genre</h2>

    <form action="{{ route('genres.update', $genre) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $genre->name) }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('genres.show', $genre) }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-warning">Update Genre</button>
        </div>
    </form>
</div>
@endsection
