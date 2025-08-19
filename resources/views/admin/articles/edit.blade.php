@extends('app.dashboards.writer_layout')

@section('title', 'Edit Article | ' . $article->title)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/edit-article.css') }}">
@endsection
@section('content')
    <x-writer_sidebar></x-writer_sidebar>
    <!-- Main Content -->
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Edit Article</h1>
            <div>
                <div class="status-dropdown">
                    <div class="status-toggle" id="statusToggle">
                        <span class="status-badge">{{$article->status}}</span>
                        {{--                        <i class="fas fa-chevron-down"></i>--}}
                    </div>
                    {{--                    <div class="status-options" id="statusOptions">--}}
                    {{--                        <div class="status-option" data-value="draft">Draft</div>--}}
                    {{--                        <div class="status-option" data-value="pending">Pending Review</div>--}}
                    {{--                        <div class="status-option" data-value="published">Published</div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>

        <div class="edit-article-container">
            <form class="edit-form" action="{{ route('writer-article.update', $article->article_id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="articleTitle" class="form-label">Article Title</label>
                    <input type="text" id="articleTitle" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ $article->title }}">
                    @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="articleContent" class="form-label">Content</label>
                    <textarea id="articleContent" name="content" class="form-control @error('content') is-invalid @enderror"
                              rows="10">{{ $article->content }}</textarea>
                    @error('content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Featured Image</label>
                    <div class="image-upload">
                        <div class="image-preview">
                            <img src="{{asset('storage/' . $article->image)}}" alt="Current featured image"
                                 id="imagePreview">
                            <i class="fas fa-image" style="font-size: 2rem; color: var(--gray); display: none;"></i>
                            <input type="hidden" name="current_image" value="{{ $article->image }}">
                        </div>
                        <div class="upload-btn">
                            <button type="button" class="btn btn-outline">
                                <i class="fas fa-upload"></i>
                                <span>Change Image</span>
                            </button>
                            <input type="file" id="imageUpload" name="new-image" accept="image/*">
                            @error('new-image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Categories</label>
                    <div class="category-selection">
                        <input type="radio" id="cat-writing" name="category_id" class="category-option"
                               value="{{$article->category->category_id}}" checked>
                        <label for="cat-writing">{{$article->category->name}}</label>
                        @foreach($categories as  $category)
                            @if($category->category_id !== $article->category_id)
                                <input type="radio" id="cat-{{$category->name}}" value="{{$category->category_id}}"
                                       name="category_id" class="category-option">
                                <label for="cat-{{$category->name}}">{{$category->name}}</label>
                            @endif
                        @endforeach
                    </div>
                    @error('category_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{--                todo : will be avilable in new version--}}
                {{--                <div class="form-group">--}}
                {{--                    <label class="form-label">Content</label>--}}
                {{--                    <div class="editor-toolbar">--}}
                {{--                        <button type="button" class="editor-btn" title="Heading 1"><i class="fas fa-heading"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Heading 2"><strong>H2</strong></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Bold"><i class="fas fa-bold"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Italic"><i class="fas fa-italic"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="List"><i class="fas fa-list-ul"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Numbered List"><i class="fas fa-list-ol"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Quote"><i class="fas fa-quote-right"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Link"><i class="fas fa-link"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Image"><i class="fas fa-image"></i></button>--}}
                {{--                        <button type="button" class="editor-btn" title="Code"><i class="fas fa-code"></i></button>--}}
                {{--                    </div>--}}
                {{--                    <div id="contentEditor" class="content-editor" contenteditable="true">--}}
                {{--                        <h2>Introduction</h2>--}}
                {{--                        <p>Writing is an essential skill in today's digital world. Whether you're crafting blog posts, emails, or social media content, improving your writing can have a significant impact on your professional success. In this article, we'll explore ten practical tips to enhance your writing in 2023.</p>--}}

                {{--                        <h2>1. Know Your Audience</h2>--}}
                {{--                        <p>Before you start writing, take time to understand who will be reading your content. Consider their knowledge level, interests, and what they hope to gain from your writing.</p>--}}

                {{--                        <h2>2. Outline Your Content</h2>--}}
                {{--                        <p>Creating an outline helps organize your thoughts and ensures a logical flow. Start with main points, then add supporting details.</p>--}}
                {{--                    </div>--}}
                {{--                    <textarea id="articleContent" name="content" style="display: none;"></textarea>--}}
                {{--                </div>--}}

                {{--                <div class="form-group">--}}
                {{--                    <label for="articleExcerpt" class="form-label">Excerpt</label>--}}
                {{--                    <textarea id="articleExcerpt" class="form-control" rows="3">Improve your writing skills with these 10 practical tips for 2023. Learn how to engage your audience and communicate more effectively.</textarea>--}}
                {{--                    <small class="text-muted">A short summary of your article (used in listings and SEO)</small>--}}
                {{--                </div>--}}

                {{--                <div class="form-group">--}}
                {{--                    <label for="articleTags" class="form-label">Tags</label>--}}
                {{--                    <input type="text" id="articleTags" class="form-control" value="writing, tips, productivity, 2023">--}}
                {{--                    <small class="text-muted">Comma-separated list of tags</small>--}}
                {{--                </div>--}}

                <div class="form-actions">
                    <input type="reset" class="btn btn-outline" value="Cancel">
                    {{--                    <button type="button" class="btn btn-outline">--}}
                    {{--                        <i class="fas fa-save"></i>--}}
                    {{--                        <span>Save Draft</span>--}}
                    {{--                    </button>--}}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        <span>Update Article</span>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Image upload preview
            const imageUpload = document.getElementById('imageUpload');
            const imagePreview = document.getElementById('imagePreview');

            imageUpload.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (event) {
                        imagePreview.src = event.target.result;
                        imagePreview.style.display = 'block';
                        imagePreview.nextElementSibling.style.display = 'none';
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

@endsection
