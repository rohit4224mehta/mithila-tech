@extends('layouts.employee_app')

@section('content')
    <div class="d-flex vh-100 bg-gradient" style="background: linear-gradient(135deg, #f1f5f9 0%, #e0e7ff 100%);">
        <div class="container-fluid py-4 flex-grow-1">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h2 fw-bold text-dark">Leave Requests</h1>
                        <p class="text-muted lead">
                            Welcome back, {{ auth()->user()->name }}! Manage your leave requests here.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Leave Requests Table -->
            <div class="card shadow-lg rounded-3 mb-5">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title fw-semibold text-dark">Leave Requests List</h5>
                        <a href="{{ route('employee.leaves.index') }}" class="btn btn-sm btn-outline-primary">Refresh</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge
                                                {{ $leave->status === 'approved' ? 'bg-success' :
                                                ($leave->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                {{ ucfirst($leave->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($leave->status === 'pending')
                                                <a href="{{ route('employee.leaves.edit', $leave->id) }}"
                                                    class="btn btn-sm btn-warning me-2">Edit</a>
                                                <form action="{{ route('employee.leaves.destroy', $leave->id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Cancel this request?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled>No Actions</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3">No leave requests yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Leave Button -->
            <div class="text-center mb-5">
                <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addLeaveModal">
                    <i class="bi bi-plus-lg me-2"></i>Request New Leave
                </button>
            </div>

            <!-- Add Leave Modal -->
            <div class="modal fade" id="addLeaveModal" tabindex="-1" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addLeaveModalLabel">Request New Leave</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addLeaveForm" action="{{ route('employee.leaves.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Leave Type</label>
                                    <select class="form-control" name="leave_type" id="leaveType" required>
                                        <option value="">Select Leave Type</option>
                                        @foreach (['Sick Leave', 'Vacation', 'Personal Leave', 'Maternity/Paternity'] as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    <small id="leave_typeError" class="text-danger d-none"></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" id="startDate" min="{{ date('Y-m-d') }}" required>
                                        <small id="start_dateError" class="text-danger d-none"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="endDate" min="{{ date('Y-m-d') }}" required>
                                        <small id="end_dateError" class="text-danger d-none"></small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Reason</label>
                                    <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                                    <small id="reasonError" class="text-danger d-none"></small>
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the company leave policy.
                                    </label>
                                    <small id="termsError" class="text-danger d-none"></small>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="addLeaveForm" class="btn btn-primary">Submit Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addLeaveForm');

    // Date range validation
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    startDate.addEventListener('change', () => endDate.min = startDate.value);

    // Handle form submission via AJAX
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

            if (data.success) {
                alert('✅ Leave request submitted successfully!');
                form.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('addLeaveModal'));
                modal.hide();
                location.reload();
            } else {
                alert('⚠️ ' + (data.message || 'Please check the form.'));
                if (data.errors) {
                    for (const field in data.errors) {
                        const errorEl = document.getElementById(`${field}Error`);
                        if (errorEl) {
                            errorEl.textContent = data.errors[field][0];
                            errorEl.classList.remove('d-none');
                        }
                    }
                }
            }
        })
        .catch(err => {
            console.error(err);
            alert('❌ Something went wrong. Please try again.');
        });
    });
});
</script>
@endpush
