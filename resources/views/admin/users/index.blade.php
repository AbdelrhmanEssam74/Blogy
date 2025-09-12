@extends('app.dashboards.admin_layout')
@section('description')
    Manage and organize your blog users. Add, edit, or delete users to maintain control over who can access and contribute to your platform.
@endsection
@section('title', auth()->user()->full_name . ' | Users')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endsection
@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Manage Users</h1>
            <div class="header-actions">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>Add User</span>
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Role</label>
                    <select class="filter-select" id="roleFilter">
                        <option value="all">All Roles</option>
                        <option value="admin">Administrator</option>
                        <option value="writer">Writer</option>
                        <option value="reader">Reader</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="all">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select class="filter-select" id="sortFilter">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="articles">Articles Count</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Search</label>
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search users...">
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

        <!-- Users Table -->
        <div class="users-table-container">
            <div class="table-header">
                <h2 class="table-title">All Users</h2>
                <div class="search-box">
                    <input type="text" placeholder="Quick search...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <table class="data-table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Articles</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">
                                    @if( $user->writer_profile)
                                        <img src="{{asset('storage/' . $user->writer_profile->profile_picture)}}"
                                             loading="lazy" alt="User avatar">
                                    @else
                                        <img src="{{asset('images/default-avatar.jpg')}}" loading="lazy"
                                             alt="User avatar">

                                    @endif
                                </div>
                                <div class="user-info">
                                    <div class="user-name">{{$user->full_name}}</div>
                                    <div class="user-email">{{$user->email}}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-{{$user->role->role_name}}">{{$user->role->role_name}}</span></td>
                        <td>{{$user->articles_count}}</td>
                        @if($user->writer_profile)
                            <td>
                                <span
                                    class="badge badge-{{$user->writer_profile->status}}">{{\Str::ucfirst($user->writer_profile->status)}}</span>
                            </td>
                        @else
                            <td>
                                <span class="badge badge-active">Active</span>
                            </td>
                        @endif
                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('D, d M Y ')}}</td>
                        <td>
                            <div class="action-buttons">
                                {{--                                <button class="action-btn btn-role" title="Change Role"--}}
                                {{--                                        onclick="openRoleModal(1, 'Admin User', 'admin')">--}}
                                {{--                                    <i class="fas fa-user-cog"></i>--}}
                                {{--                                </button>--}}
                                @if($user->writer_profile)
                                    @if($user->writer_profile->status === 'active')
                                        <a class="action-btn btn-status inactive"
                                                href="{{ route('admin.users-deactivate' , $user->user_id) }}"
                                                title="Deactivate">
                                            <i class="fas fa-user-slash"></i>
                                        </a>
                                    @elseif($user->writer_profile->status === 'inactive')
                                        <a class="action-btn btn-status active"
                                           href="{{ route('admin.users-active' , $user->user_id) }}"
                                                title="Activate">
                                            <i class="fas fa-user-check"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="pagination">
                {{ $users->withQueryString()->onEachSide(1)->links('components.pagination') }}
            </div>
        </div>
    </main>
    <script>
        // Filter functionality
        function applyFilters() {
            const roleFilter = document.getElementById('roleFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const tbody = document.querySelector('.data-table tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.forEach(row => {
                const role = row.querySelector('td:nth-child(2) span').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                const name = row.querySelector('.user-name').textContent.toLowerCase();
                const email = row.querySelector('.user-email').textContent.toLowerCase();

                const roleMatch = roleFilter === 'all' || role.includes(roleFilter);
                const statusMatch = statusFilter === 'all' || status.includes(statusFilter);
                const searchMatch = searchTerm === '' ||
                    name.includes(searchTerm) ||
                    email.includes(searchTerm);

                if (roleMatch && statusMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Sorting
            const visibleRows = rows.filter(row => row.style.display !== 'none');

            visibleRows.sort((a, b) => {
                if (sortFilter === 'name') {
                    const nameA = a.querySelector('.user-name').textContent.toLowerCase();
                    const nameB = b.querySelector('.user-name').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                } else if (sortFilter === 'articles') {
                    const articlesA = parseInt(a.querySelector('td:nth-child(3)').textContent) || 0;
                    const articlesB = parseInt(b.querySelector('td:nth-child(3)').textContent) || 0;
                    return articlesB - articlesA; // descending
                } else if (sortFilter === 'oldest') {
                    const dateA = new Date(a.querySelector('td:nth-child(5)').textContent);
                    const dateB = new Date(b.querySelector('td:nth-child(5)').textContent);
                    return dateA - dateB;
                } else { // newest
                    const dateA = new Date(a.querySelector('td:nth-child(5)').textContent);
                    const dateB = new Date(b.querySelector('td:nth-child(5)').textContent);
                    return dateB - dateA;
                }
            });

            // Append sorted rows back
            visibleRows.forEach(row => tbody.appendChild(row));
        }

        function clearFilters() {
            document.getElementById('roleFilter').value = 'all';
            document.getElementById('statusFilter').value = 'all';
            document.getElementById('searchInput').value = '';
            document.getElementById('sortFilter').value = 'newest';

            // Show all rows
            document.querySelectorAll('.data-table tbody tr').forEach(row => {
                row.style.display = '';
            });
        }
    </script>

@endsection
