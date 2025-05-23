@extends('layouts.main')

@section('title', 'Home')

@section('styles')
<style>
    .ribbon-wrapper {
        width: 85px;
        height: 88px;
        overflow: hidden;
        position: absolute;
        top: -3px;
        right: -3px;
        z-index: 99;
    }
    
    .ribbon {
        font-size: 12px;
        font-weight: bold;
        color: white;
        text-align: center;
        transform: rotate(45deg);
        position: relative;
        padding: 7px 0;
        left: -5px;
        top: 15px;
        width: 120px;
        background-color: var(--accent-color);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .book-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    
    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .book-img-container {
        height: 250px;
        overflow: hidden;
        position: relative;
        background-color: #f8f9fa;
    }
    
    .book-img-container img {
        height: 100%;
        width: 100%;
        object-fit: contain;
        object-position: center;
        transition: transform 0.5s ease;
        image-rendering: -webkit-optimize-contrast; /* Improves image sharpness in Chrome/Safari */
        image-rendering: crisp-edges; /* Improves image sharpness in Firefox */
    }
    
    .book-card:hover .book-img-container img {
        transform: scale(1.05);
    }
    
    .book-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .rating-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: rgba(0,0,0,0.6);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
    }
    
    .book-price {
        font-weight: 700;
        color: var(--accent-color);
        font-size: 1.25rem;
        display: flex;
        align-items: center;
    }
    
    .book-price-discount {
        text-decoration: line-through;
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-left: 8px;
    }
    
    .book-category-tag {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0,0,0,0.6);
        color: white;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 0.7rem;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="bg-gray-800 py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">Welcome to BookStore</h1>
                    <p class="text-xl text-gray-300 mb-6">Discover thousands of books across various genres. From bestsellers to rare finds, we have something for every reader.</p>
                    <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold rounded-md transition-colors">
                        Browse Books
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/hero-books.jpg') }}" alt="Books Collection" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Books Section -->
    <section class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-100">Featured Books</h2>
                <a href="{{ route('books.index') }}" class="flex items-center text-amber-500 hover:text-amber-400 font-medium">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredBooks as $book)
                <a href="{{ route('books.show', $book->id) }}" class="block group">
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform transition-transform group-hover:scale-105">
                        <div class="relative h-64 overflow-hidden bg-gray-700">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center p-4">
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-300">{{ $book->title }}</h3>
                                        <p class="text-gray-400 mt-2">By {{ $book->author }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-70"></div>
                            
                            <!-- Rating Badge -->
                            <div class="absolute top-2 left-2 bg-gray-900 bg-opacity-75 text-amber-500 text-sm font-medium px-2 py-1 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                {{ number_format(4 + (1 - mt_rand(0, 10)/10), 1) }}
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="absolute bottom-2 right-2 bg-amber-500 text-gray-900 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $book->categories->first()->name ?? 'Fiction' }}
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-200 group-hover:text-amber-500 transition-colors">{{ $book->title }}</h3>
                            <p class="text-gray-400 text-sm mb-2">By {{ $book->author }}</p>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-amber-500 font-bold">${{ number_format($book->price, 2) }}</span>
                                    @if($loop->index % 2 == 0)
                                        <span class="text-gray-500 text-sm line-through ml-2">${{ number_format($book->price * 1.2, 2) }}</span>
                                    @endif
                                </div>
                                <button onclick="showPurchaseModal({{ $book->id }})" class="inline-flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-gray-900 font-medium text-sm px-3 py-1 rounded-full transition-colors">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-100 mb-8">Browse by Category</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}" class="block group">
                    <div class="bg-gray-700 hover:bg-gray-600 rounded-lg p-6 h-full transition-colors">
                        <div class="flex items-center mb-4">
                            <span class="bg-amber-500 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                </svg>
                            </span>
                            <h3 class="text-xl font-semibold text-amber-500">{{ $category->name }}</h3>
                        </div>
                        <p class="text-gray-300 mb-4">{{ $category->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-amber-400 group-hover:text-amber-300">Browse {{ $category->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400 group-hover:text-amber-300 transform group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-xl shadow-2xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 p-8">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <h2 class="text-3xl font-bold text-amber-500">Subscribe to Our Newsletter</h2>
                        </div>
                        <p class="text-xl text-gray-300 mb-6">Stay updated with our latest books and exclusive offers!</p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Get personalized book recommendations
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Exclusive discounts for subscribers
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Early access to new releases
                            </li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/2 p-8 bg-gray-800">
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="bg-gray-700 rounded-lg p-6 shadow-inner">
                            @csrf
                            <h3 class="text-xl font-bold text-amber-500 mb-4">Join Our Community of Readers</h3>
                            <div class="mb-4">
                                <input type="email" class="w-full bg-gray-600 border border-gray-500 rounded-md py-3 px-4 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                                      placeholder="Enter your email" required>
                            </div>
                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold py-3 px-4 rounded-md transition-colors flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                                Subscribe Now
                            </button>
                            <p class="text-gray-400 text-sm mt-3">We respect your privacy. Unsubscribe at any time.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 