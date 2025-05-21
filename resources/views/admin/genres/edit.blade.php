@extends('layouts.admin')

@section('title', 'Edit Genre')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Genre: {{ $genre->name }}</h1>
        <a href="{{ route('admin.genres.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Genres
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Genre Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name', $genre->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="4">{{ old('description', $genre->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                        {{ old('is_active', $genre->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                    <small class="d-block text-muted">Inactive genres won't be displayed on the site</small>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Genre</button>
            </form>
        </div>
    </div>
</div>
@endsection 