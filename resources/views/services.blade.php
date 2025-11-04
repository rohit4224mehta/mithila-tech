@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-services position-relative overflow-hidden bg-gradient-tech" style="background-image: url('{{ $hero->background_image ?? asset('images/tech-bg.jpg') }}');">
            <div class="hero-overlay"></div>
            <div class="container position-relative z-index-1 py-5">
                <div class="row min-vh-80 align-items-center text-center">
                    <div class="col-12">
                        <h1 class="display-3 fw-bold text-white mb-4 animate__animated animate__fadeInDown">{{ $hero->title ?? 'Our Services' }}</h1>
                        <p class="lead text-white-50 mb-5 animate__animated animate__fadeIn animate__delay-1s">{{ $hero->subtitle ?? 'Comprehensive IT solutions for your business.' }}</p>
                        <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeIn animate__delay-2s">
                            <a href="#our-services" class="btn btn-primary btn-lg px-4">Explore Services <i class="bi bi-arrow-down ms-2"></i></a>
                            <a href="#contact" class="btn btn-outline-light btn-lg px-4">Get in Touch <i class="bi bi-chat-left-text ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="section bg-light" id="our-services">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-primary-soft text-primary mb-3 animate__animated animate__fadeIn">{{ $servicesOverview->badge ?? 'Our Expertise' }}</span>
                    <h2 class="section-title mb-3 animate__animated animate__fadeIn">{{ $servicesOverview->title ?? 'Our IT Services' }}</h2>
                    <p class="lead text-muted mx-auto animate__animated animate__fadeIn" style="max-width: 700px">{{ $servicesOverview->description ?? 'Delivering cutting-edge IT solutions tailored to your needs.' }}</p>
                </div>

                <div class="row g-4">
                    @forelse ($services as $service)
                        <div class="col-md-6 col-lg-4 animate__animated" data-animate="animate__fadeInUp" data-delay="{{ $loop->index * 100 }}">
                            <div class="service-card card border-0 shadow-sm h-100">
                                <div class="card-body p-4 text-center">
                                    <div class="service-icon bg-primary-soft text-primary mb-4 mx-auto" style="width: 60px; height: 60px;">
                                        <i class="{{ $service->icon ?? 'bi-gear' }} fs-2"></i>
                                    </div>
                                    <h3 class="h5 mb-3">{{ $service->name ?? 'Service Name' }}</h3>
                                    <p class="text-muted mb-4">{{ $service->short_description ?? 'Service description here.' }}</p>
                                    <a href="{{ route('service.detail', $service->slug ?? 'service-' . $loop->index) }}" class="btn btn-outline-primary stretched-link">Learn More</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No services available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Technology Partners -->
        <section class="section bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-primary-soft text-primary mb-3 animate__animated animate__fadeIn">{{ $partners->badge ?? 'Partners' }}</span>
                    <h2 class="section-title mb-3 animate__animated animate__fadeIn">{{ $partners->title ?? 'Our Technology Partners' }}</h2>
                    <p class="lead text-muted mx-auto animate__animated animate__fadeIn" style="max-width: 700px">{{ $partners->description ?? 'We collaborate with leading tech companies to deliver exceptional solutions.' }}</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @forelse ($partners->logos ?? [] as $logo)
                        <div class="col-6 col-md-3 col-lg-2 animate__animated" data-animate="animate__fadeIn" data-delay="{{ $loop->index * 100 }}">
                            <div class="partner-logo bg-white p-3 rounded shadow-sm">
                                <img src="{{ $logo->image_url ?? 'https://via.placeholder.com/120x60?text=' . urlencode($logo->name ?? 'Partner') }}" alt="{{ $logo->name ?? 'Partner' }}" class="img-fluid mx-auto d-block">
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No partners available at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="section bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 animate__animated" data-animate="animate__fadeInLeft">
                        <span class="badge bg-primary-soft text-primary mb-3">{{ $process->badge ?? 'Our Approach' }}</span>
                        <h2 class="section-title mb-4">{{ $process->title ?? 'How We Work' }}</h2>
                        <p class="lead text-muted mb-4">{{ $process->lead_description ?? 'A streamlined process to deliver results.' }}</p>
                        <p class="mb-4">{{ $process->additional_description ?? 'We follow a proven methodology to ensure success.' }}</p>
                        <a href="{{ route('process.detail') }}" class="btn btn-primary">Learn Our Process</a>
                    </div>
                    <div class="col-lg-6 animate__animated" data-animate="animate__fadeInRight">
                        <div class="process-steps">
                            @forelse ($process->steps ?? [] as $step)
                                <div class="process-step d-flex align-items-start mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle me-3" style="width: 40px; height: 40px;">
                                        {{ $loop->index + 1 }}
                                    </div>
                                    <div class="step-content">
                                        <h4 class="mb-2">{{ $step->title ?? 'Step Title' }}</h4>
                                        <p class="text-muted">{{ $step->description ?? 'Step description here.' }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No process steps defined.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section bg-gradient-tech text-white position-relative overflow-hidden">
            <div class="container position-relative z-1 py-6">
                <div class="text-center">
                    <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInDown">{{ $cta->title ?? 'Ready to Transform?' }}</h2>
                    <p class="lead mb-5 mx-auto animate__animated animate__fadeInUp" style="max-width: 650px">{{ $cta->description ?? 'Let’s build your future with our IT solutions.' }}</p>
                    <div class="d-flex justify-content-center gap-4 flex-column flex-md-row animate__animated animate__zoomIn">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 py-3 mb-2 mb-md-0">Contact Us</a>
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

.hero-services {
    position: relative;
    min-height: 80vh;
    background-size: cover;
    background-position: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    z-index: 0;
}

.min-vh-80 {
    min-height: 80vh;
}

.z-index-1 {
    position: relative;
    z-index: 1;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.7) !important;
}

