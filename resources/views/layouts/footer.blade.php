<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Branding & Tagline -->
            <div class="col-md-4 mb-4">
                <a href="{{ url('/') }}" class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/velora-logo.png') }}" alt="Velora Logo" width="40" height="40" class="me-2 rounded-circle">
                    <strong class="fs-4">Velora</strong>
                </a>
                <p class="text-light opacity-75">Empowering IT Solutions for projects, tasks, and teams.</p>
                <div class="d-flex gap-3">
                    <a href="https://twitter.com" class="text-white" target="_blank"><i class="bi bi-twitter"></i></a>
                    <a href="https://linkedin.com" class="text-white" target="_blank"><i class="bi bi-linkedin"></i></a>
                    <a href="https://facebook.com" class="text-white" target="_blank"><i class="bi bi-facebook"></i></a>
                </div>
            </div>

            <!-- Company Links -->
            <div class="col-md-2 mb-4">
                <h5 class="fw-semibold">Company</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/about') }}" class="text-light text-decoration-none">About Us</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-light text-decoration-none">Contact</a></li>
                    <li><a href="{{ url('/careers') }}" class="text-light text-decoration-none">Careers</a></li>
                </ul>
            </div>

            <!-- Features Links -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-semibold">Features</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/features/project-management') }}" class="text-light text-decoration-none">Project Management</a></li>
                    <li><a href="{{ url('/features/task-tracking') }}" class="text-light text-decoration-none">Task Tracking</a></li>
                    <li><a href="{{ url('/features/analytics') }}" class="text-light text-decoration-none">Analytics & Reporting</a></li>
                    <li><a href="{{ url('/features/integration') }}" class="text-light text-decoration-none">Integration</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-semibold">Support</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/support') }}" class="text-light text-decoration-none">Help Center</a></li>
                    <li><a href="{{ url('/support/faq') }}" class="text-light text-decoration-none">FAQ</a></li>
                    <li><a href="mailto:support@velora.com" class="text-light text-decoration-none">support@velora.com</a></li>
                    <li><a href="tel:+911234567890" class="text-light text-decoration-none">+91-1234567890</a></li>
                </ul>
            </div>
        virtually
        <hr class="bg-light">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; {{ date('Y') }} Velora. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ url('/terms') }}" class="text-light text-decoration-none me-3">Terms of Service</a>
                <a href="{{ url('/privacy') }}" class="text-light text-decoration-none">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a:hover {
        color: #93c5fd !important;
        transition: color 0.3s ease;
    }
    footer .bi {
        font-size: 1.5rem;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
