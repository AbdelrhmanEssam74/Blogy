@extends('app.layout')

@section('description')
    Search results for category {{ $category->name }} on {{ config('app.name') }}. Find articles, tutorials, and resources related to {{ $category->name }}.
@endsection

@section('title' , 'Search Results | ' . $category->slug)

@section('header')
    <header id="header" class="header position-relative">
        @include('partials.upper-navbar')
        @include('partials.main-navbar')
    </header>
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title position-relative">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Category</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>{{$category->name}} Category</h1>
                <p>
                    {{ $category->description }}
                </p>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Category Postst Section -->
                    <section id="category-postst" class="category-postst section">

                        <div class="container" data-aos="fade-up" data-aos-delay="100">
                            <div class="row gy-4">
                                @foreach($articles as $article)
                                    <div class="col-lg-6">
                                        <article>

                                            <div class="post-img">
                                                <img src="{{asset('storage/' . $article->image)}}" alt=""
                                                     class="img-fluid">
                                            </div>

                                            <p class="post-category">{{$category->name}}</p>

                                            <h2 class="title">
                                                <a href="">{{custom_strlen($article->content , 50)}}...</a>
                                            </h2>

                                            <div class="d-flex align-items-center">
                                                <img
                                                    src="{{asset('storage/' . $article->user->writer_profile->profile_picture)}}"
                                                    alt=""
                                                    class="img-fluid post-author-img flex-shrink-0">
                                                <div class="post-meta">
                                                    <p class="post-author">{{\Str::ucfirst( $article->user->full_name)}}</p>
                                                    <p class="post-date">
                                                        <time datetime="2022-01-01">
                                                            {{\Carbon\Carbon::parse($article->user->created_at)->format('M d, Y')}}</time>
                                                    </p>
                                                </div>
                                            </div>

                                        </article>
                                    </div><!-- End post list item -->
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <!-- /Category Postst Section -->
                    <div class="pagination">
                        {{ $articles->withQueryString()->onEachSide(1)->links('components.pagination_-v2') }}
                    </div>
                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">

                        <!-- Search Widget -->
                        {{--                        <div class="search-widget widget-item">--}}

                        {{--                            <h3 class="widget-title">Search</h3>--}}
                        {{--                            <form action="">--}}
                        {{--                                <input type="text">--}}
                        {{--                                <button type="submit" title="Search"><i class="bi bi-search"></i></button>--}}
                        {{--                            </form>--}}

                        {{--                        </div>--}}
                        <!--/Search Widget -->

                        <!-- Categories Widget -->
                        <div class="categories-widget widget-item">

                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                @foreach($allCategories as $cat)
                                    <li><a href="{{ route('categories.index' , $cat->slug) }}">
                                            {{$cat->name}} <span>({{$cat->articles_count}})</span>
                                        </a></li>
                                @endforeach
                            </ul>

                        </div><!--/Categories Widget -->

                        <!-- Recent Posts Widget -->
                        <div class="recent-posts-widget widget-item">

                            <h3 class="widget-title">Recent Posts</h3>
                            @foreach($recentArticles as $recent)

                                <div class="post-item">
                                    <img src="{{asset('storage/' . $recent->image)}}" alt="" class="flex-shrink-0 img-fluid">
                                    <div>
                                        <h4><a href="blog-details.html">{{$recent->title}}</a></h4>
                                        <time datetime="2020-01-01">  {{\Carbon\Carbon::parse($recent->published_at)->format('M d, Y')}}</time>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End recent post item-->

                        </div><!--/Recent Posts Widget -->

                        <!-- Tags Widget -->
                        {{--                        <div class="tags-widget widget-item">--}}

                        {{--                            <h3 class="widget-title">Tags</h3>--}}
                        {{--                            <ul>--}}
                        {{--                                <li><a href="#">App</a></li>--}}
                        {{--                                <li><a href="#">IT</a></li>--}}
                        {{--                                <li><a href="#">Business</a></li>--}}
                        {{--                                <li><a href="#">Mac</a></li>--}}
                        {{--                                <li><a href="#">Design</a></li>--}}
                        {{--                                <li><a href="#">Office</a></li>--}}
                        {{--                                <li><a href="#">Creative</a></li>--}}
                        {{--                                <li><a href="#">Studio</a></li>--}}
                        {{--                                <li><a href="#">Smart</a></li>--}}
                        {{--                                <li><a href="#">Tips</a></li>--}}
                        {{--                                <li><a href="#">Marketing</a></li>--}}
                        {{--                            </ul>--}}

                        {{--                        </div>--}}
                        <!--/Tags Widget -->

                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

