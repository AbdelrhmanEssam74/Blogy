@extends('app.layout')

@section('title', 'Articles')

@section('content')
    <div class="container py-5">

        <!-- Hero Title -->
        <h1 class="fw-bold text-center mb-4">Discover Captivating Stories</h1>

        <!-- Banner Image -->
        <div class="mb-5">
            <img src="https://images.unsplash.com/photo-1432821596592-e2c18b78144f?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-100 rounded-3" style="height: 400px; object-fit: cover;" alt="Articles Banner">
        </div>

        <!-- Articles Grid -->
        <div class="row g-4">
            @foreach ($articles as $article)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-1 h-100 shadow-sm hover-card">

                        <!-- Article Image -->
                        <div class="position-relative" style="height: 200px;">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                 class="w-100 h-100 object-fit-cover" alt="{{ $article->title }}">

                            @if ($article->category)
                                <span class="badge bg-dark position-absolute top-0 start-0 m-2 px-3 py-1">
                                {{ $article->category->name }}
                            </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <small class="text-muted d-block mb-2">
                                {{ $article->created_at->format('F d, Y') }} • {{ rand(5, 50) }} min
                            </small>
                            <h5 class="fw-bold mb-2">{{ $article->title }}</h5>
                            <p class="text-secondary mb-0">{{ Str::limit($article->content, 120) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $articles->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <style>
        .object-fit-cover {
            object-fit: cover;
        }
        .hover-card {
            transition: all 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
        }
        .badge {
            font-size: 0.8rem;
            font-weight: 500;
            border-radius: 0;
        }
    </style>
@endsection
