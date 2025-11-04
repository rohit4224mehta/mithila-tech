@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4 text-primary">My Profile</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Profile Picture and Details -->
            <div class="text-center mb-4">
                <img src="{{ auth()->user()->profile_picture ? asset('storage/profile_pictures/' . auth()->user()->profile_picture) : asset('images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                <p class="text-muted">{{ auth()->user()->email }}</p>
            </div>

            <!-- Client Details -->
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Phone:</strong> {{ auth()->user()->phone ?? 'Not provided' }}</p>
                    <p><strong>Address:</strong> {{ auth()->user()->address ?? 'Not provided' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Bio:</strong></p>
                    <p>{{ auth()->user()->bio ?? 'No bio available' }}</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-4">
                <a href="{{ route('client.feedback') }}" class="btn btn-secondary">View Feedback History</a>
            </div>

            <!-- Edit Profile Button -->
            <div class="text-end mt-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="bi bi-pencil-fill me-1"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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

                <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
                    @csrf
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', auth()->user()->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
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
    .modal-content {
        border-radius: 0.75rem;
    }
    img.rounded-circle {
        object-fit: cover;
    }
    .invalid-feedback {
        display: block;
    }
    @media (max-width: 767.98px) {
        .modal-dialog {
            margin: 0.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editProfileForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.success);
                $('#editProfileModal').modal('hide');
                location.reload();
            } else if (data.errors) {
                let errors = data.errors;
                for (let field in errors) {
                    let errorDiv = document.querySelector(`#${field}-error`);
                    if (errorDiv) {
                        errorDiv.innerText = errors[field][0];
                        errorDiv.style.display = 'block';
                    }
                }
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endpush