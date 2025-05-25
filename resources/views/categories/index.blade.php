@extends('layouts.main')

@section('title', 'Kategori Buku')

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Category Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-amber-500 mb-3">Kategori Buku</h1>
            <p class="text-xl text-gray-400">Temukan koleksi lengkap kami yang diorganisir berdasarkan kategori</p>
        </div>

        <!-- Main Categories Section -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-100 mb-6 pb-2 border-b border-gray-700">Semua Kategori</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <div class="bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-amber-500 rounded-full p-3 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-amber-500">{{ $category->name }}</h3>
                        </div>
                        <p class="text-gray-400 mb-6">{{ $category->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="bg-gray-700 text-amber-400 text-xs font-medium px-3 py-1.5 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                {{ $category->books_count }} buku
                            </span>
                            <a href="{{ route('categories.show', $category->id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-gray-900 font-medium rounded-md transition-colors">
                                Lihat Buku
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Categories with Images -->
        <section class="mb-16">
            <h2 class="text-2xl font-bold text-gray-100 mb-6 pb-2 border-b border-gray-700">Kategori Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($featuredCategories as $category)
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-70 z-10"></div>
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105" alt="{{ $category->name }}">
                    @else
                        <div class="bg-gray-700 w-full h-64"></div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                        <h3 class="text-2xl font-bold text-amber-500 mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-300 mb-4">{{ $category->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="bg-amber-500 text-gray-900 text-xs font-medium px-3 py-1.5 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                {{ $category->books_count }} buku
                            </span>
                            <a href="{{ route('categories.show', $category->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-white text-gray-900 font-medium rounded-md transition-colors">
                                Jelajahi
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Popular Categories -->
        <section class="mb-16">
            <h2 class="text-2xl font-bold text-gray-100 mb-6 pb-2 border-b border-gray-700">Kategori Populer</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($popularCategories as $category)
                <div class="bg-gray-800 rounded-lg text-center shadow-lg p-6 hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-500 bg-opacity-20 rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-bold text-amber-500 mb-2">{{ $category->name }}</h4>
                    <p class="text-gray-400 mb-4">{{ $category->books_count }} buku tersedia</p>
                    <a href="{{ route('categories.show', $category->id) }}" class="inline-flex items-center px-4 py-2 border border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-gray-900 font-medium rounded-md transition-colors">
                        Lihat Buku
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Category Statistics -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-100 mb-6 pb-2 border-b border-gray-700">Statistik Kategori</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-500 bg-opacity-20 rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-500 mb-1">{{ $totalCategories }}</h3>
                    <p class="text-gray-400">Total Kategori</p>
                </div>
                
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-500 bg-opacity-20 rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-500 mb-1">{{ $totalBooks }}</h3>
                    <p class="text-gray-400">Total Buku</p>
                </div>
                
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-500 bg-opacity-20 rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-500 mb-1">{{ $avgBooksPerCategory }}</h3>
                    <p class="text-gray-400">Rata-rata Buku per Kategori</p>
                </div>
                
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <div class="bg-amber-500 bg-opacity-20 rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-amber-500 mb-1">{{ $mostPopularCategory }}</h3>
                    <p class="text-gray-400">Kategori Terpopuler</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection 