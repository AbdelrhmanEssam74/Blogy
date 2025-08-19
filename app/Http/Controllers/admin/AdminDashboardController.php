<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where("role_id" , '!=', 1)->count();
        $totalCategories = Category::count();
        $totalArticles = Article::count();
        $pendingArticles = Article::where('status', 'pending')->count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $archivedArticles = Article::where('status', 'archived')->count();
        // get recent articles with the user who created it
        $recentArticles = Article::with('user')->latest()->take(4)->get();
        return view('admin.dashboard',
            compact(
                'totalArticles',
                'pendingArticles',
                'publishedArticles',
                'draftArticles',
                'archivedArticles',
                'recentArticles',
                'totalUsers',
                'totalCategories',
            )
        );
    }
}
