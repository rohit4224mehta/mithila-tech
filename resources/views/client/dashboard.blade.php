@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">
        Client Dashboard - IT Solutions Hub
    </h2>

    {{-- ✅ Debug (only for local env) --}}
    @if (app()->environment('local'))
        {{-- <pre>{{ json_encode($projects->toArray(), JSON_PRETTY_PRINT) }}</pre> --}}
    @endif

    <div class="row g-4">

        {{-- 📊 Project Overview Card --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Project Overview</h5>
                    <p><strong>Total Projects:</strong> {{ $projectCount ?? 0 }}</p>
                    <p><strong>Total Hours:</strong> {{ $totalHours ?? 0 }}</p>
                    <p><strong>Pending Tasks:</strong> {{ $pendingTasks ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- 🕒 Recent Projects --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Recent Projects</h5>

                    @if ($recentProjects->isEmpty())
                        <p class="text-muted">No projects available yet.</p>
                    @else
                        <div class="list-group">
                            @foreach ($recentProjects as $project)
                                <a href="{{ route('client.projects.show', $project->id) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">{{ $project->name }}</h6>
                                        <small class="text-muted">
                                            {{ optional($project->start_date)->format('M d, Y') }}
                                        </small>
                                    </div>
                                    <p class="mb-1 small text-secondary">
                                        Status: <span class="badge bg-info text-dark">{{ ucfirst($project->status) }}</span>
                                    </p>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                             style="width: {{ $project->progress }}%"
                                             aria-valuenow="{{ $project->progress }}"
                                             aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        Progress: {{ $project->progress }}%
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- 📈 Project Progress Chart --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm bg-glass">
                <div class="card-body p-4">
                    <h5 class="card-title text-dark mb-3">Project Progress Visualization</h5>
                    @if (empty($chartData['labels']))
                        <p class="text-muted">No project data available for visualization.</p>
                    @else
                        <canvas id="projectProgressChart" height="200"></canvas>
                    @endif
                </div>
            </div>
        </div>

        {{-- ⚡ Quick Links --}}
        <div class="col-md-3">
            <a href="{{ route('client.projects') }}"
               class="card h-100 bg-primary text-white p-4 text-decoration-none text-center">
                <i class="bi bi-kanban fs-2 mb-2"></i>
                <h6 class="mb-0">View Projects</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('client.feedback') }}"
               class="card h-100 bg-primary text-white p-4 text-decoration-none text-center">
                <i class="bi bi-chat-dots fs-2 mb-2"></i>
                <h6 class="mb-0">Submit Feedback</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('client.password.edit') }}"
               class="card h-100 bg-primary text-white p-4 text-decoration-none text-center">
                <i class="bi bi-shield-lock fs-2 mb-2"></i>
                <h6 class="mb-0">Change Password</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('client.contact.submit') }}"
               class="card h-100 bg-primary text-white p-4 text-decoration-none text-center">
                <i class="bi bi-envelope fs-2 mb-2"></i>
                <h6 class="mb-0">Contact Support</h6>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-glass {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }
    .bg-light-blue { background-color: #4dabf7; }
    .bg-light-purple { background-color: #a770ef; }
    .bg-light-orange { background-color: #ff8c42; }
    .bg-light-green { background-color: #32cd32; }
    .card {
        border-radius: 1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.2);
    }
    .progress-bar {
        transition: width 0.6s ease;
    }
    @media (max-width: 767.98px) {
        .row > [class*="col-"] {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if (!empty($chartData['labels']))
        const ctx = document.getElementById('projectProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Progress (%)',
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: '#4dabf7',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: { display: true, text: 'Progress (%)' }
                    }
                }
            }
        });
    @endif
});
</script>
@endpush
