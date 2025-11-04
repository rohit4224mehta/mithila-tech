@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="hero-gradient text-white section" role="banner" aria-label="Media Center Hero">
            <div class="container position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">
                            Media Center
                        </h1>
                        <p class="lead mb-5 animate__animated animate__fadeIn animate__delay-1s">
                            Explore the latest news, press releases, and media coverage about Volera Technologies
                        </p>
                        <div class="animate__animated animate__fadeIn animate__delay-2s">
                            <a href="#highlights" class="btn btn-primary btn-lg me-3 smooth-scroll">View Highlights</a>
                            <a href="#press" class="btn btn-outline-light btn-lg smooth-scroll">Press Releases</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Media Highlights Section -->
        <section class="section bg-light" id="highlights" role="region" aria-label="Recent Highlights">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Recent Highlights</h2>
                    <p class="lead text-muted">Notable media coverage and achievements</p>
                </div>

                <div class="row g-4">
                    @forelse($highlights as $highlight)
                        <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp">
                            <div class="card card-service h-100">
                                <div class="card-body p-4">
                                    <div class="service-icon">
                                        <i class="bi {{ $highlight->type === 'highlight' ? 'bi-trophy' : 'bi-building' }}"></i>
                                    </div>
                                    <h4 class="mb-3">{{ $highlight->title }}</h4>
                                    <p class="text-muted">{{ $highlight->description }}</p>
                                    <div class="d-flex align-items-center mt-3">
                                        @if($highlight->image)
                                            <img src="{{ asset($highlight->image) }}" alt="{{ $highlight->source ?? 'Media' }} logo" class="rounded-circle me-3" width="40" height="40" loading="lazy">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <small class="text-muted">{{ $highlight->source ?? 'Volera Technologies' }}</small><br>
                                            <small class="text-primary">{{ $highlight->published_at->format('F j, Y') }}</small>
                                        </div>
                                    </div>
                                    @if($highlight->link)
                                        <a href="{{ $highlight->link }}" class="btn btn-sm btn-outline-primary mt-3" target="_blank" rel="noopener noreferrer">Read Article</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No highlights available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Press Releases Section -->
        <section class="section" id="press" role="region" aria-label="Press Releases">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Press Releases</h2>
                    <p class="lead text-muted">Official announcements and company news</p>
                </div>

                <div class="row g-4">
                    @forelse($pressReleases as $press)
                        <div class="col-md-6 animate__animated animate__fadeInUp">
                            <div class="testimonial-card">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary text-white rounded-circle p-3 me-3">
                                        <i class="bi {{ $press->type === 'press_release' ? 'bi-building' : 'bi-people' }}"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $press->title }}</h5>
                                        <small class="text-muted">{{ $press->published_at->format('F j, Y') }}</small>
                                    </div>
                                </div>
                                <p class="mb-3">{{ $press->description }}</p>
                                @if($press->tags)
                                    <div class="d-flex mb-3">
                                        @foreach(explode(',', $press->tags) as $tag)
                                            <span class="badge bg-primary me-2">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                @if($press->link)
                                    <a href="{{ asset($press->link) }}" class="btn btn-sm btn-outline-primary mt-3" download>Download PDF</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No press releases available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section media-inquiries-section text-white" style="background: url('{{ asset('images/incuery.jpg') }}') no-repeat center center/cover;" role="region" aria-label="Media Inquiries">
            <div class="container position-relative z-1">
                <div class="text-center">
                    <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInDown">Media Inquiries?</h2>
                    <p class="lead mb-5 animate__animated animate__fadeInUp">
                        Contact our press team for interviews, statements, or additional information
                    </p>
                    <div class="animate__animated animate__zoomIn">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 me-3">Contact Press Team</a>
                        <a href="{{ asset('downloads/media-kit.zip') }}" class="btn btn-outline-light btn-lg" download>Media Kit</a>
                    </div>
                </div>
            </div>
        </section>

        
    </div>

    <style>
:root {
    --primary-color: #2563eb;
    --secondary-color: #1e40af;
    --accent-color: #3b82f6;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --text-color: #334155;
    --text-light: #64748b;
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

.hero-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    position: relative;
    overflow: hidden;
}

.hero-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/images/media.jpg') no-repeat center center;
    background-size: cover;
    opacity: 0.15;
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

.card-service {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    height: 100%;
}

.card-service:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.service-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: white;
    font-size: 1.5rem;
}

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
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
}

.testimonial-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}

@media (max-width: 768px) {
    .section {
        padding: 2rem 0;
    }

    .hero-gradient h1 {
        font-size: 2rem;
    }

    .hero-gradient .lead {
        font-size: 1rem;
    }

    .card-service, .testimonial-card {
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
@endsection

<!-- External Styles and Scripts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
