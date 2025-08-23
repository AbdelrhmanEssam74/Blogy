@extends('app.dashboards.admin_layout')

@section('title', auth()->user()->full_name . ' | Articles')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/articles.css') }}">
@endsection

@section('content')
    <x-admin_sidebar></x-admin_sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Manage Articles</h1>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="published">Published</option>
                        <option value="pending">Pending Review</option>
                        <option value="draft">Draft</option>
                        <option value="rejected">Rejected</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Writer</label>
                    <select class="filter-select" id="writerFilter">
                        <option value="">All Writers</option>
                        @foreach($writers as $writer)
                            <option value="{{$writer->user_id}}">{{$writer->full_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Category</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{$category->category_id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Date Range</label>
                    <select class="filter-select" id="dateFilter">
                        <option value="">All Time</option>
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 90 Days</option>
                        <option value="365">Last Year</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-times"></i>
                    <span>Clear Filters</span>
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-filter"></i>
                    <span>Apply Filters</span>
                </button>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="articles-table-container">
            <div class="table-header">
                <h2 class="table-title">All Articles</h2>
                <div class="search-box">
                    <input type="text" placeholder="Search articles...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <table class="data-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <a href="{{route('admin.article-show',$article->slug)}}"> {{  Str::substr($article->title, 0, 30) }}
                                .....</a>
                        </td>
                        <td>{{$article->user->full_name}}</td>
                        <td>{{$article->category->name}}</td>
                        <td><span class="badge badge-{{$article->status}}">{{$article->status}}</span></td>
                        <td> {{ \Carbon\Carbon::parse($article->created_at)->format('d M Y h:i')}}</td>
                        <td>
                            @if($article->status === 'pending')
                                <div class="action-buttons">
                                    <button class="action-btn btn-approve" onclick="approveArticle({{$article->article_id}},'{{route('admin.article-approve',$article->article_id)}}')">
                                        <i class="fas fa-check"></i>
                                        <span>Approve</span>
                                    </button>
                                    <a class="action-btn btn-reject">
                                        <i class="fas fa-times"></i>
                                        <span>Reject</span>
                                    </a>
                                </div>
                            @elseif($article->status === 'published')
                                <div class="action-buttons">
                                    <button  class="action-btn btn-archive">
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </button>
                                    <a href="#" class="action-btn btn-delete">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            @elseif($article->status === 'archived')
                                <div class="action-buttons">
                                    <a href="#" class="action-btn btn-restore">
                                        <i class="fas fa-undo"></i>
                                        <span>Restore</span>

                                    </a>
                                    <a href="#" class="action-btn btn-delete">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            @elseif($article->status === 'rejected')
                                <div class="action-buttons">
                                    <a href="#" class="action-btn btn-approve">
                                        <i class="fas fa-check"></i>
                                        <span>Approve</span>
                                    </a>
                                    <a href="#" class="action-btn btn-archive">
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </a>
                                </div>
                            @elseif($article->status === 'draft')
                                <div class="action-buttons">
                                    <a href="#" class="action-btn btn-archive">
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </a>
                                    <a href="#" class="action-btn btn-delete">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    {{-- update status form  --}}
                    <form id="update-form" action="" method="POST" class="d-none">
                        @method('PUT')
                        @csrf
                    </form>
                @endforeach
                </tbody>
            </table>
            {{--      Pagination         --}}
            <div class="pagination">
                {{ $articles->withQueryString()->onEachSide(1)->links('components.pagination') }}
            </div>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clearFiltersBtn = document.querySelector('.btn-outline');
            const filterSelects = document.querySelectorAll('.filter-select');
            clearFiltersBtn.addEventListener('click', function () {
                filterSelects.forEach(select => {
                    select.value = '';
                });
            });
        });
        // send request to approve article
        function approveArticle(articleId , route) {
            const form = document.getElementById('update-form');
            form.action = route;
            form.submit();
        }
    </script>
@endsection
