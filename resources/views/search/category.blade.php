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
    <!-- Main Content -->
    <main class="main">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar: Categories Widget -->
                <div class="col-md-3">
                    <div class="categories-widget widget">
                        <h3>Other Categories</h3>
                        <ul class="category-list">
                            @foreach($allCategories as $cat)
                                <li>
                                    <a href="{{ route('categories.index', $cat->slug) }}"
                                       class="category-link">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="page-header">
                        <h1>{{ $category->name }} Articles</h1>
                        <p>Showing {{ $articles->count() }} articles in the {{ $category->name }} category</p>
                    </div>

                    <div class="articles-grid">
                        @foreach($articles as $article)
                            <article class="article-card">
                                <img src="{{asset('storage/' . $article->image)}}"
                                     loading="lazy"
                                     alt="{{$article->title}}"
                                     class="article-image">
                                <div class="article-content">
                                    <span class="article-category">{{ $category->name }}</span>
                                    <h3 class="article-title">
                                        <a href="#">{{$article->title}}</a>
                                    </h3>
                                    <p class="article-excerpt">{{custom_strlen($article->content , 100)}}...</p>
                                    <div class="article-meta">
                                        <span>By {{\Str::ucfirst($article->user->full_name)}}</span>
                                        <span>{{\Carbon\Carbon::parse($article->created_at)->format(' M d,  Y ')}}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        @if(!$articles->count())
                            <div class="no-articles">
                                <p>No articles found in this category.</p>
                            </div>
                        @endif
                    </div>


                    {{ $articles->withQueryString()->onEachSide(1)->links('components.pagination_-v2') }}

                </div>
            </div>
        </div>
    </main>


    <style>

        /* Main Content Styles */
        .main {
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        /* Sidebar Styles */
        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .categories-widget {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            position: sticky;
            top: 100px;
            margin-bottom: 2rem;
        }

        .categories-widget h3 {
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--border-color);
            color: var(--dark-text);
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .category-list {
            list-style: none;
        }

        .category-list li {
            margin-bottom: 0.5rem;
        }

        .category-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--dark-text);
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .category-link.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .category-link:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .category-link::before {
            content: "•";
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        /* Main Content Area */
        .col-md-9 {
            flex: 0 0 72%;
            max-width: 72%;
        }

        .page-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        }

        .page-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--dark-text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-header h1::before {
            content: "📰";
            font-size: 1.8rem;
        }

        .page-header p {
            color: var(--light-text);
            font-size: 1.1rem;
        }

        /* Articles Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 2rem;
        }

        .article-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-image {
            transform: scale(1.05);
        }

        .article-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .article-category {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            margin-bottom: 1rem;
            align-self: flex-start;
        }

        .article-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .article-title a {
            text-decoration: none;
            color: var(--dark-text);
            transition: color 0.3s ease;
        }

        .article-title a:hover {
            color: var(--primary-color);
        }

        .article-excerpt {
            color: var(--light-text);
            margin-bottom: 1.25rem;
            flex-grow: 1;
        }

        .article-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--light-text);
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        .article-meta span:first-child {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* No Articles State */
        .no-articles {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .no-articles p {
            font-size: 1.2rem;
            color: var(--light-text);
        }

        .no-articles::before {
            content: "📝";
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
        }


        /* Responsive Design */
        @media (max-width: 992px) {
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .col-md-9 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .categories-widget {
                position: static;
            }

            .category-list {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 10px;
            }

            .category-link:hover {
                transform: translateY(-2px);
            }
        }

        @media (max-width: 768px) {
            .articles-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 1.75rem;
            }
        }

        /* Animation for page load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .article-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .article-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .article-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .article-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .article-card:nth-child(5) {
            animation-delay: 0.4s;
        }

        .article-card:nth-child(6) {
            animation-delay: 0.5s;
        }
    </style>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

