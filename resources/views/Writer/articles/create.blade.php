@extends('app.dashboards.writer_layout')

@section('title', auth()->user()->full_name . ' | Create New Post')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/create-article.css') }}">
@endsection
@section('content')
    <x-writer_sidebar></x-writer_sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Create New Post</h1>
        </div>

        <!-- Post Form -->
        <form class="post-form">
            <div class="form-group">
                <label for="post-title" class="form-label">Post Title</label>
                <input type="text" id="post-title" class="form-control" placeholder="Enter your post title...">
            </div>

            <div class="form-group">
                <label for="post-content" class="form-label">Content</label>
                <textarea id="post-content" class="form-control"
                          placeholder="Write your post content here..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div class="image-upload">
                    <div class="upload-btn">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-upload"></i>
                            <span>Choose Image</span>
                        </button>
                        <input type="file" id="post-image" accept="image/*">
                    </div>
                    <div class="image-preview">
                        <i class="fas fa-image" style="font-size: 2rem; color: var(--gray);"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Categories</label>
                <div class="category-select">
                    <input type="radio" id="cat-writing" name="category" class="category-option" checked>
                    <label for="cat-writing">Writing</label>

                    <input type="radio" id="cat-marketing" name="category" class="category-option">
                    <label for="cat-marketing">Marketing</label>

                    <input type="radio" id="cat-seo" name="category" class="category-option">
                    <label for="cat-seo">SEO</label>

                    <input type="radio" id="cat-productivity" name="category" class="category-option">
                    <label for="cat-productivity">Productivity</label>

                    <input type="radio" id="cat-technology" name="category" class="category-option">
                    <label for="cat-technology">Technology</label>
                </div>
                <div id="post-status" class="status-message">
                    <i class="fas fa-info-circle"></i>
                    <strong>please note</strong> that
                    <strong>your article will not be immediately visible to readers</strong>. Instead, it will be
                    reviewed by our team and published once approved.
                </div>
            </div>
            <div class="form-actions">

                <button type="button" class="btn btn-outline">
                    <i class="fas fa-save"></i>
                    <span>Save Draft</span>
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    <span>Publish Article</span>
                </button>
            </div>
        </form>
    </main>
    <script>
        // Simple image preview functionality
        document.getElementById('post-image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.querySelector('.image-preview');

                preview.innerHTML = ''; // Clear previous content

                reader.onload = function (event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
