@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Contact Hero Section -->
        <section class="hero-contact text-white section" role="banner" aria-label="Contact Hero">
            <div class="hero-background"></div>
            <div class="container position-relative z-1">
                <div class="row min-vh-60 align-items-center py-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Get In Touch</h1>
                        <p class="lead mb-5 text-white-75 animate__animated animate__fadeIn animate__delay-1s">
                            We'd love to hear from you. Contact Mithila Tech for inquiries, support, or to discuss your next project.
                        </p>
                        <a href="#contact-form" class="btn btn-primary btn-lg smooth-scroll">Send a Message</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
    <section class="section bg-white" id="contact-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm animate__animated animate__fadeIn">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-5">
                                <span class="badge bg-primary-soft text-primary mb-3">CONTACT US</span>
                                <h2 class="section-title mb-3">Let’s Talk About Your Project</h2>
                                <p class="text-muted">Fill in the form below and our experts will reach out within 24 hours.</p>
                            </div>

                            {{-- Success and Error Messages --}}
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Validation Errors --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Contact Form --}}
                            <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Your Name" value="{{ old('name') }}" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Your Email" value="{{ old('email') }}" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" name="subject" id="subject" class="form-control"
                                                placeholder="Subject" value="{{ old('subject') }}" required>
                                            <label for="subject">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" id="message" class="form-control" rows="5"
                                                placeholder="Your Message" required>{{ old('message') }}</textarea>
                                            <label for="message">Your Message</label>
                                        </div>
                                    </div>

                                    {{-- Consent Checkbox --}}
                                    <div class="col-12">
                                        <div class="form-check text-start">
                                            <input type="checkbox" name="consent" id="consent" value="1"
                                                class="form-check-input" required>
                                            <label for="consent" class="form-check-label small text-muted">
                                                I agree to the <a href="{{ route('privacy') }}" class="text-primary">Privacy Policy</a>.
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <span class="submit-text">Send Message</span>
                                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Contact Info Section -->
        <section class="section bg-light" role="region" aria-label="Contact Information">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-primary-soft text-primary mb-3">OUR OFFICES</span>
                    <h2 class="section-title mb-3">Find Us Here</h2>
                    <p class="text-muted mx-auto" style="max-width: 700px">
                        Visit our offices or contact us through any of these channels
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4 animate__animated animate__fadeInUp">
                        <div class="contact-info-card text-center h-100">
                            <div class="contact-icon bg-primary-soft text-primary mx-auto mb-4">
                                <i class="bi bi-geo-alt fs-3"></i>
                            </div>
                            <h4 class="mb-3">Headquarters</h4>
                            <address class="text-muted">
                                {{ env('COMPANY_ADDRESS', '123 Innovation Hub, Kathmandu, Nepal') }}
                            </address>
                            <a href="https://www.google.com/maps/search/?api=1&query=Kathmandu,Nepal" class="btn btn-outline-primary mt-3" target="_blank">Get Directions</a>
                        </div>
                    </div>
                    <div class="col-md-4 animate__animated animate__fadeInUp" data-delay="100">
                        <div class="contact-info-card text-center h-100">
                            <div class="contact-icon bg-primary-soft text-primary mx-auto mb-4">
                                <i class="bi bi-telephone fs-3"></i>
                            </div>
                            <h4 class="mb-3">Phone & Email</h4>
                            <ul class="list-unstyled text-muted">
                                <li class="mb-2"><i class="bi bi-phone me-2"></i> {{ env('COMPANY_PHONE', '+977 1 2345678') }}</li>
                                <li class="mb-2"><i class="bi bi-envelope me-2"></i> {{ env('COMPANY_EMAIL', 'info@mithila-tech.com') }}</li>
                                <li><i class="bi bi-headset me-2"></i> Support: {{ env('COMPANY_SUPPORT_EMAIL', 'support@mithila-tech.com') }}</li>
                            </ul>
                            <a href="tel:{{ env('COMPANY_PHONE', '+97712345678') }}" class="btn btn-outline-primary mt-3">Call Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 animate__animated animate__fadeInUp" data-delay="200">
                        <div class="contact-info-card text-center h-100">
                            <div class="contact-icon bg-primary-soft text-primary mx-auto mb-4">
                                <i class="bi bi-clock fs-3"></i>
                            </div>
                            <h4 class="mb-3">Working Hours</h4>
                            <ul class="list-unstyled text-muted">
                                @foreach(explode(', ', env('COMPANY_WORKING_HOURS', 'Monday - Friday: 9:00 AM - 5:00 PM, Saturday: 10:00 AM - 2:00 PM, Sunday: Closed')) as $hours)
                                    <li class="mb-2">{{ $hours }}</li>
                                @endforeach
                            </ul>
                            <a href="#contact-form" class="btn btn-outline-primary mt-3 smooth-scroll">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

        <!-- CTA Section -->
        <section class="section bg-primary text-white" role="region" aria-label="Call to Action">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <h2 class="mb-3">Have a Project in Mind?</h2>
                        <p class="lead mb-0">Let's discuss how Mithila Tech can help you achieve your business goals.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#contact-form" class="btn btn-light btn-lg px-5 smooth-scroll">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>


    </div>


    {{-- for css style --}}
    <style>
        :root {
    --primary-color: #4361ee;
    --primary-dark: rgb(42, 41, 43);
    --primary-light: rgba(67, 97, 238, 0.1);
    --secondary-color: #4895ef;
    --accent-color: #4895ef;
    --teal-color: #4cc9f0;
    --dark-color: #1a1a2e;
    --white: #ffffff;
    --text-muted: #6c757d;
    --border-radius: 8px;
    --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #2b2d42;
    background-color: #f8f9fa;
}

