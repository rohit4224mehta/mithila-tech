@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Blog Detail Section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="mb-4">{{ $blog->title }}</h1>
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ $blog->author_image ?? 'https://via.placeholder.com/50' }}" alt="{{ $blog->author ?? 'Author' }}" class="rounded-circle me-3" width="50" height="50" loading="lazy">
                            <div>
                                <h6 class="mb-0">{{ $blog->author ?? 'Mithila Tech' }}</h6>
                                <small class="text-muted">{{ $blog->author_title ?? 'Contributor' }}</small><br>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i> {{ $blog->published_at->format('F j, Y') }} •
                                    <i class="bi bi-clock me-1"></i> {{ $blog->read_time ?? '5' }} min read
                                </small>
                            </div>
                        </div>
                        <div class="mb-4">
                            @if($blog->category)
                                <span class="badge bg-primary me-2">{{ $blog->category }}</span>
                            @endif
                            @if($blog->tags)
                                @foreach(explode(',', $blog->tags) as $tag)
                                    <span class="badge bg-teal">{{ trim($tag) }}</span>
                                @endforeach
                            @endif
                        </div>
                        <img src="{{ $blog->image ? asset($blog->image) : 'https://via.placeholder.com/800x400' }}" alt="{{ $blog->title }}" class="img-fluid rounded mb-4" loading="lazy">
                        <div class="content">
                            {!! nl2br(e($blog->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer bg-dark text-white py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; {{ date('Y') }} Mithila Tech. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">
                            <span id="datetime" class="fw-bold"></span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript for dynamic datetime -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateDateTime() {
            const now = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Kolkata',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZoneName: 'short'
            });
            document.getElementById('datetime').textContent = now;
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);
    });
    </script>
@endsection

<!-- External Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">