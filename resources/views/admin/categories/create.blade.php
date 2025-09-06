@extends('app.dashboards.admin_layout')

@section('title', auth()->user()->full_name . ' | Create Category')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/create-category.css') }}">
@endsection

@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a> > <a href="{{ route('admin.categories') }}">Categories</a> > Create New
                </div>
                <h1>Create New Category</h1>
            </div>
            <a href="{{ route('admin.categories') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        <!-- Create Form -->
        <div class="create-form-container">
            <form id="createCategoryForm">
                <div class="form-grid">
                    <!-- Left Column -->
                    <div>
                        <div class="form-section">
                            <h3 class="section-title">Basic Information</h3>

                            <div class="form-group">
                                <label for="categoryName" class="form-label">Category Name *</label>
                                <input type="text" id="categoryName" name="name" class="form-control" placeholder="e.g., Technology, Business, Lifestyle"  >
                                <div class="form-help">This will be displayed as the category name throughout the site.</div>
                                <div class="form-error" id="nameError">Please enter a category name.</div>
                            </div>

                            <div class="form-group">
                                <label for="categorySlug" class="form-label">Slug *</label>
                                <div class="slug-group">
                                    <span class="slug-prefix">/category/</span>
                                    <input type="text" id="categorySlug" name="=slug" disabled class="form-control slug-input" placeholder="category-slug"  >
                                </div>
                                <div class="form-help">URL-friendly version of the name. Auto-generated from the category name.</div>
                                <div class="form-error" id="slugError">Please enter a valid slug (letters, numbers, and hyphens only).</div>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription" class="form-label">Description</label>
                                <textarea id="categoryDescription" class="form-control form-textarea" name="description" placeholder="Brief description of the category..."></textarea>
                                <div class="form-help">Brief description of the category that will be displayed on category pages.</div>
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
                                        <i class="fas fa-image"></i>
                                        <img id="previewImage" src="" alt="Category image preview">
                                    </div>
                                    <div class="upload-btn">
                                        <button type="button" class="btn btn-outline">
                                            <i class="fas fa-upload"></i>
                                            <span>Upload Image</span>
                                        </button>
                                        <input type="file" id="categoryImage" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-help">Recommended size: 400×400 pixels. Supported formats: JPG, PNG, GIF.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="toggle-group">
                                <span class="toggle-label">Status</span>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="categoryStatus" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="form-help">Active categories are visible to users. Inactive categories are hidden.</div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createCategoryForm');
            const nameInput = document.getElementById('categoryName');
            const slugInput = document.getElementById('categorySlug');
            const imageInput = document.getElementById('categoryImage');
            const previewImage = document.getElementById('previewImage');
            const imagePreview = document.getElementById('imagePreview');

            // Auto-generate slug from name
            nameInput.addEventListener('input', function() {
                const name = this.value.trim();
                const slug = generateSlug(name);

                // Only update if slug is empty or matches the previous auto-generated value
                if (slugInput.value === '' || slugInput.dataset.autoGenerated === 'true') {
                    slugInput.value = slug;
                    slugInput.dataset.autoGenerated = 'true';
                }
            });

            // Allow manual slug editing without auto-overwrite
            slugInput.addEventListener('input', function() {
                this.dataset.autoGenerated = 'false';

                // Validate slug format
                const slug = this.value;
                const slugRegex = /^[a-z0-9]+(?:-[a-z0-9]+)*$/;

                if (slug && !slugRegex.test(slug)) {
                    this.style.borderColor = 'var(--danger)';
                    document.getElementById('slugError').style.display = 'block';
                } else {
                    this.style.borderColor = '';
                    document.getElementById('slugError').style.display = 'none';
                }
            });

            // Manual slug generation button (optional - could be added)
            function generateSlugManual() {
                const name = nameInput.value.trim();
                if (name) {
                    slugInput.value = generateSlug(name);
                    slugInput.dataset.autoGenerated = 'true';
                    slugInput.classList.add('pulse');
                    setTimeout(() => slugInput.classList.remove('pulse'), 500);
                }
            }

            // Image preview
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        imagePreview.querySelector('i').style.display = 'none';
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate form
                if (validateForm()) {
                    // In a real application, you would send this data to your server
                    const formData = new FormData();
                    formData.append('name', nameInput.value.trim());
                    formData.append('slug', slugInput.value.trim());
                    formData.append('description', document.getElementById('categoryDescription').value);
                    formData.append('status', document.getElementById('categoryStatus').checked ? 'active' : 'inactive');
                    formData.append('metaTitle', document.getElementById('metaTitle').value);
                    formData.append('metaDescription', document.getElementById('metaDescription').value);

                    if (imageInput.files[0]) {
                        formData.append('image', imageInput.files[0]);
                    }

                    console.log('Creating category with:', {
                        name: nameInput.value.trim(),
                        slug: slugInput.value.trim(),
                        description: document.getElementById('categoryDescription').value,
                        status: document.getElementById('categoryStatus').checked ? 'active' : 'inactive',
                        metaTitle: document.getElementById('metaTitle').value,
                        metaDescription: document.getElementById('metaDescription').value,
                        hasImage: !!imageInput.files[0]
                    });

                    // Show success message (in real app, this would be after API response)
                    alert('Category created successfully!');
                    // Redirect to categories list
                    window.location.href = '#';
                }
            });

            // Cancel button
            document.querySelector('.btn-outline').addEventListener('click', function() {
                if (confirm('Are you sure you want to cancel? Any entered data will be lost.')) {
                    window.location.href = '#';
                }
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
        });
    </script>

@endsection
