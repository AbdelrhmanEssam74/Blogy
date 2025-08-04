@section('header')
    <header id="header" class="header position-relative">
    <div class="container-fluid container-xl position-relative">

        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{route('home')}}" class="logo d-flex align-items-end">
                <h1 class="sitename">Blogy</h1><span>.</span>
            </a>

            <div class="d-flex align-items-center">
                <div class="social-links">
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                </div>

                <form class="search-form ms-4">
                    <input type="text" placeholder="Search..." class="form-control">
                    <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>

    </div>
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
    </header>

@endsection