h1, h2, h3, h4 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
}

.hero-contact {
    background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-dark) 100%);
    position: relative;
    overflow: hidden;
}

.hero-contact .hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/images/contact-bg.jpg') no-repeat center center;
    background-size: cover;
    opacity: 0.1;
    z-index: 0;
}

.min-vh-60 {
    min-height: 60vh;
}

.section {
    padding: 4rem 0;
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

.contact-info-card {
    background: #ffffff;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.contact-info-card:hover {
    transform: translateY(-0.5rem);
    box-shadow: 0 1rem 1.5rem rgba(0, 0, 0, 0.1);
}

.contact-icon {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.contact-info-card:hover .contact-icon {
    transform: scale(1.1);
}

.bg-primary-soft {
    background-color: rgba(67, 97, 238, 0.1);
}

.text-primary {
    color: var(--primary-color) !important;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75);
}

/* .form-floating {
    position: relative;
    margin-bottom: 1.5rem;
} */

/* .form-floating label {
    color: var(--text-muted);
    transition: var(--transition);
} */

.form-control {
    border-radius: var(--border-radius);
    padding: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.1);
}

/* .form-control:not(:placeholder-shown) + label,
.form-control:focus + label {
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    background: #ffffff;
    padding: 0 0.5rem;
    color: var(--primary-color);
} */

.form-check-label a {
    text-decoration: none;
}

.form-check-label a:hover {
    text-decoration: underline;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: var(--transition);
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
    color: #ffffff;
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
    font-size: 0.75rem;
}

.map-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.map-iframe {
    display: block;
    filter: grayscale(30%) contrast(110%);
}

@media (max-width: 768px) {
    .section {
        padding: 2rem 0;
    }

    .min-vh-60 {
        min-height: 50vh;
    }

    .hero-contact .display-3 {
        font-size: 2rem;
    }

    .hero-contact .lead {
        font-size: 1rem;
    }

    .contact-info-card {
        margin-bottom: 1.5rem;
    }

    .form-floating label {
        font-size: 0.875rem;
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
                    const animation = entry.target.getAttribute('data-animate') || 'animate__fadeIn';
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    entry.target.style.animationDelay = `${delay}ms`;
                    entry.target.classList.add(animation);
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate__animated').forEach(element => {
            observer.observe(element);
        });

        // Form submission handling with AJAX
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const submitText = submitBtn.querySelector('.submit-text');
                const spinner = submitBtn.querySelector('.spinner-border');

                submitText.textContent = 'Sending...';
                spinner.classList.remove('d-none');
                submitBtn.disabled = true;

                try {
                    const response = await fetch(contactForm.action, {
                        method: 'POST',
                        body: new FormData(contactForm),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();
                    submitText.textContent = 'Message Sent!';
                    contactForm.reset();

                    setTimeout(() => {
                        submitText.textContent = 'Send Message';
                        spinner.classList.add('d-none');
                        submitBtn.disabled = false;
                    }, 3000);
                } catch (error) {
                    submitText.textContent = 'Error!';
                    spinner.classList.add('d-none');
                    submitBtn.disabled = false;
                    console.error('Form submission error:', error);
                }
            });
        }
    });
    </script>
@endsection

<!-- External Styles and Scripts -->
