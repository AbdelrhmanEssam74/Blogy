<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6);
        return view('admin.categories.index',
        compact('categories'));
    }
    public function create(){
        return view('admin.categories.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:2000',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'slug' => 'required|nullable|unique:categories|max:255'
        ]);
        if($request->hasFile('image'))
        {
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
}
