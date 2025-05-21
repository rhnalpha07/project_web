<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Books based on imagination and not necessarily on reality',
                'is_featured' => true,
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Books based on facts, real events, and real people',
                'is_featured' => true,
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Fiction dealing with advanced technology and futuristic scenarios',
                'is_featured' => false,
            ],
            [
                'name' => 'Mystery',
                'description' => 'Fiction dealing with the solution of a crime or puzzle',
                'is_featured' => false,
            ],
            [
                'name' => 'Biography',
                'description' => 'Books about a person written by someone else',
                'is_featured' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 