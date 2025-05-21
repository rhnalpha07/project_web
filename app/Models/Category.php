<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Get the books for the category.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Scope a query to only include featured categories.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by number of books.
     */
    public function scopePopular($query)
    {
        return $query->withCount('books')->orderBy('books_count', 'desc');
    }
} 