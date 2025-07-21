<?php

namespace App\Http\Controllers\API;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewApiController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['book', 'user'])->orderBy('created_at', 'desc')->paginate(15);
        return response()->json($reviews);
    }

    public function show(Review $review)
    {
        $review->load(['book', 'user']);
        return response()->json($review);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create($validated);

        return response()->json(['message' => 'Review created successfully.', 'review' => $review], 201);
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($validated);

        return response()->json(['message' => 'Review updated successfully.', 'review' => $review]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.']);
    }
}