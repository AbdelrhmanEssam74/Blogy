<div class="nav-wrap">
    <div class="container d-flex justify-content-center position-relative">
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('home')}}" class="active">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="{{route('categories.index')}}">Category</a></li>
                <li><a href="contact.html">Contact</a></li>
                @if(!auth()->user())
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">{{auth()->user()->full_name}}</a>
                        <ul class="dropdown-menu">
                            {{--                                <li><a href="{{route('profile.show')}}">Profile</a></li>--}}
                            {{--                                <li><a href="{{route('posts.create')}}">Create Post</a></li>--}}
                            <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
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
