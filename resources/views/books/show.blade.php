@extends('layouts.main')

@section('title', $book->title)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Book Image -->
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($book->cover_image)
                    <div style="height: 400px; background-color: #f8f9fa; overflow: hidden;">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" 
                            style="height: 100%; width: 100%; object-fit: contain; object-position: center; image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                    </div>
                @else
                    <div style="height: 400px;">
                        <x-book-cover-placeholder :title="$book->title" :author="$book->author" />
                    </div>
                @endif
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">Add to Cart</button>
                        <button class="btn btn-outline-primary">Add to Wishlist</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Details -->
        <div class="col-md-8">
            <h1 class="mb-3">{{ $book->title }}</h1>
            
            <div class="mb-4">
                <h5 class="text-muted">By {{ $book->author }}</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <span class="h3 text-primary mb-0">${{ number_format($book->price, 2) }}</span>
                    </div>
                    <div class="badge bg-success">In Stock</div>
                </div>
            </div>

            <!-- Book Information Tabs -->
            <ul class="nav nav-tabs mb-3" id="bookTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab">
                        Description
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-bs-toggle="tab" href="#details" role="tab">
                        Details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab">
                        Reviews
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="bookTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="p-4 bg-light rounded">
                        {{ $book->description }}
                    </div>
                </div>

                <!-- Details Tab -->
                <div class="tab-pane fade" id="details" role="tabpanel">
                    <div class="p-4 bg-light rounded">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 200px">ISBN:</th>
                                <td>{{ $book->isbn }}</td>
                            </tr>
                            <tr>
                                <th>Publisher:</th>
                                <td>{{ $book->publisher }}</td>
                            </tr>
                            <tr>
                                <th>Publication Date:</th>
                                <td>{{ $book->publication_date->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Pages:</th>
                                <td>{{ $book->pages }}</td>
                            </tr>
                            <tr>
                                <th>Language:</th>
                                <td>{{ $book->language }}</td>
                            </tr>
                            <tr>
                                <th>Categories:</th>
                                <td>
                                    @foreach($book->categories as $category)
                                        <span class="badge bg-secondary me-1">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="p-4 bg-light rounded">
                        <!-- Review Form -->
                        <div class="mb-4">
                            <h4>Write a Review</h4>
                            <form action="{{ route('books.reviews.store', $book->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <select class="form-select" name="rating" required>
                                        <option value="5">5 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="2">2 Stars</option>
                                        <option value="1">1 Star</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Your Review</label>
                                    <textarea class="form-control" name="comment" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        </div>

                        <!-- Existing Reviews -->
                        <div class="reviews-list">
                            @forelse($book->reviews as $review)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <h5 class="card-title mb-0">{{ $review->user->name }}</h5>
                                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $review->comment }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="alert alert-info">
                                No reviews yet. Be the first to review this book!
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    <section class="mt-5">
        <h3 class="mb-4">Related Books</h3>
        <div class="row">
            @foreach($relatedBooks as $relatedBook)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($relatedBook->cover_image)
                        <div style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                            <img src="{{ asset('storage/' . $relatedBook->cover_image) }}" class="card-img-top" alt="{{ $relatedBook->title }}" 
                                style="height: 100%; width: 100%; object-fit: contain; object-position: center; image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                        </div>
                    @else
                        <div style="height: 200px;">
                            <x-book-cover-placeholder :title="$relatedBook->title" :author="$relatedBook->author" />
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $relatedBook->title }}</h5>
                        <p class="card-text"><small class="text-muted">By {{ $relatedBook->author }}</small></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">${{ number_format($relatedBook->price, 2) }}</span>
                            <a href="{{ route('books.show', $relatedBook->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection 