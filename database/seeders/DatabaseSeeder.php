<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Author::factory(10)->create()->each(function ($author) {
            $books = Book::factory(3)->create(['author_id' => $author->id]);

            $books->each(function ($book) {
                $genres = Genre::factory(2)->create();
                $book->genres()->attach($genres);
                Review::factory(5)->create(['book_id' => $book->id]);
            });
        });
    }
}
