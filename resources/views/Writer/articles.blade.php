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
            <a href="{{ route('writer.create') }}" class="  btn btn-primary">
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
                    <th>Views</th>
                    <th>Comments</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="article-title">
                            <img src="https://via.placeholder.com/40" alt="Article thumbnail">
                            <span>10 Tips for Better Writing in 2023</span>
                        </div>
                    </td>
                    <td><span class="article-status status-published">Published</span></td>
                    <td>3,245</td>
                    <td>24</td>
                    <td>May 15, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="article-title">
                            <img src="https://via.placeholder.com/40" alt="Article thumbnail">
                            <span>The Future of Content Marketing</span>
                        </div>
                    </td>
                    <td><span class="article-status status-published">Published</span></td>
                    <td>2,187</td>
                    <td>15</td>
                    <td>May 10, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="article-title">
                            <img src="https://via.placeholder.com/40" alt="Article thumbnail">
                            <span>SEO Strategies That Actually Work</span>
                        </div>
                    </td>
                    <td><span class="article-status status-published">Published</span></td>
                    <td>4,562</td>
                    <td>32</td>
                    <td>May 5, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="article-title">
                            <img src="https://via.placeholder.com/40" alt="Article thumbnail">
                            <span>How to Build an Email List</span>
                        </div>
                    </td>
                    <td><span class="article-status status-draft">Draft</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>Apr 28, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="article-title">
                            <img src="https://via.placeholder.com/40" alt="Article thumbnail">
                            <span>Productivity Hacks for Writers</span>
                        </div>
                    </td>
                    <td><span class="article-status status-pending">Pending Review</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>Apr 22, 2023</td>
                    <td>
                        <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="pagination">
                <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </main>
@endsection
