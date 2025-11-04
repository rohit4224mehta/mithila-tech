@extends('layouts.employee_app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header with Welcome Message -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-primary mb-2">Dashboard</h1>
                    <p class="text-muted lead">Welcome back, {{ auth()->user()->employee ? auth()->user()->employee->first_name ?? auth()->user()->name : 'Guest' }}!</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-warning text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <h3 class="h6 text-warning fw-bold mb-2">Tasks Completed</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->tasks->where('status', 'completed')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-info text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <h3 class="h6 text-info fw-bold mb-2">Present Days</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->attendance->where('status', 'present')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-success text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-kanban fs-4"></i>
                        </div>
                        <h3 class="h6 text-success fw-bold mb-2">Projects Active</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->projects->where('status', 'in_progress')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-danger text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-door-open fs-4"></i>
                        </div>
                        <h3 class="h6 text-danger fw-bold mb-2">Pending Leaves</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->leaves->where('status', 'pending')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="card mb-5 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold text-primary mb-3">Task Completion Trend (Last 7 Days)</h5>
                <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                    <canvas id="taskChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="row g-4">
            <!-- Tasks Table -->
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title fw-semibold text-primary">Recent Tasks</h5>
                            <a href="{{ route('employee.tasks.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3">Task ID</th>
                                        <th class="py-3">Title</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->tasks->sortByDesc('created_at')->take(3) as $task)
                                        <tr>
                                            <td class="py-3">{{ $task->id }}</td>
                                            <td class="py-3">{{ $task->title }}</td>
                                            <td class="py-3"><span class="badge {{ $task->status === 'completed' ? 'bg-success' : ($task->status === 'in_progress' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ ucfirst($task->status) }}</span></td>
                                            <td class="py-3">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-3 text-center">No tasks available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title fw-semibold text-primary">Recent Attendance</h5>
                            <a href="{{ route('employee.attendance.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3">Date</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Check-in</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->attendance->sortByDesc('date')->take(3) as $attendance)
                                        <tr>
                                            <td class="py-3">{{ $attendance->date->format('M d, Y') }}</td>
                                            <td class="py-3"><span class="badge {{ $attendance->status === 'present' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($attendance->status) }}</span></td>
                                            <td class="py-3">{{ $attendance->check_in ? $attendance->check_in->format('h:i A') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-3 text-center">No attendance records available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    @media (max-width: 768px) {
        .chart-container {
            height: 200px !important;
        }
        .card-body {
            padding: 1rem;
        }
        .table-responsive {
            min-width: 300px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('taskChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Tasks Completed',
                data: {{ json_encode(auth()->user()->tasks->where('status', 'completed')->groupBy(function ($task) {
                    return now()->subDays(6 - (now()->dayOfWeek - $task->created_at->dayOfWeek + 7) % 7)->format('D');
                })->map->count()->all()) ?: [0, 0, 0, 0, 0, 0, 0] }}, // Dynamic data or fallback
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                },
                x: {
                    ticks: { font: { size: 12 } }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
@endpush
