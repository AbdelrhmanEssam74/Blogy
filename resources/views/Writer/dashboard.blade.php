@extends('app.dashboards.writer_layout')

@section('title', auth()->user()->full_name . ' | Dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/dashboard.css') }}">
@endsection
@section('content')
    <x-writer_sidebar></x-writer_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Dashboard Overview , <span style="font-size: 20px; font-style: italic; font-weight: lighter"
                                           class="text-muted">{{auth()->user()->full_name}}</span></h1>
            <div class="header-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Last 30 Days</span>
                </button>
                <a href="{{ route('writer-article.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>New Article</span>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3> <i class="fa-light fa-newspaper"></i> Total Articles</h3>
                <div class="value">{{ $totalArticles }}</div>
                <div class="change positive">
                    {{--  version 2  --}}
                    {{--<i class="fas fa-arrow-up"></i>--}}
                    {{-- <span>12% from last month</span>--}}
                </div>
            </div>

            <div class="stat-card">
                <h3><i class="fa-light fa-upload"></i> Published</h3>
                <div class="value">{{$publishedArticles}}</div>
                <div class="change positive">
                    {{--  version 2  --}}
                    {{--                    <i class="fas fa-arrow-up"></i>--}}
                    {{--                    <span>8% from last month</span>--}}
                </div>
            </div>

            <div class="stat-card">
                <h3><i class="fa-light fa-floppy-disk-circle-arrow-right"></i> Drafts</h3>
                <div class="value">{{$draftArticles}}</div>
                <div class="change negative">
                    {{--                    <i class="fas fa-arrow-down"></i>--}}
                    {{--                    <span>3% from last month</span>--}}
                </div>
            </div>

            <div class="stat-card">
                <h3><i class="fa-light fa-magnifying-glass-arrows-rotate"></i> Pending</h3>
                <div class="value">{{$pendingArticles}}</div>
                <div class="change positive">
                    {{--                    <i class="fas fa-arrow-up"></i>--}}
                    {{--                    <span>24% from last month</span>--}}
                </div>
            </div>
            <div class="stat-card">
                <h3> <i class="fa-light fa-box-archive"></i> Archived</h3>
                <div class="value">{{$archivedArticles}}</div>
                <div class="change positive">
                    {{--                    <i class="fas fa-arrow-up"></i>--}}
                    {{--                    <span>24% from last month</span>--}}
                </div>
            </div>
        </div>

        <!-- Recent Posts Section -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Recent Articles</h2>
                <a href="#" style="color: var(--primary); font-size: 0.9rem;">View All</a>
            </div>

            <table class="post-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published At</th>
                    {{--                    <th>Views</th>--}}
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentArticles as $article)
                    <tr>
                        <td class="post-title"><a href="{{route('writer.view_article',$article->slug)}}"> {{  Str::substr($article->title, 0, 30) }} .....</a></td>
                        <td>{{  $article->category->name }}</td>
                        <td>
                            @if($article->published_at)
                                {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y h:i')}}
                            @else
                                <span class="text-muted fst-italic">Not Published</span>
                            @endif
                        </td>
                        {{--                    <td>3,245</td>--}}
                        <td><span class="post-status status-{{  $article->status }}">{{  $article->status }}</span></td>
                        <td>
                            @if($article->status==='review')
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                            @else
                                <a href="{{route('writer.view_article',$article->slug)}}" class="action-btn show"><i class="fas fa-eye"></i></a>
                                <a href="{{route('writer.edit_article',$article->article_id)}}" class="action-btn edit"><i class="fas fa-edit"></i></a>
                                <a class="action-btn delete"><i class="fas fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Recent Activity Section -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Recent Activity</h2>
            </div>

            <div class="activity-feed">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    @if($lastComment)
                        <div class="activity-content">
                            <h4>New comment on "{{ $lastComment->article->title }}"</h4>
                            <p>{{ $lastComment->user->full_name }} left a comment: "{{ $lastComment->content }}"</p>
                            <div class="activity-time">{{ $lastComment->created_at->diffForHumans() }}</div>
                        </div>
                    @else
                        <p>No comments yet.</p>
                    @endif

                </div>
                {{--    New Version--}}
                {{--                <div class="activity-item">--}}
                {{--                    <div class="activity-icon">--}}
                {{--                        <i class="fas fa-thumbs-up"></i>--}}
                {{--                    </div>--}}
                {{--                    <div class="activity-content">--}}
                {{--                        <h4>Post liked</h4>--}}
                {{--                        <p>Your post "SEO Strategies That Actually Work" got 24 new likes</p>--}}
                {{--                        <div class="activity-time">5 hours ago</div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="activity-item">--}}
                {{--                    <div class="activity-icon">--}}
                {{--                        <i class="fas fa-share"></i>--}}
                {{--                    </div>--}}
                {{--                    <div class="activity-content">--}}
                {{--                        <h4>Post shared</h4>--}}
                {{--                        <p>Your post "The Future of Content Marketing" was shared 8 times</p>--}}
                {{--                        <div class="activity-time">1 day ago</div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="activity-item">--}}
                {{--                    <div class="activity-icon">--}}
                {{--                        <i class="fas fa-user-plus"></i>--}}
                {{--                    </div>--}}
                {{--                    <div class="activity-content">--}}
                {{--                        <h4>New subscriber</h4>--}}
                {{--                        <p>Sarah M. subscribed to your newsletter</p>--}}
                {{--                        <div class="activity-time">2 days ago</div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </main>
@endsection
