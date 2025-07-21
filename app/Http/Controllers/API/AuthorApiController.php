<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorApiController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->orderBy('name')->paginate(15);
        return response()->json($authors);
    }

    public function show(Author $author)
    {
        $author->load('books');
        return response()->json($author);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($validated);

        return response()->json(['message' => 'Author created successfully.', 'author' => $author], 201);
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update($validated);

        return response()->json(['message' => 'Author updated successfully.', 'author' => $author]);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['message' => 'Author deleted successfully.']);
    }
}