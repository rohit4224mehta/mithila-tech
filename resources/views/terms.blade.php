@extends('layouts.app')

@section('content')
    <!-- Terms Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="text-center mb-5 animate_animated animate_fadeInDown">
                <h2 class="section-title">Terms of Service</h2>
                <p class="lead text-muted">Governing your use of Velora's services</p>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0 animate_animated animate_fadeInLeft">
                    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop" alt="Legal Document" class="img-fluid rounded-3 shadow-lg">
                </div>
                <div class="col-lg-6 animate_animated animate_fadeInRight">
                    <h3 class="h4 fw-bold mb-3">Welcome to Velora</h3>
                    <p class="mb-4">
                        These Terms of Service govern your use of Velora Technologies Pvt. Ltd.'s website, applications, and services. By accessing or using our platform, you agree to comply with these terms, effective as of July 25, 2025, 08:50 AM IST. Please read carefully to understand your rights and obligations.
                    </p>
                    <a href="#terms-details" class="btn btn-primary">Explore Terms</a>
                </div>
            </div>

            <!-- Terms Details -->
            <div id="terms-details" class="text-center mb-5 animate_animated animate_fadeInUp">
                <h2 class="section-title">Key Provisions</h2>
                <p class="lead text-muted">Essential terms defining our relationship</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-1">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h4 class="mb-3">Acceptance</h4>
                            <p class="text-muted">
                                By using our services, you agree to these terms and our Privacy Policy, confirming you are at least 18 or have parental consent.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-2">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h4 class="mb-3">Account Security</h4>
                            <p class="text-muted">
                                You are responsible for maintaining your account credentials; we may suspend accounts for violations.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp animate-delay-3">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-gear"></i>
                            </div>
                            <h4 class="mb-3">Service Usage</h4>
                            <p class="text-muted">
                                Use our services legally; unauthorized actions like data scraping are prohibited.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animate_animated animate_fadeInUp">
                    <div class="card card-service h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-lock"></i>
                            </div>
                            <h4 class="mb-3">Intellectual Property</h4>
                            <p class="text-muted">
                                All content belongs to Velora; reproduction requires written consent.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Terms -->
            <div class="text-center mt-5 animate_animated animate_fadeIn">
                <h2 class="section-title">Detailed Terms</h2>
                <p class="lead text-muted">A timeline of key legal obligations</p>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <ul class="timeline">
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-1">
                            <div class="timeline-content">
                                <h5 class="mb-2">Acceptance of Terms</h5>
                                <p>Agreeing to these terms and our Privacy Policy is mandatory for service use.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-2">
                            <div class="timeline-content">
                                <h5 class="mb-2">Payment Obligations</h5>
                                <p>Fees are non-refundable unless specified, processed securely with tax responsibilities.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp animate-delay-3">
                            <div class="timeline-content">
                                <h5 class="mb-2">Liability Limits</h5>
                                <p>Services are provided 'as is'; liability is limited per Indian law.</p>
                            </div>
                        </li>
                        <li class="timeline-item animate_animated animate_fadeInUp">
                            <div class="timeline-content">
                                <h5 class="mb-2">Termination Rights</h5>
                                <p>We may terminate accounts for breaches; users may discontinue use anytime.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="text-center mt-5 animate_animated animate_fadeInUp">
                <h2 class="section-title">Need Assistance?</h2>
                <p class="lead text-muted">Reach out for support or clarification</p>
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