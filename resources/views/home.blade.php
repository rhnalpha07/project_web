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
    <div class="hero-section bg-light rounded-3 p-5 mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Welcome to BookStore</h1>
                <p class="lead">Discover thousands of books across various genres. From bestsellers to rare finds, we have something for every reader.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg">Browse Books</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/hero-books.jpg') }}" alt="Books Collection" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Featured Books Section -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Featured Books</h2>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">View All <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        
        <div class="row">
            @foreach($featuredBooks as $book)
            <div class="col-md-3 mb-4">
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
                                @if($loop->index % 2 == 0)
                                <span class="book-price-discount">${{ number_format($book->price * 1.2, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-shopping-cart me-1"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Categories Section -->
    <section class="mb-5">
        <h2 class="mb-4">Browse by Category</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card bg-light h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-bookmark text-primary me-2"></i>
                            {{ $category->name }}
                        </h5>
                        <p class="card-text text-muted mb-4">{{ $category->description }}</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary">
                            Browse {{ $category->name }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-primary text-white p-5 rounded-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2><i class="fas fa-envelope-open-text me-2"></i> Subscribe to Our Newsletter</h2>
                <p>Stay updated with our latest books and exclusive offers!</p>
                <ul class="list-unstyled mt-3">
                    <li><i class="fas fa-check-circle me-2"></i> Get personalized book recommendations</li>
                    <li><i class="fas fa-check-circle me-2"></i> Exclusive discounts for subscribers</li>
                    <li><i class="fas fa-check-circle me-2"></i> Early access to new releases</li>
                </ul>
            </div>
            <div class="col-md-6">
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="bg-white p-4 rounded shadow">
                    @csrf
                    <h5 class="text-dark mb-3">Join Our Community of Readers</h5>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-paper-plane me-2"></i> Subscribe Now
                    </button>
                    <p class="text-muted mt-2 mb-0 small">We respect your privacy. Unsubscribe at any time.</p>
                </form>
            </div>
        </div>
    </section>
@endsection 