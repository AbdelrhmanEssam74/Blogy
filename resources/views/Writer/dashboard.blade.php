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
                <a href="{{ route('writer.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>New Article</span>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Posts</h3>
                <div class="value">42</div>
                <div class="change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <h3>Published</h3>
                <div class="value">36</div>
                <div class="change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <h3>Drafts</h3>
                <div class="value">6</div>
                <div class="change negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>3% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <h3>Monthly Views</h3>
                <div class="value">12.4K</div>
                <div class="change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>24% from last month</span>
                </div>
            </div>
        </div>

        <!-- Recent Posts Section -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Recent Posts</h2>
                <a href="#" style="color: var(--primary); font-size: 0.9rem;">View All</a>
            </div>

            <table class="post-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Publish Date</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="post-title">10 Tips for Better Writing in 2023</td>
                    <td>Writing</td>
                    <td>May 15, 2023</td>
                    <td>3,245</td>
                    <td><span class="post-status status-published">Published</span></td>
                    <td>
                        <button class="action-btn"><i class="fas fa-edit"></i></button>
                        <button class="action-btn"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="post-title">The Future of Content Marketing</td>
                    <td>Marketing</td>
                    <td>May 10, 2023</td>
                    <td>2,187</td>
                    <td><span class="post-status status-published">Published</span></td>
                    <td>
                        <button class="action-btn"><i class="fas fa-edit"></i></button>
                        <button class="action-btn"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="post-title">SEO Strategies That Actually Work</td>
                    <td>SEO</td>
                    <td>May 5, 2023</td>
                    <td>4,562</td>
                    <td><span class="post-status status-published">Published</span></td>
                    <td>
                        <button class="action-btn"><i class="fas fa-edit"></i></button>
                        <button class="action-btn"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="post-title">How to Build an Email List</td>
                    <td>Marketing</td>
                    <td>Draft</td>
                    <td>-</td>
                    <td><span class="post-status status-draft">Draft</span></td>
                    <td>
                        <button class="action-btn"><i class="fas fa-edit"></i></button>
                        <button class="action-btn"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
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
                    <div class="activity-content">
                        <h4>New comment on "10 Tips for Better Writing"</h4>
                        <p>John D. left a comment: "This was really helpful!"</p>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Post liked</h4>
                        <p>Your post "SEO Strategies That Actually Work" got 24 new likes</p>
                        <div class="activity-time">5 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-share"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Post shared</h4>
                        <p>Your post "The Future of Content Marketing" was shared 8 times</p>
                        <div class="activity-time">1 day ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New subscriber</h4>
                        <p>Sarah M. subscribed to your newsletter</p>
                        <div class="activity-time">2 days ago</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
