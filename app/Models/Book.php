<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'price',
        'cover_image',
        'publisher',
        'publication_date',
        'pages',
        'language',
        'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'publication_date' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the categories for the book.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the genres for the book.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get the reviews for the book.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope a query to only include featured books.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
} 