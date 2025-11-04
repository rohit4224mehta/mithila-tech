@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-gradient text-white position-relative overflow-hidden" style="background-image: url('{{ $hero->background_image ?? asset('images/tech-bg.jpg') }}'); min-height: 70vh;">
            <div class="hero-overlay bg-dark opacity-50"></div>
            <div class="container position-relative z-1 py-5">
                <div class="row align-items-center min-vh-70">
                    <div class="col-12 text-center">
                        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">{{ $hero->title ?? 'Our Innovative Solutions' }}</h1>
                        <p class="lead mb-5 text-white-75 animate__animated animate__fadeIn animate__delay-1s">{{ $hero->subtitle ?? 'Cutting-edge IT solutions to transform your business' }}</p>
                        <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeIn animate__delay-2s">
                            <a href="#solutions" class="btn btn-primary btn-lg px-5 py-3">Explore Solutions</a>
                            <a href="#contact" class="btn btn-outline-light btn-lg px-5 py-3">Get in Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solutions Section -->
        <section class="section bg-light" id="solutions">
            <div class="container">
                <div class="text-center mb-6">
                    <h2 class="section-title fw-bold mb-4 animate__animated animate__fadeIn">{{ $solutionsOverview->title ?? 'Our Solution Offerings' }}</h2>
                    <p class="lead text-muted mx-auto animate__animated animate__fadeIn" style="max-width: 750px">{{ $solutionsOverview->description ?? 'Tailored technology solutions for your business challenges' }}</p>
                </div>

                <div class="row g-4 g-lg-5">
                    @forelse ($solutions as $solution)
                        <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp" data-delay="{{ $loop->index * 200 }}">
                            <div class="card card-solution h-100 border-0 shadow-sm rounded-3">
                                <div class="card-body p-4 text-center d-flex flex-column">
                                    <div class="solution-icon bg-gradient-tech rounded-circle mx-auto mb-4" style="width: 80px; height: 80px;">
                                        <i class="{{ $solution->icon ?? 'bi bi-gear' }} text-white fs-2"></i>
                                    </div>
                                    <h4 class="h5 mb-3 fw-semibold">{{ $solution->name ?? 'Solution Name' }}</h4>
                                    <p class="text-muted mb-4 flex-grow-1">{{ $solution->short_description ?? 'Description here' }}</p>
                                    <ul class="list-unstyled text-start text-muted ps-4 mb-4">
                                        @forelse ($solution->features ?? [] as $feature)
                                            <li class="mb-2 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-2"></i> {{ is_array($feature) ? $feature['title'] : $feature }}</li>
                                        @empty
                                            <li>No features listed.</li>
                                        @endforelse
                                    </ul>
                                    <a href="{{ route('solution.detail', $solution->slug ?? 'solution-' . $loop->index) }}" class="btn btn-outline-primary mt-auto">Learn More</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No solutions available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Case Studies Section -->
        <section class="section bg-white" id="case-studies">
            <div class="container">
                <div class="text-center mb-6">
                    <h2 class="section-title fw-bold mb-4 animate__animated animate__fadeIn">{{ $caseStudiesOverview->title ?? 'Our Success Stories' }}</h2>
                    <p class="lead text-muted mx-auto animate__animated animate__fadeIn" style="max-width: 750px">{{ $caseStudiesOverview->description ?? 'Real-world solutions delivering measurable results' }}</p>
                </div>

                <div class="row g-4 g-lg-5">
                    @forelse ($testimonials as $testimonial)
                        <div class="col-md-6 animate__animated animate__fadeIn{{ $loop->even ? 'Left' : 'Right' }}" data-delay="{{ $loop->index * 200 }}">
                            <div class="testimonial-card card border-0 shadow-sm rounded-3 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <img src="{{ $testimonial->image_url ?? asset('images/testimonial-placeholder.jpg') }}" alt="{{ $testimonial->author ?? 'Client' }}" class="rounded-circle me-3" width="70" height="70">
                                        <div>
                                            <h5 class="mb-0 fw-semibold">{{ $testimonial->author ?? 'Anonymous Client' }}</h5>
                                            <small class="text-muted">{{ $testimonial->company ?? 'Industry' }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-4">{{ $testimonial->quote ?? 'Testimonial content here' }}</p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @forelse ($testimonial->tags ?? [] as $tag)
                                            <span class="badge bg-{{ $loop->first ? 'primary' : 'success' }} text-white px-2 py-1">{{ $tag }}</span>
                                        @empty
                                            <span class="badge bg-secondary text-white px-2 py-1">No tags</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No case studies available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section bg-gradient-tech text-white position-relative overflow-hidden">
            <div class="container position-relative z-1 py-6">
                <div class="text-center">
                    <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInDown">{{ $cta->title ?? 'Ready to Transform Your Business?' }}</h2>
                    <p class="lead mb-5 mx-auto animate__animated animate__fadeInUp" style="max-width: 650px">{{ $cta->description ?? 'Let\'s discuss how our solutions can drive your digital transformation' }}</p>
                    <div class="d-flex justify-content-center gap-4 flex-column flex-md-row animate__animated animate__zoomIn">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 py-3 mb-2 mb-md-0">Get Started</a>
                        <a href="{{ route('solutions') }}" class="btn btn-outline-light btn-lg px-5 py-3">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

:root {
    --primary-color: #1e40af; /* Deep blue */
    --secondary-color: #3b82f6; /* Light blue */
    --accent-color: #60a5fa; /* Soft blue */
    --dark-color: #1e293b;
    --light-color: #f9fafb;
    --text-color: #1e293b;
    --text-light: #64748b;
    --gradient-tech: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.1);
    --border-radius: 0.75rem;
    --transition: all 0.3s ease;
    --spacing-base: 1rem;
    --spacing-lg: 2rem;
}

