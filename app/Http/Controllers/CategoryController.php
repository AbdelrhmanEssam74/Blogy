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
        $allCategories = Category::select('category_id', 'name', 'slug')->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::where('category_id', $category->category_id)->with('user')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('search.category', compact('category', 'articles' , 'allCategories'));
    }
}
