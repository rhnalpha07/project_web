@extends('layouts.main')

@section('title', 'Books')

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
        height: 220px;
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
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
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
    
    .category-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        border-left: 4px solid var(--primary-color);
    }
    
    .category-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .active-category {
        background-color: var(--primary-color);
        color: white !important;
        font-weight: 600;
        padding: 8px 15px !important;
        border-radius: 20px;
    }
</style>
@endsection

@section('header')
<div class="page-header text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Explore Our Books</h1>
        <p class="lead">Discover the perfect read from our vast collection</p>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar with Categories -->
        <div class="col-lg-3 mb-4">
            <div class="card category-card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Categories</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('books.index') }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ !request('category') ? 'active-category' : '' }}">
                            All Books
                            <span class="badge bg-secondary rounded-pill">{{ $books->total() }}</span>
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('books.index', ['category' => $category->id]) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('category') == $category->id ? 'active-category' : '' }}">
                            {{ $category->name }}
                            <span class="badge bg-secondary rounded-pill">{{ $category->books_count ?? 0 }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="card category-card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i> Price Range</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.index') }}" method="GET">
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        <div class="mb-3">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input type="number" class="form-control" id="min_price" name="min_price" 
                                  value="{{ request('min_price') }}" min="0" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input type="number" class="form-control" id="max_price" name="max_price" 
                                  value="{{ request('max_price') }}" min="0" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Books Grid -->
        <div class="col-lg-9">
            <!-- Search Bar -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('books.index') }}" method="GET" class="input-group">
                        <input type="text" 
                               name="search" 
                               placeholder="Search for title, author, or description..." 
                               class="form-control"
                               value="{{ request('search') }}">
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </form>
                </div>
            </div>
            
            @if($books->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> No books found matching your criteria. Try different search terms or browse all books.
            </div>
            @else
            
            <!-- Books Grid -->
            <div class="row">
                @foreach($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card book-card h-100">
                        <div class="book-img-container">
                            @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                            @else
                            <x-book-cover-placeholder :title="$book->title" :author="$book->author" />
                            @endif
                            <div class="book-card-overlay"></div>
                            <div class="rating-badge">
                                <i class="fas fa-star text-warning me-1"></i>
                                {{ number_format(4 + (1 - mt_rand(0, 10)/10), 1) }}
                            </div>
                            <span class="book-category-tag">{{ $book->categories->first()->name ?? 'Fiction' }}</span>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title book-title">{{ $book->title }}</h5>
                            <p class="book-author mb-2"><i class="fas fa-user-edit text-muted me-1"></i> {{ $book->author }}</p>
                            <p class="card-text flex-grow-1">{{ Str::limit($book->description, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-end mt-auto">
                                <div class="book-price">
                                    ${{ number_format($book->price, 2) }}
                                    @if($loop->index % 3 == 0)
                                    <span class="book-price-discount">${{ number_format($book->price * 1.25, 2) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-shopping-cart me-1"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 