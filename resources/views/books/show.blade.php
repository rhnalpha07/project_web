@extends('layouts.main')

@section('title', $book->title)

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center text-gray-400 hover:text-amber-500 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Buku
                </a>
            </div>

            <!-- Book Details -->
            <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <div class="md:flex">
                    <!-- Book Cover -->
                    <div class="md:w-1/3 relative">
                        <div class="aspect-[2/3] h-full">
                            @if($book->cover_image && Storage::disk('public')->exists($book->cover_image))
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-700 p-4">
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <h3 class="text-xl font-bold text-gray-300">{{ $book->title }}</h3>
                                    </div>
                                </div>
                            @endif
                            @if($book->is_featured)
                                <div class="absolute top-4 -left-2 bg-amber-500 text-gray-900 py-1 px-4 font-semibold shadow-lg transform -rotate-3">
                                    Unggulan
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Book Info -->
                    <div class="md:w-2/3 p-8">
                        <h1 class="text-4xl font-bold text-amber-500 mb-2">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-300 mb-6">oleh <span class="font-medium">{{ $book->author }}</span></p>
                        
                        <div class="flex flex-wrap gap-3 mb-6">
                            @foreach($book->categories as $category)
                                <span class="inline-flex items-center px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-gray-200">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                            @foreach($book->genres as $genre)
                                <span class="inline-flex items-center px-3 py-1 bg-gray-700 rounded-full text-sm font-medium text-amber-400">
                                    {{ $genre->name }}
                                </span>
                            @endforeach
                        </div>
                        
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-200 mb-3">Deskripsi</h2>
                            <p class="text-gray-300 leading-relaxed">{{ $book->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mb-8">
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">ISBN</h3>
                                <p class="text-gray-200 font-mono">{{ $book->isbn }}</p>
                            </div>
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">Penerbit</h3>
                                <p class="text-gray-200">{{ $book->publisher }}</p>
                            </div>
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">Tanggal Terbit</h3>
                                <p class="text-gray-200">{{ $book->publication_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">Halaman</h3>
                                <p class="text-gray-200">{{ $book->pages }}</p>
                            </div>
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">Bahasa</h3>
                                <p class="text-gray-200">{{ $book->language }}</p>
                            </div>
                            <div class="bg-gray-700 bg-opacity-40 p-3 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-400">Ketersediaan</h3>
                                <p class="text-gray-200">{{ $book->stock > 0 ? 'Tersedia (' . $book->stock . ')' : 'Habis' }}</p>
                            </div>
                        </div>

                        <!-- Price and Actions -->
                        <div class="border-t border-gray-700 pt-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <span class="text-3xl font-bold text-amber-500">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    @auth
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-5 py-3 border border-gray-600 text-sm font-medium rounded-lg text-gray-200 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-amber-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                    <form action="{{ route('transactions.buy', $book->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent text-sm font-medium rounded-lg text-gray-900 bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-amber-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            Beli Sekarang
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-3 border border-gray-600 text-sm font-medium rounded-lg text-gray-200 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-amber-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Masuk untuk Membeli
                                    </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section - Comment out since the reviews table doesn't exist -->
            {{-- 
            @if(isset($book->reviews) && $book->reviews->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-200 mb-6">Ulasan Pelanggan</h2>
                <div class="space-y-6">
                    @foreach($book->reviews as $review)
                    <div class="bg-gray-800 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-amber-500 flex items-center justify-center text-gray-900 font-bold text-lg">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-200">{{ $review->user->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-300">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            --}}
        </div>
    </div>
</div>
@endsection 