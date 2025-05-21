<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Fiction',
                'description' => 'Literary works created from imagination'
            ],
            [
                'name' => 'Mystery',
                'description' => 'Fiction dealing with the solution of a crime or puzzle'
            ],
            [
                'name' => 'Thriller',
                'description' => 'Fiction characterized by suspense and excitement'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Fiction based on scientific discoveries or advanced technology'
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Fiction featuring supernatural or magical elements'
            ],
            [
                'name' => 'Romance',
                'description' => 'Fiction focusing on relationships and romantic love'
            ],
            [
                'name' => 'Historical Fiction',
                'description' => 'Fiction set in the past featuring historical events'
            ],
            [
                'name' => 'Biography',
                'description' => 'Non-fiction account of someone\'s life'
            ],
            [
                'name' => 'Self-Help',
                'description' => 'Books that aim to help readers solve personal problems'
            ],
            [
                'name' => 'Business',
                'description' => 'Books on business topics, leadership, and management'
            ],
            [
                'name' => 'Children\'s',
                'description' => 'Books written for children'
            ]
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
