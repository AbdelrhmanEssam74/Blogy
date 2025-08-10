<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
}
