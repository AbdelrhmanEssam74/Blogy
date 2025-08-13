<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class WriterDashboardController extends Controller
{
    /**
     * Display the writer's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalArticles = Article::count();
        $recentArticles = Article::with('category')
            ->latest()
            ->take(4)
            ->get();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $lastComment = Article::with('comment')->with('user')->latest()->take(1)->get();
        return view('writer.dashboard', compact(
            'recentArticles',
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'lastComment',
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('writer.profile', compact('user'));
    }
}
