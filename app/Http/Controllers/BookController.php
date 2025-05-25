<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter - Fix ambiguous id column by specifying the table name
        if ($request->has('category')) {
            $categoryId = $request->category;
            $query->whereHas('categories', function($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        
        // Load categories with book counts
        $categories = Category::withCount('books')->get();
        
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        // Check if we need to load relationships
        if (Schema::hasTable('categories')) {
            $book->load('categories');
        }
        
        if (Schema::hasTable('genres')) {
            $book->load('genres');
        }
        
        // We don't load reviews since we've commented out that section in the view
        
        return view('books.show', compact('book'));
    }
} 