@extends('layouts.employee_app')

@section('content')
    <div class="d-flex vh-100 bg-gradient" style="background: linear-gradient(135deg, #f1f5f9 0%, #e0e7ff 100%);">
        <div class="container-fluid py-4 flex-grow-1">
            <!-- Page Header -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h2 fw-bold text-dark" style="color: #2c3e50;">MithilaTech Attendance System</h1>
                        <p class="text-muted lead">Manage and track your daily attendance with ease</p>
                    </div>
                </div>
            </div>

            <!-- Clock-In/Clock-Out Section -->
            <div class="card shadow-lg rounded-3 mb-5">
                <div class="card-body p-4 text-center">
                    <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Clock In/Out</h5>
                    <p class="h4 mb-4" id="currentTimeDisplay">{{ now()->format('l, F d, Y, h:i A') }} IST</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button id="clockInBtn" class="btn btn-success px-4 py-2 rounded-pill shadow-sm" data-action="clock-in" {{ auth()->user()->attendanceToday ? 'disabled' : '' }}>
                            <i class="bi bi-play-fill me-2"></i> Clock In
                        </button>
                        <button id="clockOutBtn" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm" data-action="clock-out" {{ !auth()->user()->attendanceToday || (auth()->user()->attendanceToday && auth()->user()->attendanceToday->check_out) ? 'disabled' : '' }}>
                            <i class="bi bi-stop-fill me-2"></i> Clock Out
                        </button>
                    </div>
                    <p class="mt-3 text-muted" id="statusMessage">
                        Status: {{ auth()->user()->attendanceToday ? (auth()->user()->attendanceToday->check_out ? 'Clocked Out' : 'Clocked In') : 'Not Clocked In' }}
                    </p>
                </div>
            </div>

            <!-- Attendance Summary with Cards -->
            <div class="card shadow-lg rounded-3 mb-5">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Attendance Summary</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <div class="stat-card p-4 bg-success bg-opacity-10 rounded-4 shadow-sm border border-success border-opacity-25 text-center">
                                <i class="bi bi-calendar-check fs-4 text-success"></i>
                                <h3 class="h6 text-success fw-bold mt-2">Total Days</h3>
                                <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->attendance->count() }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="stat-card p-4 bg-info bg-opacity-10 rounded-4 shadow-sm border border-info border-opacity-25 text-center">
                                <i class="bi bi-check-circle fs-4 text-info"></i>
                                <h3 class="h6 text-info fw-bold mt-2">Present Days</h3>
                                <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->attendance->where('status', 'present')->count() }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="stat-card p-4 bg-danger bg-opacity-10 rounded-4 shadow-sm border border-danger border-opacity-25 text-center">
                                <i class="bi bi-x-circle fs-4 text-danger"></i>
                                <h3 class="h6 text-danger fw-bold mt-2">Absent Days</h3>
                                <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->attendance->where('status', 'absent')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Attendance Chart -->
                    <div style="height: 300px; margin-top: 20px;">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Attendance Log Table -->
            <div class="card shadow-lg rounded-3 mb-5">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Attendance Log</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 text-dark" style="color: #2c3e50;">Date</th>
                                    <th class="py-3 text-dark" style="color: #2c3e50;">Clock In</th>
                                    <th class="py-3 text-dark" style="color: #2c3e50;">Clock Out</th>
                                    <th class="py-3 text-dark" style="color: #2c3e50;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (auth()->user()->attendance as $record)
                                    <tr>
                                        <td class="py-3">{{ $record->date->format('F d, Y') }}</td>
                                        <td class="py-3">{{ $record->check_in ? $record->check_in->format('h:i A') : '-' }}</td>
                                        <td class="py-3">{{ $record->check_out ? $record->check_out->format('h:i A') : '-' }}</td>
                                        <td class="py-3"><span class="badge {{ $record->status === 'present' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($record->status) }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-3 text-center">No attendance records available</td>
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

    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card {
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-success, .btn-danger {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .btn-success:hover, .btn-danger:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .table-light th {
        background-color: #f1f3f5;
        color: var(--primary-color);
        font-weight: 600;
    }

    .progress {
        border-radius: 10px;
        background-color: #e9ecef;
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
        h1 { font-size: 1.5rem; }
        .container-fluid { padding: 0.5rem; }
        .col-12.col-md-4 { margin-bottom: 1rem; }
        .d-flex.justify-content-center { flex-direction: column; gap: 0.5rem; }
        .btn { width: 100%; margin: 0.25rem 0; }
        #currentTimeDisplay { font-size: 1.25rem; }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        h1 { font-size: 1.75rem; }
        .container-fluid { padding: 1rem; }
        .col-12.col-md-4 { margin-bottom: 0.75rem; }
        .d-flex.justify-content-center { gap: 1rem; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    function updateTime() {
        const now = new Date().toLocaleString('en-US', { timeZone: 'Asia/Kolkata', weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true });
        document.getElementById('currentTimeDisplay').textContent = `${now} IST`;
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Attendance Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceData = {
        labels: @json(auth()->user()->attendance->map(function ($record) {
            return $record->date->format('F d');
        })->all() ?? []),
        datasets: [{
            label: 'Attendance Status',
            data: @json(auth()->user()->attendance->map(function ($record) {
                return $record->status === 'present' ? 1 : 0;
            })->all() ?? []),
            backgroundColor: @json(auth()->user()->attendance->map(function ($record) {
                return $record->status === 'present' ? '#10b981' : '#ef4444';
            })->all() ?? []),
            borderColor: '#ffffff',
            borderWidth: 1
        }]
    };
    new Chart(ctx, {
        type: 'bar',
        data: attendanceData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top', labels: { font: { size: 14 } } },
                title: { display: true, text: 'Attendance Overview', font: { size: 16 }, color: '#2c3e50' }
            },
            scales: {
                y: { beginAtZero: true, max: 1, ticks: { callback: value => value === 1 ? 'Present' : 'Absent' } }
            }
        }
    });

    // Clock In/Out Functionality
    const clockInBtn = document.getElementById('clockInBtn');
    const clockOutBtn = document.getElementById('clockOutBtn');
    const statusMessage = document.getElementById('statusMessage');

    function updateButtonStates() {
        const attendance = @json(auth()->user()->attendanceToday ?? null);
        clockInBtn.disabled = !!attendance;
        clockOutBtn.disabled = !attendance || (attendance && attendance.check_out !== null);
        statusMessage.textContent = `Status: ${attendance ? (attendance.check_out ? 'Clocked Out' : 'Clocked In') : 'Not Clocked In'}`;
    }

    [clockInBtn, clockOutBtn].forEach(btn => {
    btn.addEventListener('click', function() {
        const action = this.getAttribute('data-action');
        fetch(`/employee/attendance/${action}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateButtonStates();
                alert(`${action === 'clock-in' ? 'Clocked In' : 'Clocked Out'} successfully!`);
            } else {
                alert(`Error: ${data.message || 'Something went wrong'}`);
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('An error occurred. Check console for details.');
        });
    });
});

    updateButtonStates();
});
</script>
@endpush
