@extends('layouts.employee_app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Leave Request</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('employee.leaves.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="leave_type" class="form-label">Leave Type</label>
            <select name="leave_type" id="leave_type" class="form-select" required>
                @foreach (['Sick Leave', 'Vacation', 'Personal Leave', 'Maternity/Paternity'] as $type)
                    <option value="{{ $type }}" {{ $leave->leave_type == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ $leave->start_date->format('Y-m-d') }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ $leave->end_date->format('Y-m-d') }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" rows="4" class="form-control" required>{{ $leave->reason }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('employee.leaves.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Leave</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('updateLeaveForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Leave Updated!',
                    text: 'Your leave request has been updated successfully.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "{{ route('employee.leaves.index') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: data.message || 'Something went wrong. Please try again.'
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Unable to process your request at the moment.'
            });
        });
    });
});
</script>
@endpush
