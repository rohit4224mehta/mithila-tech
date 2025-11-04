@extends('layouts.employee_app')

@section('content')
    <div class="d-flex vh-100 bg-gradient" style="background: linear-gradient(135deg, #f1f5f9 0%, #e0e7ff 100%);">
        <div class="container-fluid py-4 flex-grow-1">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h2 fw-bold text-dark" style="color: #2c3e50;">Performance Dashboard</h1>
                        <p class="text-muted lead">Welcome back, {{ auth()->user()->name }}! Review your performance metrics here.</p>
                    </div>
                </div>
            </div>

            <!-- Performance KPIs -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-circle bg-success text-white mb-3">
                                <i class="bi bi-check-circle fs-4"></i>
                            </div>
                            <h3 class="h6 text-success fw-bold mb-2">Task Completion</h3>
                            <p class="h3 mb-0 fw-bold">{{ number_format($performance['task_completion'], 0) }}%</p>
                            <small class="text-muted">+{{ $performance['task_completion_change'] ?? 0 }}% from last month</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-circle bg-primary text-white mb-3">
                                <i class="bi bi-star-fill fs-4"></i>
                            </div>
                            <h3 class="h6 text-primary fw-bold mb-2">Avg. Rating</h3>
                            <p class="h3 mb-0 fw-bold">{{ number_format($performance['avg_rating'], 1) }}/5</p>
                            <small class="text-muted">From {{ $performance['review_count'] ?? 0 }} reviews</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon-circle bg-info text-white mb-3">
                                <i class="bi bi-kanban fs-4"></i>
                            </div>
                            <h3 class="h6 text-info fw-bold mb-2">Projects</h3>
                            <p class="h3 mb-0 fw-bold">{{ $performance['completed_projects'] ?? 0 }}</p>
                            <small class="text-muted">Completed this quarter</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Chart -->
            <div class="card shadow-lg rounded-3 mb-5">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Performance Trend</h5>
                    <div style="height: 300px;">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="card shadow-lg rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Recent Reviews</h5>
                        <a href="{{ route('employee.performance.reviews') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-dark" style="color: #2c3e50;">Date</th>
                                    <th class="text-dark" style="color: #2c3e50;">Reviewer</th>
                                    <th class="text-dark" style="color: #2c3e50;">Rating</th>
                                    <th class="text-dark" style="color: #2c3e50;">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                                        <td>{{ $review->reviewer_name ?? 'Anonymous' }}</td>
                                        <td><span class="badge {{ $review->rating >= 4 ? 'bg-success' : ($review->rating >= 3 ? 'bg-primary' : 'bg-warning') }}">{{ $review->rating }}/5</span></td>
                                        <td>{{ $review->comments }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No reviews available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --light-color: #f8fafc;
    }

    .bg-gradient {
        background-size: 200% 200%;
        animation: gradientAnimation 15s ease infinite;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .card {
        border: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .row > * {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .table-responsive {
            min-width: 300px;
            overflow-x: auto;
        }
        h1 { font-size: 1.75rem; }
        .container-fluid { padding: 1rem; }
        .col-12.col-md-6.col-lg-4 { margin-bottom: 1rem; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Performance Chart
    const ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($performanceTrend['months']),
            datasets: [{
                label: 'Performance Score',
                data: @json($performanceTrend['scores']),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 3,
                    max: 5,
                    ticks: {
                        stepSize: 0.5
                    }
                }
            }
        }
    });
});
</script>
@endpush
