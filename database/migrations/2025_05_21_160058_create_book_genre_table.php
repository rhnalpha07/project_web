<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if table already exists to avoid errors
        if (!Schema::hasTable('book_genre')) {
            Schema::create('book_genre', function (Blueprint $table) {
                $table->id();
                $table->foreignId('book_id')->constrained()->onDelete('cascade');
                $table->foreignId('genre_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                
                // Add unique constraint to prevent duplicates
                $table->unique(['book_id', 'genre_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_genre');
    }
};
