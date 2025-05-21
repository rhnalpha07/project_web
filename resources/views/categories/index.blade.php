@extends('layouts.main')

@section('title', 'Book Categories')

@section('content')
    <!-- Category Header -->
    <div class="bg-light p-4 rounded-3 mb-5">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <h1 class="display-5 fw-bold">Book Categories</h1>
                <p class="lead">Discover our extensive collection organized by categories</p>
            </div>
        </div>
    </div>

    <!-- Main Categories Section -->
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <h2 class="border-bottom pb-2">All Categories</h2>
        </div>
        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-wrapper me-3">
                            <i class="fas fa-bookmark text-primary"></i>
                        </div>
                        <h3 class="card-title mb-0">{{ $category->name }}</h3>
                    </div>
                    <p class="card-text">{{ $category->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="badge bg-light text-dark rounded-pill">
                            <i class="fas fa-book me-1"></i> {{ $category->books_count }} books
                        </span>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">
                            Browse Books <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Featured Categories with Images -->
    <section class="mt-5 pt-4 border-top">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="border-bottom pb-2">Featured Categories</h2>
            </div>
        </div>
        <div class="row">
            @foreach($featuredCategories as $category)
            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white overflow-hidden hover-card">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="card-img" alt="{{ $category->name }}" style="height: 250px; object-fit: cover; opacity: 0.7;">
                    @else
                        <div class="bg-secondary" style="height: 250px;"></div>
                    @endif
                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                        <h3 class="card-title">{{ $category->name }}</h3>
                        <p class="card-text">{{ $category->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-book me-1"></i> {{ $category->books_count }} books
                            </span>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-light">
                                Explore <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="mt-5 pt-4 border-top">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="border-bottom pb-2">Popular Categories</h2>
            </div>
        </div>
        <div class="row">
            @foreach($popularCategories as $category)
            <div class="col-md-3 mb-4">
                <div class="card text-center h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="icon-wrapper-lg mx-auto">
                                <i class="fas fa-book fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h4 class="card-title">{{ $category->name }}</h4>
                        <p class="card-text text-muted">{{ $category->books_count }} books available</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary mt-2">
                            View Books <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Category Statistics -->
    <section class="mt-5 pt-4 bg-light p-4 rounded border-top">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="border-bottom pb-2">Category Statistics</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-white h-100 shadow-sm hover-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="icon-wrapper-lg mx-auto">
                                <i class="fas fa-tags fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="text-primary mb-0">{{ $totalCategories }}</h3>
                        <p class="text-muted">Total Categories</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-white h-100 shadow-sm hover-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="icon-wrapper-lg mx-auto">
                                <i class="fas fa-book fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="text-primary mb-0">{{ $totalBooks }}</h3>
                        <p class="text-muted">Total Books</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-white h-100 shadow-sm hover-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="icon-wrapper-lg mx-auto">
                                <i class="fas fa-chart-bar fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="text-primary mb-0">{{ $avgBooksPerCategory }}</h3>
                        <p class="text-muted">Avg. Books per Category</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-white h-100 shadow-sm hover-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="icon-wrapper-lg mx-auto">
                                <i class="fas fa-crown fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="text-primary mb-0">{{ $mostPopularCategory }}</h3>
                        <p class="text-muted">Most Popular Category</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-wrapper-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection 