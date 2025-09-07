@extends('app.dashboards.admin_layout')
@section('description')
    Edit details and settings for the category.
    @endsection
@section('title', auth()->user()->full_name . ' | Categories')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/edit-category.css') }}">
@endsection

@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a> > <a href="{{ route('admin.categories') }}">Categories</a>
                    > Edit Category
                </div>
                <h1>Edit Category</h1>
            </div>
            <a href="{{ route('admin.categories') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        <!-- Edit Form -->
        <div class="edit-form-container">
            <form id="editCategoryForm" action="{{ route('admin.category-update' , $category->category_id) }}"
                  method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-grid">
                    <!-- Left Column -->
                    <div>
                        <div class="form-section">
                            <h3 class="section-title">Basic Information</h3>

                            <div class="form-group">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" id="categoryName" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{$category->name}}">
                                <div class="form-help">This will be displayed as the category name throughout the
                                    site.
                                </div>
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="categorySlug" class="form-label">Slug</label>
                                <input type="text" id="categorySlug" name="slug" class="form-control   @error('name') is-invalid @enderror "
                                       value="{{$category->slug}}"
                                >
                                <div class="form-help">URL-friendly version of the name. Usually all lowercase and
                                    contains only letters, numbers, and hyphens, Created Automatically
                                </div>
                                @error('slug')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription" class="form-label">Description</label>
                                <textarea id="categoryDescription" name="description" rows="11"
                                          class="form-control form-textarea">{{$category->description}}</textarea>
                                <div class="form-help">Brief description of the category that will be displayed on
                                    category pages.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="form-section">
                            <h3 class="section-title">Category Image</h3>

                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="image-preview" id="imagePreview">
                                        <img src="{{asset('storage/' . $category->image)}}" loading="lazy"
                                             alt="Current category image">
                                    </div>
                                    <div class="upload-btn">
                                        <button type="button" class="btn btn-outline">
                                            <i class="fas fa-upload"></i>
                                            <span>Change Image</span>
                                        </button>
                                        <input type="file" id="categoryImage" name="new_image" accept="image/*"
                                               onchange="previewImage(this)">
                                        <input type="hidden" name="old_image" value="{{$category->image}}" >
                                    </div>
                                </div>
                                <div class="form-help">Supported formats: JPG, PNG,
                                    GIF.
                                </div>
                                @error('new_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="toggle-group">
                                <span class="toggle-label">Status</span>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="active" id="categoryStatus"
                                           @if($category->active) checked @endif>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="form-help">Active categories are visible to users. Inactive categories are
                                hidden but preserved.
                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="section-title">Category Statistics</h3>

                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div class="stat-value">{{$category->articles_count}}</div>
                                    <div class="stat-label">Total Articles</div>
                                </div>
                            </div>

                            <div class="form-help" style="margin-top: 1rem;">
                                Last updated: {{\Carbon\Carbon::parse($category->updated_at)->format('F j, Y, g:i a')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <div>
                        <button disabled type="button" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            <span>Delete Category</span>
                        </button>
                    </div>
                    <div class="action-buttons">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-times"></i>
                            <span>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Delete Category</h3>
                <button class="modal-close" onclick="">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the category "<strong id="deleteCategoryName">Technology</strong>"?
                </p>
                <p style="color: var(--danger); font-size: 0.875rem; margin-top: 1rem;">
                    <i class="fas fa-exclamation-triangle"></i>
                    This action cannot be undone. All articles in this category will be moved to "Uncategorized".
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="">
                    Cancel
                </button>
                <button class="btn btn-danger" onclick="">
                    <i class="fas fa-trash"></i>
                    <span>Delete Category</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('categoryName');
        const slugInput = document.getElementById('categorySlug');

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '" alt="Category Image">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Auto-generate slug from name
        nameInput.addEventListener('input', function () {
            const name = this.value.trim();
            const slug = generateSlug(name);
            slugInput.value = slug;

        });

        // Slug generation function
        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') // Remove non-word characters
                .replace(/[\s_-]+/g, '-')  // Replace spaces and underscores with hyphens
                .replace(/^-+|-+$/g, '');  // Remove leading/trailing hyphens
        }
    </script>

@endsection
