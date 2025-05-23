@extends('layouts.main')

@section('title', 'Books')

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-amber-500 mb-3">Explore Our Books</h1>
            <p class="text-xl text-gray-400">Discover the perfect read from our vast collection</p>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar with Categories -->
            <div class="w-full md:w-1/4">
                <!-- Categories -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg mb-6">
                    <div class="bg-amber-500 text-gray-900 py-3 px-4">
                        <h3 class="font-bold text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            Categories
                        </h3>
                    </div>
                    <div class="divide-y divide-gray-700">
                        <a href="{{ route('books.index') }}" 
                            class="block px-4 py-3 hover:bg-gray-700 transition-colors flex justify-between items-center {{ !request('category') ? 'bg-gray-700 text-amber-500 font-medium' : 'text-gray-300' }}">
                            All Books
                            <span class="bg-gray-600 text-gray-300 text-xs font-medium px-2 py-1 rounded-full">{{ $books->total() }}</span>
                        </a>
                        
                        @foreach($categories as $category)
                        <a href="{{ route('books.index', ['category' => $category->id]) }}" 
                            class="block px-4 py-3 hover:bg-gray-700 transition-colors flex justify-between items-center {{ request('category') == $category->id ? 'bg-gray-700 text-amber-500 font-medium' : 'text-gray-300' }}">
                            {{ $category->name }}
                            <span class="bg-gray-600 text-gray-300 text-xs font-medium px-2 py-1 rounded-full">{{ $category->books_count ?? 0 }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Price Filter -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    <div class="bg-gray-700 text-gray-100 py-3 px-4">
                        <h3 class="font-bold text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Price Range
                        </h3>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('books.index') }}" method="GET">
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            
                            <div class="mb-4">
                                <label for="min_price" class="block text-sm font-medium text-gray-400 mb-1">Min Price</label>
                                <input type="number" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                                    id="min_price" name="min_price" value="{{ request('min_price') }}" min="0" step="0.01">
                            </div>
                            <div class="mb-4">
                                <label for="max_price" class="block text-sm font-medium text-gray-400 mb-1">Max Price</label>
                                <input type="number" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                                    id="max_price" name="max_price" value="{{ request('max_price') }}" min="0" step="0.01">
                            </div>
                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold py-2 px-4 rounded-md transition-colors">
                                Apply Filter
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4">
                <!-- Search Bar -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg mb-6">
                    <div class="p-4">
                        <form action="{{ route('books.index') }}" method="GET" class="flex">
                            <input type="text" name="search" placeholder="Search for title, author, or description..." 
                                class="flex-grow bg-gray-700 border border-gray-600 rounded-l-md py-2 px-4 text-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                value="{{ request('search') }}">
                            
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            
                            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold py-2 px-4 rounded-r-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                @if($books->isEmpty())
                <div class="bg-gray-800 text-gray-300 rounded-lg p-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    No books found matching your criteria. Try different search terms or browse all books.
                </div>
                @else
                
                <!-- Books Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($books as $book)
                    <div class="relative group bg-gray-800 rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                        <!-- Image & Hover Buttons -->
                        <div class="relative h-64 overflow-hidden">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center bg-gray-700 p-4">
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-300">{{ $book->title }}</h3>
                                        <p class="text-gray-400">By {{ $book->author }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center space-x-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('books.show', $book->id) }}" class="px-3 py-2 bg-gray-700 text-gray-100 rounded-md hover:bg-gray-600">Details</a>
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 bg-gray-700 text-gray-100 rounded-md hover:bg-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                                <form action="{{ route('transactions.buy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 bg-amber-500 text-gray-900 rounded-md hover:bg-amber-600">
                                        Buy Now
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Card Content -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-200">{{ $book->title }}</h3>
                            <p class="text-gray-400 text-sm mb-2">By {{ $book->author }}</p>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ Str::limit($book->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-amber-500 font-bold">${{ number_format($book->price, 2) }}</span>
                                <div class="space-x-2">
                                    <button onclick="showPurchaseModal({{ $book->id }})" class="px-3 py-2 bg-amber-500 text-gray-900 rounded-md hover:bg-amber-600">
                                        Buy Now
                                    </button>
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 bg-gray-700 text-gray-100 rounded-md hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $books->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 