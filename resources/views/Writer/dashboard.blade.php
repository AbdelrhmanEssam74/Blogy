@extends('app.dashboards.writer_layout')

@section('title', 'Writer Dashboard')
@section('content')
    <!-- Dashboard Header -->
    <header class="luxury-dashboard-header">
        <div class="container">
            <h1 class="luxury-dashboard-title ">Welcome {{auth()->user()->full_name}}</h1>
            <p class="luxury-dashboard-subtitle">Manage your content and track your performance</p>
        </div>
    </header>

    <div class="luxury-dashboard-container">
        <x-writer_sidebar></x-writer_sidebar>
        <div class="luxury-dashboard">
            <!-- Main Content -->
            <main class="container p-4 luxury-dashboard-content">
                <!-- Stats Overview -->
                <div class="luxury-stats-grid">
                    <div class="luxury-stat-card">
                        <div class="luxury-stat-icon">
                            <i class="fa-light fa-file-lines"></i>
                        </div>
                        <div class="luxury-stat-content">
                            <h3 class="luxury-stat-value">24</h3>
                            <p class="luxury-stat-label">Published Articles</p>
                        </div>
                    </div>

                    <div class="luxury-stat-card">
                        <div class="luxury-stat-icon">
                            <i class="fa-duotone fa-solid fa-eye"></i>
                        </div>
                        <div class="luxury-stat-content">
                            <h3 class="luxury-stat-value">18.7K</h3>
                            <p class="luxury-stat-label">Total Views</p>
                        </div>
                    </div>

                    <div class="luxury-stat-card">
                        <div class="luxury-stat-icon">
                            <i class="fa-light fa-circle-heart"></i>
                        </div>
                        <div class="luxury-stat-content">
                            <h3 class="luxury-stat-value">892</h3>
                            <p class="luxury-stat-label">Engagements</p>
                        </div>
                    </div>

                    <div class="luxury-stat-card">
                        <div class="luxury-stat-icon">
                            <i class="fa-regular fa-clock-rotate-left"></i>
                        </div>
                        <div class="luxury-stat-content">
                            <h3 class="luxury-stat-value">3</h3>
                            <p class="luxury-stat-label">Drafts</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Articles -->
                <section class="luxury-section">
                    <div class="luxury-section-header">
                        <h2 class="luxury-section-title">Recent Articles</h2>
                        <a href="/articles/create" class="luxury-btn primary">
                            <i class="bi bi-plus-circle me-2"></i>New Article
                        </a>
                    </div>

                    <div class="luxury-articles-table">
                        <div class="luxury-table-header">
                            <div class="luxury-table-row">
                                <div class="luxury-table-cell" style="flex: 3">Title</div>
                                <div class="luxury-table-cell">Status</div>
                                <div class="luxury-table-cell">Views</div>
                                <div class="luxury-table-cell">Created</div>
                                <div class="luxury-table-cell">Actions</div>
                            </div>
                        </div>

                        <div class="luxury-table-body">
                            @foreach($recentArticles as $article)
                                <div class="luxury-table-row">
                                    <div class="luxury-table-cell" style="flex: 3">
                                        <a href="/articles/{{ $article->slug }}" class="luxury-article-link">
                                            {{ $article->title }}
                                        </a>
                                    </div>
                                    <div class="luxury-table-cell">
                            <span
                                class="luxury-status-badge {{ $article->status === 'published' ? 'published' : 'draft' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                                    </div>
                                    <div class="luxury-table-cell">{{ number_format($article->views) }}</div>
                                    <div class="luxury-table-cell">{{ $article->created_at->format('M d, Y') }}</div>
                                    <div class="luxury-table-cell">
                                        <div class="luxury-actions">
                                            <a href="/articles/{{ $article->article_id }}/edit"
                                               class="luxury-action-btn" title="Edit">
                                                <i class="fa-light fa-pen-to-square"></i>
                                            </a>
                                            <a href="/articles/{{ $article->slug }}" class="luxury-action-btn"
                                               title="View">
                                                <i class="fa-light fa-eye"></i>
                                            </a>
                                            <form action="/articles/{{ $article->article_id }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="luxury-action-btn danger" title="Delete"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fa-light fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="luxury-view-all">
                        <a href="/articles" class="luxury-btn link">View All Articles <i
                                class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </section>

