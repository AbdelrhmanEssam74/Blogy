<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'required|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);

        return redirect('/articles')->with('success', 'Article created successfully');
    }


    public function delete($id)
    {
        $article = Article::findorfail($id);
        $article->delete();
        return redirect('/articles')->with('success', 'Article Deleted Successfully');
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
        if(!$user)
        {
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

    private function str_slug(mixed $title, string $string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', $string, strtolower($title));
        return trim($slug, $string);
    }

}
