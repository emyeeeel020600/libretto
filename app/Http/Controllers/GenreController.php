<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Display paginated list
    public function index()
    {
        $genres = Genre::with('books')->orderBy('name')->paginate(15);
        return view('genres.index', compact('genres'));
    }

    // Show single genre with books
    public function show(Genre $genre)
    {
        $genre->load('books');
        return view('genres.show', compact('genre'));
    }

    // Show form to create new genre
    public function create()
    {
        return view('genres.create');
    }

    // Store new genre in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create($validated);

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    // Show edit form
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    // Update existing genre
    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    // Delete genre
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }
}
