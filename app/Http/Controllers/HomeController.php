<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the home page with featured books and categories.
     */
    public function index()
    {
        $featuredBooks = Book::inRandomOrder()->take(4)->get();
        $categories = Category::take(6)->get();
        
        return view('home', compact('featuredBooks', 'categories'));
    }
    
    /**
     * Handle newsletter subscription.
     */
    public function subscribeNewsletter(Request $request)
    {
        // In a real application, you would validate and save the email
        return redirect()->route('home')->with('success', 'Thank you for subscribing to our newsletter!');
    }
} 