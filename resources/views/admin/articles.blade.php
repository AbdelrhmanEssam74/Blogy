@extends('app.dashboards.writer_layout')

@section('title', auth()->user()->full_name . ' | Articles')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/articles.css') }}">
@endsection

@section('content')
    <x-writer_sidebar></x-writer_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>My Articles</h1>
            <a href="{{ route('writer-article.create') }}" class="  btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>New Article</span>
            </a>
        </div>

        <div class="articles-container">
            <div class="articles-header">
                <h2 class="section-title">All Articles</h2>
                <div class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search articles...">
                    </div>
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>
            </div>

            <table class="articles-table">
                <thead>
                <tr>
                    <th>Article</th>
                    <th>Status</th>
                    {{--                    <th>Views</th>--}}
                    <th>Comments</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <div class="article-title">
                                <img src="{{asset('storage/' . $article->image) }}" alt="Article thumbnail">
                                <a href="{{ route('writer.view_article' , $article->slug) }}">
                                    <span>{{ $article->title }}</span></a>
                            </div>
                        </td>
                        <td><span class="article-status status-{{$article->status}}">{{$article->status}}</span></td>
                        <td>{{count( $article->comment) }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            @if($article->status==='pending')
                                <a href="{{route('writer.view_article',$article->slug)}}" class="action-btn show">
                                    <i class="fas fa-eye"></i></a>
                                <a href="{{route('writer.edit_article',$article->article_id)}}" class="action-btn edit">
                                    <i class="fas fa-edit"></i></a>
                            @else
                                <a href="{{route('writer.view_article',$article->slug)}}" class="action-btn show">
                                    <i class="fas fa-eye"></i></a>
                                <a href="{{route('writer.edit_article',$article->article_id)}}" class="action-btn edit">
                                    <i class="fas fa-edit"></i></a>
                                <button
                                    onclick="openDeleteModal('{{ $article->article_id }}')"
                                    class="action-btn delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <x-delete_confirm
                                    :article-id="$article->article_id"
                                    :article-title="$article->title"/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $articles->withQueryString()->onEachSide(1)->links('components.pagination') }}
            </div>

        </div>
    </main>
@endsection
