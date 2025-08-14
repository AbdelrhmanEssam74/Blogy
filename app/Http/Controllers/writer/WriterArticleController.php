<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class WriterArticleController extends Controller
{
    public function index()
    {
        // Logic to display a list of articles
        return view('Writer.articles');

    }

    public function create()
    {
        // get all categories from database
        $categories = Category::select('category_id', 'name')->get();
        return view('Writer.articles.create' , ['categories' => $categories]);
    }


    public function store(Request $request)
    {
        // get writer id from session
        // create slug from title
        // default status is review
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['writer_id'] = auth()->user()->user_id;
        $slug = Str::slug($request->title, '-');
        $count = Article::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        $validated['slug'] = $slug;
        if ($request->hasFile('image')) {
            // create a folder for the article images if it doesn't exist ( main folder name -> articles ) (writer folder name -> user_id)
            $imagePath = $request->file('image')->store('articles/'. auth()->user()->user_id, 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);
        Alert::success('Success', 'Article created successfully');
        return redirect()->route('writer.dashboard');
    }

    public function delete($id)
    {
        // Logic to delete an article by ID
    }

    public function show($slug)
    {
        // Logic to display a single article by slug
    }

    public function edit($id)
    {
        // Logic to show the article edit form
    }

    public function update(Request $request, $article)
    {
        // Logic to update an existing article
    }
}
