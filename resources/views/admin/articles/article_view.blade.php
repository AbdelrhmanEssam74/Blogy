@extends('app.dashboards.admin_layout')

@section('title', 'Articles | ' . $article->slug)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/article-view.css') }}">
@endsection

@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Article Details</h1>
            <div class="header-actions">
                <button class="btn btn-outline " onclick="backToRoute('{{route('admin.articles')}}')">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Articles</span>
                </button>
{{--                <button class="btn btn-primary">--}}
{{--                    <i class="fas fa-edit"></i>--}}
{{--                    <span>Edit Article</span>--}}
{{--                </button>--}}
            </div>
        </div>

        <!-- Article Details Section -->
        <div class="article-details ">
            <div class="admin-article-actions">
                @if($article->status === 'pending')
                    <div class="action-buttons">
                        <a href="#" class="action-btn btn-approve">
                            <i class="fas fa-check"></i>
                            <span>Approve</span>
                        </a>
                        <a class="action-btn btn-reject">
                            <i class="fas fa-times"></i>
                            <span>Reject</span>
                        </a>
                    </div>
                @elseif($article->status === 'published')
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
                        <a href="#"  class="action-btn btn-archive">
                            <i class="fas fa-archive"></i>
                            <span>Archive</span>
                        </a>
                        <a href="#" class="action-btn btn-delete">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="article-header">
                <div>
                    <h1 class="article-title">{{$article->title}}</h1>
                    <div class="article-meta">
                        <span class="meta-item">
                            <i class="fas fa-user"></i>
                            <strong>Writer:</strong> {{$article->user->full_name}}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-tag"></i>
                            <strong>Category:</strong> {{$article->category->name}}
                        </span>
                        <span class="meta-item">
                            @if($article->published_at)
                                <i class="fas fa-calendar"></i>
                                <strong>Published:</strong> {{  \Carbon\Carbon::parse($article->published_at)->format('d M Y h:i')}}
                            @else
                                <i class="fas fa-calendar"></i>
                                <strong>Not Published yes:</strong> {{$article->status}}
                            @endif
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-sync"></i>
                            <strong>Last Updated:</strong> {{  \Carbon\Carbon::parse($article->updated_at)->format('d M Y h:i')}}
                        </span>
                        <span class="meta-item">
                            <span class="badge badge-{{$article->status}}">{{Str::ucfirst($article->status)}}</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="article-stats">
                {{--    todo : will avilable in new virsion            --}}
                                <div class="stat-item">
                                    <div class="stat-value">--</div>
                                    <div class="stat-label">Total Views</div>
                                </div>
                <div class="stat-item">
                    <div class="stat-value">{{count($article->comment)}}</div>
                    <div class="stat-label">Comments</div>
                </div>
                                <div class="stat-item">
                                    <div class="stat-value">--</div>
                                    <div class="stat-label">Likes</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">--</div>
                                    <div class="stat-label">Shares</div>
                                </div>
            </div>

            <img src="{{asset('storage/' . $article->image)}}" alt="Featured image" class="article-featured-image">
            <div class="article-content">
                <p>
                    {{$article->content}}
                </p>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="section-header">
                <h2 class="section-title">Article Comments ({{count($article->comment)}})</h2>
                <div class="comments-filter">
                    <select class="filter-select" name="status-filter" id="commentFilter">
                        <option value="all">All Comments</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending Review</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <!-- Comment List -->
            <div class="comments-list">
                @if(!count($article->comment))
                    <div class="empty-state">
                        <i class="fas fa-comment-slash"></i>
                        <h3>No Comments Yet</h3>
                        <p>This article doesn't have any comments yet!</p>
                    </div>
                @endif
                @isset($article->comment)
                    @foreach($article->comment as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <div class="comment-author">
                                    <div class="author-avatar">{{ strtoupper(substr($article->user->full_name, 0, 2)) }}</div>
                                    <div class="author-info">
                                        <h4>{{ $comment->name }}</h4>
                                        <p>{{ $comment->email }}</p>
                                    </div>
                                </div>
                                <div class="comment-info">
                                    <span
                                        class="comment-date">{{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y \a\t h:i A') }}</span>
                                    <span
                                        class="comment-status status-{{ strtolower($comment->status) }}">{{ ucfirst($comment->status) }}</span>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>{{ $comment->content }}</p>
                            </div>
                            <div class="comment-actions">
                                @if($comment->status !== 'approved')
                                    <button class="action-btn btn-approve">
                                        <i class="fas fa-check"></i>
                                        <span>Approve</span>
                                    </button>
                                @endif
                                @if($comment->status !== 'rejected')
                                    <button class="action-btn btn-reject">
                                        <i class="fas fa-times"></i>
                                        <span>Reject</span>
                                    </button>
                                @endif
                                <button class="action-btn btn-delete">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete Permanently</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>

        </div>
    </main>

    <script>
        // create function to get back to a specific route
        function backToRoute(route) {
            window.location.href = route;
        }
    </script>
@endsection
