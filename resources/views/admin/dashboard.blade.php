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
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>New Article</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Total Articles</h3>
                    <div class="stat-icon primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="value">142</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Published</h3>
                    <div class="stat-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="value">126</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Active Users</h3>
                    <div class="stat-icon warning">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="value">2,845</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>24% from last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Monthly Views</h3>
                    <div class="stat-icon danger">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                <div class="value">124K</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>18% from last month</span>
                </div>
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
                    <th>Views</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>10 Tips for Better Writing</td>
                    <td>Jane Smith</td>
                    <td><span class="badge badge-published">Published</span></td>
                    <td>3,245</td>
                    <td>May 15, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>The Future of Content Marketing</td>
                    <td>John Doe</td>
                    <td><span class="badge badge-published">Published</span></td>
                    <td>2,187</td>
                    <td>May 10, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>SEO Strategies That Work</td>
                    <td>John Doe</td>
                    <td><span class="badge badge-pending">Pending</span></td>
                    <td>-</td>
                    <td>May 5, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

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