body {
    font-family: 'Poppins', sans-serif;
    color: var(--text-color);
    background-color: var(--light-color);
    overflow-x: hidden;
}

h1, h2, h3, h4 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
}

.hero-gradient {
    position: relative;
    min-height: 70vh;
    background-size: cover;
    background-position: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.z-1 {
    position: relative;
    z-index: 1;
}

.min-vh-70 {
    min-height: 70vh;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.section {
    padding: var(--spacing-lg) 0;
}

.section-title {
    position: relative;
    font-size: 2.5rem;
    line-height: 1.2;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

.card-solution {
    border-radius: var(--border-radius);
    transition: var(--transition);
    background: #fff;
}

.card-solution:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
}

.solution-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.testimonial-card {
    border-radius: var(--border-radius);
    transition: var(--transition);
    background: #fff;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.bg-gradient-tech {
    background: var(--gradient-tech);
}

.btn-primary {
    background: var(--gradient-tech);
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-light);
}

.btn-outline-light {
    color: #fff;
    border-color: #fff;
}

.btn-outline-light:hover {
    background: #fff;
    color: var(--primary-color);
}

@media (max-width: 1200px) {
    .display-3 {
        font-size: 2.25rem;
    }
    .section-title {
        font-size: 2.25rem;
    }
}

@media (max-width: 992px) {
    .display-3 {
        font-size: 2rem;
    }
    .section-title {
        font-size: 2rem;
    }
    .col-md-6, .col-lg-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 768px) {
    .display-3 {
        font-size: 1.75rem;
    }
    .section-title {
        font-size: 1.75rem;
    }
    .lead {
        font-size: 1rem;
    }
    .col-md-6, .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .d-flex.gap-3, .d-flex.gap-4 {
        flex-direction: column;
        gap: 1rem;
    }
    .section {
        padding: var(--spacing-base) 0;
    }
}

@media (max-width: 576px) {
    .display-3 {
        font-size: 1.5rem;
    }
    .section-title {
        font-size: 1.5rem;
    }
    .lead {
        font-size: 0.95rem;
    }
    .btn-lg {
        padding: 0.5rem 1.25rem;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function animateOnScroll() {
        const elements = document.querySelectorAll('.animate__animated:not(.animated)');
        const windowHeight = window.innerHeight;
        const triggerPoint = windowHeight * 0.85;

        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            if (elementPosition < triggerPoint) {
                const delay = parseInt(element.getAttribute('data-delay')) || 0;
                setTimeout(() => {
                    element.classList.add(element.classList[1]);
                    element.classList.add('animated');
                }, delay);
            }
        });
    }

    window.addEventListener('scroll', animateOnScroll);
    window.addEventListener('load', animateOnScroll);

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>
@endpush
