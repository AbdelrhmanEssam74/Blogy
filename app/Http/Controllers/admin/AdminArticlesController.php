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
        $article = Article::where('slug', $slug)->with(['category' , 'user' , 'comment'])->first();
        return view('admin.articles.article_view', ['article' => $article]);
    }
    // 3. admin approves article
    public function approve($article_id){
//        dd($article_id);
        $article = Article::findOrFail($article_id);
        if ($article){
            $article->status = 'published';
            $article->save();
            Alert::success('Success', 'Article published successfully');
            return redirect()->back();
        }
    }
    // 4. admin rejects article
    // 5. admin deletes article
    // 6. admin archives article
}
