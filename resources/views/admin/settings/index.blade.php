@extends('app.dashboards.admin_layout')
@section('description')
    Admin Settings Page for {{ auth()->user()->full_name }} - Manage your account settings and preferences.
    {{ config('app.name') }}
@endsection
@section('title', auth()->user()->full_name . ' | Settings')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/settings.css') }}">
@endsection
@section('content')
    <x-admin_sidebar></x-admin_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Settings</h1>
        </div>

        <!-- Settings Tabs -->
        <div class="settings-tabs">
            <button class="tab-btn active" data-tab="profile">Profile</button>
            <button class="tab-btn" data-tab="website">Website</button>
            <button class="tab-btn" data-tab="notifications">Notifications</button>
            <button class="tab-btn" data-tab="security">Security</button>
        </div>

        <!-- Profile Settings -->
        <div class="tab-content active" id="profile-tab">
            <div class="settings-container">
                <div class="form-section">
                    <h3 class="section-title">Profile Information</h3>

                    <div class="profile-image">
                        <div class="avatar">
                            <img src="https://via.placeholder.com/80" alt="Profile picture">
                        </div>
                        <div class="upload-btn">
                            <button type="button" class="btn btn-outline">
                                <i class="fas fa-upload"></i>
                                <span>Change Avatar</span>
                            </button>
                            <input type="file" accept="image/*">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" value="John">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" value="Doe">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="john.doe@example.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="johndoe">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control form-textarea">Senior editor and content manager with over 5 years of experience in digital publishing.</textarea>
                        <div class="form-help">Brief description for your profile.</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-outline">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Website Settings -->
        <div class="tab-content" id="website-tab">
            <div class="settings-container">
                <div class="form-section">
                    <h3 class="section-title">General Settings</h3>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Site Title</label>
                            <input type="text" class="form-control" value="MyBlog">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Site Tagline</label>
                            <input type="text" class="form-control" value="Sharing ideas and knowledge">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Admin Email</label>
                            <input type="email" class="form-control" value="admin@myblog.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Posts Per Page</label>
                            <input type="number" class="form-control" value="10">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Content Settings</h3>

                    <div class="toggle-group">
                        <span class="toggle-label">Comments Enabled</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <span class="toggle-label">Comment Moderation</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <span class="toggle-label">User Registration</span>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-outline">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="tab-content" id="security-tab">
            <div class="settings-container">
                <div class="form-section">
                    <h3 class="section-title">Change Password</h3>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Two-Factor Authentication</h3>

                    <div class="toggle-group">
                        <span class="toggle-label">Enable 2FA</span>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="form-help">Add an extra layer of security to your account by enabling two-factor authentication.</div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Active Sessions</h3>

                    <div class="form-group">
                        <div class="form-help">You're logged in on these devices. Revoke any sessions that you don't recognize.</div>
                    </div>

                    <div class="form-group">
                        <div style="padding: 1rem; background: var(--light); border-radius: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <strong>Chrome on Windows</strong>
                                <span class="badge badge-active">Current</span>
                            </div>
                            <div style="font-size: 0.875rem; color: var(--gray);">
                                Last active: 2 hours ago • IP: 192.168.1.5
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div style="padding: 1rem; background: var(--light); border-radius: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                <strong>Safari on iPhone</strong>
                                <button class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Revoke</button>
                            </div>
                            <div style="font-size: 0.875rem; color: var(--gray);">
                                Last active: 3 days ago • IP: 192.168.1.10
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-outline">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="settings-container" style="margin-top: 2rem;">
            <div class="danger-zone">
                <h3 class="danger-title">Danger Zone</h3>
                <p class="danger-text">These actions are irreversible. Please be cautious.</p>

                <div class="form-grid">
                    <div>
                        <label class="form-label">Export Data</label>
                        <div class="form-help">Download all your data in a ZIP file.</div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-download"></i>
                            <span>Export Data</span>
                        </button>
                    </div>
                </div>

                <div class="form-grid" style="margin-top: 1rem;">
                    <div>
                        <label class="form-label">Delete Account</label>
                        <div class="form-help">Permanently delete your account and all associated data.</div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            <span>Delete Account</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');

                    // Update active tab button
                    tabBtns.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Show corresponding content
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === `${tabId}-tab`) {
                            content.classList.add('active');
                        }
                    });
                });
            });

            // Avatar upload preview
            const avatarUpload = document.querySelector('.upload-btn input[type="file"]');
            const avatarImg = document.querySelector('.avatar img');

            avatarUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        avatarImg.src = event.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            });

            // Save buttons
            document.querySelectorAll('.btn-primary').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.closest('.tab-content').id;
                    alert(`Settings for ${tab.replace('-tab', '')} have been saved!`);
                });
            });

            // Cancel buttons
            document.querySelectorAll('.btn-outline').forEach(btn => {
                if (btn.textContent.includes('Cancel')) {
                    btn.addEventListener('click', function() {
                        alert('Changes discarded');
                    });
                }
            });

            // Danger zone buttons
            document.querySelector('.btn-danger').addEventListener('click', function() {
                if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                    alert('Account deletion process started. Check your email for confirmation.');
                }
            });
        });
    </script>
@endsection
