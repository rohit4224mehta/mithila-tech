@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-900 via-blue-600 to-purple-600">
        <section class="py-20 text-center">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">Projects</h1>
                <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    This section will display your ongoing and completed projects.
                </p>
            </div>
        </section>

        <section class="py-16 bg-white/95 backdrop-blur-lg">
            <div class="container mx-auto px-4 text-center">
                <p class="text-gray-600">Placeholder for project details. To be expanded later.</p>
            </div>
        </section>

        <section class="py-20 text-center bg-gradient-to-br from-indigo-900 to-blue-600">
            <div class="container mx-auto px-4">
                <a href="{{ route('employee.dashboard') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                    Back to Dashboard
                </a>
            </div>
        </section>

        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Thursday, July 24, 2025, 12:03 AM IST</p>
        </footer>
    </div>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

body {
    font-family: 'Poppins', sans-serif;
}

.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradientAnimation 15s ease infinite;
}

@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.btn-primary {
    background: linear-gradient(90deg, #1e3a8a, #3b82f6);
    border: none;
    font-weight: 600;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.btn-primary:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

@media (max-width: 767px) {
    h1 { font-size: 2rem; }
    .container { padding: 1rem; }
}
</style>
