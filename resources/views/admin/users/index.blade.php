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
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">
                                <img src="https://via.placeholder.com/40" alt="User avatar">
                            </div>
                            <div class="user-info">
                                <div class="user-name">Admin User</div>
                                <div class="user-email">admin@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-admin">Administrator</span></td>
                    <td>0</td>
                    <td><span class="badge badge-active">Active</span></td>
                    <td>Jan 15, 2022</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-role" title="Change Role" onclick="openRoleModal(1, 'Admin User', 'admin')">
                                <i class="fas fa-user-cog"></i>
                            </button>
                            <button class="action-btn btn-status inactive" title="Deactivate" onclick="toggleUserStatus(1, true)">
                                <i class="fas fa-user-slash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">JS</div>
                            <div class="user-info">
                                <div class="user-name">Jane Smith</div>
                                <div class="user-email">jane.smith@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-writer">Writer</span></td>
                    <td>24</td>
                    <td><span class="badge badge-active">Active</span></td>
                    <td>Mar 2, 2023</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-role" title="Change Role" onclick="openRoleModal(2, 'Jane Smith', 'writer')">
                                <i class="fas fa-user-cog"></i>
                            </button>
                            <button class="action-btn btn-status inactive" title="Deactivate" onclick="toggleUserStatus(2, true)">
                                <i class="fas fa-user-slash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">JD</div>
                            <div class="user-info">
                                <div class="user-name">John Doe</div>
                                <div class="user-email">john.doe@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-writer">Writer</span></td>
                    <td>18</td>
                    <td><span class="badge badge-inactive">Inactive</span></td>
                    <td>Apr 10, 2023</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-role" title="Change Role" onclick="openRoleModal(3, 'John Doe', 'writer')">
                                <i class="fas fa-user-cog"></i>
                            </button>
                            <button class="action-btn btn-status" title="Activate" onclick="toggleUserStatus(3, false)">
                                <i class="fas fa-user-check"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">SW</div>
                            <div class="user-info">
                                <div class="user-name">Sarah Wilson</div>
                                <div class="user-email">sarah@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-reader">Reader</span></td>
                    <td>0</td>
                    <td><span class="badge badge-active">Active</span></td>
                    <td>May 5, 2023</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-role" title="Change Role" onclick="openRoleModal(4, 'Sarah Wilson', 'reader')">
                                <i class="fas fa-user-cog"></i>
                            </button>
                            <button class="action-btn btn-status inactive" title="Deactivate" onclick="toggleUserStatus(4, true)">
                                <i class="fas fa-user-slash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">MJ</div>
                            <div class="user-info">
                                <div class="user-name">Mike Johnson</div>
                                <div class="user-email">mike@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-reader">Reader</span></td>
                    <td>0</td>
                    <td><span class="badge badge-active">Active</span></td>
                    <td>Jun 12, 2023</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-role" title="Change Role" onclick="openRoleModal(5, 'Mike Johnson', 'reader')">
                                <i class="fas fa-user-cog"></i>
                            </button>
                            <button class="action-btn btn-status inactive" title="Deactivate" onclick="toggleUserStatus(5, true)">
                                <i class="fas fa-user-slash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="pagination">
                <div class="pagination-info">
                    Showing 1-5 of 24 users
                </div>
                <div class="pagination-controls">
                    <button class="page-btn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">5</button>
                    <button class="page-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
    <!-- Role Change Modal -->
    <div class="modal-overlay" id="roleModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Change User Role</h3>
                <button class="modal-close" onclick="closeRoleModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-message">
                    Change role for <strong id="roleUserName">Jane Smith</strong>:
                </p>

                <div class="form-group">
                    <select class="filter-select" id="roleSelect">
                        <option value="reader">Reader</option>
                        <option value="writer">Writer</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeRoleModal()">
                    Cancel
                </button>
                <button class="btn btn-primary" onclick="updateUserRole()">
                    <i class="fas fa-save"></i>
                    <span>Update Role</span>
                </button>
            </div>
        </div>
    </div>
    <script>
        // Store current user data
        let currentUser = null;

        // Filter functionality
        function applyFilters() {
            const roleFilter = document.getElementById('roleFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr');

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

        // Role change modal
        function openRoleModal(userId, userName, currentRole) {
            currentUser = { id: userId, name: userName, role: currentRole };
            document.getElementById('roleUserName').textContent = userName;
            document.getElementById('roleSelect').value = currentRole;
            document.getElementById('roleModal').classList.add('active');
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.remove('active');
        }

        function updateUserRole() {
            if (!currentUser) return;

            const newRole = document.getElementById('roleSelect').value;

            // In a real application, you would send this to the server
            console.log(`Changing role for user ${currentUser.id} from ${currentUser.role} to ${newRole}`);

            // Update the UI
            const roleBadge = document.querySelector(`tr:nth-child(${currentUser.id}) td:nth-child(2) span`);
            roleBadge.textContent = newRole.charAt(0).toUpperCase() + newRole.slice(1);
            roleBadge.className = 'badge badge-' + newRole;

            // Show success message
            alert(`Role updated successfully for ${currentUser.name}`);
            closeRoleModal();
        }

        // Toggle user status
        function toggleUserStatus(userId, isCurrentlyActive) {
            const userName = document.querySelector(`tr:nth-child(${userId}) .user-name`).textContent;

            if (confirm(`Are you sure you want to ${isCurrentlyActive ? 'deactivate' : 'activate'} ${userName}?`)) {
                // In a real application, you would send this to the server
                console.log(`Toggling status for user ${userId}`);

                // Update the UI
                const statusBadge = document.querySelector(`tr:nth-child(${userId}) td:nth-child(4) span`);
                const statusButton = document.querySelector(`tr:nth-child(${userId}) .btn-status`);

                if (isCurrentlyActive) {
                    statusBadge.textContent = 'Inactive';
                    statusBadge.className = 'badge badge-inactive';
                    statusButton.className = 'action-btn btn-status';
                    statusButton.title = 'Activate';
                    statusButton.innerHTML = '<i class="fas fa-user-check"></i>';
                    statusButton.onclick = function() { toggleUserStatus(userId, false); };
                } else {
                    statusBadge.textContent = 'Active';
                    statusBadge.className = 'badge badge-active';
                    statusButton.className = 'action-btn btn-status inactive';
                    statusButton.title = 'Deactivate';
                    statusButton.innerHTML = '<i class="fas fa-user-slash"></i>';
                    statusButton.onclick = function() { toggleUserStatus(userId, true); };
                }

                // Show success message
                alert(`${userName} has been ${isCurrentlyActive ? 'deactivated' : 'activated'} successfully`);
            }
        }

        // Close modal when clicking outside
        document.getElementById('roleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRoleModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRoleModal();
            }
        });
    </script>
@endsection
