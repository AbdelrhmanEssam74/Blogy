@extends('app.layout')

@section('description')
    View the article "{{ $article->title }}" on {{ config('app.name') }}. Read in-depth content, insights, and expert opinions on various topics.
@endsection

@section('title' , 'Search Results | ' . $article->slug)

@section('header')
    <header id="header" class="header position-relative">
        @include('partials.upper-navbar')
        @include('partials.main-navbar')
    </header>
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('categories.index' , $article->category->slug) }}">Category</a></li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Blog Details</h1>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container" data-aos="fade-up">
                            <article class="article">
                                <div class="hero-img" data-aos="zoom-in">
                                    <img src="{{asset('storage/' . $article->image)}}" alt="Featured blog image"
                                         class="img-fluid" loading="lazy">
                                    <div class="meta-overlay">
                                        <div class="meta-categories">
                                            <a href="{{ route('categories.index' , $article->category->slug) }}"
                                               class="category">{{$article->category->name}}</a>
                                            {{--<span class="divider">•</span>--}}
                                            {{--<span class="reading-time"><i class="bi bi-clock"></i> 6 min read</span>--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                    <div class="content-header">
                                        <h1 class="title">{{$article->title}}</h1>

                                        <div class="author-info">
                                            <div class="author-details">
                                                <img
                                                    src="{{asset('storage/' . $article->user->writer_profile->profile_picture)}}"
                                                    alt="Author" class="author-img">
                                                <div class="info">
                                                    <h4>{{$article->user->full_name}}</h4>
                                                    {{--                                                    <span class="role">Senior Web Developer</span>--}}
                                                </div>
                                            </div>
                                            <div class="post-meta">
                                                <span class="date"><i class="bi bi-calendar3"></i>  {{\Carbon\Carbon::parse($article->created_at)->format('M d, Y')}}</span>
                                                <span class="divider">•</span>
                                                {{--                                                <span class="comments"><i class="bi bi-chat-text"></i> 18 Comments</span>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="lead">
                                            {{$article->content}}
                                        </p>
                                    </div>
                                </div>

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->

                    <!-- Blog Author Section -->
                    <section id="blog-author" class="blog-author section">

                        <div class="container" data-aos="fade-up">
                            <div class="author-box">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-4 text-center">
                                        <img
                                            src="{{asset('storage/' . $article->user->writer_profile->profile_picture)}}"
                                            class="author-img rounded-circle"
                                            alt="" loading="lazy">

                                        {{--
                                        {"facebook":"https:\/\/facebook.com\/writer1",
                                        "twitter":"https:\/\/x.com\/writer1",
                                        "linkedin":"https:\/\/linkedin.com\/in\/writer1"}
                                        --}}


                                        @php
                                            $links = $article->user->writer_profile->social_media_links;
                                            $icons = [
                                                'facebook' => 'fa-square-facebook',
                                                'twitter' => 'fa-x-twitter',
                                                'linkedin' => 'fa-linkedin',
                                                'github' => 'fa-square-github',
                                                'instagram' => 'fa-square-instagram',
                                            ];
                                        @endphp

                                        <div class="author-social-links mt-3">
                                            @foreach($links as $platform => $url)
                                                @if(!empty($url) && isset($icons[$platform]))
                                                    <a href="{{ $url }}" class="{{ $platform }}" target="_blank">
                                                        <i class="fa-brands {{ $icons[$platform] }}"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-9 col-md-8">
                                        <div class="author-content">
                                            <h3 class="author-name">{{$article->user->full_name}}</h3>

                                            {{-- <span  class="author-title">Senior Tech Writer &amp; Developer Advocate</span>--}}

                                            <div class="author-bio mt-3">
                                                {{$article->user->writer_profile->bio}}
                                            </div>

                                            <div class="author-website mt-3">
                                                <a href="{{$article->user->writer_profile->website}}" target="_blank"
                                                   class="website-link">
                                                    <i class="fa-light fa-globe-pointer"></i>
                                                    <span>  {{$article->user->writer_profile->website}}</span>
                                                </a>
                                                <a href="#" class="more-posts">
                                                    Read More from {{$article->user->full_name}} <i
                                                        class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section><!-- /Blog Author Section -->

                    <!-- Blog Comments Section -->
                    {{--                    <section id="blog-comments" class="blog-comments section">--}}

                    {{--                        <div class="container" data-aos="fade-up" data-aos-delay="100">--}}

                    {{--                            <div class="blog-comments-3">--}}
                    {{--                                <div class="section-header">--}}
                    {{--                                    <h3>Discussion <span class="comment-count">(8)</span></h3>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="comments-wrapper">--}}
                    {{--                                    <!-- Comment 1 -->--}}
                    {{--                                    <article class="comment-card">--}}
                    {{--                                        <div class="comment-header">--}}
                    {{--                                            <div class="user-info">--}}
                    {{--                                                <img src="assets/img/person/person-f-9.webp" alt="User avatar"--}}
                    {{--                                                     loading="lazy">--}}
                    {{--                                                <div class="meta">--}}
                    {{--                                                    <h4 class="name">Sarah Williams</h4>--}}
                    {{--                                                    <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-content">--}}
                    {{--                                            <p>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum--}}
                    {{--                                                suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh--}}
                    {{--                                                et. Maecen aliquam, risus at semper.</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-actions">--}}
                    {{--                                            <button class="action-btn like-btn">--}}
                    {{--                                                <i class="bi bi-hand-thumbs-up"></i>--}}
                    {{--                                                <span>12</span>--}}
                    {{--                                            </button>--}}
                    {{--                                            <button class="action-btn reply-btn">--}}
                    {{--                                                <i class="bi bi-reply"></i>--}}
                    {{--                                                <span>Reply</span>--}}
                    {{--                                            </button>--}}
                    {{--                                        </div>--}}
                    {{--                                    </article>--}}

                    {{--                                    <!-- Comment 2 with replies -->--}}
                    {{--                                    <article class="comment-card">--}}
                    {{--                                        <div class="comment-header">--}}
                    {{--                                            <div class="user-info">--}}
                    {{--                                                <img src="assets/img/person/person-m-9.webp" alt="User avatar"--}}
                    {{--                                                     loading="lazy">--}}
                    {{--                                                <div class="meta">--}}
                    {{--                                                    <h4 class="name">James Cooper</h4>--}}
                    {{--                                                    <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-content">--}}
                    {{--                                            <p>Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis, convallis--}}
                    {{--                                                in, nisi. Suspendisse non nisl sit amet velit hendrerit rutrum. Ut leo.--}}
                    {{--                                                Ut a nisl id ante tempus hendrerit.</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-actions">--}}
                    {{--                                            <button class="action-btn like-btn">--}}
                    {{--                                                <i class="bi bi-hand-thumbs-up"></i>--}}
                    {{--                                                <span>8</span>--}}
                    {{--                                            </button>--}}
                    {{--                                            <button class="action-btn reply-btn">--}}
                    {{--                                                <i class="bi bi-reply"></i>--}}
                    {{--                                                <span>Reply</span>--}}
                    {{--                                            </button>--}}
                    {{--                                        </div>--}}

                    {{--                                        <!-- Reply Thread -->--}}
                    {{--                                        <div class="reply-thread">--}}
                    {{--                                            <!-- Reply 1 -->--}}
                    {{--                                            <article class="comment-card reply">--}}
                    {{--                                                <div class="comment-header">--}}
                    {{--                                                    <div class="user-info">--}}
                    {{--                                                        <img src="assets/img/person/person-f-9.webp" alt="User avatar"--}}
                    {{--                                                             loading="lazy">--}}
                    {{--                                                        <div class="meta">--}}
                    {{--                                                            <h4 class="name">Emily Parker</h4>--}}
                    {{--                                                            <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="comment-content">--}}
                    {{--                                                    <p>Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante--}}
                    {{--                                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia--}}
                    {{--                                                        Curae.</p>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="comment-actions">--}}
                    {{--                                                    <button class="action-btn like-btn">--}}
                    {{--                                                        <i class="bi bi-hand-thumbs-up"></i>--}}
                    {{--                                                        <span>5</span>--}}
                    {{--                                                    </button>--}}
                    {{--                                                    <button class="action-btn reply-btn">--}}
                    {{--                                                        <i class="bi bi-reply"></i>--}}
                    {{--                                                        <span>Reply</span>--}}
                    {{--                                                    </button>--}}
                    {{--                                                </div>--}}
                    {{--                                            </article>--}}

                    {{--                                            <!-- Reply 2 -->--}}
                    {{--                                            <article class="comment-card reply">--}}
                    {{--                                                <div class="comment-header">--}}
                    {{--                                                    <div class="user-info">--}}
                    {{--                                                        <img src="assets/img/person/person-f-7.webp" alt="User avatar"--}}
                    {{--                                                             loading="lazy">--}}
                    {{--                                                        <div class="meta">--}}
                    {{--                                                            <h4 class="name">Daniel Brown</h4>--}}
                    {{--                                                            <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="comment-content">--}}
                    {{--                                                    <p>Nam commodo suscipit quam. Vestibulum ullamcorper mauris at--}}
                    {{--                                                        ligula. Fusce fermentum odio nec arcu.</p>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="comment-actions">--}}
                    {{--                                                    <button class="action-btn like-btn">--}}
                    {{--                                                        <i class="bi bi-hand-thumbs-up"></i>--}}
                    {{--                                                        <span>3</span>--}}
                    {{--                                                    </button>--}}
                    {{--                                                    <button class="action-btn reply-btn">--}}
                    {{--                                                        <i class="bi bi-reply"></i>--}}
                    {{--                                                        <span>Reply</span>--}}
                    {{--                                                    </button>--}}
                    {{--                                                </div>--}}
                    {{--                                            </article>--}}
                    {{--                                        </div>--}}
                    {{--                                    </article>--}}

                    {{--                                    <!-- Comment 3 -->--}}
                    {{--                                    <article class="comment-card">--}}
                    {{--                                        <div class="comment-header">--}}
                    {{--                                            <div class="user-info">--}}
                    {{--                                                <img src="assets/img/person/person-m-6.webp" alt="User avatar"--}}
                    {{--                                                     loading="lazy">--}}
                    {{--                                                <div class="meta">--}}
                    {{--                                                    <h4 class="name">Rachel Adams</h4>--}}
                    {{--                                                    <span class="date"><i class="bi bi-calendar3"></i> February 13, 2025</span>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-content">--}}
                    {{--                                            <p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean--}}
                    {{--                                                leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="comment-actions">--}}
                    {{--                                            <button class="action-btn like-btn">--}}
                    {{--                                                <i class="bi bi-hand-thumbs-up"></i>--}}
                    {{--                                                <span>6</span>--}}
                    {{--                                            </button>--}}
                    {{--                                            <button class="action-btn reply-btn">--}}
                    {{--                                                <i class="bi bi-reply"></i>--}}
                    {{--                                                <span>Reply</span>--}}
                    {{--                                            </button>--}}
                    {{--                                        </div>--}}
                    {{--                                    </article>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </section>--}}
                    <!-- /Blog Comments Section -->

                    <!-- Blog Comment Form Section -->
                    {{--                    <section id="blog-comment-form" class="blog-comment-form section">--}}

                    {{--                        <div class="container" data-aos="fade-up" data-aos-delay="100">--}}

                    {{--                            <form method="post" role="form">--}}

                    {{--                                <div class="section-header">--}}
                    {{--                                    <h3>Share Your Thoughts</h3>--}}
                    {{--                                    <p>Your email address will not be published. Required fields are marked *</p>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="row gy-3">--}}
                    {{--                                    <div class="col-md-6 form-group">--}}
                    {{--                                        <label for="name">Full Name *</label>--}}
                    {{--                                        <input type="text" name="name" class="form-control" id="name"--}}
                    {{--                                               placeholder="Enter your full name" required="">--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="col-md-6 form-group">--}}
                    {{--                                        <label for="email">Email Address *</label>--}}
                    {{--                                        <input type="email" name="email" class="form-control" id="email"--}}
                    {{--                                               placeholder="Enter your email address" required="">--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="col-12 form-group">--}}
                    {{--                                        <label for="website">Website</label>--}}
                    {{--                                        <input type="url" name="website" class="form-control" id="website"--}}
                    {{--                                               placeholder="Your website (optional)">--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="col-12 form-group">--}}
                    {{--                                        <label for="comment">Your Comment *</label>--}}
                    {{--                                        <textarea class="form-control" name="comment" id="comment" rows="5"--}}
                    {{--                                                  placeholder="Write your thoughts here..." required=""></textarea>--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="col-12 text-center">--}}
                    {{--                                        <button type="submit" class="btn-submit">Post Comment</button>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                            </form>--}}

                    {{--                        </div>--}}

                    {{--                    </section>--}}
                    <!-- /Blog Comment Form Section -->

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

                        </div>
                        <!--/Categories Widget -->

                        <!-- Recent Posts Widget -->
                        <div class="recent-posts-widget widget-item">

                            <h3 class="widget-title">Related Posts</h3>
                            @foreach($related_articles as $related)

                                <div class="post-item">
                                    <img src="{{asset('storage/' . $related->image)}}" alt=""
                                         class="flex-shrink-0 img-fluid">
                                    <div>
                                        <h4>
                                            <a href="{{ route('article.view' , $related->slug) }}">{{$related->title}}</a>
                                        </h4>
                                        <time
                                            datetime="2020-01-01">  {{\Carbon\Carbon::parse($related->published_at)->format('M d, Y')}}</time>
                                    </div>
                                </div>
                            @endforeach
                            @if(!count($related_articles))
                                <p class="no-items">No related articles found.</p>
                            @endif
                        </div>
                        <!--/Recent Posts Widget -->

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

