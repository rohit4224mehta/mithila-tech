@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-vh-100 py-5" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
        <div class="col-md-10">
            <div class="text-center mb-5">
                <h1 class="text-white mb-3" style="font-family: 'Poppins', sans-serif;">Employee Dashboard</h1>
                <p class="text-white-50" style="font-family: 'Poppins', sans-serif;">Welcome! Today is Wednesday, July 23, 2025, 02:21 AM IST</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 dashboard-card">
                        <div class="card-header bg-transparent text-primary border-0">
                            <i class="bi bi-list-task me-2"></i> My Tasks
                        </div>
                        <div class="card-body">
                            <p class="card-text">View and update your assigned tasks with ease.</p>
                            <a href="{{ route('employee.tasks.index') }}" class="btn btn-primary mt-3">View Tasks <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 dashboard-card">
                        <div class="card-header bg-transparent text-primary border-0">
                            <i class="bi bi-calendar-check-fill me-2"></i> Attendance
                        </div>
                        <div class="card-body">
                            <p class="card-text">Mark your check-in and check-out effortlessly.</p>
                            <a href="{{ route('employee.attendance.index') }}" class="btn btn-primary mt-3">Mark Attendance <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>


    .min-vh-100 {
        min-height: 100vh;
    }

    .dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-text {
        color: #4b5563;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(90deg, #1e3a8a, #3b82f6);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .btn-primary i {
        margin-left: 0.5rem;
    }

    @media (max-width: 767px) {
        .col-md-10 {
            padding: 1rem;
        }
        .card {
            margin-bottom: 1.5rem;
        }
        .card-header {
            font-size: 1.1rem;
        }
    }
</style>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
