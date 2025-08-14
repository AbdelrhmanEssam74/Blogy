<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(9);
        return view('articles.index', ['articles' => $articles]);
    }


    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.article', ['article' => $article]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function create_first()
    {
        $categories = Category::all();
        if (auth()->user()->articles()->count() > 0) {
            return redirect('/articles')->with('error', 'You have already created an article. You can create more articles from the articles page.');
        }
        return view('articles.create-first', ['categories' => $categories]);

    }

    public function store(Request $request)
    {
//        echo "hello";
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|max:1000|min:10',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $validated['writer_id'] = auth()->user()->user_id;
        $slug = Str::slug($request->title, '-');
        $count = Article::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);
        // update user role to 3 (writer)
        $user = auth()->user();
        $user->role_id = 3;
        $user->save();

        return redirect('/articles/create-first')->with('message', '🎉 Congratulations! You\'ve published your first article. You can now manage and create more content as a Writer.');
    }


    public function delete($id)
    {
        $article = Article::findorfail($id);
        $article->delete();
        return redirect('/articles')->with('success', 'Article deleted successfully');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles,slug,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = $article->image;
        }

        $article->update($validated);

        return redirect('/articles')->with('success', 'Article updated successfully');
    }

    public function store_first(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login')->with('error', 'You must be logged in to create an article.');
        }
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|max:255',
        ]);
        return response()->json(['data' => $validated]);
        $slug = $this->str_slug($request->title, '-');
        $validated['slug'] = $slug;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);

        return redirect('/home')->with('success', '🎉 Congratulations! You\'ve published your first article. You can now manage and create more content as a Writer.');
    }


}
