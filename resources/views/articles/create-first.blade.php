@extends('app.layout')

@section('content')
    {{-- success message --}}
    @if(session('success'))
        <x-celebration_message></x-celebration_message>
    @endif

    {{-- Show Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="fw-light mb-3">Create your First Article</h1>
                    <p class="text-muted">Share your expertise with our community</p>
                    <div class="luxury-divider mx-auto my-4"></div>
                </div>

                <form action="{{ route('articles.store-first') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Field -->
                    <div class="mb-4">
                        <label for="title" class="form-label small text-uppercase text-muted">Article Title</label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title') }}"
                               class="form-control border-0 border-bottom rounded-0 px-0 py-3 luxury-input
                              @error('title') is-invalid @enderror"
                               placeholder="Enter your article title">
                        @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div class="mb-4">
                        <label for="content" class="form-label small text-uppercase text-muted">Article Content</label>
                        <textarea id="content" name="content" rows="8"
                                  class="form-control border-0 border-bottom rounded-0 px-0 py-3 luxury-input
                                  @error('content') is-invalid @enderror"
                                  placeholder="Write your content here...">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload (Styled) -->
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div>
                            <label class="form-label small text-uppercase text-muted">Featured Image</label>
                            <div class="luxury-file-upload">
                                <input type="file" id="image" name="image" class="d-none" accept="image/*">
                                <label for="image" class="w-100">
                                    <div class="border-2 border-dashed rounded p-5 text-center luxury-upload-area">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-gold mb-3"></i>
                                        <h5 class="mb-2">Upload Featured Image</h5>
                                        <p class="small text-muted mb-2">Drag & drop or click to browse</p>
                                        <p class="small text-muted">PNG, JPG (Max 5MB)</p>
                                    </div>
                                </label>
                            </div>
                            @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <img src="{{ asset('images/placeholder_image.png') }}" alt="" id="image-preview"
                                 style="max-height: 150px;">
                            <p class="small text-muted mt-2">Preview</p>
                        </div>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <label for="category" class="form-label small text-uppercase text-muted">Select Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category"
                                name="category_id">
                            <option value="0" selected disabled>-- Choose a category --</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->category_id }}" >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-5 pt-3">
                        <button type="submit" class="btn btn-dark rounded-0 w-100 py-3 luxury-btn">
                            <i class="bi bi-send-check me-2"></i>
                            Publish Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgPreview = document.getElementById('image-preview');
                    imgPreview.setAttribute('src', e.target.result);
                    imgPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <style>
        :root {
            --luxury-gold: #c9a668;
            --luxury-dark: #1a1a1a;
            --luxury-border: #e0d6c2;
        }

        .luxury-divider {
            width: 80px;
            height: 2px;
            background: var(--luxury-gold);
        }

        #image-preview {
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .luxury-input {
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .luxury-input:focus {
            box-shadow: none;
            border-color: var(--luxury-gold);
        }

        .luxury-file-upload .luxury-upload-area {
            background-color: #f9f9f9;
            border: 2px dashed var(--luxury-border);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .luxury-file-upload .luxury-upload-area:hover {
            border-color: var(--luxury-gold);
            background-color: rgba(201, 166, 104, 0.05);
        }

        .text-gold {
            color: var(--luxury-gold);
        }

        .luxury-btn {
            background-color: var(--luxury-dark);
            color: white;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            font-weight: 300;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .form-select {
            border-radius: 0.5rem;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .luxury-btn:hover {
            background-color: var(--luxury-dark);
            color: white;
            opacity: 0.9;
        }
    </style>
@endsection
