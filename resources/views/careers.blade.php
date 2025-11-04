@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-900 via-gray-900 to-black text-white py-20 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-4 animate__animated animate__fadeInDown">
                    Join Mithila Tech
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 mb-6 animate__animated animate__fadeIn animate__delay-1s">
                    Shape the future of IT with our innovative team in Nepal and beyond.
                </p>
                <div class="flex justify-center gap-4 animate__animated animate__fadeIn animate__delay-2s">
                    <a href="#openings" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                        View Openings
                    </a>
                    <a href="#culture" class="inline-block border-2 border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-gray-900 transition-all duration-300 transform hover:scale-105">
                        Our Culture
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Openings Section -->
    <section class="py-16 bg-white" id="openings">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Current Opportunities</h2>
                <p class="text-lg text-gray-600 mt-2">Explore exciting roles tailored for passionate professionals</p>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-100 text-red-800 rounded-lg text-center">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Job Filter -->
            <div class="mb-8 flex flex-col sm:flex-row justify-center gap-4">
                <input type="text" id="job-search" class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search jobs...">
                <select id="job-filter" class="w-full sm:w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Roles</option>
                    <option value="developer">Developer</option>
                    <option value="designer">Designer</option>
                    <option value="manager">Manager</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="job-listings">
                @forelse ($careers as $career)
                    <div class="job-card bg-white border border-gray-200 rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" data-type="{{ Str::lower($career->category ?? $career->title) }}">
                        <div class="flex items-center mb-4">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full p-3">
                                <i class="bi bi-briefcase-fill text-lg"></i>
                            </div>
                            <h3 class="ml-4 text-xl font-semibold text-gray-900">{{ $career->title }}</h3>
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <p><i class="bi bi-geo-alt mr-2"></i>{{ $career->location ?? 'Remote' }}</p>
                            <p><i class="bi bi-clock mr-2"></i>{{ $career->type ?? 'Full-time' }}</p>
                            <p><i class="bi bi-bar-chart mr-2"></i>{{ $career->experience ?? '2+ years' }}</p>
                        </div>
                        <p class="mt-4 text-gray-600">{{ Str::limit($career->description ?? 'No description available.', 150) }}</p>
                        <ul class="mt-4 space-y-2 text-gray-600">
                            @foreach ($career->benefits as $benefit)
                                <li><i class="bi bi-check-circle-fill text-blue-600 mr-2"></i>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('career.apply', $career->slug) }}" class="mt-6 inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all duration-300">
                            Apply Now
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 text-lg">No open positions currently available. Check back soon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Culture Section -->
    <section class="py-16 bg-gray-100" id="culture">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Our Culture & Values</h2>
                <p class="text-lg text-gray-600 mt-2">What makes Mithila Tech a great place to work</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cultureValues as $value)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <i class="{{ $value->icon ?? 'bi bi-heart-fill' }} text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $value->title }}</h3>
                        <p class="text-gray-600">{{ $value->description }}</p>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-600 text-lg">Culture information coming soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">What Our Team Says</h2>
                <p class="text-lg text-gray-600 mt-2">Hear from our employees</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($testimonials as $testimonial)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md p-6 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <img src="{{ $testimonial->image_url ?? 'https://via.placeholder.com/80' }}" alt="{{ $testimonial->name }}" class="mx-auto rounded-full mb-4" width="80" height="80">
                        <p class="text-gray-600 mb-4">"{{ $testimonial->content }}"</p>
                        <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                        <p class="text-gray-500 text-sm">{{ $testimonial->role }}</p>
                        <div class="mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill text-yellow-400' : 'bi-star text-gray-300' }} mr-1"></i>
                            @endfor
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-600 text-lg">No testimonials available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-blue-900 via-gray-900 to-black text-white text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-4 animate__animated animate__fadeInDown">
                Ready to Join Us?
            </h2>
            <p class="text-lg text-gray-300 mb-6 animate__animated animate__fadeInUp">
                Take the next step in your career with Mithila Tech.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-gray-900 px-6 py-3 rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate__animated animate__zoomIn">
                Contact HR
            </a>
        </div>
    </section>
</div>



@section('scripts')

<script>
    AOS.init({
        duration: 800,
        once: true,
    });

    // Job search and filter
    document.getElementById('job-search').addEventListener('input', filterJobs);
    document.getElementById('job-filter').addEventListener('change', filterJobs);

    function filterJobs() {
        const search = document.getElementById('job-search').value.toLowerCase();
        const filter = document.getElementById('job-filter').value.toLowerCase();
        const cards = document.querySelectorAll('.job-card');

        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const type = card.dataset.type.toLowerCase();
            const matchesSearch = search === '' || title.includes(search);
            const matchesFilter = filter === '' || type.includes(filter);
            card.style.display = matchesSearch && matchesFilter ? '' : 'none';
        });
    }
</script>
@endsection