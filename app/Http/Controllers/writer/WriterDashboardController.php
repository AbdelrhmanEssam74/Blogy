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
        $recentArticles = Article::all()->sortByDesc('created_at')->take(5);
        return view('writer.dashboard' , compact('recentArticles'));
    }
    public function profile()
    {
        $user = auth()->user();
        return view('writer.profile', compact('user'));
    }
}
