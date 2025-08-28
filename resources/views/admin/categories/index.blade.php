@extends('app.dashboards.admin_layout')

@section('title', auth()->user()->full_name . ' | Categories')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
@endsection

@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Manage Categories</h1>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="openCategoryModal()">
                    <i class="fas fa-plus"></i>
                    <span>Add Category</span>
                </button>
            </div>
        </div>

        <!-- Sorting and Filtering Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select class="filter-select" id="sortBy" onchange="applySorting()">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="articles_asc">Articles (Low to High)</option>
                        <option value="articles_desc">Articles (High to Low)</option>
                        <option value="date_asc">Date Created (Oldest)</option>
                        <option value="date_desc">Date Created (Newest)</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Articles Range</label>
                    <select class="filter-select" id="articlesRange" onchange="applyFilters()">
                        <option value="all">All Articles</option>
                        <option value="0-10">0-10 Articles</option>
                        <option value="11-50">11-50 Articles</option>
                        <option value="51-100">51-100 Articles</option>
                        <option value="100+">100+ Articles</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter" onchange="applyFilters()">
                        <option value="all">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Search</label>
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search categories..." onkeyup="applyFilters()">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>

            <div class="filter-actions">
                <button class="btn btn-outline" onclick="clearFilters()">
                    <i class="fas fa-times"></i>
                    <span>Clear Filters</span>
                </button>
                <button class="btn btn-primary" onclick="applyFilters()">
                    <i class="fas fa-filter"></i>
                    <span>Apply Filters</span>
                </button>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid" id="categoriesContainer">
            @if(!empty($categories))
                @foreach($categories as $category)
                    <div class="category-card"
                         data-name="{{$category->name}}"
                         data-articles="{{$category->articles_count}}"
                         data-date="{{\Carbon\Carbon::parse($category->created_at)->format('Y-m-d')}}"
                         data-status="
                         @if($category->status)
                            active
                            @else
                            inactive
                         @endif
                         ">
                        <div class="category-header">
                            <div class="category-image">
                                <img src="{{asset('storage/' . $category->image) }}" alt="category-thumbnail-img">
                            </div>
                            <div class="category-info">
                                <h3 class="category-name">{{$category->name}}</h3>
                                <div class="category-slug">{{$category->slug}}</div>
                                <span class="article-count">
                            <i class="fas fa-file-alt"></i>
                            {{$category->articles_count}} articles
                        </span>
                            </div>
                        </div>
                        <p class="category-description">
                            {{$category->description}}
                        </p>
                        <div class="category-actions">
                            <button class="action-btn btn-edit" onclick="">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </button>
                            <button class="action-btn btn-delete" onclick="">
                                <i class="fas fa-trash"></i>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


        <!-- Pagination -->
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
        // Auto-generate slug from name
        document.getElementById('categoryName').addEventListener('input', function () {
            const name = this.value.trim();
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            document.getElementById('categorySlug').value = slug;
        });
    </script>
@endsection
