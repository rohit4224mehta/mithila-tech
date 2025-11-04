
@extends('layouts.app')

@section('content')
    <!-- Hero Section with Gradient Overlay and Parallax Effect -->
    <section class="hero relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-950 text-white text-center py-20 overflow-hidden" style="background-image: linear-gradient(to right, rgba(14, 15, 17, 0.9), rgba(30, 41, 59, 0.9)), url('{{ $hero->background_image ? asset('storage/' . $hero->background_image) : asset('images/home-hero.jpg') }}'); background-attachment: fixed; background-size: cover; background-position: center;">
        <div class="container py-16">
            <div class="animate-fade-in-down">
                <h1 class="display-3 fw-bold mb-6 text-shadow-lg">{{ $hero->title ?? 'Welcome to Mithila Tech' }}</h1>
                <p class="lead mx-auto mb-8 px-6 text-lg" style="max-width: 750px;">
                    {{ $hero->subtitle ?? 'Innovative IT Solutions' }} As of <strong>{{ date('h:i A T, l, F d, Y') }}</strong> ({{ now()->format('h:i A T') }}), our vision is set on tomorrow with {{ $hero->focus_areas ?? 'Innovation' }}.
                </p>
                <a href="#vision" class="btn btn-warning btn-lg shadow-xl hover:scale-110 transition-transform duration-300 bg-yellow-600 hover:bg-yellow-700 text-white">{{ $hero->call_to_action ?? 'Get Started' }}</a>
            </div>
            <div class="text-center mt-4 text-xl fst-italic text-gray-300 animate-fade-in-up">
                “{{ $hero->quote ?? 'Building the future, today.' }}”
            </div>
        </div>
    </section>

    <!-- Vision Section with Subtle Animation -->
    <section class="py-16 bg-gray-100 text-center" id="vision">
        <div class="container">
            <h2 class="fw-bold text-4xl mb-8 text-gray-800 animate__animated animate__fadeInUp">{{ $vision->title ?? 'Our Vision' }}</h2>
            <p class="lead mx-auto mb-10 text-gray-600" style="max-width: 850px;">
                {{ $vision->description ?? 'To revolutionize technology for a better world.' }}
            </p>
        </div>
    </section>

    <!-- Mithila Tech 5-Step Approach – Stylish Version -->
    <section class="py-16 bg-white">
        <div class="container">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 class="fw-bold text-4xl mb-4 text-gray-900">{{ $approach->title ?? 'Our Approach' }}</h2>
                <p class="text-gray-600 mx-auto" style="max-width: 750px;">
                    {{ $approach->subtitle ?? 'A systematic process to deliver excellence.' }}
                </p>
            </div>
            <div class="space-y-12">
                @forelse ($steps as $step)
                    <div class="row align-items-center gy-6 {{ $loop->iteration % 2 == 0 ? 'flex-md-row-reverse' : '' }}" data-aos="{{ $loop->iteration % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                        <div class="col-md-6 text-center">
                            <img src="{{ $step->image_url ? 'https://cdn-icons-png.flaticon.com/512/' . $step->image_url : asset('images/default-step.jpg') }}" class="img-fluid rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300" alt="{{ $step->title ?? 'Step' }}" style="max-height: 250px;">
                        </div>
                        <div class="col-md-6">
                            <h3 class="fw-bold mb-3 text-{{ $step->color ?? 'blue' }}-600 text-2xl">{{ $loop->iteration }}. {{ $step->title ?? 'Step Title' }}</h3>
                            <p class="text-gray-600 text-lg">{{ $step->description ?? 'Step description here.' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <p class="text-gray-600">No steps available at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- What We're Building with Hover Effects and Icons -->
    <section class="py-16 bg-gray-50 text-center">
        <div class="container">
            <h2 class="fw-bold text-4xl mb-6 text-gray-900">{{ $building->title ?? 'What We’re Building' }}</h2>
            <p class="text-gray-600 mb-8 text-lg mx-auto" style="max-width: 850px;">
                {{ $building->subtitle ?? 'Innovative solutions for global challenges.' }}
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($offerings as $offering)
                    <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-all duration-300 p-6 bg-white rounded-lg">
                        <div class="mb-4 flex justify-center">
                            <img src="{{ $offering->icon_url ? 'https://cdn-icons-png.flaticon.com/512/' . $offering->icon_url : asset('images/default-icon.png') }}" class="h-16" alt="{{ $offering->title ?? 'Offering' }}">
                        </div>
                        <h5 class="fw-semibold mb-3 text-xl text-{{ $offering->color ?? 'blue' }}-600">{{ $offering->title ?? 'Offering Title' }}</h5>
                        <p class="text-gray-600">{{ $offering->description ?? 'Offering description here.' }}</p>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-gray-600">No offerings available at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Why Mithila Tech Stands Out with Animation -->
    <section class="py-16 bg-gray-100">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="fw-bold text-4xl mb-4 text-gray-900">{{ $standout->title ?? 'Why We Stand Out' }}</h2>
                <p class="text-gray-600">{{ $standout->subtitle ?? 'Our commitment to innovation and quality sets us apart.' }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($strengths as $strength)
                    <div class="card h-100 border-0 shadow-md text-center p-6 bg-white rounded-lg hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <div class="mb-4 text-{{ $strength->color ?? 'blue' }}">
                            <i class="bi {{ $strength->icon ?? 'bi-star' }} fs-3"></i>
                        </div>
                        <h5 class="fw-semibold text-xl mb-3">{{ $strength->title ?? 'Strength Title' }}</h5>
                        <p class="text-gray-600">{{ $strength->description ?? 'Strength description here.' }}</p>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-gray-600">No strengths available at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Who We Are with Image Hover -->
    <section class="py-16 bg-white text-center">
        <div class="container">
            <h2 class="fw-bold text-4xl mb-6 text-gray-900">{{ $whoWeAre->title ?? 'Who We Are' }}</h2>
            <p class="lead mx-auto mb-8 text-gray-600" style="max-width: 850px;">
                {{ $whoWeAre->description ?? 'A team passionate about technology.' }}
            </p>
            <p class="text-gray-600 mb-8">Founded by <strong class="text-{{ $whoWeAre->founder_color ?? 'blue' }}-600">{{ $whoWeAre->founder_name ?? 'John Doe' }}</strong> with a dream to grow from zero to impact the world.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($founders as $founder)
                    <div class="card h-100 shadow-md border-0 hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $founder->image_url ? asset('storage/' . $founder->image_url) : asset('images/founders/default.jpg') }}" class="card-img-top rounded-t-lg" alt="{{ $founder->name ?? 'Founder' }} Photo">
                        <div class="card-body p-6">
                            <h5 class="card-title text-xl">{{ $founder->name ?? 'Founder Name' }}</h5>
                            <p class="text-{{ $founder->color ?? 'blue' }}-600 mb-2">{{ $founder->role ?? 'Role' }}</p>
                            <p class="card-text text-gray-600">{{ $founder->bio ?? 'Founder bio here.' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-gray-600">No founders available at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Latest Insights with Dynamic Loading -->
    <section class="py-16 bg-gray-50">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="fw-bold text-4xl mb-4 text-gray-900">{{ $insights->title ?? 'Latest Insights' }}</h2>
                <p class="text-gray-600">Stay updated with our latest news, announcements, and tech trends as of {{ date('F d, Y') }}.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($insights->posts ?? [] as $post)
                    <div class="card h-100 shadow-md border-0 hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ $post->image_url ? asset('storage/' . $post->image_url) : asset('images/blog/default.jpg') }}" class="card-img-top rounded-t-lg" alt="{{ $post->title ?? 'Blog Post' }} Blog Post">
                        <div class="card-body p-6">
                            <h5 class="card-title text-xl">{{ $post->title ?? 'Post Title' }}</h5>
                            <p class="card-text text-gray-600">{{ $post->excerpt ?? 'Post excerpt here.' }}</p>
                            <a href="{{ route('blog.show', $post->slug ?? '#') }}" class="btn btn-sm btn-outline-primary mt-3">Read More</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-gray-600">No posts available at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .text-shadow-lg {
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
    }

    .animate__animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .animate__fadeIn {
        animation-name: fadeIn;
    }

    .animate__fadeInUp {
        animation-name: fadeInUp;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card:hover {
        transform: translateY(-10px);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .hover-shadow {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .transition {
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .hero h1 { font-size: 2rem; }
        .hero .lead { font-size: 1rem; }
        .grid-cols-3 { grid-template-columns: 1fr; }
        .col-md-6 { flex: 0 0 100%; max-width: 100%; }
    }
</style>
@endpush

@push('scripts')
<script>
    AOS.init();
    document.addEventListener('DOMContentLoaded', function () {
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate__animated');
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                const delay = element.dataset.delay ? parseInt(element.dataset.delay) : 0;
                if (elementPosition < screenPosition) {
                    setTimeout(() => {
                        element.classList.add(element.classList[1]);
                    }, delay);
                }
            });
        };
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    });
</script>
@endpush
