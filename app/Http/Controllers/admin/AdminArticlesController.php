<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

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
    // 3. admin approves article
    // 4. admin rejects article
    // 5. admin deletes article
    // 6. admin archives article
}
