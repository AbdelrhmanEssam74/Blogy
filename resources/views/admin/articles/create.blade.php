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
            <h1>Create New Article</h1>
            <p>Share your knowledge and insights with the world.</p>
        </div>

        <!-- Post Form -->
        <form class="post-form" method="post" action="{{ route('writer-article.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="post-title" class="form-label">Post Title</label>
                <input type="text"
                       id="post-title"
                       name="title"
                       class="form-control
                @error('title') is-invalid @enderror"
                       value="{{ old('title') }}"
                       placeholder="Enter your post title...">
                @error('title')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-content" class="form-label">Content</label>
                <textarea id="post-content" class="form-control  @error('content') is-invalid @enderror"
                          name="content"
                          placeholder="Write your post content here...">
                   @if(old('content'))
                        {{ old('content') }}
                   @endif
                </textarea>
                @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div class="image-upload">
                    <div class="upload-btn">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-upload"></i>
                            <span>Choose Image</span>
                        </button>
                        <input type="file" id="post-image" name="image" accept="image/*">
                    </div>
                    <div class="image-preview">
                        <i class="fas fa-image" style="font-size: 2rem; color: var(--gray);"></i>
                    </div>
                </div>
                @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Categories</label>
                <div class="category-select">
                    @if(!$categories->isEmpty())
                        <input type="radio" id="cat" checked name="category_id"
                               class="category-option" value="">
                        <label for="cat">Select Category</label>
                        @foreach($categories as $category)
                            <input type="radio" id="cat-{{ $category->category_id }}" name="category_id"
                                   class="category-option" value="{{ $category->category_id }}">
                            <label for="cat-{{ $category->category_id }}">{{ $category->name }}</label>
                        @endforeach
                    @endif
                    @error('category_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                </div>
                <div id="post-status" class="status-message">
                    <i class="fas fa-info-circle"></i>
                    <strong>please note</strong> that
                    <strong>your article will not be immediately visible to readers</strong>. Instead, it will be
                    reviewed by our team and published once approved.
                </div>
            </div>
            <div class="form-actions">

                {{--                <button  type="button" class="btn btn-outline">--}}
                {{--                    <i class="fas fa-save"></i>--}}
                {{--                    <span>Save Draft</span>--}}
                {{--                </button>--}}
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
