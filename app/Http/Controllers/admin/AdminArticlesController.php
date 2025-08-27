<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminArticlesController extends Controller
{
    // 1. admin show all articles
    public function index()
    {
        // load 5 articles  for each page
        $articlesCount = Article::count();
        $articles = Article::with('user', 'category')->paginate(5);
        // load all writers
        $writers = User::where('role_id', 3)->get();
        // load all categories
        $categories = Category::all();
        return view('admin.articles',
            compact(
                'articles',
                'writers',
                'categories',
                'articlesCount'
            ));
    }

    // 2. admin shows a single article
    public function show($slug)
    {
        // get the article with its category, user, and comments based on the slug
        $article = Article::where('slug', $slug)->with(['category', 'user', 'comment'])->first();
        return view('admin.articles.article_view', ['article' => $article]);
    }

    // 3. admin approves article
    public function approve($article_id)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->status = 'published';
            $article->published_at = now();
            $article->save();
            Alert::success('Success', 'Article published successfully');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();
    }

    // 4. admin rejects article
    public function reject($article_id ,Request $request)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->status = 'rejected';
            $article->note = $request->note;
            $article->note_date = now()->toDateString();
            $article->save();
            Alert::success('Success', 'Article rejected successfully');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();
    }

    // 5. admin deletes article
    public function delete($article_id)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->status = 'deleted';
            $article->save();
            Alert::success('Success', 'Article deleted successfully');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();
    }

    // 6. admin archives article
    public function archive($article_id)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->status = 'archived';
            $article->save();
            Alert::success('Success', 'Article archived successfully');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();
    }

    // 7. admin restores article
    public function restore($article_id)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->status = 'published';
            $article->save();
            Alert::success('Success', 'Article restored successfully');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();

    }

    // 8. admin deletes article permanently
    public function delete_permanently($article_id)
    {
        $article = Article::findOrFail($article_id);
        if ($article) {
            $article->delete();
            Alert::success('Success', 'Article deleted permanently');
            return redirect()->back();
        }
        Alert::error('Error', 'Article not found');
        return redirect()->back();
    }
    // 9. filter the articles
    public function filter(Request $request)
    {
        $articles = Article::query();

        if ($request->filled('category_id')) {
            $articles->where('category_id', $request->category_id);
        }
        if ($request->filled('writer_id')) {
            $articles->where('writer_id', $request->writer_id);
        }
        if ($request->filled('status')) {
            $articles->where('status', $request->status);
        }

        $articles = $articles->with('user', 'category')->paginate(5);

        // load all writers and categories (same as index)
        $writers = User::where('role_id', 3)->get();
        $categories = Category::all();
        $articlesCount = Article::count();
        return view('admin.articles', compact('articles', 'writers', 'categories', 'articlesCount'));
    }

}
