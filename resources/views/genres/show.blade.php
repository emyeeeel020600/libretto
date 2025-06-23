@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Genre: {{ $genre->name }}</h1>

    <div>
        <h3>Books</h3>
        @if ($genre->books->isEmpty())
            <p class="text-muted">No books for this genre.</p>
        @else
            <ul class="list-group">
                @foreach ($genre->books as $book)
                    <li class="list-group-item">
                        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
