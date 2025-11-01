@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-900 via-blue-600 to-purple-600">
        <section class="py-20 text-center">
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">Application Managed Services</h1>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Comprehensive support to optimize and maintain your applications for peak performance.
                </p>
            </div>
        </section>

        <section class="py-16 bg-white/95 backdrop-blur-lg">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="animate__animated animate__fadeInLeft">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">What We Offer</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Our Application Managed Services provide end-to-end support, including monitoring, updates, and troubleshooting to ensure your software runs smoothly. We tailor solutions to meet your business needs, enhancing reliability and user satisfaction.
                        </p>
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/600x400?text=App+Managed+Services" alt="App Services" class="rounded-xl shadow-2xl w-full h-auto hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-100/95 backdrop-blur-lg">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 animate__animated animate__zoomIn">Benefits</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-shield-fill text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800">Enhanced Security</h3>
                        <p class="text-gray-600">Protect your applications with advanced security protocols.</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-clock-fill text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800">24/7 Support</h3>
                        <p class="text-gray-600">Round-the-clock assistance for uninterrupted service.</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-graph-up text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800">Performance Boost</h3>
                        <p class="text-gray-600">Optimize your apps for faster and efficient operations.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white/95 backdrop-blur-lg">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 animate__animated animate__fadeIn">Client Testimonial</h2>
                <div class="max-w-2xl mx-auto bg-indigo-50 p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                    <p class="text-gray-600 italic mb-4">"Volera’s application support saved us hours of downtime—highly recommend!"</p>
                    <p class="text-gray-800 font-semibold">- TechCorp Manager</p>
                </div>
            </div>
        </section>

        <section class="py-20 text-center bg-gradient-to-br from-indigo-900 to-blue-600">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-white mb-6 animate__animated animate__fadeInDown">Get Started Today</h2>
                <p class="text-lg text-gray-200 max-w-2xl mx-auto mb-8 animate__animated animate__fadeInUp">
                    Elevate your applications with our expert services. Contact us now!
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                    Contact Us
                </a>
            </div>
        </section>

        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 07:09 PM IST</p>
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
