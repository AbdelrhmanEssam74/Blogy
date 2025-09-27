<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $allCategories = Category::select('category_id', 'name', 'slug' , 'articles_count')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::where('category_id', $category->category_id)->with('user.writer_profile')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $recentArticles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('search.category', compact('category', 'articles' , 'allCategories' , 'recentArticles'));
    }
}
