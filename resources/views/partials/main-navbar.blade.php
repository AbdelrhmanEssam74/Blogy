<div class="nav-wrap">
    <div class="container d-flex justify-content-center position-relative">
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('home')}}"  class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}"  class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"   >Categories</a>
                    <ul class="dropdown-menu">
                        @php($categories=\App\Models\Category::all())
                        @foreach($categories as $category)
                            <li><a href="{{ route('categories.index' , $category->slug) }}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('contact') }}"  class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                @if(!auth()->user())
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">{{auth()->user()->full_name}}</a>
                        <ul class="dropdown-menu">
                            @if(auth()->user()->role_id===3)
                                <li><a href="{{ route('writer.dashboard')}}">Dashboard</a></li>
                            @endif
                            @if(auth()->user()->role_id===1)
                                <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                            @endif
                            <li><a href="{{route('logout')}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endif
            </ul>
            <i class="mobile-nav-toggle  d-xl-none fa-regular fa-bars"></i>
        </nav>
    </div>
</div>
