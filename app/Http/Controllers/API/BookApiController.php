<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genre'])->orderBy('title')->paginate(15);
        return response()->json($books);
    }

    public function show(Book $book)
    {
        $book->load(['author', 'genre', 'reviews']);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $book = Book::create($validated);

        return response()->json(['message' => 'Book created successfully.', 'book' => $book], 201);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $book->update($validated);

        return response()->json(['message' => 'Book updated successfully.', 'book' => $book]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully.']);
    }
}