{{--                <!-- Performance Charts -->--}}
{{--                <section class="luxury-section">--}}
{{--                    <div class="luxury-section-header">--}}
{{--                        <h2 class="luxury-section-title">Performance Analytics</h2>--}}
{{--                        <div class="luxury-time-filter">--}}
{{--                            <button class="luxury-time-btn active">7D</button>--}}
{{--                            <button class="luxury-time-btn">30D</button>--}}
{{--                            <button class="luxury-time-btn">90D</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="luxury-charts-grid">--}}
{{--                        <div class="luxury-chart-card">--}}
{{--                            <h3 class="luxury-chart-title">Views Over Time</h3>--}}
{{--                            <div class="luxury-chart-container">--}}
{{--                                <canvas id="viewsChart" height="300"></canvas>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        --}}{{--                    <div class="luxury-chart-card">--}}
{{--                        --}}{{--                        <h3 class="luxury-chart-title">Top Performing Articles</h3>--}}
{{--                        --}}{{--                        <div class="luxury-top-articles">--}}
{{--                        --}}{{--                            @foreach($topArticles as $article)--}}
{{--                        --}}{{--                                <div class="luxury-top-article">--}}
{{--                        --}}{{--                                    <div class="luxury-top-article-info">--}}
{{--                        --}}{{--                                        <h4>{{ $article->title }}</h4>--}}
{{--                        --}}{{--                                        <p>{{ number_format($article->views) }} views • {{ $article->engagement_rate }}% engagement</p>--}}
{{--                        --}}{{--                                    </div>--}}
{{--                        --}}{{--                                    <div class="luxury-top-article-views">--}}
{{--                        --}}{{--                                        <div class="luxury-progress-bar" style="width: {{ $article->views_percentage }}%"></div>--}}
{{--                        --}}{{--                                    </div>--}}
{{--                        --}}{{--                                </div>--}}
{{--                        --}}{{--                            @endforeach--}}
{{--                        --}}{{--                        </div>--}}
{{--                        --}}{{--                    </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
            </main>
        </div>
    </div>

    <style>
        :root {
            --luxury-gold: #c9a668;
            --luxury-dark: #1a1a1a;
            --luxury-light: #f8f5f0;
            --luxury-border: #e0d6c2;
            --luxury-text: #333333;
            --luxury-meta: #6c757d;
            --luxury-success: #2e7d32;
            --luxury-warning: #ed6c02;
        }

        .luxury-dashboard-container {
            display: flex;
            max-width: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100vh;
        }


        /* Dashboard takes remaining space */
        .luxury-dashboard {
            flex: 1; /* Fill available space */
            background-color: white;
            color: var(--luxury-text);
        }

        .luxury-dashboard {

            background-color: white;
            color: var(--luxury-text);
            min-height: 100vh;
        }

        .luxury-dashboard-header {
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            padding: 3rem 0;
            border-bottom: 1px solid var(--luxury-border);
        }

        .luxury-dashboard-title {
            color: var(--luxury-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .luxury-dashboard-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--luxury-meta);
            font-size: 1.1rem;
        }

        .luxury-dashboard-content {
            padding: 2rem 0 4rem;
        }

        .luxury-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .luxury-stat-card {
            background-color: white;
            border: 1px solid var(--luxury-border);
            border-radius: 8px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .luxury-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .luxury-stat-icon {
            width: 50px;
            height: 50px;
            background-color: var(--luxury-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            color: var(--luxury-gold);
            font-size: 1.25rem;
        }

        .luxury-stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--luxury-dark);
            margin-bottom: 0.25rem;
            line-height: 1;
        }

        .luxury-stat-label {
            color: var(--luxury-meta);
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .luxury-section {
            margin-bottom: 3rem;
        }

        .luxury-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .luxury-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--luxury-dark);
            margin-bottom: 0;
        }

        .luxury-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .luxury-btn.primary {
            background-color: var(--luxury-dark);
            color: white;
        }

        .luxury-btn.primary:hover {
            background-color: var(--luxury-gold);
            color: var(--luxury-dark);
        }

        .luxury-btn.link {
            color: var(--luxury-dark);
            background: transparent;
            padding: 0;
        }

        .luxury-btn.link:hover {
            color: var(--luxury-gold);
        }

        .luxury-articles-table {
            border: 1px solid var(--luxury-border);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .luxury-table-header {
            background-color: var(--luxury-light);
            border-bottom: 1px solid var(--luxury-border);
        }

        .luxury-table-row {
            display: flex;
            padding: 1rem 1.5rem;
        }

        .luxury-table-cell {
            flex: 1;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .luxury-table-body .luxury-table-row {
            border-bottom: 1px solid var(--luxury-border);
            transition: background-color 0.2s ease;
        }

        .luxury-table-body .luxury-table-row:last-child {
            border-bottom: none;
        }

        .luxury-table-body .luxury-table-row:hover {
            background-color: var(--luxury-light);
        }

        .luxury-article-link {
            color: var(--luxury-dark);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .luxury-article-link:hover {
            color: var(--luxury-gold);
        }

        .luxury-status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .luxury-status-badge.published {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--luxury-success);
        }

        .luxury-status-badge.draft {
            background-color: rgba(237, 108, 2, 0.1);
            color: var(--luxury-warning);
        }

        .luxury-actions {
            display: flex;
            gap: 0.75rem;
        }

        .luxury-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            border: 1px solid var(--luxury-border);
            color: var(--luxury-dark);
            transition: all 0.2s ease;
        }

        .luxury-action-btn:hover {
            background-color: var(--luxury-dark);
            color: white;
            border-color: var(--luxury-dark);
        }

        .luxury-action-btn.danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .luxury-view-all {
            text-align: right;
        }

        .luxury-time-filter {
            display: flex;
            gap: 0.5rem;
        }

        .luxury-time-btn {
            padding: 0.35rem 0.75rem;
            background-color: transparent;
            border: 1px solid var(--luxury-border);
            border-radius: 4px;
            font-size: 0.8rem;
            color: var(--luxury-meta);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .luxury-time-btn.active {
            background-color: var(--luxury-dark);
            color: white;
            border-color: var(--luxury-dark);
        }

        .luxury-charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .luxury-chart-card {
            background-color: white;
            border: 1px solid var(--luxury-border);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .luxury-chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .luxury-chart-container {
            height: 300px;
        }

        .luxury-top-articles {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .luxury-top-article {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .luxury-top-article-info h4 {
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .luxury-top-article-info p {
            font-size: 0.8rem;
            color: var(--luxury-meta);
            margin-bottom: 0;
        }

        .luxury-top-article-views {
            height: 6px;
            background-color: var(--luxury-light);
            border-radius: 3px;
            overflow: hidden;
        }

        .luxury-progress-bar {
            height: 100%;
            background-color: var(--luxury-gold);
        }

        @media (max-width: 992px) {
            .luxury-charts-grid {
                grid-template-columns: 1fr;
            }

            .luxury-table-cell {
                font-size: 0.8rem;
            }

            .luxury-actions {
                gap: 0.5rem;
            }

            .luxury-action-btn {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            .luxury-stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .luxury-table-row {
                flex-wrap: wrap;
                padding: 0.75rem;
            }

            .luxury-table-cell {
                flex: 0 0 50%;
                margin-bottom: 0.5rem;
            }

            .luxury-table-cell:last-child {
                flex: 0 0 100%;
                justify-content: flex-end;
            }
        }

        @media (max-width: 576px) {
            .luxury-stats-grid {
                grid-template-columns: 1fr;
            }

            .luxury-section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Views Chart
        const viewsCtx = document.getElementById('viewsChart').getContext('2d');
        const viewsChart = new Chart(viewsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Article Views',
                    data: [1200, 1900, 1500, 2400, 2100, 3200],
                    borderColor: '#c9a668',
                    backgroundColor: 'rgba(201, 166, 104, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Time filter functionality
        document.querySelectorAll('.luxury-time-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.luxury-time-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Here you would typically fetch new data based on the selected time period
                // For this example, we'll just update the chart with random data
                const newData = Array(6).fill().map(() => Math.floor(Math.random() * 4000));
                viewsChart.data.datasets[0].data = newData;
                viewsChart.update();
            });
        });
    </script>
@endsection
