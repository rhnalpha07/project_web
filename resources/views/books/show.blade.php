@extends('layouts.main')

@section('title', $book->title)

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center text-gray-400 hover:text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Books
                </a>
            </div>

            <!-- Book Details -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <!-- Book Cover -->
                    <div class="md:w-1/3">
                        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Book Info -->
                    <div class="md:w-2/3 p-6">
                        <h1 class="text-3xl font-bold text-amber-500 mb-2">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-400 mb-4">by {{ $book->author }}</p>
                        
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-200 mb-2">Description</h2>
                            <p class="text-gray-400">{{ $book->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-400">Category</h3>
                                <p class="text-gray-200">{{ $book->category->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400">Genre</h3>
                                <p class="text-gray-200">{{ $book->genre->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400">ISBN</h3>
                                <p class="text-gray-200">{{ $book->isbn }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400">Published Year</h3>
                                <p class="text-gray-200">{{ $book->published_year }}</p>
                            </div>
                        </div>

                        <!-- Price and Actions -->
                        <div class="border-t border-gray-700 pt-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-amber-500">${{ number_format($book->price, 2) }}</span>
                                </div>
                                <div class="space-x-4">
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-600 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </form>
                                    <form action="{{ route('transactions.buy', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-900 bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                            Buy Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 