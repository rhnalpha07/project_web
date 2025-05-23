<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        // Sample books data
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A story of decadence and excess, The Great Gatsby follows the mysterious millionaire Jay Gatsby.',
                'isbn' => '9780743273565',
                'price' => 150000,
                'stock' => 50,
                'cover_image' => 'books/great-gatsby.jpg',
                'publisher' => 'Scribner',
                'publication_date' => '1925-04-10',
                'pages' => 180,
                'language' => 'English',
                'category_id' => $categories->where('name', 'Fiction')->first()->id ?? 1,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'The story of racial injustice and the loss of innocence in the American South.',
                'isbn' => '9780446310789',
                'price' => 175000,
                'stock' => 45,
                'cover_image' => 'books/mockingbird.jpg',
                'publisher' => 'Grand Central Publishing',
                'publication_date' => '1960-07-11',
                'pages' => 281,
                'language' => 'English',
                'category_id' => $categories->where('name', 'Fiction')->first()->id ?? 1,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'A fantasy novel about the adventures of hobbit Bilbo Baggins.',
                'isbn' => '9780547928227',
                'price' => 200000,
                'stock' => 60,
                'cover_image' => 'books/hobbit.jpg',
                'publisher' => 'Houghton Mifflin Harcourt',
                'publication_date' => '1937-09-21',
                'pages' => 310,
                'language' => 'English',
                'category_id' => $categories->where('name', 'Fantasy')->first()->id ?? 2,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'A romantic novel following the emotional development of Elizabeth Bennet.',
                'isbn' => '9780141439518',
                'price' => 145000,
                'stock' => 40,
                'cover_image' => 'books/pride-prejudice.jpg',
                'publisher' => 'Penguin Classics',
                'publication_date' => '1813-01-28',
                'pages' => 432,
                'language' => 'English',
                'category_id' => $categories->where('name', 'Romance')->first()->id ?? 3,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian social science fiction novel that examines the consequences of totalitarianism.',
                'isbn' => '9780451524935',
                'price' => 165000,
                'stock' => 55,
                'cover_image' => 'books/1984.jpg',
                'publisher' => 'Signet Classic',
                'publication_date' => '1949-06-08',
                'pages' => 328,
                'language' => 'English',
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id ?? 4,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
} 