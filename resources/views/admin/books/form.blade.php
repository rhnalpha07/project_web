@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{ isset($book) ? 'Edit Book: ' . $book->title : 'Add New Book' }}
        </h1>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($book) ? route('admin.books.update', $book) : route('admin.books.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($book))
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5 class="mb-3">Basic Information</h5>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $book->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                       id="author" name="author" value="{{ old('author', $book->author ?? '') }}" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="mb-4">
                            <h5 class="mb-3">Additional Details</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                               id="isbn" name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}">
                                        @error('isbn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="published_date" class="form-label">Publication Date</label>
                                        <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                               id="published_date" name="published_date" 
                                               value="{{ old('published_date', isset($book) ? $book->published_date->format('Y-m-d') : '') }}">
                                        @error('published_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="language" class="form-label">Language</label>
                                        <select class="form-select @error('language') is-invalid @enderror" 
                                                id="language" name="language">
                                            <option value="">Select Language</option>
                                            <option value="en" {{ old('language', $book->language ?? '') == 'en' ? 'selected' : '' }}>English</option>
                                            <option value="id" {{ old('language', $book->language ?? '') == 'id' ? 'selected' : '' }}>Indonesian</option>
                                        </select>
                                        @error('language')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pages" class="form-label">Number of Pages</label>
                                        <input type="number" class="form-control @error('pages') is-invalid @enderror" 
                                               id="pages" name="pages" value="{{ old('pages', $book->pages ?? '') }}">
                                        @error('pages')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- Cover Image -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Cover Image</h5>
                            </div>
                            <div class="card-body">
                                @if(isset($book) && $book->cover_image)
                                    <div class="mb-3">
                                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" 
                                             class="img-fluid rounded mb-2">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                       id="cover_image" name="cover_image" accept="image/*">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Recommended size: 600x800px. Max file size: 2MB
                                </small>
                            </div>
                        </div>

                        <!-- Pricing & Stock -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Pricing & Stock</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                               id="price" name="price" value="{{ old('price', $book->price ?? '') }}" required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" name="stock" value="{{ old('stock', $book->stock ?? 0) }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Category</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-secondary me-2" onclick="history.back()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($book) ? 'Update Book' : 'Create Book' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 