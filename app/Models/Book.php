<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'price',
        'stock',
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
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id')
                    ->select(['categories.id', 'categories.name']);
    }

    /**
     * Get the genres for the book.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id')
                    ->select(['genres.id', 'genres.name']);
    }

    /**
     * Get the reviews for the book.
     * This relationship is only defined if the reviews table exists.
     */
    public function reviews()
    {
        // Only define this relationship if the reviews table exists
        if (Schema::hasTable('reviews')) {
            return $this->hasMany(Review::class);
        }
        
        // Return an empty relation if the table doesn't exist
        return $this->hasMany(Review::class)->whereRaw('1 = 0');
    }

    /**
     * Get the transactions for the book.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Scope a query to only include featured books.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
} 