/* Section Styling */
.section {
    padding: 5rem 0;
}

@media (max-width: 768px) {
    .section {
        padding: 3rem 0;
    }
}

/* Section Titles */
.section-title {
    position: relative;
    font-size: 2.5rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -0.75rem;
    left: 50%;
    transform: translateX(-50%);
    width: 3rem;
    height: 0.25rem;
    background: var(--primary-color);
    border-radius: 0.125rem;
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }
}

/* Badges */
.badge {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.875rem;
    padding: 0.4rem 1rem;
    border-radius: 1rem;
}

/* Service Cards */
.service-card {
    border-radius: var(--border-radius);
    transition: var(--transition);
    height: 100%;
}

.service-card:hover {
    transform: translateY(-0.5rem);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
}

.service-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.service-icon i {
    transition: var(--transition);
}

.service-card:hover .service-icon i {
    transform: scale(1.2);
    color: var(--primary-color) !important;
}

/* Partner Logos */
.partner-logos {
    padding: 2rem 0;
}

.partner-logo {
    transition: var(--transition);
    border: 1px solid var(--primary-soft);
}

.partner-logo:hover {
    transform: translateY(-0.5rem);
    box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1);
}

.partner-logo img {
    filter: grayscale(80%);
    transition: var(--transition);
}

.partner-logo:hover img {
    filter: grayscale(0%);
}

/* Process Steps */
.process-step {
    transition: var(--transition);
    background: var(--white);
    border-left: 4px solid var(--primary-color);
    padding: 1.5rem;
}

.process-step:hover {
    background: var(--primary-soft);
}

.step-number {
    font-weight: 600;
    margin-right: 1rem;
}

/* Buttons */
.btn {
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius);
    transition: var(--transition);
    border-width: 2px;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-0.25rem);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: var(--white);
}

.btn-outline-light {
    color: var(--white);
    border-color: var(--white);
}

.btn-outline-light:hover {
    background-color: var(--white);
    color: var(--primary-color);
}

.btn-lg {
    padding: 0.875rem 2rem;
    font-size: 1.1rem;
}

/* Animations */
.animate__animated {
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(2rem);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate__fadeInUp {
    animation-name: fadeInUp;
    animation-duration: 0.8s;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate__fadeIn {
    animation-name: fadeIn;
    animation-duration: 0.8s;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-2rem);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate__fadeInLeft {
    animation-name: fadeInLeft;
    animation-duration: 0.8s;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(2rem);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate__fadeInRight {
    animation-name: fadeInRight;
    animation-duration: 0.8s;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .display-3 {
        font-size: 2.25rem;
    }

    .row.align-items-center > * {
        text-align: center;
    }

    .process-step {
        border-left: none;
        border-top: 4px solid var(--primary-color);
        padding-top: 1.5rem;
    }
}

@media (max-width: 768px) {
    .display-3 {
        font-size: 1.75rem;
    }

    .lead {
        font-size: 1rem;
    }

    .process-step {
        flex-direction: column;
        align-items: flex-start;
    }

    .step-number {
        margin-bottom: 1rem;
        margin-right: 0;
    }
}

@media (max-width: 576px) {
    .btn-lg {
        padding: 0.5rem 1.25rem;
        font-size: 0.95rem;
    }

    .d-flex.gap-3 {
        flex-direction: column;
        gap: 0.75rem !important;
    }

    .partner-logo {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Animation on scroll
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

    // Interactive effects
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.querySelector('.service-icon i').style.transform = 'scale(1.2)';
        });
        card.addEventListener('mouseleave', () => {
            card.querySelector('.service-icon i').style.transform = 'scale(1)';
        });
    });

    const partnerLogos = document.querySelectorAll('.partner-logo');
    partnerLogos.forEach(logo => {
        logo.addEventListener('mouseenter', () => logo.style.transform = 'translateY(-0.5rem)');
        logo.addEventListener('mouseleave', () => logo.style.transform = 'translateY(0)');
    });
});
</script>
@endpush