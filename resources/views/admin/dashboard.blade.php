@extends('app.dashboards.admin_layout')

@section('title', auth()->user()->full_name . ' | Dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection
@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <div class="header-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Last 30 Days</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Total Users</h3>
                    <div class="stat-icon warning">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="value">{{$totalUsers}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Total Articles</h3>
                    <div class="stat-icon primary">
                        <i class="fa-sharp fa-light fa-file-lines"></i>
                    </div>
                </div>
                <div class="value">{{$totalArticles}}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Published</h3>
                    <div class="stat-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="value">{{$publishedArticles}}</div>

            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Total Categories</h3>
                    <div class="stat-icon danger">
                        <i class="fa-duotone fa-thin fa-tag"></i>
                    </div>
                </div>
                <div class="value">{{$totalCategories}}</div>

            </div>
        </div>

        <!-- Recent Articles Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Recent Articles</h2>
                <a href="#" class="section-link">
                    <span>View All</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            <table class="data-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    {{--                    <th>Views</th>--}}
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($recentArticles as $article)
                    <tr>
                        <td>
                            <a href="{{route('writer.view_article',$article->slug)}}"> {{  Str::substr($article->title, 0, 30) }}
                                .....</a>
                        </td>
                        <td>
                            <a href="#">{{$article->user->full_name}}</a>
                        </td>
                        <td>
                            <span class="badge badge-{{$article->status}}">{{$article->status}}</span></td>
                        <td>
                            @if($article->published_at)
                                {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y h:i')}}
                            @else
                                <span class="text-muted fst-italic">Not Published</span>
                            @endif
                        </td>
                        {{--                    <td>3,245</td>--}}
                        <td>
                            <a href="{{route('writer.view_article',$article->slug)}}" class="action-btn show">
                                <i class="fas fa-eye"></i></a>
                            <a href="{{route('writer.edit_article',$article->article_id)}}" class="action-btn edit">
                                <i class="fas fa-edit"></i></a>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>

        {{--        todo        --}}
        <!-- Recent Activity Section -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Recent Activity</h2>
                <a href="#" class="section-link">
                    <span>View All</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            <div class="activity-feed">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New article published</h4>
                        <p>Jane Smith published "10 Tips for Better Writing"</p>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New comment approved</h4>
                        <p>Admin approved a comment on "The Future of Content Marketing"</p>
                        <div class="activity-time">5 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New user registered</h4>
                        <p>Mike Brown joined as a new author</p>
                        <div class="activity-time">1 day ago</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
