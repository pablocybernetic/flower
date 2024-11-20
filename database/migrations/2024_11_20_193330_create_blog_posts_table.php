<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_blog_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->string('author')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('category')->nullable(); // Add category
            $table->text('tags')->nullable(); // Add tags (JSON or comma-separated)
            $table->text('excerpt')->nullable(); // Add excerpt
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Add status field
            $table->unsignedBigInteger('author_id')->nullable(); // For author relationship
            $table->integer('views')->default(0); // Track views
            $table->string('meta_title')->nullable(); // SEO title
            $table->text('meta_description')->nullable(); // SEO description
            $table->text('seo_keywords')->nullable(); // SEO keywords
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Foreign key for author if you're using a `users` table for authors
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
