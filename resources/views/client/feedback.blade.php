@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">Client Feedback & Reviews</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Submit Feedback Form -->
        <div class="col-md-6">
            <div class="card shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Submit Feedback</h5>
                    <form action="{{ route('client.feedback.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="project_id" class="form-label">Select Project</label>
                            <select name="project_id" id="project_id" class="form-select" required>
                                <option value="">Choose a project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="">Select rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Feedback History -->
        <div class="col-md-6">
            <div class="card shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Feedback History</h5>
                    <div class="list-group">
                        @foreach ($feedbacks as $feedback)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-between">
                                    <h6 class="mb-1">{{ $feedback->project->name ?? 'Unknown Project' }}</h6>
                                    <small>{{ $feedback->created_at->format('M d, Y') }}</small>
                                </div>
                                <p class="mb-1 small">Rating: {{ $feedback->rating }}/5</p>
                                <p class="text-sm text-gray-500">{{ Str::limit($feedback->comment, 100) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Chart -->
        <div class="col-md-12">
            <div class="card shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Feedback Analytics</h5>
                    <canvas id="feedbackChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('feedbackChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                datasets: [{
                    label: 'Feedback Ratings',
                    data: [
                        {{ $ratingCounts->get(1, 0) }},
                        {{ $ratingCounts->get(2, 0) }},
                        {{ $ratingCounts->get(3, 0) }},
                        {{ $ratingCounts->get(4, 0) }},
                        {{ $ratingCounts->get(5, 0) }}
                    ],
                    backgroundColor: ['#EF4444', '#F59E0B', '#EAB308', '#22C55E', '#10B981'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Rating Distribution'
                    }
                }
            }
        });
    });
</script>
@endpush