<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6);
        return view('admin.categories.index',
            compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:2000',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'slug' => 'required|nullable|unique:categories|max:255'
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories/' . auth()->user()->user_id, 'public');
            $validated['image'] = $imagePath;
        }
        Category::create($validated);
        Alert::success('Success', 'Category created successfully');
        return redirect()->route('admin.categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $category_id)
    {
        // get writer id from session
        // Logic to update an article by ID
        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                'string',
                Rule::unique('categories')->ignore($category_id, 'category_id'),
            ],
            'description' => 'nullable|max:2000',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'slug' => [
                'required',
                'max:255',
                'string',
                Rule::unique('categories')->ignore($category_id, 'category_id'),
            ]
        ]);

        $category = Category::findOrFail($category_id);
        $category->name = $validated['name'];
        if ($request->has('description')) {
            $category->description = $validated['description'];
        }
        $category->slug = $validated['slug'];
        if ($request->has('active') && $request->active === 'on') {
            $category->active = 1;
        } else {
            $category->active = 0;
        }
        if ($request->hasFile('new_image')) {
            if ($category->image) {
                $oldImagePath = 'storage/' . $category->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // store the new image
            $imagePath = $request->file('new_image')->store('categories/' . auth()->user()->user_id, 'public');
            $category->image = $imagePath;
        }
        // Check if any attribute changed
        if (!$category->isDirty()) {
            Alert::info('No Changes', 'No updates were made to the Category.');
            return redirect()->back();
        }
        $category->save();
        Alert::success('Success', 'Category updated successfully');
        return redirect()->back();
    }
}
