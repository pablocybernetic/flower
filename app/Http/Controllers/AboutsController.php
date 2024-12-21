<?php
namespace App\Http\Controllers;

use App\Models\Abouts;
use Illuminate\Http\Request;

class AboutsController extends Controller
{
    public function index()
    {
        $abouts = Abouts::first(); // Assuming only one About Us content exists
        return view('about.index', compact('abouts'));
    }

    public function edit()
    {
        $abouts = Abouts::first(); // Retrieve the existing record
    
        // No need to decode if it's already an array
        if (is_string($abouts->features)) {
            $abouts->features = json_decode($abouts->features, true); // Decode if it's a string
        }
    
        return view('admin.about.edit', compact('abouts'));
    }
    

    public function update(Request $request)
    {
        // Validate incoming data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle features field
        if ($request->has('features')) {
            $data['features'] = explode(',', $request->features);
        }
    
        // Handle image uploads using the same approach as your friend's code
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
    
            // Define the upload path
            $uploadPath = public_path('assets/images/about');
    
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            // Save the image with a unique name
            $image1Name = uniqid() . '.' . $image1->getClientOriginalExtension();
            $image1->move($uploadPath, $image1Name);
    
            // Save the relative path to the database
            $data['image1'] = "assets/images/about/$image1Name";
        }
    
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
    
            // Define the upload path
            $uploadPath = public_path('assets/images/about');
    
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            // Save the image with a unique name
            $image2Name = uniqid() . '.' . $image2->getClientOriginalExtension();
            $image2->move($uploadPath, $image2Name);
    
            // Save the relative path to the database
            $data['image2'] = "assets/images/about/$image2Name";
        }
    
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
    
            // Define the upload path
            $uploadPath = public_path('assets/images/about');
    
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            // Save the image with a unique name
            $image3Name = uniqid() . '.' . $image3->getClientOriginalExtension();
            $image3->move($uploadPath, $image3Name);
    
            // Save the relative path to the database
            $data['image3'] = "assets/images/about/$image3Name";
        }
    
        // Find the existing record and update it
        $abouts = Abouts::first();
        $abouts->update($data);
    
        return redirect()->route('about.index')->with('success', 'About Us content updated successfully.');
    }
    

}
