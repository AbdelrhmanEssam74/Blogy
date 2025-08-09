<?php

namespace App\Http\Controllers\writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WriterArticleController extends Controller
{
    public function index()
    {
        // Logic to display a list of articles
        return view('Writer.articles');

    }

    public function create()
    {
        // Logic to show the article creation form
        return view('Writer.articles.create');
    }


    public function store(Request $request)
    {
        // Logic to store a new article
    }

    public function delete($id)
    {
        // Logic to delete an article by ID
    }

    public function show($slug)
    {
        // Logic to display a single article by slug
    }

    public function edit($id)
    {
        // Logic to show the article edit form
    }

    public function update(Request $request, $article)
    {
        // Logic to update an existing article
    }
}
