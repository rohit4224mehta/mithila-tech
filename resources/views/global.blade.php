@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-gradient text-white section">
            <div class="container position-relative z-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Global Presence</h1>
                        <p class="lead mb-5 animate__animated animate__fadeIn animate__delay-1s">
                            Connecting innovation across continents with our worldwide network of expertise
                        </p>
                        <div class="animate__animated animate__fadeIn animate__delay-2s">
                            <a href="#offices" class="btn btn-primary btn-lg me-3">Our Offices</a>
                            <a href="#coverage" class="btn btn-outline-light btn-lg">Service Coverage</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Global Offices Section -->
        <section class="section bg-light" id="offices">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Our Global Offices</h2>
                    <p class="lead text-muted">Strategic locations serving clients worldwide</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4 animate__animated animate__fadeInLeft">
                        <div class="card card-service h-100">
                            <div class="card-body p-4">
                                <div class="service-icon bg-warning">
                                    <i class="bi bi-building"></i>
                                </div>
                                <h4 class="mb-3">Bangalore, India</h4>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-primary">Headquarters</span>
                                    <span class="badge bg-success">Since 2010</span>
                                </div>
                                <p class="text-muted">
                                    Our innovation hub driving cutting-edge technology development
                                </p>
                                <ul class="text-muted ps-4 mb-3">
                                    <li>500+ employees</li>
                                    <li>R&D Center</li>
                                    <li>Global Delivery Center</li>
                                </ul>
                                <a href="#contact" class="btn btn-sm btn-primary mt-2">Contact Office</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="card card-service h-100">
                            <div class="card-body p-4">
                                <div class="service-icon bg-danger">
                                    <i class="bi bi-bank"></i>
                                </div>
                                <h4 class="mb-3">New York, USA</h4>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-primary">Americas HQ</span>
                                    <span class="badge bg-success">Since 2018</span>
                                </div>
                                <p class="text-muted">
                                    North American operations center serving Fortune 500 clients
                                </p>
                                <ul class="text-muted ps-4 mb-3">
                                    <li>200+ employees</li>
                                    <li>Sales & Consulting</li>
                                    <li>Client Experience Center</li>
                                </ul>
                                <a href="#contact" class="btn btn-sm btn-primary mt-2">Contact Office</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 animate__animated animate__fadeInRight">
                        <div class="card card-service h-100">
                            <div class="card-body p-4">
                                <div class="service-icon bg-info">
                                    <i class="bi bi-globe-europe-africa"></i>
                                </div>
                                <h4 class="mb-3">London, UK</h4>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-primary">EMEA HQ</span>
                                    <span class="badge bg-success">Since 2021</span>
                                </div>
                                <p class="text-muted">
                                    European base delivering localized solutions across the region
                                </p>
                                <ul class="text-muted ps-4 mb-3">
                                    <li>150+ employees</li>
                                    <li>Customer Support Hub</li>
                                    <li>Compliance Center</li>
                                </ul>
                                <a href="#contact" class="btn btn-sm btn-primary mt-2">Contact Office</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Global Coverage Section -->
        <section class="section" id="coverage">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Worldwide Service Coverage</h2>
                    <p class="lead text-muted">Our global footprint and service capabilities</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 animate__animated animate__fadeInLeft">
                        <div class="culture-card text-center p-5 h-100">
                            <div class="culture-icon mb-4">
                                <i class="bi bi-map"></i>
                            </div>
                            <h4>Global Reach</h4>
                            <p class="text-muted">
                                Serving clients in 25+ countries across 6 continents with localized solutions
                            </p>
                            <div class="mt-4">
                                <span class="badge bg-primary me-2">Asia-Pacific</span>
                                <span class="badge bg-success me-2">North America</span>
                                <span class="badge bg-info me-2">Europe</span>
                                <span class="badge bg-warning">Middle East</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 animate__animated animate__fadeInRight">
                        <div class="culture-card text-center p-5 h-100">
                            <div class="culture-icon mb-4">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h4>Global Team</h4>
                            <p class="text-muted">
                                1200+ professionals worldwide speaking 15+ languages to serve our diverse clientele
                            </p>
                            <div class="mt-4">
                                <span class="badge bg-primary me-2">24/7 Support</span>
                                <span class="badge bg-success me-2">Local Experts</span>
                                <span class="badge bg-info">Global Standards</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Visualization -->
                <div class="mt-5 animate__animated animate__fadeInUp">
                    <div class="world-map-container p-4 bg-white rounded-xl shadow-lg">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">Our Global Presence</h4>
                            <p class="text-muted">Interactive visualization of our offices and service areas</p>
                        </div>
                        <div class="world-map-placeholder bg-gray-100 rounded-lg flex items-center justify-center" style="height: 400px;">
                            <div class="text-center p-4">
                                <i class="bi bi-globe text-5xl text-primary mb-3"></i>
                                <h5>Global Network Map</h5>
                                <p class="text-muted">Interactive map visualization to be implemented</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client Testimonials -->
        <section class="section bg-light">
            <div class="container">
                <div class="text-center mb-5 animate__animated animate__fadeInDown">
                    <h2 class="section-title">Global Client Experiences</h2>
                    <p class="lead text-muted">What our international clients say about working with us</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 animate__animated animate__fadeInLeft">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="rounded-circle me-3" width="60">
                                <div>
                                    <h5 class="mb-0">James Wilson</h5>
                                    <small class="text-muted">CTO, GlobalTech (USA)</small>
                                </div>
                            </div>
                            <p class="mb-3">
                                "Volera's global delivery model provided seamless 24/7 support across our operations in three continents."
                            </p>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 animate__animated animate__fadeInRight">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Client" class="rounded-circle me-3" width="60">
                                <div>
                                    <h5 class="mb-0">Sophie Martin</h5>
                                    <small class="text-muted">Director, EuroBank (France)</small>
                                </div>
                            </div>
                            <p class="mb-3">
                                "Their local expertise combined with global standards made our digital transformation smooth and effective."
                            </p>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section bg-primary text-white" id="contact">
            <div class="container text-center">
                <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInDown">Ready to Go Global Together?</h2>
                <p class="lead mb-5 animate__animated animate__fadeInUp">
                    Leverage our worldwide network to expand your business reach
                </p>
                <div class="animate__animated animate__zoomIn">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 me-3">Contact Us</a>
                    <a href="#offices" class="btn btn-outline-light btn-lg">Find an Office</a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-muted">© 2025 Volera Technologies. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 text-muted">
                            <span id="datetime" class="fw-bold">Wednesday, July 23, 2025, 11:02 PM IST</span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

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
    background-color: #f8fafc;
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
    background: url('https://images.unsplash.com/photo-1639762681057-408e52192e55?q=80&w=2232&auto=format&fit=crop') no-repeat center center;
    background-size: cover;
    opacity: 0.15;
    z-index: 0;
}

