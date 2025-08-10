<aside class="sidebar">
    <div class="sidebar-header">
        <h2>MyBlog</h2>
        <p>{{ auth()->user()->full_name }} Dashboard</p>
    </div>

    <div class="sidebar-menu" id="sidebarMenu">
        <a href="{{ route('writer.dashboard') }}"
           class="menu-item {{ request()->routeIs('writer.dashboard') ? 'active' : '' }}" data-target="dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('writer.create') }}"
           class="menu-item {{ request()->routeIs('writer.create') ? 'active' : '' }}" data-target="new-post">
            <i class="fas fa-pen"></i>
            <span>New Article</span>
        </a>
        <a href="{{ route('writer.articles') }}"
           class="menu-item  {{ request()->routeIs('writer.articles') ? 'active' : '' }}" data-target="posts">
            <i class="fas fa-file-alt"></i>
            <span>Articles</span>
        </a>
        {{-- will avilable in v1.1--}}
        {{--        <a href="#" class="menu-item coming-soon" title="Will Available Soon" data-target="analytics">--}}
        {{--            <i class="fas fa-chart-line"></i>--}}
        {{--            <span>Analytics</span>--}}
        {{--        </a>--}}

        {{--        <a href="#" class="menu-item " data-target="comments">--}}
        {{--            <i class="fas fa-comments"></i>--}}
        {{--            <span>Comments</span>--}}
        {{--        </a>--}}
        {{--        <a href="#" class="menu-item " data-target="categories">--}}
        {{--            <i class="fas fa-tags"></i>--}}
        {{--            <span>Categories</span>--}}
        {{--        </a>--}}
        {{--        <a href="#" class="menu-item " data-target="subscribers">--}}
        {{--            <i class="fas fa-users"></i>--}}
        {{--            <span>Subscribers</span>--}}
        {{--        </a>--}}
        <a href="{{ route('writer.profile') }}"
           class="menu-item  {{ request()->routeIs('writer.profile') ? 'active' : '' }}" data-target="settings">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">{{ substr(auth()->user()->full_name, 0, 1) }}</div>
            <div class="user-info">
                <h4>{{ auth()->user()->full_name }}</h4>
                <p>
                    @if(auth()->user()->role_id === 3)
                        Writer
                    @elseif(auth()->user()->role_id === 2)
                        Author
                    @endif
                </p>
            </div>
        </div>
    </div>
</aside>

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
