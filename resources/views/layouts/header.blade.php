<header>
    <!-- Top Bar -->
    <div class="top-bar bg-dark text-white py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="contact-info">
                <span class="me-3"><i class="bi bi-telephone-fill me-1"></i> +1-800-555-1234</span>
                <span><i class="bi bi-envelope-fill me-1"></i> support@volera.com</span>
            </div>
            <div class="social-links">
                <a href="#" class="text-white me-3" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top " style="background: linear-gradient(90deg, #1e3a8a, #3b82f6);">
        <div class="container space-between">
            <a class="navbar-brand d-flex align-items-center" href="/" aria-label="Volera Home">
                <img src="{{ asset('images/velora-logo.png') }}" alt="Volera Logo" width="50" class="rounded-circle shadow-sm me-2 logo-hover">
                <span class="fw-bold text-white" style="font-family: 'Poppins', sans-serif;">Volera</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon animate-hamburger"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- New Navigation Items -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('about') }}" aria-label="About"><i class="bi bi-info-circle-fill me-1"></i> About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-fill me-1"></i> Services
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end glassmorphism" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="{{ route('services.application') }}"><i class="bi bi-app-fill me-2"></i> Application Managed Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('services.cloud') }}"><i class="bi bi-cloud-fill me-2"></i> Cloud Managed Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('services.mysql') }}"><i class="bi bi-database-fill me-2"></i> MySQL Service</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('solutions') }}" aria-label="Solutions"><i class="bi bi-lightbulb-fill me-1"></i> Solutions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('media') }}" aria-label="Media"><i class="bi bi-camera-fill me-1"></i> Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('blog') }}" aria-label="Blog"><i class="bi bi-journal-text me-1"></i> Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('careers') }}" aria-label="Careers"><i class="bi bi-person-workspace me-1"></i> Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('global') }}" aria-label="Global"><i class="bi bi-globe2 me-1"></i> Global</a>
                    </li>
                    <!-- Static Auth Links -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}" aria-label="Login"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}" aria-label="Register"><i class="bi bi-person-plus-fill me-1"></i> Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-4 py-1 ms-2 logout-btn" href="#" aria-label="Logout"><i class="bi bi-box-arrow-left me-1"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    .top-bar {
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .contact-info i, .social-links i {
        transition: transform 0.3s ease;
    }

    .contact-info i:hover, .social-links i:hover {
        transform: scale(1.2);
    }

    .navbar {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .navbar-brand .logo-hover {
        transition: transform 0.5s ease, filter 0.3s ease;
    }

    .navbar-brand .logo-hover:hover {
        transform: rotate(360deg);
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.6));
    }

    .nav-link {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        transition: color 0.3s ease, background-color 0.3s ease, transform 0.2s ease;
    }

    .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        transform: translateY(-2px);
    }

    .glassmorphism {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease;
    }

    .dropdown-menu {
        border-radius: 10px;
        padding: 0.5rem;
    }

    .dropdown-item {
        color: white;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        transform: translateX(5px);
    }

    .logout-btn {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        border-radius: 50px;
        border-width: 2px;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    .logout-btn:hover {
        background-color: #ffffff !important;
        color: #1e3a8a !important;
        transform: scale(1.05);
    }

    .animate-hamburger {
        transition: transform 0.3s ease;
    }

    .navbar-toggler[aria-expanded="true"] .animate-hamburger {
        transform: rotate(90deg);
    }

    @media (max-width: 991px) {
        .top-bar .container {
            flex-direction: column;
            text-align: center;
        }
        .top-bar .contact-info, .top-bar .social-links {
            margin: 0.5rem 0;
        }
        .navbar-nav {
            padding: 1.5rem;
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            border-radius: 10px;
            margin-top: 0.5rem;
        }
        .nav-item {
            margin: 0.75rem 0;
        }
        .nav-link {
            font-size: 1.2rem;
        }
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
