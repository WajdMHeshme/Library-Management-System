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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('author');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedInteger('stock')->default(0);
            $table->string('cover_image')->nullable();
            $table->string('language')->nullable();
            $table->decimal('price', 8, 2)->default(0.0);
            $table->unsignedSmallInteger('published_year')->nullable();
            $table->unsignedInteger('pages')->nullable();
            $table->enum('availability', ['sale', 'borrow'])->default('sale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
