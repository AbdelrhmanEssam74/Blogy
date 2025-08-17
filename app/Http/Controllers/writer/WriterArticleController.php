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
       // load all articles for the writer 3 for each page
        $articles = Article::where('writer_id', auth()->user()->user_id)->with(['category', 'comment'])->paginate(4);
        return view('Writer.articles', compact('articles'));

    }

    public function create()
    {
        // get all categories from database
        $categories = Category::select('category_id', 'name')->get();
        return view('Writer.articles.create', ['categories' => $categories]);
    }

    // show article for the writer
    public function view_article($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('Writer.articles.article_view', ['article' => $article]);
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
            $imagePath = $request->file('image')->store('articles/' . auth()->user()->user_id, 'public');
            $validated['image'] = $imagePath;
        }

        Article::create($validated);
        Alert::success('Success', 'Article created successfully');
        return redirect()->route('writer.dashboard');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        // delete the article image if it exists
        if ($article->image) {
            $imagePath = 'public/' . $article->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $article->delete();
        Alert::success('Success', 'Article deleted successfully');
        return redirect()->back();
    }

    public function show($slug)
    {
        // Logic to display a single article by slug
    }

    public function edit($id)
    {
        // Logic to edit an article by ID
        $article = Article::findOrFail($id);
        $categories = Category::select('category_id', 'name')->get();
        return view('Writer.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $article_id)
    {
        // get writer id from session
        // Logic to update an article by ID
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category_id' => 'required|exists:categories,category_id',
            'new-image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $article = Article::findOrFail($article_id);
        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->category_id = $validated['category_id'];

        if ($request->hasFile('new-image')) {
            // create a folder for the article images if it doesn't exist ( main folder name -> articles ) (writer folder name -> user_id)
            // delete the old image if it exists
            if ($article->image) {
                $oldImagePath = 'public/' . $article->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // store the new image
            $imagePath = $request->file('new-image')->store('articles/' . auth()->user()->user_id, 'public');
            $article->image = $imagePath;
        }
        // Check if any attribute changed
        if (!$article->isDirty()) {
            Alert::info('No Changes', 'No updates were made to the article.');
            return redirect()->back();
        }
        $article->save();
        Alert::success('Success', 'Article updated successfully');
        return redirect()->route('writer.view_article' , $article->slug);
    }
}
