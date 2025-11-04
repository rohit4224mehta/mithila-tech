@extends('layouts.employee_app')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark" style="color: #2c3e50;">Task Management</h1>
                    <p class="text-muted lead">Track and manage your tasks efficiently</p>
                </div>
                
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-success text-white mb-3" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <h3 class="h6 text-success fw-bold mb-2">Completed Tasks</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->tasks->where('status', 'completed')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-danger text-white mb-3" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-exclamation-circle-fill fs-4"></i>
                        </div>
                        <h3 class="h6 text-danger fw-bold mb-2">Pending Tasks</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->tasks->where('status', 'pending')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-warning text-white mb-3" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                        <h3 class="h6 text-warning fw-bold mb-2">In Progress</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->tasks->where('status', 'in-progress')->count() ?: 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-3">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-info text-white mb-3" style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <h3 class="h6 text-info fw-bold mb-2">Due Today</h3>
                        <p class="h3 mb-0 fw-bold text-dark">{{ auth()->user()->tasks()->whereDate('due_date', now()->toDateString())->count() ?: 0 }}</p>>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Progress Chart -->
        <div class="card shadow-lg mb-5">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Task Progress Overview</h5>
                <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                    <canvas id="taskProgressChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Task Filters -->
        <div class="card shadow-lg mb-5">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Filter Tasks</h5>
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <select class="form-select border-0 shadow-sm filter-status" style="background-color: #f9f9f9;">
                            <option value="">All Statuses</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="date" class="form-control border-0 shadow-sm filter-date" style="background-color: #f9f9f9;" value="">
                    </div>
                    <div class="col-12 col-md-4">
                        <button class="btn btn-primary w-100 apply-filters">Apply Filters</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="card shadow-lg mb-5">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Task List</h5>
                    <a href="{{ route('employee.tasks.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped tasks-table">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 text-dark" style="color: #2c3e50;">Task Name</th>
                                <th class="py-3 text-dark" style="color: #2c3e50;">Status</th>
                                <th class="py-3 text-dark" style="color: #2c3e50;">Due Date</th>
                                <th class="py-3 text-dark" style="color: #2c3e50;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (auth()->user()->tasks as $task)
                                <tr>
                                    <td class="py-3">{{ $task->title }}</td> <!-- Changed from $task->task_name -->
                                    <td class="py-3"><span class="badge {{ $task->status === 'completed' ? 'bg-success' : ($task->status === 'in-progress' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ ucfirst($task->status) }}</span></td>
                                    <td class="py-3">{{ $task->due_date ? $task->due_date->format('F d, Y') : 'N/A' }}</td>
                                    <td class="py-3">
                                        <a href="{{ route('employee.tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                                        <form action="{{ route('employee.tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
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

        <!-- Add New Task Button and Modal -->
        <div class="text-center mb-5">
            <button type="button" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                <i class="bi bi-plus-lg me-2"></i> Add New Task
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-white shadow-lg rounded-3">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form id="addTaskForm" action="{{ route('employee.tasks.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="taskName" class="form-label fw-semibold text-primary">Task Name</label>
                                    <input type="text" class="form-control" id="taskName" name="titl" required>
                                    <span id="taskNameError" class="error text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="taskStatus" class="form-label fw-semibold text-primary">Status</label>
                                    <select class="form-select" id="taskStatus" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="in-progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <span id="taskStatusError" class="error text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="dueDate" class="form-label fw-semibold text-primary">Due Date</label>
                                    <input type="date" class="form-control" id="dueDate" name="due_date" required>
                                    <span id="dueDateError" class="error text-danger"></span>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Save Task</button>
                            </form>
                        </div>
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
        --light-color: #ecf0f1;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
    }

    .content-wrapper {
        padding: 20px;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #233240;
        transform: translateY(-2px);
    }

    .btn-outline-warning {
        border-color: var(--warning-color);
        color: var(--warning-color);
    }

    .btn-outline-warning:hover {
        background-color: var(--warning-color);
        color: #ffffff;
    }

    .btn-outline-danger {
        border-color: var(--danger-color);
        color: var(--danger-color);
    }

    .btn-outline-danger:hover {
        background-color: var(--danger-color);
        color: #ffffff;
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .is-invalid {
        border-color: #dc3545;
    }
    .is-valid {
        border-color: #28a745;
    }
    .error {
        display: none;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .row > * {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .chart-container {
            height: 200px !important;
        }
        .card-body {
            padding: 1rem;
        }
        .table-responsive {
            min-width: 300px;
            overflow-x: auto;
        }
        .col-md-4 {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Task Progress Chart
    const ctx = document.getElementById('taskProgressChart').getContext('2d');
    const tasks = @json(auth()->user()->tasks->groupBy('status')->map(function ($group) {
        return $group->count();
    })->all() ?: ['completed' => 0, 'pending' => 0, 'in-progress' => 0]);
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'In Progress'],
            datasets: [{
                data: [tasks.completed || 0, tasks.pending || 0, tasks['in-progress'] || 0],
                backgroundColor: [var(--success-color), var(--danger-color), var(--warning-color)],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 14 } } },
                title: { display: true, text: 'Task Distribution', font: { size: 16 }, color: var(--primary-color) }
            }
        }
    });

    // Filter Tasks
    const filterStatus = document.querySelector('.filter-status');
    const filterDate = document.querySelector('.filter-date');
    const applyFilters = document.querySelector('.apply-filters');
    const tasksTable = document.querySelector('.tasks-table tbody');

    applyFilters.addEventListener('click', function() {
        const status = filterStatus.value;
        const date = filterDate.value;
        fetchTasks(status, date);
    });

    function fetchTasks(status = '', date = '') {
        fetch(`/employee/tasks?status=${status}&date=${date}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            tasksTable.innerHTML = '';
            if (data.length > 0) {
                data.forEach(task => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
    <td class="py-3">${task.title}</td> <!-- Changed from task.task_name -->
    <td class="py-3"><span class="badge ${task.status === 'completed' ? 'bg-success' : (task.status === 'in-progress' ? 'bg-warning text-dark' : 'bg-danger')}">${ucfirst(task.status)}</span></td>
    <td class="py-3">${task.due_date ? new Date(task.due_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) : 'N/A'}</td>
    <td class="py-3">
        <a href="/employee/tasks/${task.id}/edit" class="btn btn-sm btn-outline-warning me-2">Edit</a>
        <form action="/employee/tasks/${task.id}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
    </td>
`;
                    tasksTable.appendChild(row);
                });
            } else {
                tasksTable.innerHTML = '<tr><td colspan="4" class="py-3 text-center">No tasks available</td></tr>';
            }
        })
        .catch(error => console.error('Error fetching tasks:', error));
    }

    // Form Validation
    const addTaskForm = document.getElementById('addTaskForm');
    addTaskForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const taskName = document.getElementById('taskName');
        const taskStatus = document.getElementById('taskStatus');
        const dueDate = document.getElementById('dueDate');
        let isValid = true;

        // Reset error messages
        document.querySelectorAll('.error').forEach(error => error.style.display = 'none');
        [taskName, taskStatus, dueDate].forEach(input => input.classList.remove('is-invalid', 'is-valid'));

        if (!taskName.value.trim()) {
            document.getElementById('taskNameError').textContent = 'Task name is required.';
            document.getElementById('taskNameError').style.display = 'block';
            taskName.classList.add('is-invalid');
            isValid = false;
        } else {
            taskName.classList.add('is-valid');
        }

        if (!taskStatus.value) {
            document.getElementById('taskStatusError').textContent = 'Please select a status.';
            document.getElementById('taskStatusError').style.display = 'block';
            taskStatus.classList.add('is-invalid');
            isValid = false;
        } else {
            taskStatus.classList.add('is-valid');
        }

        if (!dueDate.value) {
            document.getElementById('dueDateError').textContent = 'Due date is required.';
            document.getElementById('dueDateError').style.display = 'block';
            dueDate.classList.add('is-invalid');
            isValid = false;
        } else {
            dueDate.classList.add('is-valid');
        }

        if (isValid) {
            fetch(addTaskForm.action, {
                method: 'POST',
                body: new FormData(addTaskForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Task added successfully!');
                    addTaskForm.reset();
                    document.querySelectorAll('.is-valid').forEach(input => input.classList.remove('is-valid'));
                    fetchTasks(); // Refresh task list
                    $('#addTaskModal').modal('hide');
                } else {
                    alert('Error adding task: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Initial load
    fetchTasks();
});
</script>
@endpush
