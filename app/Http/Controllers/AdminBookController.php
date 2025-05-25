<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminBookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request)
    {
        // Meningkatkan batas waktu eksekusi
        set_time_limit(120);
        
        // Memulai query builder
        $query = Book::with(['categories', 'genres']);
        
        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }
        
        // Filter berdasarkan status stok
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->status === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }
        
        // Paginate hasil
        $books = $query->latest()->paginate(10)->withQueryString();
        
        // Load kategori untuk filter
        $categories = Category::all();
        
        return view('admin.books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        $categories = Category::all();
        $genres = Genre::where('is_active', true)->get();
        return view('admin.books.create', compact('categories', 'genres'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        try {
            // Modify request data to ensure is_featured is a boolean
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured') ? true : false;
            
            $request->validate([
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'isbn' => 'required|string|max:13|unique:books,isbn',
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'publisher' => 'required|string|max:255',
                'publication_date' => 'required|date',
                'pages' => 'required|integer|min:1',
                'language' => 'required|string|max:50',
                'is_featured' => 'boolean',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'genres' => 'nullable|array',
                'genres.*' => 'exists:genres,id',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Book validation passed', ['request' => $request->all()]);

            $bookData = $request->except(['categories', 'genres']);
            $bookData['is_featured'] = $request->has('is_featured') ? true : false;
            
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('books', 'public');
                $bookData['cover_image'] = $imagePath;
            }

            $book = Book::create($bookData);
            
            Log::info('Book created', ['book_id' => $book->id]);
            
            if ($request->has('categories')) {
                $book->categories()->attach($request->categories);
                Log::info('Categories attached', ['categories' => $request->categories]);
            }
            
            if ($request->has('genres')) {
                $book->genres()->attach($request->genres);
                Log::info('Genres attached', ['genres' => $request->genres]);
            }

            return redirect()->route('admin.books.index')
                ->with('success', 'Book created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating book: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            
            return back()->withInput()->with('error', 'An error occurred while saving the book: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $genres = Genre::where('is_active', true)->get();
        return view('admin.books.edit', compact('book', 'categories', 'genres'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        try {
            // Modify request data to ensure is_featured is a boolean
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured') ? true : false;
            
            $request->validate([
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'isbn' => 'required|string|max:13|unique:books,isbn,'.$book->id,
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'publisher' => 'required|string|max:255',
                'publication_date' => 'required|date',
                'pages' => 'required|integer|min:1',
                'language' => 'required|string|max:50',
                'is_featured' => 'boolean',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'genres' => 'nullable|array',
                'genres.*' => 'exists:genres,id',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Book validation passed for update', ['book_id' => $book->id, 'request' => $request->all()]);

            $bookData = $request->except(['categories', 'genres']);
            $bookData['is_featured'] = $request->has('is_featured') ? true : false;
            
            if ($request->hasFile('cover_image')) {
                // Delete old image if exists
                if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                    Storage::disk('public')->delete($book->cover_image);
                }
                
                $imagePath = $request->file('cover_image')->store('books', 'public');
                $bookData['cover_image'] = $imagePath;
            }

            $book->update($bookData);
            Log::info('Book updated', ['book_id' => $book->id]);
            
            if ($request->has('categories')) {
                $book->categories()->sync($request->categories);
                Log::info('Categories synced', ['book_id' => $book->id, 'categories' => $request->categories]);
            }
            
            // Update genres
            if ($request->has('genres')) {
                $book->genres()->sync($request->genres);
                Log::info('Genres synced', ['book_id' => $book->id, 'genres' => $request->genres]);
            } else {
                $book->genres()->detach();
                Log::info('All genres detached', ['book_id' => $book->id]);
            }

            return redirect()->route('admin.books.index')
                ->with('success', 'Book updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage(), [
                'exception' => $e,
                'book_id' => $book->id,
                'request' => $request->all()
            ]);
            
            return back()->withInput()->with('error', 'An error occurred while updating the book: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        // Delete the book's image if it exists
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }
        
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }
} 