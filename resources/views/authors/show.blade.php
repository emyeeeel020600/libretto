@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title">{{ $author->name }}</h1>

        <h4 class="mt-4">Books</h4>
        @if ($author->books->isEmpty())
            <p>This author has no books listed.</p>
        @else
            <ul class="list-group">
                @foreach ($author->books as $book)
                    <li class="list-group-item">
                        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
