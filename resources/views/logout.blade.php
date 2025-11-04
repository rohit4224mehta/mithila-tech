@extends('layouts.app')

@section('content')
    <div class="logout-container min-vh-100 d-flex flex-column" style="background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);">
        <!-- Main Content -->
        <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <!-- Logout Confirmation Card -->
                        <div class="card border-0 shadow-lg overflow-hidden">
                            <div class="row g-0">
                                <!-- Visual Section -->
                                <div class="col-md-5 d-none d-md-flex bg-primary-gradient align-items-center justify-content-center p-4">
                                    <div class="text-center text-white">
                                        <i class="bi bi-shield-lock display-4 mb-3"></i>
                                        <h3 class="h4 mb-0">Secure Session Ended</h3>
                                    </div>
                                </div>
                                
                                <!-- Content Section -->
                                <div class="col-md-7">
                                    <div class="card-body p-5">
                                        <div class="text-center mb-4">
                                            <div class="logout-icon bg-primary-soft text-primary rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3">
                                                <i class="bi bi-box-arrow-right fs-3"></i>
                                            </div>
                                            <h2 class="h3 fw-bold text-dark mb-2">You've Been Logged Out</h2>
                                            <p class="text-muted mb-4">Your Volera employee session has been securely terminated.</p>
                                        </div>
                                        
                                        <div class="d-grid gap-3">
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill py-3 shadow-sm">
                                                <i class="bi bi-box-arrow-in-right me-2"></i> Return to Login
                                            </a>
                                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg rounded-pill py-3 shadow-sm">
                                                <i class="bi bi-house-door me-2"></i> Back to Homepage
                                            </a>
                                        </div>
                                        
                                        <div class="text-center mt-4">
                                            <p class="small text-muted mb-2">For security reasons, please close your browser</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                <span class="badge bg-light text-dark small"><i class="bi bi-clock me-1"></i> Session Ended</span>
                                                <span class="badge bg-light text-dark small"><i class="bi bi-shield-check me-1"></i> Secure</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 small">
                            <i class="bi bi-c-circle me-1"></i> 2025 Volera Technologies. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 small">
                            <i class="bi bi-calendar3 me-1"></i> 
                            <span id="currentDateTime">Friday, July 25, 2025, 12:05 AM IST</span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #4f46e5;
    --primary-dark: #4338ca;
    --primary-light: #e0e7ff;
    --primary-soft: rgba(79, 70, 229, 0.1);
    --secondary-color: #64748b;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --success-color: #10b981;
    --danger-color: #ef4444;
    --warning-color: #f59e0b;
    --info-color: #3b82f6;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background-color: #f8fafc;
    color: #334155;
}

.logout-container {
    background-size: 200% 200%;
    animation: gradientAnimation 10s ease infinite;
}

@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.bg-primary-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}

.card {
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
}

.logout-icon {
    width: 64px;
    height: 64px;
    transition: all 0.3s ease;
}

.btn {
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border-width: 2px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(79, 70, 229, 0.3) !important;
}

.btn-outline-secondary {
    color: var(--secondary-color);
    border-color: var(--secondary-color);
}

.btn-outline-secondary:hover {
    background-color: var(--secondary-color);
    color: var(--light-color);
}

.badge {
    font-weight: 500;
    padding: 0.35rem 0.75rem;
    border-radius: 50rem;
}

/* Responsive Adjustments */
@media (max-width: 767.98px) {
    .card-body {
        padding: 2rem;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
    }
}

@media (max-width: 575.98px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .logout-icon {
        width: 56px;
        height: 56px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update date and time in footer
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
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
    }

    updateDateTime();
    setInterval(updateDateTime, 60000); // Update every minute

    // Add animation to logout icon
    const logoutIcon = document.querySelector('.logout-icon');
    if (logoutIcon) {
        logoutIcon.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(15deg) scale(1.1)';
        });
        
        logoutIcon.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0) scale(1)';
        });
    }
});
</script>
@endpush

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">