<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index()
{
    $categories = Category::all(); // Fetch all categories
    return response()->json([
        'success' => true,
        'data' => $categories
    ]);
}

    public function allcats()
    {
        $categories = Category::all(); // Fetch all categories
        return view('admin.categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Generate the initial slug
        $slug = Str::slug($request->name);

        // Check if slug already exists and append a suffix if necessary
        $slugBase = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $count;
            $count++;
        }

        // Create the category
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Display the specified category (based on slug)
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // Find category by slug
        return view('admin.categories.show', compact('category'));
    }

    // Show the form for editing the specified category (based on slug)
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // Find category by slug
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified category in storage
    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // Find category by slug

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Generate the new slug from the name
        $slug = Str::slug($request->name);

        // Check if slug already exists and append a suffix if necessary
        $slugBase = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $count;
            $count++;
        }

        // Update the category
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified category from storage
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // Find category by slug
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
