<?php
// app/Models/BlogPost.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    // Allow mass assignment for these attributes
    protected $fillable = [
        'title', 'content', 'slug', 'author', 'featured_image', 
        'category', 'tags', 'excerpt', 'status', 'author_id', 
        'views', 'meta_title', 'meta_description', 'seo_keywords', 
        'published_at'
    ];

    // Cast 'tags' as an array if stored as a JSON or comma-separated
    protected $casts = [
        'tags' => 'array',
    ];

    // Optionally, you can define relationships
    // If you have a User model for the author, you can define a relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Method to increment the view count
    public function incrementViews()
    {
        $this->increment('views');
    }
}
