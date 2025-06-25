@extends('layouts.app')

@section('title', 'Genres')

@section('create-button')
    <a href="{{ route('genres.create') }}" class="btn btn-primary shadow-sm">+ Add New Genre</a>
@endsection

@section('content')
    @if ($genres->isEmpty())
        <p class="text-muted">No genres available.</p>
    @else
        <div class="row g-4">
            @foreach ($genres as $genre)
                <div class="col-md-6 col-lg-4">
                    <div 
                        class="card h-100 shadow-sm border-0 rounded-3 p-4 transition-hover" 
                        style="cursor: pointer;" 
                        onclick="window.location='{{ route('genres.show', $genre) }}'">
                        <h4 class="card-title mb-1 fw-bold">
                            <a href="{{ route('genres.show', $genre) }}" 
                               class="text-decoration-none text-dark"
                               onclick="event.stopPropagation();">
                                {{ $genre->name }}
                            </a>
                        </h4>
                        <p class="text-muted small mb-2">
                            {{ $genre->books->count() }} book{{ $genre->books->count() === 1 ? '' : 's' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $genres->links() }}
        </div>
    @endif

    <style>
        .transition-hover {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }
        .transition-hover:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }
    </style>
@endsection
