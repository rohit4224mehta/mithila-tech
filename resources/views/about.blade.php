@extends('layouts.app')

@section('content')
    <!-- About Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="text-center mb-5 animate__animated animate__fadeInDown">
                <h2 class="section-title">About Us</h2>
                <p class="lead text-muted">Discover the story behind Mithila Tech</p>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                    <img src="{{ $aboutData->image_url ?? asset('images/mission.jpg') }}" alt="Mithila Tech Team" class="img-fluid rounded-3 shadow-lg">
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <h3 class="h4 fw-bold mb-3">Who We Are</h3>
                    <p class="mb-4">{{ $aboutData->description ?? 'Mithila Tech is a Nepal-based IT startup revolutionizing technology with innovative solutions.' }}</p>
                    <p class="mb-4">
                        Founded in {{ $aboutData->founded_year ?? 2020 }}, Mithila Tech has grown into a leading IT solutions provider with over {{ $aboutData->team_size ?? 50 }} professionals. We serve clients across {{ $aboutData->countries_served ?? 10 }} countries, delivering innovative solutions to empower businesses.
                    </p>
                    <a href="#team" class="btn btn-primary">Meet Our Team</a>
                </div>
            </div>

            <!-- Our Values -->
            <div class="text-center mb-5 animate__animated animate__fadeInUp">
                <h2 class="section-title">Our Core Values</h2>
                <p class="lead text-muted">Guiding principles that define our work</p>
            </div>

            <div class="row g-4">
                @forelse ($values as $value)
                    <div class="col-md-4 animate__animated animate__fadeInUp" data-delay="{{ $loop->index * 100 }}">
                        <div class="card card-service h-100">
                            <div class="card-body text-center p-4">
                                <div class="service-icon">
                                    <i class="bi {{ $value->icon ?? 'bi-info-circle' }}"></i>
                                </div>
                                <h4 class="mb-3">{{ $value->title ?? 'Value Title' }}</h4>
                                <p class="text-muted">{{ $value->description ?? 'Description here' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No values defined yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Milestones -->
            <div class="text-center mt-5 animate__animated animate__fadeIn">
                <h2 class="section-title">Our Milestones</h2>
                <p class="lead text-muted">A journey of growth and achievement</p>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <ul class="timeline">
                        @forelse ($milestones as $milestone)
                            <li class="timeline-item animate__animated animate__fadeInUp" data-delay="{{ $loop->index * 100 }}">
                                <div class="timeline-content">
                                    <h5 class="mb-2">{{ $milestone->year ?? 'Year' }} - {{ $milestone->title ?? 'Title' }}</h5>
                                    <p>{{ $milestone->description ?? 'Description here' }}</p>
                                </div>
                            </li>
                        @empty
                            <li class="timeline-item">
                                <div class="timeline-content">
                                    <p class="text-muted">No milestones available.</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Members Section -->
    <section id="team" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5 animate__animated animate__fadeInDown">
                <h2 class="fw-bold">Meet Our Team</h2>
                <p class="text-muted">The people behind Mithila Tech’s innovation and impact</p>
            </div>

            <div class="row g-4">
                @forelse($teamMembers as $member)
                    <div class="col-md-4 col-sm-6 animate__animated animate__fadeInUp">
                        <div class="card h-100 shadow-sm team-card text-center">
                            <div class="card-body">
                                <img src="{{ $member->image_url ?? asset('images/default-avatar.png') }}" alt="{{ $member->name ?? 'Team Member' }}" class="rounded-circle mb-3" width="100" height="100">
                                <h5 class="card-title mb-1">{{ $member->name ?? 'Name' }}</h5>
                                <p class="text-primary fw-semibold small">{{ $member->position ?? 'Position' }}</p>
                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($member->bio ?? 'Bio here', 100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center col-12">No team members found.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Service Cards */
    .card-service {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .card-service:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(67, 97, 238, 0.1);
        margin: 0 auto 1.5rem;
        color: var(--primary-color);
        font-size: 2rem;
    }

    /* Timeline */
    .timeline {
        position: relative;
        list-style: none;
        padding: 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 3px;
        background: var(--primary-color);
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        width: 50%;
        padding: 0 40px;
        box-sizing: border-box;
        margin-bottom: 30px;
    }

    .timeline-item:nth-child(odd) {
        left: 0;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
    }

    .timeline-content {
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 768px) {
        .timeline::before {
            left: 40px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 0;
        }

        .timeline-item:nth-child(even) {
            left: 0;
        }
    }

    /* Team Member Cards */
    .team-card img {
        object-fit: cover;
        border: 3px solid #4361ee;
    }

    .team-card {
        border-radius: 12px;
        transition: 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.1);
    }

    /* Custom Variables */
    :root {
        --primary-color: #4361ee;
    }
</style>
@endpush

@push('scripts')
<script>
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