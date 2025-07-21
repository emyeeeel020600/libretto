<?php

namespace App\Http\Controllers\API;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreApiController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('name')->paginate(15);
        return response()->json($genres);
    }

    public function show(Genre $genre)
    {
        $genre->load('books');
        return response()->json($genre);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::create($validated);

        return response()->json(['message' => 'Genre created successfully.', 'genre' => $genre], 201);
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($validated);

        return response()->json(['message' => 'Genre updated successfully.', 'genre' => $genre]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json(['message' => 'Genre deleted successfully.']);
    }
}