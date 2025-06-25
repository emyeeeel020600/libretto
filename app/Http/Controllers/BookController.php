<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Book::with(['author', 'genres', 'reviews'])->orderBy('title')->paginate(9);
        return view('books.index', compact('books'));
    }


    // Show the create form
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    // Store the new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create($validated);
        $book->genres()->sync($request->input('genres', []));

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Show single book
    public function show(Book $book)
    {
        $book->load('author', 'genres', 'reviews');
        return view('books.show', compact('book'));
    }

    // Show edit form
    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update($validated);
        $book->genres()->sync($request->input('genres', []));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Optional: Delete book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
