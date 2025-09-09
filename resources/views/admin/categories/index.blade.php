@extends('app.dashboards.admin_layout')
@section('description')
    Manage and organize your blog categories. Add, edit, or delete categories to keep your content structured and easily navigable for your readers.
@endsection
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
                <a class="btn btn-primary" href="{{ route('admin.category-create') }}">
                    <i class="fas fa-plus"></i>
                    <span>Add Category</span>
                </a>
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
                    <input type="text" id="searchInput" class="filter-select" placeholder="Search categories..." onkeyup="applyFilters()">
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
                         data-name="{{ $category->name }}"
                         data-articles="{{ $category->articles_count }}"
                         data-date="{{ \Carbon\Carbon::parse($category->created_at)->format('Y-m-d') }}"
                         data-status="{{ $category->active ? 'active' : 'inactive' }}">
                        <div class="category-header">
                            <div class="category-image">
                                <img src="{{ asset('storage/' . $category->image) }}" loading="lazy"
                                     alt="category-thumbnail-img">
                            </div>
                            <div class="category-info">
                                <h3 class="category-name">{{ $category->name }}</h3>
                                <div class="category-slug">{{ $category->slug }}</div>
                                <span class="article-count">
                                    <i class="fas fa-file-alt"></i>
                                    {{ $category->articles_count }} articles
                                </span>
                            </div>
                        </div>
                        <p class="category-description">
                            {{ \Str::substr($category->description , 0 , 50) }}.....
                        </p>
                        <div class="category-actions">
                            <a class="action-btn btn-edit"
                               href="{{ route('admin.category-edit' , $category->category_id) }}">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $categories->withQueryString()->onEachSide(1)->links('components.pagination') }}
        </div>
    </main>

    <script>
        // Collect all category cards
        const container = document.getElementById('categoriesContainer');
        const categoryCards = document.querySelectorAll('.category-card');
        const allCategories = Array.from(categoryCards);

        // Sorting functionality
        function applySorting() {
            const sortBy = document.getElementById('sortBy').value;
            const categories = Array.from(container.querySelectorAll('.category-card'));

            categories.sort((a, b) => {
                switch (sortBy) {
                    case 'name_asc':
                        return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                    case 'name_desc':
                        return b.getAttribute('data-name').localeCompare(a.getAttribute('data-name'));
                    case 'articles_asc':
                        return parseInt(a.getAttribute('data-articles')) - parseInt(b.getAttribute('data-articles'));
                    case 'articles_desc':
                        return parseInt(b.getAttribute('data-articles')) - parseInt(a.getAttribute('data-articles'));
                    case 'date_asc':
                        return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                    case 'date_desc':
                        return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
                    default:
                        return 0;
                }
            });

            // Re-append sorted elements to container
            categories.forEach(category => container.appendChild(category));
        }

        // Filtering functionality
        function applyFilters() {
            const articlesRange = document.getElementById('articlesRange').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categories = container.querySelectorAll('.category-card');

            categories.forEach(category => {
                const articles = parseInt(category.getAttribute('data-articles'));
                const status = category.getAttribute('data-status');
                const name = category.getAttribute('data-name').toLowerCase();
                const description = category.querySelector('.category-description').textContent.toLowerCase();

                // Check articles range
                let articlesMatch = false;
                switch (articlesRange) {
                    case 'all': articlesMatch = true; break;
                    case '0-10': articlesMatch = articles >= 0 && articles <= 10; break;
                    case '11-50': articlesMatch = articles >= 11 && articles <= 50; break;
                    case '51-100': articlesMatch = articles >= 51 && articles <= 100; break;
                    case '100+': articlesMatch = articles > 100; break;
                }

                // Check status
                const statusMatch = statusFilter === 'all' || status === statusFilter;

                // Check search term
                const searchMatch = searchTerm === '' || name.includes(searchTerm) || description.includes(searchTerm);

                // Show or hide based on filters
                if (articlesMatch && statusMatch && searchMatch) {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });
        }

        // Clear all filters
        function clearFilters() {
            document.getElementById('sortBy').value = 'name_asc';
            document.getElementById('articlesRange').value = 'all';
            document.getElementById('statusFilter').value = 'all';
            document.getElementById('searchInput').value = '';

            applySorting();
            applyFilters();
        }
    </script>
@endsection
