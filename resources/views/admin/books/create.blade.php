@extends('layouts.admin')

@section('title', 'Add New Book')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
    .select2-container--bootstrap-5 .select2-selection {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        height: auto;
        font-size: 1rem;
        border-radius: 0.25rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add New Book</h6>
            <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                id="author" name="author" value="{{ old('author') }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                id="isbn" name="isbn" value="{{ old('isbn') }}" required>
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories <span class="text-danger">*</span></label>
                            <select class="form-select select2 @error('categories') is-invalid @enderror" 
                                id="categories" name="categories[]" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="genres" class="form-label">Genres</label>
                            <select class="form-select select2 @error('genres') is-invalid @enderror" 
                                id="genres" name="genres[]" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" 
                                        {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('genres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="publisher" class="form-label">Publisher <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                                id="publisher" name="publisher" value="{{ old('publisher') }}" required>
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="publication_date" class="form-label">Publication Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('publication_date') is-invalid @enderror" 
                                id="publication_date" name="publication_date" value="{{ old('publication_date') }}" required>
                            @error('publication_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="pages" class="form-label">Pages <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('pages') is-invalid @enderror" 
                                id="pages" name="pages" value="{{ old('pages') }}" min="1" required>
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="language" class="form-label">Language <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('language') is-invalid @enderror" 
                                id="language" name="language" value="{{ old('language', 'English') }}" required>
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" 
                                value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured</label>
                            <small class="d-block text-muted">Featured books will be displayed prominently on the home page</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                id="cover_image" name="cover_image" accept="image/*">
                            <div class="form-text">Upload an image for the book cover (max 2MB)</div>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-3">
                            <div id="imagePreviewContainer" class="mb-3 text-center d-none">
                                <p>Image Preview:</p>
                                <img id="imagePreview" src="#" alt="Cover Preview" 
                                    class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Book
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Debug form submission and validate
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            console.log('Form submitted');
            
            // Validate required fields
            let isValid = true;
            let categoriesSelected = $('#categories').val() && $('#categories').val().length > 0;
            
            if (!categoriesSelected) {
                isValid = false;
                $('#categories').addClass('is-invalid');
                $('<div class="invalid-feedback">Please select at least one category</div>').insertAfter('#categories + .select2');
            } else {
                $('#categories').removeClass('is-invalid');
                $('#categories').next('.invalid-feedback').remove();
            }
            
            // Ensure Select2 values are properly included in form data
            if (!isValid) {
                e.preventDefault();
                alert('Please fix the errors before submitting.');
                return false;
            }
            
            // Make sure Select2 selections are captured even if the field is not in focus
            $('#categories').trigger('change');
            $('#genres').trigger('change');
            
            return true;
        });
    });

    // Preview image before upload
    document.getElementById('cover_image').addEventListener('change', function(event) {
        const fileInput = event.target;
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('d-none');
            }
            
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreviewContainer.classList.add('d-none');
        }
    });
    
    // Initialize Select2
    $(document).ready(function() {
        // Inisialisasi Select2 untuk categories
        $('#categories').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select categories'
        });
        
        // Inisialisasi Select2 untuk genres
        $('#genres').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select genres'
        });
        
        // Jika ada error, pastikan Select2 tetap menampilkan nilai yang sudah dipilih
        @if($errors->any())
            let oldCategories = {!! json_encode(old('categories', [])) !!};
            $('#categories').val(oldCategories).trigger('change');
            
            let oldGenres = {!! json_encode(old('genres', [])) !!};
            $('#genres').val(oldGenres).trigger('change');
        @endif
    });
</script>
@endsection 