
@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="hero-blog text-white section" role="banner" aria-label="Blog Hero">
            <div class="container position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">
                            Mithila Tech Insights
                        </h1>
                        <p class="lead mb-5 animate__animated animate__fadeIn animate__delay-1s">
                            Discover the latest trends, innovations, and expert perspectives in IT and digital transformation
                        </p>
                        <div class="animate__animated animate__fadeIn animate__delay-2s">
                            <a href="#posts" class="btn btn-primary btn-lg me-3 smooth-scroll">Explore Articles</a>
                            <a href="#subscribe" class="btn btn-outline-light btn-lg smooth-scroll">Get Updates</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Posts Section -->
        <section class="section bg-light" id="posts" role="region" aria-label="Latest Articles">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Latest Articles</h2>
                    <p class="lead text-muted">Expert knowledge from our IT professionals</p>
                </div>

                <div class="row g-4">
                    @forelse($posts as $post)
                        <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp">
                            <div class="card blog-card h-100">
                                <div class="card-img-top" style="background-image: url('{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/300x200' }}');"></div>
                                <div class="card-body p-4">
                                    <div class="d-flex mb-3">
                                        @if($post->category)
                                            <span class="badge bg-primary me-2">{{ $post->category }}</span>
                                        @endif
                                        @if($post->tags)
                                            @foreach(explode(',', $post->tags) as $tag)
                                                <span class="badge bg-teal">{{ trim($tag) }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <h4 class="mb-3">{{ $post->title }}</h4>
                                    <p class="text-muted">
                                        {{ Str::limit($post->content, 100) }}
                                    </p>
                                    <div class="d-flex align-items-center mt-4">
                                        <img src="{{ $post->author_image ?? 'https://via.placeholder.com/40' }}" alt="{{ $post->author ?? 'Author' }}" class="rounded-circle me-3" width="40" height="40" loading="lazy">
                                        <div>
                                            <small class="text-muted">{{ $post->author ?? 'Mithila Tech' }}</small><br>
                                            <small class="text-primary">{{ $post->published_at ? $post->published_at->format('F j, Y') : now()->format('F j, Y') }} • {{ $post->read_time ?? '5' }} min read</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">Read Article <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No articles available at this time.</p>
                        </div>
                    @endforelse
                </div>

                @if($posts->hasPages())
                    <div class="text-center mt-5">
                        {{ $posts->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </section>

        <!-- Featured Post Section -->
        <section class="section bg-teal-50" id="featured" role="region" aria-label="Editor's Pick">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Editor's Pick</h2>
                    <p class="lead text-muted">Featured content from our experts</p>
                </div>

                @if($featured = $posts->first())
                    <div class="row g-4 align-items-center animate__animated animate__fadeInUp">
                        <div class="col-lg-6">
                            <div class="featured-post-img" style="background-image: url('{{ $featured->image ? asset($featured->image) : 'https://via.placeholder.com/600x400' }}');"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    @if($featured->category)
                                        <span class="badge bg-primary me-2">{{ $featured->category }}</span>
                                    @endif
                                    @if($featured->tags)
                                        @foreach(explode(',', $featured->tags) as $tag)
                                            <span class="badge bg-teal">{{ trim($tag) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <h2 class="mb-3">{{ $featured->title }}</h2>
                                <p class="lead mb-4">
                                    {{ Str::limit($featured->content, 150) }}
                                </p>
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ $featured->author_image ?? 'https://via.placeholder.com/50' }}" alt="{{ $featured->author ?? 'Author' }}" class="rounded-circle me-3" width="50" height="50" loading="lazy">
                                    <div>
                                        <h6 class="mb-0">{{ $featured->author ?? 'Mithila Tech' }}</h6>
                                        <small class="text-muted">{{ $featured->author_title ?? 'Contributor' }}</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-3"><i class="bi bi-calendar me-1"></i> {{ $featured->published_at ? $featured->published_at->format('F j, Y') : now()->format('F j, Y') }}</small>
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $featured->read_time ?? '10' }} min read</small>
                                </div>
                                <a href="{{ route('blog.show', $featured->slug) }}" class="btn btn-primary mt-4">Read Full Article</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <p class="text-muted">No featured article available at this time.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Categories Section -->
        <section class="section" role="region" aria-label="Explore by Topic">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Explore by Topic</h2>
                    <p class="lead text-muted">Browse our content by category</p>
                </div>

                <div class="row g-4 animate__animated animate__fadeIn">
                    @foreach(['Cloud Computing' => 'bi-cloud', 'Cybersecurity' => 'bi-shield-lock', 'AI/ML' => 'bi-robot', 'Data' => 'bi-database', 'Development' => 'bi-code-slash', 'Innovation' => 'bi-lightbulb'] as $category => $icon)
                        <div class="col-6 col-md-4 col-lg-2">
                            <a href="{{ route('blog.category', Str::slug($category)) }}" class="category-card">
                                <div class="category-icon bg-{{ Str::slug($category) }}">
                                    <i class="bi {{ $icon }}"></i>
                                </div>
                                <h6 class="mt-3 text-center">{{ $category }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section bg-dark text-white" id="subscribe" role="region" aria-label="Subscribe">
            <div class="container text-center">
                <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInDown">Stay Informed</h2>
                <p class="lead mb-5 animate__animated animate__fadeInUp">
                    Get the latest tech insights from Mithila Tech delivered to your inbox
                </p>
                <div class="animate__animated animate__zoomIn">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">{{ session('success') }}</div>
                    @endif
                    @if($errors->has('email'))
                        <div class="alert alert-danger mb-4">{{ $errors->first('email') }}</div>
                    @endif
                    <form class="row g-3 justify-content-center" action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Your email address" value="{{ old('email') }}" required aria-label="Email address">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Subscribe</button>
                        </div>
                    </form>
                    <small class="text-muted mt-2 d-block">We'll never share your email. Unsubscribe anytime.</small>
                </div>
            </div>
        </section>
    </div>

    <!-- External Styles and Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- JavaScript for dynamic datetime and smooth scrolling -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update datetime in footer (Asia/Kolkata)
        function updateDateTime() {
            const now = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Kolkata',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZoneName: 'short'
            });
            document.getElementById('datetime').textContent = now;
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);

        // Smooth scrolling for anchor links
        document.querySelectorAll('.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__fadeIn');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate__animated').forEach(element => {
            observer.observe(element);
        });
    });
    </script>

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #4895ef;
            --teal-color: #4cc9f0;
            --purple-color: #7209b7;
            --orange-color: #f8961e;
            --pink-color: #f72585;
            --dark-color: #1a1a2e;
            --darker-color: #16213e;
            --light-color: #f8f9fa;
            --text-color: #2b2d42;
            --text-light: #8d99ae;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
            background-color: var(--light-color);
        }

        h1, h2, h3, h4 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        .hero-blog {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--secondary-color) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-blog::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/web.jpg') no-repeat center center;
            background-size: cover;
            opacity: 0.3;
            z-index: 0;
        }

        .section {
            padding: 4rem 0;
            position: relative;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .blog-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .blog-card .card-img-top {
            height: 200px;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .featured-post-img {
            height: 400px;
            border-radius: 12px;
            background-size: cover;
            background-position: center;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-card {
            display: block;
            text-decoration: none;
            color: var(--text-color);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin: 0 auto;
            color: white;
            font-size: 1.75rem;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .bg-primary { background-color: var(--primary-color) !important; }
        .bg-purple { background-color: var(--purple-color) !important; }
        .bg-orange { background-color: var(--orange-color) !important; }
        .bg-teal { background-color: var(--teal-color) !important; }
        .bg-indigo { background-color: var(--secondary-color) !important; }
        .bg-pink { background-color: var(--pink-color) !important; }
        .bg-dark { background-color: var(--dark-color) !important; }
        .bg-darker { background-color: var(--darker-color) !important; }
        .bg-teal-50 { background-color: rgba(76, 201, 240, 0.05); }

        .text-primary { color: var(--primary-color) !important; }
        .text-teal { color: var(--teal-color) !important; }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .section {
                padding: 2rem 0;
            }

            .hero-blog h1 {
                font-size: 2rem;
            }

            .hero-blog .lead {
                font-size: 1rem;
            }

            .featured-post-img {
                height: 250px;
                margin-bottom: 1.5rem;
            }

            .blog-card, .category-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
