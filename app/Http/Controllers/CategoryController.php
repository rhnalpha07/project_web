<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->get();
        
        $featuredCategories = Category::where('is_featured', true)
            ->withCount('books')
            ->take(2)
            ->get();

        $popularCategories = Category::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(4)
            ->get();

        $totalCategories = Category::count();
        $totalBooks = \App\Models\Book::count();
        $avgBooksPerCategory = round($totalBooks / ($totalCategories ?: 1), 1);
        $mostPopularCategory = Category::withCount('books')
            ->orderBy('books_count', 'desc')
            ->first()
            ->name ?? 'N/A';

        return view('categories.index', compact(
            'categories',
            'featuredCategories',
            'popularCategories',
            'totalCategories',
            'totalBooks',
            'avgBooksPerCategory',
            'mostPopularCategory'
        ));
    }

    public function show(Request $request, Category $category)
    {
        $query = $category->books();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $books = $query->paginate(12)->withQueryString();
        
        return view('categories.show', compact('category', 'books'));
    }
} 