<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Properly handle is_featured as a boolean
        $data['is_featured'] = $request->has('is_featured') ? true : false;
        
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        }
        
        Category::create($data);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            
            // Properly handle is_featured as a boolean
            $data['is_featured'] = $request->has('is_featured') ? true : false;
            
            if ($request->hasFile('image')) {
                // Check if image file is valid
                if (!$request->file('image')->isValid()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'The uploaded image is invalid. Please try again with a different file.']);
                }
                
                // Delete old image if exists
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
                
                // Store new image
                try {
                    $imagePath = $request->file('image')->store('categories', 'public');
                    $data['image'] = $imagePath;
                } catch (\Exception $e) {
                    Log::error('Image upload failed during category update: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
                }
            }
            
            $category->update($data);
            
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');
                
        } catch (\Exception $e) {
            Log::error('Category update failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'An error occurred while updating the category: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has books
        if ($category->books()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category that has books. Remove books first or reassign them to another category.');
        }
        
        // Delete image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
} 