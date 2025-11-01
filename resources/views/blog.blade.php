@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section with Background Image -->
        <section class="py-20 text-center relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x600?text=Blog+Hero');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 via-blue-600/70 to-purple-600/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">Our Blog</h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Stay updated with the latest IT trends, insights, and innovations from Volera Technologies.
                </p>
            </div>
        </section>

        <!-- Recent Posts Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Recent+Posts');">
            <div class="absolute inset-0 bg-white/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12 animate__animated animate__zoomIn">Recent Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">The Future of Cloud Computing</h3>
                        <p class="text-gray-600">Explore how cloud technology is shaping the IT landscape in 2025.</p>
                        <a href="#read-more" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">Read More</a>
                    </div>
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-2">Securing Your Applications</h3>
                        <p class="text-gray-600">Best practices for enhancing application security in a digital world.</p>
                        <a href="#read-more" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section with Background Image -->
        <section class="py-20 text-center relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x600?text=Blog+CTA');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 to-blue-600/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-8 animate__animated animate__fadeInDown">Dive Deeper into IT</h2>
                <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Explore more articles and insights to stay ahead in the tech world with Volera Technologies.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                    Contact Us
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 11:04 PM IST</p>
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
