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
        $totalArticles = Article::where([
            'writer_id' => auth()->user()->user_id,
        ])->count();
        $recentArticles = Article::where([
            'writer_id' => auth()->user()->user_id,
        ])->with('category')
            ->latest()
            ->take(4)
            ->get();
        $publishedArticles = Article::where([
            'status' => 'published',
            'writer_id' => auth()->user()->user_id,
        ])->count();
        $draftArticles = Article::where(
            [
                'status' => 'draft',
                'writer_id' => auth()->user()->user_id,
            ]
        )->count();
        $ReviewedArticles = Article::where(
            [
                'status' => 'review',
                'writer_id' => auth()->user()->user_id,
            ]
        )->count();
        $lastComment = Article::with('comment')
            ->with('user')
            ->where('writer_id', auth()->user()->user_id)
            ->latest()
            ->take(1)
            ->get();
        return view('writer.dashboard', compact(
            'recentArticles',
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'lastComment',
            'ReviewedArticles'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('writer.profile', compact('user'));
    }
}
