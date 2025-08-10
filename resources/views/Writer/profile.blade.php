@extends('app.dashboards.writer_layout')

@section('title', auth()->user()->full_name . ' | Profile')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/writer/profile.css') }}">
@endsection
@section('content')
    <x-writer_sidebar></x-writer_sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Profile Settings</h1>
        </div>

        <div class="settings-container">
            <div class="settings-tabs">
                <button class="tab-btn active" data-tab="profile">Profile</button>
                <button class="tab-btn" data-tab="account">Account</button>
                <button class="tab-btn" data-tab="notifications">Notifications</button>
                <button class="tab-btn" data-tab="security">Security</button>
            </div>

            <!-- Profile Tab -->
            <div class="tab-content active" id="profile-tab">
                <form class="profile-form">
                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            <img src="https://via.placeholder.com/80" alt="Profile picture" id="avatarPreview">
                            <i class="fas fa-user" style="font-size: 2rem; color: var(--gray); display: none;"></i>
                        </div>
                        <div class="upload-btn">
                            <button type="button" class="btn btn-outline">
                                <i class="fas fa-upload"></i>
                                <span>Change Avatar</span>
                            </button>
                            <input type="file" id="avatarUpload" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" class="form-control" value="Jane Smith">
                    </div>

                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" class="form-control" rows="4">Writer and content creator specializing in technology and productivity.</textarea>
                    </div>

                    <div class="form-group">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" id="website" class="form-control" value="https://janesmith.com">
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" class="form-control" value="San Francisco, CA">
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Account Tab -->
            <div class="tab-content" id="account-tab">
                <form class="profile-form">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" class="form-control" value="jane.smith@example.com">
                    </div>

                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" value="janesmith">
                    </div>

                    <div class="form-group">
                        <label for="language" class="form-label">Language</label>
                        <select id="language" class="form-control">
                            <option value="en" selected>English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="timezone" class="form-label">Timezone</label>
                        <select id="timezone" class="form-control">
                            <option value="-8" selected>(GMT-8) Pacific Time (US & Canada)</option>
                            <option value="-7">(GMT-7) Mountain Time (US & Canada)</option>
                            <option value="-6">(GMT-6) Central Time (US & Canada)</option>
                            <option value="-5">(GMT-5) Eastern Time (US & Canada)</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Security Tab -->
            <div class="tab-content" id="security-tab">
                <form class="profile-form">
                    <div class="form-group">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <div class="password-toggle">
                            <input type="password" id="currentPassword" class="form-control">
                            <i class="fas fa-eye toggle-icon" data-target="currentPassword"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="password-toggle">
                            <input type="password" id="newPassword" class="form-control">
                            <i class="fas fa-eye toggle-icon" data-target="newPassword"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <div class="password-toggle">
                            <input type="password" id="confirmPassword" class="form-control">
                            <i class="fas fa-eye toggle-icon" data-target="confirmPassword"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="twoFactor" class="form-check-input">
                            <label for="twoFactor" class="form-check-label">Enable Two-Factor Authentication</label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Active sidebar menu item management
            const menuItems = document.querySelectorAll('.menu-item');

            function handleMenuItemClick(event) {
                event.preventDefault();

                menuItems.forEach(item => {
                    item.classList.remove('active');
                });

                this.classList.add('active');

                // In a real app, you would load content here
                console.log(`Loading ${this.querySelector('span').textContent}...`);
            }

            menuItems.forEach(item => {
                item.addEventListener('click', handleMenuItemClick);
            });

            // Set settings as active by default for this page
            const settingsItem = document.querySelector('.menu-item:nth-child(8)');
            if (settingsItem) {
                settingsItem.classList.add('active');
            }

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
            const avatarUpload = document.getElementById('avatarUpload');
            const avatarPreview = document.getElementById('avatarPreview');

            avatarUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        avatarPreview.src = event.target.result;
                        avatarPreview.style.display = 'block';
                        avatarPreview.nextElementSibling.style.display = 'none';
                    }

                    reader.readAsDataURL(file);
                }
            });

            // Password toggle visibility
            const toggleIcons = document.querySelectorAll('.toggle-icon');

            toggleIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
@endsection
