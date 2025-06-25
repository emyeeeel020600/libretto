@extends('layouts.app')

@section('title', 'Add New Genre')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Genre Details</h2>

    <form action="{{ route('genres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">Back to Genres</a>
            <button type="submit" class="btn btn-primary">Create Genre</button>
        </div>
    </form>
</div>
@endsection
