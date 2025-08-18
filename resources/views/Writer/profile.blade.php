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
                <button class="tab-btn active" id="tab-profile" data-tab="profile">Profile</button>
                <button class="tab-btn" id="tab-account" data-tab="account">Account</button>
                <button class="tab-btn" id="tab-notifications" data-tab="notifications">Notifications</button>
                <button class="tab-btn" id="tab-security" data-tab="security">Security</button>
            </div>

            <!-- Profile Tab -->
            <div class="tab-content active" id="profile-tab">
                <form class="profile-form" action="{{route('writer.profile.update')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="active_tab" value="profile">
                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            <img
                                src="{{ $user->writer_profile && $user->writer_profile->profile_picture
          ? asset('storage/' . $user->writer_profile->profile_picture)
          : asset('images/default-avatar.jpg') }}"
                                alt="Profile picture"
                                id="avatarPreview">

                            <i class="fas fa-user" style="font-size: 2rem; color: var(--gray); display: none;"></i>
                        </div>
                        <div class="upload-btn">
                            <button type="button" class="btn btn-outline">
                                <i class="fas fa-upload"></i>
                                <span>Change Avatar</span>
                            </button>
                            <input type="file" id="avatarUpload" name="new-image" accept="image/*">
                            <input type="hidden" name="current-image"
                                   value="{{$user->writer_profile->profile_picture}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" name="fullName" class="form-control"
                               value="{{$user->full_name}}">
                    </div>

                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" class="form-control" name="bio"
                                  rows="4">{{$user->writer_profile->bio}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" id="website" class="form-control" name="website"
                               value="{{$user->writer_profile->website}}">
                    </div>
                    @php
                        $defaultSocials = ['facebook', 'twitter', 'linkedin'];
                        $savedSocials = $user->writer_profile->social_media_links
                            ? json_decode($user->writer_profile->social_media_links, true)
                            : [];
                    @endphp

                    <div class="form-group">
                        <label class="form-label">Social Media</label>

                        @foreach($defaultSocials as $platform)
                            <div class="form-group mt-2">
                                <label for="social-{{ $platform }}" class="form-label">{{ ucfirst($platform) }}</label>
                                <input type="url"
                                       id="social-{{ $platform }}"
                                       name="social_media[{{ $platform }}]"
                                       class="form-control"
                                       value="{{ old("social_media.$platform", $savedSocials[$platform] ?? '') }}"
                                       placeholder="https://{{ $platform }}.com/yourprofile">
                            </div>
                        @endforeach
                    </div>


                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="location" class="form-label">Location</label>--}}
                    {{--                        <input type="text" id="location" class="form-control" value="San Francisco, CA">--}}
                    {{--                    </div>--}}

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            <!-- Account Tab -->
            <div class="tab-content" id="account-tab">
                <form class="profile-form" action="{{route('writer.account.update')}}" method="post">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="active_tab" value="account">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" disabled class="form-control" name="email"
                               value="{{$user->email}}">
                        <small class="form-text text-muted">This email address will be used for login.</small>
                        <br>
                        <small class="form-text text-muted">This email address can not be changes</small>

                    </div>

                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="username" class="form-label">Username</label>--}}
                    {{--                        <input type="text" id="username" class="form-control" value="janesmith">--}}
                    {{--                    </div>--}}

                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="language" class="form-label">Language</label>--}}
                    {{--                        <select id="language" class="form-control">--}}
                    {{--                            <option value="en" selected>English</option>--}}
                    {{--                            <option value="es">Spanish</option>--}}
                    {{--                            <option value="fr">French</option>--}}
                    {{--                            <option value="de">German</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="timezone" class="form-label">Timezone</label>--}}
                    {{--                        <select id="timezone" class="form-control">--}}
                    {{--                            <option value="-8" selected>(GMT-8) Pacific Time (US & Canada)</option>--}}
                    {{--                            <option value="-7">(GMT-7) Mountain Time (US & Canada)</option>--}}
                    {{--                            <option value="-6">(GMT-6) Central Time (US & Canada)</option>--}}
                    {{--                            <option value="-5">(GMT-5) Eastern Time (US & Canada)</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="form-actions">--}}
                    {{--                        <button type="button" class="btn btn-outline">Cancel</button>--}}
                    {{--                        <button type="submit" class="btn btn-primary">Save Changes</button>--}}
                    {{--                    </div>--}}
                </form>
            </div>
            {{-- Notification Tab --}}
            <div class="tab-content" id="notifications-tab">
                <div class="notification-settings">
                    Will be available soon
                </div>
            </div>
            <!-- Security Tab -->
            <div class="tab-content" id="security-tab">

                @php
                    $activeTab = session('active_tab', 'profile'); // الافتراضي profile
                @endphp

                <div class="tab-pane fade {{ $activeTab == 'security' ? 'show active' : '' }}" id="security-tab">

                    <form class="profile-form" action="{{ route('writer.security.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="active_tab" value="security">

                        {{-- Current Password --}}
                        <div class="form-group">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <div class="password-toggle">
                                <input type="password"
                                       id="currentPassword"
                                       name="current_password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       value="{{ old('current_password') }}">
                                <i class="fas fa-eye toggle-icon" data-target="currentPassword"></i>
                            </div>
                            @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="form-group">
                            <label for="newPassword" class="form-label">New Password</label>
                            <div class="password-toggle">
                                <input type="password"
                                       id="newPassword"
                                       name="new_password"
                                       class="form-control @error('new_password') is-invalid @enderror">
                                <i class="fas fa-eye toggle-icon" data-target="newPassword"></i>
                            </div>
                            @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <div class="password-toggle">
                                <input type="password"
                                       id="confirmPassword"
                                       name="new_password_confirmation"
                                       class="form-control @error('new_password_confirmation') is-invalid @enderror">
                                <i class="fas fa-eye toggle-icon" data-target="confirmPassword"></i>
                            </div>
                            @error('new_password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-outline">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            // القيمة اللي جاية من السيشن (Laravel)
            const activeTab = @json(session('active_tab', 'profile'));

            function activateTab(tabId) {
                // أزرار التاب
                tabBtns.forEach(btn => {
                    btn.classList.toggle('active', btn.getAttribute('data-tab') === tabId);
                });

                // محتوى التاب
                tabContents.forEach(content => {
                    content.classList.toggle('active', content.id === `${tabId}-tab`);
                });
            }

            // أول ما الصفحة تفتح
            activateTab(activeTab);

            // عند الضغط على زر
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    activateTab(this.getAttribute('data-tab'));
                });
            });

            // Avatar preview
            const avatarUpload = document.getElementById('avatarUpload');
            const avatarPreview = document.getElementById('avatarPreview');

            if (avatarUpload && avatarPreview) {
                avatarUpload.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            avatarPreview.src = event.target.result;
                            avatarPreview.style.display = 'block';
                            if (avatarPreview.nextElementSibling) {
                                avatarPreview.nextElementSibling.style.display = 'none';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Password toggle
            document.querySelectorAll('.toggle-icon').forEach(icon => {
                icon.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    if (passwordInput) {
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            this.classList.replace('fa-eye', 'fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            this.classList.replace('fa-eye-slash', 'fa-eye');
                        }
                    }
                });
            });
        });
    </script>




@endsection
