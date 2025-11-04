<header>
    <!-- Top Bar -->
    <div class="top-bar bg-dark text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="contact-info d-flex flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone-fill me-2 text-primary"></i>
                            <a href="tel:+917464059831" class="text-white text-decoration-none">+91 7464 059 831</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope-fill me-2 text-primary"></i>
                            <a href="mailto:support@mithilatech.com" class="text-white text-decoration-none">support@mithilatech.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links d-inline-flex gap-2">
                        <a href="https://facebook.com/mithilatech" target="_blank" class="text-white" aria-label="Facebook" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Facebook">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="https://twitter.com/mithilatech" target="_blank" class="text-white" aria-label="Twitter" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Twitter">
                            <i class="bi bi-twitter-x fs-5"></i>
                        </a>
                        <a href="https://linkedin.com/company/mithilatech" target="_blank" class="text-white" aria-label="LinkedIn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="LinkedIn">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                        <a href="https://instagram.com/mithilatech" target="_blank" class="text-white" aria-label="Instagram" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Instagram">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary sticky-top">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand logo-highlight" href="{{ route('home') }}" aria-label="Mithila Tech Home">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/mithila-tech-logo.png') }}" alt="Mithila Tech Logo" style="height: 60px; width: auto;" class="me-2">
                </div>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}"><i class="bi bi-house-door-fill me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('about') }}"><i class="bi bi-info-circle-fill me-1"></i> About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('solutions') }}"><i class="bi bi-lightbulb-fill me-1"></i> Solutions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('services') }}"><i class="bi bi-gear-fill me-1"></i> Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('careers') }}"><i class="bi bi-person-workspace me-1"></i> Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('blog') }}"><i class="bi bi-journal-text me-1"></i> Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('media') }}"><i class="bi bi-camera-fill me-1"></i> Media</a>
                    </li>
                </ul>

                <!-- Right Side Navigation (Dynamic based on auth) -->
                <div class="d-flex align-items-center gap-3">
                    <div class="vr text-white mx-2 d-none d-lg-block" style="height: 30px;"></div>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="{{ route('client.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('client.profile') }}"><i class="bi bi-speedometer2 me-2"></i> Profile</a></li>

                                <li><a class="dropdown-item" href="{{ route('client.password.edit') }}"><i class="bi bi-lock-fill me-2"></i> Change Password</a></li>
                                <li><a class="dropdown-item" href="{{ route('client.projects') }}"><i class="bi bi-briefcase-fill me-2"></i> Projects</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-light">
                            <i class="bi bi-person-plus-fill me-1"></i> Get Started
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-light text-primary">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
:root {
    --primary-color: #4361ee;
    --primary-dark: rgb(42, 41, 43);
    --primary-light: rgba(67, 97, 238, 0.1);
    --secondary-color: #4895ef;
    --dark-color: #1a1a2e;
    --light-color: #f8f9fa;
    --text-color: #2b2d42;
    --text-muted: #6c757d;
    --white: #ffffff;
    --border-radius: 0.5rem;
    --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    --transition: all 0.3s ease;
}

/* Top Bar */
.top-bar {
    font-size: 0.875rem;
    background-color: var(--dark-color);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-info a {
    transition: var(--transition);
}
.contact-info a:hover {
    color: var(--secondary-color) !important;
    text-decoration: underline;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    transition: var(--transition);
}
.social-links a:hover {
    background-color: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
    color: var(--secondary-color);
}

/* Main Nav */
.navbar {
    padding: 0.75rem 0;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
    box-shadow: var(--box-shadow);
}

.navbar-brand {
    transition: var(--transition);
}
.navbar-brand:hover {
    transform: scale(1.05);
}

.nav-link {
    font-weight: 500;
    padding: 0.75rem 1.25rem;
    margin: 0 0.25rem;
    border-radius: var(--border-radius);
    transition: var(--transition);
    position: relative;
}
.nav-link:hover, .nav-link:focus {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--secondary-color);
}
.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background-color: var(--secondary-color);
    transition: var(--transition);
    transform: translateX(-50%);
}
.nav-link:hover::after, .nav-link:focus::after {
    width: 60%;
}
.nav-link.active {
    background-color: rgba(255, 255, 255, 0.15);
    color: var(--secondary-color);
}
.nav-link.active::after {
    width: 60%;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border-radius: var(--border-radius);
    margin-top: 0.5rem;
    min-width: 12rem;
    background-color: var(--dark-color);
}

.dropdown-item {
    padding: 0.5rem 1.5rem;
    transition: var(--transition);
    color: var(--white);
}
.dropdown-item:hover, .dropdown-item:focus {
    background-color: var(--primary-light);
    color: var(--secondary-color);
}

.btn-outline-light {
    border-color: rgba(255, 255, 255, 0.5);
    transition: var(--transition);
}
.btn-outline-light:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    color: var(--white);
}

.btn-light {
    background-color: var(--white);
    border-color: var(--white);
    transition: var(--transition);
}
.btn-light:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    color: var(--white);
}

/* Mobile */
@media (max-width: 991.98px) {
    .navbar-collapse {
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-dark) 100%);
        border-radius: var(--border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
    }
    .nav-item {
        margin: 0.5rem 0;
    }
    .dropdown-menu {
        margin-left: 1rem;
        background-color: rgba(26, 26, 46, 0.9);
    }
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }
    .navbar-toggler:focus {
        box-shadow: none;
    }
}

/* Dropdown Animation */
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.dropdown-menu {
    animation: slideDown 0.3s ease forwards;
}

/* Sticky Nav */
.sticky-top {
    top: 0;
    z-index: 1030;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const currentUrl = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentUrl || (currentUrl.includes('client') && link.getAttribute('href') === '{{ route('client.profile') }}')) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
            const dropdown = link.closest('.dropdown-menu');
            if (dropdown) {
                const dropdownToggle = document.querySelector(`[aria-labelledby="${dropdown.getAttribute('aria-labelledby')}"]`);
                if (dropdownToggle) dropdownToggle.classList.add('active');
            }
        }
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush
