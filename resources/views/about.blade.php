@extends('layouts.app')

@section('content')
    <div class="min-vh-100 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-600">
        <!-- Hero Section -->
        <section class="py-20 md:py-32 bg-opacity-90">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">Welcome to Volera Technologies</h1>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Innovating IT solutions to empower businesses worldwide. Explore our journey, mission, and services designed for your success.
                </p>
                <a href="#our-mission" class="btn btn-primary inline-block px-10 py-4 text-xl font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300 animate__animated animate__pulse animate__infinite animate__slower">
                    Learn More
                </a>
            </div>
        </section>

        <!-- Mission & History Section -->
        <section class="py-20 bg-white/95 backdrop-blur-lg">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
                    <div class="animate__animated animate__fadeInLeft">
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6">Our Mission</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            At Volera Technologies, our mission is to revolutionize the IT landscape with innovative, scalable, and secure solutions. We empower businesses to thrive in a digital-first world through expertise, dedication, and a client-centric approach.
                        </p>
                    </div>
                    <div>
                        <img src="public/images/mission+images.avif" alt="Our Mission" class="rounded-xl shadow-2xl w-full h-auto transition-transform hover:scale-105 duration-300">
                    </div>
                </div>
                <div class="text-center">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-10 animate__animated animate__zoomIn">Our History</h2>
                    <p class="text-gray-600 leading-relaxed text-lg max-w-4xl mx-auto mb-12">
                        Founded in 2010, Volera Technologies started with a small team of IT enthusiasts. Over 15 years, we’ve grown globally, completing over 500 projects, driven by innovation and a commitment to excellence.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-indigo-600 mb-2">2010</h3>
                            <p class="text-gray-600">Company Founded</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-indigo-600 mb-2">2015</h3>
                            <p class="text-gray-600">Global Expansion</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-indigo-600 mb-2">2023</h3>
                            <p class="text-gray-600">500+ Projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Teaser Section -->
        <section class="py-20 bg-gray-100/95 backdrop-blur-lg">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-12 animate__animated animate__fadeIn">Our Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-app-fill text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Application Managed Services</h3>
                        <p class="text-gray-600">Comprehensive support for your applications, ensuring optimal performance.</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-cloud-fill text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Cloud Managed Services</h3>
                        <p class="text-gray-600">Scalable cloud solutions tailored to your business needs.</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <i class="bi bi-database-fill text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">MySQL Services</h3>
                        <p class="text-gray-600">Robust database management for seamless operations.</p>
                    </div>
                </div>
                {{-- <a href="{{ route('services') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg mt-8 hover:scale-105 transition-transform duration-300"> --}}
                    Explore All Services
                </a>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-white/95 backdrop-blur-lg">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-12 animate__animated animate__zoomIn">What Our Clients Say</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <p class="text-gray-600 italic mb-4">&quot;Volera transformed our cloud infrastructure, saving us 25% in costs!&quot;</p>
                        <p class="text-gray-800 font-semibold">- TechCorp CEO</p>
                    </div>
                    <div class="p-6 bg-indigo-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300">
                        <p class="text-gray-600 italic mb-4">&quot;Their e-commerce solution boosted our sales by 60%—incredible service!&quot;</p>
                        <p class="text-gray-800 font-semibold">- Global Retail Manager</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action with Contact Form -->
        <section class="py-20 text-center bg-gradient-to-br from-blue-900 to-indigo-600">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-8 animate__animated animate__fadeInDown">Join Our Journey</h2>
                <p class="text-lg text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Ready to transform your business? Contact us today to start your digital journey with Volera Technologies!
                </p>
                <div class="max-w-lg mx-auto bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-2xl animate__animated animate__zoomIn">
                    <form>
                        <div class="mb-4">
                            <input type="text" placeholder="Your Name" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </div>
                        <div class="mb-4">
                            <input type="email" placeholder="Your Email" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </div>
                        <div class="mb-6">
                            <textarea placeholder="Your Message" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-full py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                            Get in Touch
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer Welcome Message -->
        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 06:40 PM IST</p>
        </footer>
    </div>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

body {
    font-family: 'Poppins', sans-serif;
}

.min-vh-100 {
    min-height: 100vh;
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
    overflow: hidden;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
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

.shadow-2xl {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

@media (max-width: 767px) {
    .container {
        padding: 1rem;
    }
    .card {
        margin: 1rem;
    }
    h1 { font-size: 2.5rem; }
    h2 { font-size: 2rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
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

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
