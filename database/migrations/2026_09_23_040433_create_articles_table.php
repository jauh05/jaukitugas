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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            
            // Simplified category & tags for clean architecture without over-engineering relation tables initially
            $table->string('category')->nullable()->index();
            $table->json('tags')->nullable();
            
            $table->string('author')->nullable();
            
            $table->enum('status', ['draft', 'review', 'scheduled', 'published', 'archived'])->default('draft')->index();
            $table->enum('source', ['manual', 'ai', 'telegram'])->default('manual');
            
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
