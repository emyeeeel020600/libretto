@extends('layouts.app')

@section('title', 'Authors')

@section('create-button')
    <a href="{{ route('authors.create') }}" class="btn btn-primary shadow-sm">+ Add New Author</a>
@endsection

@section('content')
    @if ($authors->isEmpty())
        <p class="text-muted">No authors available.</p>
    @else
        <div class="row g-4">
            @foreach ($authors as $author)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 p-4">
                        <h4 class="card-title mb-1 fw-bold">
                            <a href="{{ route('authors.show', $author) }}" class="text-decoration-none text-dark">
                                {{ $author->name }}
                            </a>
                        </h4>
                        <p class="text-muted small mb-0">
                            {{ $author->books->count() }} book{{ $author->books->count() === 1 ? '' : 's' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
