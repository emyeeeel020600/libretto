<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorApiController;
use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\API\GenreApiController;
use App\Http\Controllers\API\ReviewApiController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('authors', AuthorApiController::class);
    Route::apiResource('books', BookApiController::class);
    Route::apiResource('genres', GenreApiController::class);
    Route::apiResource('reviews', ReviewApiController::class);
    
    Route::get('/user', fn(Request $request) => $request->user());
});
