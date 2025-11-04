@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4 text-primary">Change Password</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="changePasswordForm">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                        <button type="button" class="btn btn-outline-secondary" id="toggleCurrentPassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <div id="current_password-error" class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                        <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <div id="new_password-error" class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required>
                        <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <div id="new_password_confirmation-error" class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
                <a href="{{ route('client.profile') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 0.75rem;
    }
    .input-group .btn-outline-secondary {
        border-left: none;
    }
    .invalid-feedback {
        display: block;
    }
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('changePasswordForm');
    const toggleCurrentPassword = document.getElementById('toggleCurrentPassword');
    const currentPassword = document.getElementById('current_password');
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const newPassword = document.getElementById('new_password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('new_password_confirmation');

    // Toggle password visibility
    toggleCurrentPassword.addEventListener('click', function () {
        const type = currentPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        currentPassword.setAttribute('type', type);
        this.querySelector('i').className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
    });

    toggleNewPassword.addEventListener('click', function () {
        const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        newPassword.setAttribute('type', type);
        this.querySelector('i').className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
    });

    toggleConfirmPassword.addEventListener('click', function () {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.querySelector('i').className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
    });

    // Handle form submission with AJAX
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const url = form.action || '{{ route('client.password.update') }}';

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response:', data); // Debug log
            if (data.success) {
                alert(data.message); // Show success popup
                setTimeout(() => {
                    window.location.href = '{{ route('client.profile') }}';
                }, 2000); // Redirect after 2 seconds
            } else {
                if (data.message) {
                    alert(data.message); // Show error message
                }
                if (data.errors) {
                    for (let field in data.errors) {
                        const errorDiv = document.getElementById(`${field}-error`);
                        if (errorDiv) {
                            errorDiv.textContent = data.errors[field][0];
                            errorDiv.style.display = 'block';
                        }
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error); // Debug error
            alert('An error occurred. Please try again.');
        });
    });
});
</script>
@endpush
