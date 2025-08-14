@extends('app.dashboards.writer_layout')

@section('title', 'Articles | ' . $article->slug)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/article-view.css') }}">
@endsection

@section('content')
    <x-writer_sidebar></x-writer_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Article Management</h1>
            <div class="article-actions">
                <a href="{{route('writer.articles')}}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Articles</span>
                </a>
            </div>
        </div>

        <div class="article-management-container">
            <div class="article-actions">
                <a href="#" class="btn btn-outline">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                    <span>View Live</span>
                </a>
                <a href="#" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                </a>
            </div>
            <div class="article-header">
                <div>
                    <h1 class="article-title">{{$article->title}}</h1>
                    <div class="article-meta">
                        <span class="meta-item">
                            @if($article->status==='published')
                                <i class="fa-light fa-calendar"></i>
                                Published: {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y h:i')}}
                            @else
                                <i class="fa-light fa-sensor-triangle-exclamation"></i>
                                <span class="text-muted fst-italic">Not Published</span>
                            @endif
                        </span>
                        <span class="meta-item">
                                    @if($article->updated_at)
                                <i class="fa-light fa-clock"></i>
                                Last updated: {{ \Carbon\Carbon::parse($article->updated_at)->format('d M Y h:i')}}
                            @else
                            @endif
                        </span>
                        <span class="meta-item">
                            <span class="article-status-badge status-{{$article->status}}">{{$article->status}}</span>
                        </span>
                        {{--                        <span class="meta-item">--}}
                        {{--                            <i class="fas fa-user-edit"></i>--}}
                        {{--                            Last edited by: You--}}
                        {{--                        </span>--}}
                    </div>
                    {{--                    todo : tags will avialble in new vetsion--}}
                    {{--                    <div class="tag-list">--}}
                    {{--                        <span class="tag">Writing</span>--}}
                    {{--                        <span class="tag">Productivity</span>--}}
                    {{--                        <span class="tag">Tips</span>--}}
                    {{--                    </div>--}}
                </div>
            </div>

            <img src="{{asset('storage/' . $article->image)}}" alt="Featured image" class="article-featured-image">

            <div class="article-content">
                <div class="article-text">
                    {!! $article->content !!}
                </div>
            </div>
            {{--todo: will avilable in new version--}}
            {{--            <div class="article-stats">--}}
            {{--                <div class="stat-card">--}}
            {{--                    <div class="stat-label">Total Views</div>--}}
            {{--                    <div class="stat-value">3,245</div>--}}
            {{--                </div>--}}
            {{--                <div class="stat-card">--}}
            {{--                    <div class="stat-label">Avg. Time on Page</div>--}}
            {{--                    <div class="stat-value">2m 45s</div>--}}
            {{--                </div>--}}
            {{--                <div class="stat-card">--}}
            {{--                    <div class="stat-label">Comments</div>--}}
            {{--                    <div class="stat-value">24</div>--}}
            {{--                </div>--}}
            {{--                <div class="stat-card">--}}
            {{--                    <div class="stat-label">Social Shares</div>--}}
            {{--                    <div class="stat-value">142</div>--}}
            {{--                </div>--}}
        </div>

        <div class="management-section">
            <div class="admin-notes">
                <div class="notes-header">
                    <div class="notes-title">Editor's Note</div>
                    <div class="notes-date">Added by Editor on May 14, 2023</div>
                </div>
                <div class="notes-content">
                    Great article! Just made a few minor edits for clarity. Consider adding an example for tip #5
                    about active voice.
                </div>
            </div>

            <div class="article-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-file-export"></i>
                    <span>Export as PDF</span>
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-copy"></i>
                    <span>Duplicate Article</span>
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-archive"></i>
                    <span>Archive</span>
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-sync-alt"></i>
                    <span>Update Status</span>
                </button>
            </div>
        </div>
        </div>
    </main>

@endsection
