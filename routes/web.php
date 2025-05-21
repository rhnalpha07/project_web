<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminGenreController;
use App\Http\Controllers\ContactController;

// Redirect root to home
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    }
    return redirect('/home');
});

// Define home route
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Static pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Books Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    
    // Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        
        // Admin Books Management
        Route::get('/admin/books', [AdminBookController::class, 'index'])->name('admin.books.index');
        Route::get('/admin/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
        Route::post('/admin/books', [AdminBookController::class, 'store'])->name('admin.books.store');
        Route::get('/admin/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/admin/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
        Route::delete('/admin/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');
        
        // Admin Categories Management
        Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
        
        // Admin Genres Management
        Route::get('/admin/genres', [AdminGenreController::class, 'index'])->name('admin.genres.index');
        Route::get('/admin/genres/create', [AdminGenreController::class, 'create'])->name('admin.genres.create');
        Route::post('/admin/genres', [AdminGenreController::class, 'store'])->name('admin.genres.store');
        Route::get('/admin/genres/{genre}/edit', [AdminGenreController::class, 'edit'])->name('admin.genres.edit');
        Route::put('/admin/genres/{genre}', [AdminGenreController::class, 'update'])->name('admin.genres.update');
        Route::delete('/admin/genres/{genre}', [AdminGenreController::class, 'destroy'])->name('admin.genres.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
