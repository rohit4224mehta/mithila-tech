@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section with Background Image -->
        <section class="py-20 text-center relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x600?text=Global+Presence+Hero');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 via-blue-600/70 to-purple-600/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">Global Presence</h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Serving clients worldwide with innovative IT solutions and a global network of expertise.
                </p>
            </div>
        </section>

        <!-- Global Offices Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Global+Offices');">
            <div class="absolute inset-0 bg-white/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12 animate__animated animate__zoomIn">Our Offices</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">Bangalore, India</h3>
                        <p class="text-gray-600">HQ: Innovation and development hub.</p>
                    </div>
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">New York, USA</h3>
                        <p class="text-gray-600">North American operations center.</p>
                    </div>
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">London, UK</h3>
                        <p class="text-gray-600">European client support base.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Map Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Services+Map');">
            <div class="absolute inset-0 bg-gray-100/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12 animate__animated animate__fadeIn">Global Services Coverage</h2>
                <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed mb-8">
                    Our services span across continents, delivering cutting-edge IT solutions to clients in Asia, North America, Europe, and beyond.
                </p>
                <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                    <p class="text-gray-600">Interactive World Map Placeholder (To be implemented)</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Section with Background Image -->
        <section class="py-20 text-center relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x600?text=Global+CTA');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 to-blue-600/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-8 animate__animated animate__fadeInDown">Expand with Us Globally</h2>
                <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Partner with Volera Technologies to leverage our global expertise. Contact us today!
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                    Get in Touch
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 11:02 PM IST</p>
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

.card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
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
    .container { padding: 1rem; }
    h1 { font-size: 2.5rem; }
    h2 { font-size: 2rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
