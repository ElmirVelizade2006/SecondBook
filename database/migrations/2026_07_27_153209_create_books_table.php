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

            // Relations
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained('users')->nullOnDelete();

            // Book Information
            $table->string('title');
            $table->string('isbn')->nullable();
            $table->text('description')->nullable();

            // Image
            $table->string('cover')->nullable();

            // Details
            $table->integer('publication_year')->nullable();
            $table->integer('pages')->nullable();
            $table->string('language')->default('English');

            // Sales
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('stock')->default(1);

            // Book Condition
            $table->enum('condition', [
                'new',
                'like_new',
                'good',
                'fair'
            ])->default('good');

            // Status
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

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