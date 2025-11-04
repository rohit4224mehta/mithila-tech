@extends('layouts.app')

@section('content')
    <!-- Privacy Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="text-center mb-5 animate_animated animate_fadeInDown">
                <h2 class="section-title">Privacy Policy</h2>
                <p class="lead text-muted">Protecting your data with Velora</p>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0 animate_animated animate_fadeInLeft">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57a5b7602?q=80&w=2070&auto=format&fit=crop" alt="Privacy Concept" class="img-fluid rounded-3 shadow-lg">
                </div>
                <div class="col-lg-6 animate_animated animate_fadeInRight">
                    <h3 class="h4 fw-bold mb-3">Your Privacy Matters</h3>
                    <p class="mb-4">
                        At Velora Technologies Pvt. Ltd., we are committed to safeguarding your personal information. This Privacy Policy explains how we collect, use, and protect your data, effective as of July 25, 2025, 08:50 AM IST. Please review it to understand your rights.
                    </p>
                    <a href="#privacy-details" class="btn btn-primary">Learn More</a>
                </div>
            </div>

            <!-- Privacy Key Points -->
            <div id="privacy-details" class="text-center mb-5 animate_animated animate_fadeInUp">
                <h2 class="section-title">Key Privacy Principles</h2>
                <p class="lead text-muted">Core commitments to your data security</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-1">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-shield-fill"></i>
                            </div>
                            <h4 class="mb-3">Data Security</h4>
                            <p class="text-muted">
                                We implement robust measures to protect your personal data from unauthorized access.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-2">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-eye-slash"></i>
                            </div>
                            <h4 class="mb-3">Data Minimization</h4>
                            <p class="text-muted">
                                We collect only the data necessary for providing our services.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-3">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <h4 class="mb-3">Transparency</h4>
                            <p class="text-muted">
                                We provide clear information about how your data is used.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h4 class="mb-3">User Control</h4>
                            <p class="text-muted">
                                You can manage or request deletion of your data at any time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Privacy Policy -->
            <div class="text-center mt-5 animate_animated animate_fadeIn">
                <h2 class="section-title">Detailed Privacy Policy</h2>
                <p class="lead text-muted">A guide to your data rights and our practices</p>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <ul class="timeline">
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-1">
                            <div class="timeline-content">
                                <h5 class="mb-2">Data Collection</h5>
                                <p>We collect personal information such as name, email, and usage data with your consent.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-2">
                            <div class="timeline-content">
                                <h5 class="mb-2">Data Usage</h5>
                                <p>Your data is used to provide services, improve functionality, and comply with legal obligations.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-3">
                            <div class="timeline-content">
                                <h5 class="mb-2">Data Sharing</h5>
                                <p>We share data only with trusted partners or as required by law, with your consent where applicable.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp">
                            <div class="timeline-content">
                                <h5 class="mb-2">Your Rights</h5>
                                <p>You can access, correct, or delete your data by contacting us at support@velora.com.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="text-center mt-5 animate_animated animate_fadeInUp">
                <h2 class="section-title">Have Questions?</h2>
                <p class="lead text-muted">Get in touch for privacy support</p>
                <a href="{{ route('contact') }}" class="btn btn-primary mt-3">Contact Us</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .timeline {
        position: relative;
        list-style: none;
        padding-left: 0;
    }
    .timeline-item {
        position: relative;
        padding: 1rem 2rem 1rem 2rem;
        border-left: 2px solid #93c5fd;
        margin-bottom: 1.5rem;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 10px;
        width: 16px;
        height: 16px;
        background: #93c5fd;
        border-radius: 50%;
        z-index: 1;
    }
    .timeline-content {
        padding-left: 1rem;
    }
    .card-service {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-service:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .service-icon {
        font-size: 2rem;
        color: #93c5fd;
        margin-bottom: 1rem;
    }
    .animate-delay-1 { animation-delay: 0.2s; }
    .animate-delay-2 { animation-delay: 0.4s; }
    .animate-delay-3 { animation-delay: 0.6s; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        timelineItems.forEach(item => {
            item.style.setProperty('--timeline-height', '10px');
            item.style.setProperty('--timeline-color', '#93c5fd');
        });
    });
</script>
@endpush