.section {
    padding: 6rem 0;
    position: relative;
}

.section-title {
    position: relative;
    display: inline-block;
    margin-bottom: 2rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
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
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    height: 100%;
}

.card-service:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.service-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: white;
    font-size: 2rem;
}

.service-icon.bg-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
}

.service-icon.bg-danger {
    background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
}

.service-icon.bg-info {
    background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
}

.culture-card {
    background: white;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    height: 100%;
}

.culture-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.culture-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 1rem;
    background: var(--primary-color);
    color: white;
    font-size: 1.5rem;
}

.world-map-container {
    border: 1px solid #e2e8f0;
}

.world-map-placeholder {
    background-color: #f1f5f9;
    position: relative;
    overflow: hidden;
}

.world-map-placeholder::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.1) 0%, transparent 20%),
        radial-gradient(circle at 70% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 20%),
        radial-gradient(circle at 50% 70%, rgba(37, 99, 235, 0.1) 0%, transparent 20%);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
}

.testimonial-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    position: relative;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.badge {
    padding: 0.35em 0.65em;
    font-weight: 500;
}

.rating {
    color: #fbbf24;
    font-size: 1.25rem;
}

@media (max-width: 768px) {
    .section {
        padding: 4rem 0;
    }

    .hero-content h1 {
        font-size: 2.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update datetime in footer
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            timeZoneName: 'short'
        };
        document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
    }

    updateDateTime();
    setInterval(updateDateTime, 60000); // Update every minute

    // Add animation on scroll
    function animateOnScroll() {
        const elements = document.querySelectorAll('.animate__animated');

        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;

            if(elementPosition < screenPosition) {
                const animation = element.getAttribute('data-animate') || 'fadeIn';
                element.classList.add(animation);
            }
        });
    }

    window.addEventListener('scroll', animateOnScroll);
    window.addEventListener('load', animateOnScroll);
});
</script>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<!-- Map Section -->
        <section class="section p-0 bg-white" role="region" aria-label="Office Location Map">
            <div class="container-fluid px-0">
                <div class="map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.112453237824!2d85.3239603150628!3d27.71203098278901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb190a197d411f%3A0x2a81a9eabf4d4f1!2sKathmandu%2C%20Nepal!5e0!3m2!1sen!2snp!4v1630000000000!5m2!1sen!2snp"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        class="map-iframe">
                    </iframe>
                </div>
            </div>
        </section>
