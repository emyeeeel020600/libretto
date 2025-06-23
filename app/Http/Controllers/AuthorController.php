<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        return view('authors.index', compact('authors'));
    }

    public function show(Author $author)
    {
        // Eager load books relation
        $author->load('books');
        return view('authors.show', compact('author'));
    }
}
