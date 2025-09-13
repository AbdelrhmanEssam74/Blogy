<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>MyBlog</h2>
        <p>Admin Dashboard</p>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"
           class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-target="dashboard">
            <i class="fa-light fa-gauge"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.articles') }}"
           class="menu-item {{request()->routeIs('admin.articles') ? 'active' : ' '}}" data-target="articles">
            <i class="fa-light fa-file-lines"></i>
            <span>Articles</span>
        </a>
        <a href="{{ route('admin.categories') }}"
           class="menu-item {{request()->routeIs('admin.categories') ? 'active' : ' '}}" data-target="categories">
            <i class="fa-light fa-tags"></i>
            <span>Categories</span>
        </a>
        <a href="{{ route('admin.users') }}" class="menu-item {{request()->routeIs('admin.users') ? 'active' : ' '}}"  data-target="users">
            <i class="fa-light fa-users"></i>
            <span>Users</span>
{{--        </a>--}}
{{--        <a href="admin-comments.html" class="menu-item">--}}
{{--            <i class="fa-light fa-comments"></i>--}}
{{--            <span>Comments</span>--}}
{{--        </a>--}}
            <a href="javascript:void(0)" class="menu-item has-submenu">
                <i class="fa-light fa-gears"></i>
                <span>Settings</span>
                <i class="fa-solid fa-chevron-down toggle-icon"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a
                       class="{{ request()->routeIs('admin.settings.profile') ? 'active' : '' }}">
                        Profile
                    </a>
                </li>
                <li>
                    <a
                       class="{{ request()->routeIs('admin.settings.website') ? 'active' : '' }}">
                        Website
                    </a>
                </li>
                <li>
                    <a
                       class="{{ request()->routeIs('admin.settings.security') ? 'active' : '' }}">
                        Security
                    </a>
                </li>
            </ul>

    </div>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">{{ auth()->user()->full_name[0] }}</div>
            <div class="user-info">
                <h4>{{auth()->user()->full_name}}</h4>
                <p>Administrator</p>
            </div>
        </div>
    </div>
</aside>
<script>
    document.querySelectorAll('.has-submenu').forEach(item => {
        item.addEventListener('click', function () {

            document.querySelectorAll('.menu-item.has-submenu').forEach(el => {
                if (el !== this) el.classList.remove('open');
            });
            this.classList.toggle('open');
        });
    });
</script>

<script>
    const NotAllowed = document.querySelectorAll('.coming-soon');
    NotAllowed.forEach(item => {
        item.classList.add('disabled');
        item.setAttribute('href', '#');
        item.setAttribute('tabindex', '-1');
        item.setAttribute('aria-disabled', 'true');
        item.setAttribute('aria-hidden', 'true');
    })

</script>
