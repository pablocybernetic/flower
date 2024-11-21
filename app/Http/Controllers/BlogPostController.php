<?php
// app/Http/Controllers/BlogPostController.php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

class BlogPostController extends Controller
{
    
        // Display a listing of blog posts
        public function index()
        {
            $blogPosts = BlogPost::all(); // You can paginate the results if needed
            $categories = DB::table('categories')->get(); // Fetch categories

            return view('admin.blog.index', compact('blogPosts','categories'));
        }
        public function show($slug) {
            $categories = DB::table('categories')->get(); // Fetch categories

            $blogs = DB::table('blog_posts')
            ->orderBy('created_at', 'desc') // Order by the most recent
            ->limit(3) // Get the last three posts
            ->get();
            $blog = DB::table('blog_posts')->where('slug', $slug)->first(); // Fetch the blog details by ID
            return view('blog_details', compact('blog','blogs', 'categories'));
        }
    
        // Show the form for creating a new blog post
        public function create()
        {
            $categories = DB::table('categories')->get(); // Fetch categories

            return view('admin.blog.create', compact('categories'));
        }
        public function edit(BlogPost $blogPost)
        {
            $categories = DB::table('categories')->get(); // Fetch categories

            return view('admin.blog.edit', compact('blogPost','categories'));
        }
        public function store(Request $request)
        {
            try {
                // Validation
                $request->validate([
                    'title' => 'required|string|max:255',
                    'category' => 'required|string|max:255',
                    'content' => 'required|string',
                    'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:255',
                    'tags' => 'nullable|string',
                ]);
        
                // Store blog post
                $blogPost = new BlogPost();
                $blogPost->title = $request->title;
                $blogPost->slug = Str::slug($request->title);
                $blogPost->category = $request->category;
                $blogPost->content = $request->content;
                $blogPost->meta_title = $request->meta_title;
                $blogPost->meta_description = $request->meta_description;
                $blogPost->tags = $request->tags;
                $blogPost->author = Auth::user()->name;
        
                // Handle image upload
                if ($request->hasFile('featured_image')) {
                    $uploadPath = public_path('assets/blogs');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    $fileName = uniqid() . '.' . $request->file('featured_image')->getClientOriginalExtension();
                    $request->file('featured_image')->move($uploadPath, $fileName);
                    $blogPost->featured_image = "assets/blogs/$fileName";
                }
        
                $blogPost->save();
        
                // Log the file path
                \Log::info('Blog post created: ' . $blogPost->id);
                \Log::info('Image saved at: ' . $blogPost->featured_image);
        
                return redirect()->route('admin.blog.create')->with('success', 'Blog post created successfully!');
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                return back()->with('error', 'An error occurred. Please try again later. ' . $e->getMessage());
            }
        }
        

public function update(Request $request, BlogPost $blogPost)
{
    // Validate input data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'nullable|string|max:255',
        'tags' => 'nullable|string',
        'excerpt' => 'nullable|string',
        'status' => 'required|in:draft,published,archived',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'seo_keywords' => 'nullable|string',
        'published_at' => 'nullable|date',
    ]);

    try {
        // Update the blog post content
        $blogPost->update($validated);
        $successMessages = ['Blog post updated successfully!'];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');

            // Define the upload path
            $uploadPath = public_path('assets/blogs');

            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Save the image with a unique name
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);

            // Save the relative path to the database
            $blogPost->update(['featured_image' => "assets/blogs/$imageName"]);

            $successMessages[] = 'Featured image uploaded successfully!';
        }

        // Check if certain fields were updated for specific feedback
        if ($request->filled('meta_title')) {
            $successMessages[] = 'Meta title updated.';
        }
        if ($request->filled('meta_description')) {
            $successMessages[] = 'Meta description updated.';
        }
        if ($request->filled('tags')) {
            $successMessages[] = 'Tags updated.';
        }

        // Redirect back with all success messages
        return redirect()->route('admin.blog.index')->with('success', implode(' ', $successMessages));
    } catch (\Exception $e) {
        // Log error details for debugging
        \Log::error('Error updating blog post: ' . $e->getMessage());

        $errorMessages = ['An error occurred while updating the blog post.'];

        // Add specific error messages based on failure points
        if ($request->hasFile('featured_image') && !$request->file('featured_image')->isValid()) {
            $errorMessages[] = 'The uploaded image is invalid.';
        }

        // Redirect back with error messages
        return back()->withErrors($errorMessages);
    }
}

    // Remove the specified blog post
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully!');
    }

}

