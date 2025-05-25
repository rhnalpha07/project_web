@extends('layouts.main')

@section('title', $category->name)

@section('content')
    <!-- Category Header -->
    <div class="bg-light p-4 rounded-3 mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold">{{ $category->name }}</h1>
                <p class="lead">{{ $category->description }}</p>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary rounded-pill fs-6 me-3">
                        <i class="fas fa-book me-1"></i> {{ $books->total() }} Buku
                    </span>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Semua Kategori
                    </a>
                </div>
            </div>
            @if($category->image)
            <div class="col-md-4 text-md-end">
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                     class="img-fluid rounded shadow" style="max-height: 200px;">
            </div>
            @endif
        </div>
    </div>

    <!-- Books List Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Buku dalam {{ $category->name }}</h2>
                <div class="d-flex">
                    <form action="{{ route('categories.show', $category) }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari di kategori ini..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($books->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
            @foreach($books as $book)
                <div class="col">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="position-relative">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-light text-center p-5" style="height: 250px;">
                                    <i class="fas fa-book fa-4x text-secondary mt-5"></i>
                                </div>
                            @endif
                            
                            @if($book->is_featured)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i> Unggulan
                                    </span>
                                </div>
                            @endif
                            
                            @if($book->created_at->diffInDays(now()) < 30)
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-success">
                                        <i class="fas fa-bookmark me-1"></i> Baru
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                            <p class="card-text text-muted mb-1">
                                <i class="fas fa-user-edit me-1"></i> {{ $book->author }}
                            </p>
                            <p class="card-text mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $book->publication_year }}
                                </small>
                            </p>
                            <p class="card-text description-truncate mb-3">{{ Str::limit($book->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-bold text-primary">Rp{{ number_format($book->price, 0, ',', '.') }}</span>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div>
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            @if(request('search'))
                Tidak ada buku yang cocok dengan "{{ request('search') }}" di kategori ini. 
                <a href="{{ route('categories.show', $category) }}" class="alert-link">Hapus pencarian</a>
            @else
                Belum ada buku yang tersedia dalam kategori ini.
            @endif
        </div>
    @endif

    <!-- Related Categories -->
    @php
        $relatedCategories = \App\Models\Category::where('id', '!=', $category->id)
            ->withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(4)
            ->get();
    @endphp

    @if($relatedCategories->count() > 0)
        <section class="mt-5 pt-4 border-top">
            <h3 class="mb-4">Kategori Lain yang Mungkin Anda Suka</h3>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($relatedCategories as $relatedCategory)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-tags fa-2x text-primary"></i>
                                </div>
                                <h5 class="card-title">{{ $relatedCategory->name }}</h5>
                                <p class="text-muted">{{ $relatedCategory->books_count }} buku</p>
                                <a href="{{ route('categories.show', $relatedCategory) }}" class="btn btn-sm btn-outline-primary">
                                    Jelajahi <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@section('styles')
<style>
    .hover-card {
        transition: transform 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
    }
    .description-truncate {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .icon-wrapper {
        width: 60px;
        height: 60px;
        margin: 0 auto;
        border-radius: 50%;
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection 