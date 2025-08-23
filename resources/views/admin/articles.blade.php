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
            <form id="filter-form" action="{{ route('admin.article-filter') }}" method="get" class="d-none">
                <div class="filter-grid">
                    <div class="filter-group">

                        <label class="filter-label">Status</label>
                        <select class="filter-select" name="status" id="statusFilter">
                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Statuses</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                Published
                            </option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                Review
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived
                            </option>
                            <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>Deleted
                            </option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Writer</label>
                        <select class="filter-select" name="writer_id" id="writerFilter">
                            <option value="">All Writers</option>
                            @foreach($writers as $writer)
                                <option
                                    value="{{ $writer->user_id }}" {{ request('writer_id') == $writer->user_id ? 'selected' : '' }}>
                                    {{ $writer->full_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Category</label>
                        <select class="filter-select" name="category_id" id="categoryFilter">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="filter-actions">
                    <button class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        <span>Clear Filters</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                        <span>Apply Filters</span>
                    </button>
                </div>
            </form>
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
                @if(!count($articles))
                    <tr>
                        <td colspan="6" class="no-articles-found">No articles found.</td>
                    </tr>
                @endif
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
                                    <button class="action-btn btn-approve"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-approve',$article->article_id)}}')">
                                        <i class="fas fa-check"></i>
                                        <span>Approve</span>
                                    </button>
                                    <button class="action-btn btn-reject"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-reject',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-times"></i>
                                        <span>Reject</span>
                                    </button>
                                </div>
                            @elseif($article->status === 'published')
                                <div class="action-buttons">
                                    <button class="action-btn btn-archive"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-archive',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </button>
                                    <button class="action-btn btn-delete"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-delete',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            @elseif($article->status === 'archived')
                                <div class="action-buttons">
                                    <button class="action-btn btn-restore"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-restore',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-undo"></i>
                                        <span>Restore</span>

                                    </button>
                                    <button class="action-btn btn-delete"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-delete',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            @elseif($article->status === 'rejected')
                                <div class="action-buttons">
                                    <button class="action-btn btn-approve"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-approve',$article->article_id)}}')">
                                        <i class="fas fa-check"></i>
                                        <span>Approve</span>
                                    </button>
                                    <button class="action-btn btn-archive"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-archive',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </button>
                                </div>
                            @elseif($article->status === 'draft')
                                <div class="action-buttons">
                                    <button class="action-btn btn-archive"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-archive',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-archive"></i>
                                        <span>Archive</span>
                                    </button>
                                    <button class="action-btn btn-delete"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-delete',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            @elseif($article->status === 'deleted')
                                <div class="action-buttons">
                                    <button class="action-btn btn-delete"
                                            onclick="updateArticleStatus({{$article->article_id}},'{{route('admin.article-delete-permanently',$article->article_id)}}')"
                                    >
                                        <i class="fas fa-trash"></i>
                                        <span>Delete Permanently</span>
                                    </button>
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
    </script>
    <script src="{{asset('js/AdminArticlesManagement.js')}}"></script>
@endsection
