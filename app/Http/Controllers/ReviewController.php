<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display a list of all reviews
    public function index()
    {
        $reviews = Review::with('book')->latest()->paginate(9);
        return view('reviews.index', compact('reviews'));
    }


    // Show the form to create a new review
    public function create()
    {
        $books = Book::all();
        return view('reviews.create', compact('books'));
    }

    // Store a new review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create($validated);

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    // Display a single review
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    // Show the form to edit a review
    public function edit(Review $review)
    {
        $books = Book::all();
        return view('reviews.edit', compact('review', 'books'));
    }

    // Update a review
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    // Delete a review
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
