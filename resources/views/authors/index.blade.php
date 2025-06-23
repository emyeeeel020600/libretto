@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Authors</h1>

    <div class="row">
        @foreach ($authors as $author)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ $author->name }}</h2>
                        <h5 class="card-subtitle mb-3 text-muted">Books:</h5>
                        @if ($author->books->isEmpty())
                            <p class="text-muted">No books found.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($author->books as $book)
                                    <li class="list-group-item px-0">
                                        <a href="{{ route('books.show', $book) }}">
                                            {{ $book->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
