@extends('layouts.employee_app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 fw-bold text-primary">My Profile</h1>
            </div>

            <div class="row">
                <!-- Profile Picture Column -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body text-center">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('https://via.placeholder.com/150?text=Profile') }}"
                                 class="rounded-circle mb-3 profile-picture shadow-sm"
                                 width="150" height="150"
                                 alt="Profile Picture">
                            <h4 class="fw-semibold">{{ $employee ? ($employee->first_name ?? $user->name) . ' ' . ($employee->last_name ?? '') : $user->name }}</h4>
                            <p class="text-muted mb-2">{{ $employee->department ?? 'Not Assigned' }}</p>
                            <p class="text-muted small">Employee ID: {{ $employee->employee_id ?? 'EMP-' . str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-muted small">Job Title: {{ $employee->job_title ?? 'Not Assigned' }}</p>

                            <form id="profilePictureForm" class="mt-3" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="profile-picture" class="form-label text-muted">Upload Profile Picture</label>
                                    <input type="file" class="form-control" id="profile-picture" name="profile_picture" accept="image/jpeg,image/png,image/jpg" data-validation="file filesize:500">
                                    <span id="profile-pictureError" class="error text-danger small"></span>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100">Update Picture</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Info Column -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-primary mb-3">Personal Information</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Full Name</label>
                                    <p>{{ $employee ? ($employee->first_name ?? 'N/A') . ' ' . ($employee->last_name ?? '') : $user->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Email</label>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Phone</label>
                                    <p>{{ $user->phone ?? 'Not provided' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Address</label>
                                    <p>{{ $user->address ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Bio</label>
                                    <p>{{ $user->bio ?? 'Not provided' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Department</label>
                                    <p>{{ $employee->department ?? 'Not Assigned' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Job Title</label>
                                    <p>{{ $employee->job_title ?? 'Not Assigned' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Employment Type</label>
                                    <p>{{ $employee->employment_type ?? 'Not Assigned' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Work Location</label>
                                    <p>{{ $employee->work_location ?? 'Not provided' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Skills</label>
                                    <p>{{ $employee->skills ? implode(', ', json_decode($employee->skills, true)) : 'Not provided' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">Join Date</label>
                                    <p>{{ $employee && $employee->join_date ? \Carbon\Carbon::parse($employee->join_date)->format('F d, Y') : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted fw-medium">End Date</label>
                                    <p>{{ $employee && $employee->end_date ? \Carbon\Carbon::parse($employee->end_date)->format('F d, Y') : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#passwordModal">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Edit Profile Modal (Employee edits only address and bio) -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editProfileForm">
                    @csrf
                    <div class="mb-3">
                        <label for="editAddress" class="form-label fw-medium text-primary">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="address" value="{{ old('address', $user->address ?? '') }}" data-validation="nullable string max:255">
                        <span id="addressError" class="error text-danger small"></span>
                    </div>
                    <div class="mb-3">
                        <label for="editBio" class="form-label fw-medium text-primary">Bio</label>
                        <textarea class="form-control" id="editBio" name="bio" data-validation="nullable string max:500" rows="4">{{ old('bio', $user->bio ?? '') }}</textarea>
                        <span id="bioError" class="error text-danger small"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="passwordModalLabel">Change Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="passwordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-medium text-primary">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" data-validation="required">
                        <span id="current_passwordError" class="error text-danger small"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-medium text-primary">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" data-validation="required min:8 different:current_password">
                        <span id="new_passwordError" class="error text-danger small"></span>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-medium text-primary">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" data-validation="required matches:new_password">
                        <span id="new_password_confirmationError" class="error text-danger small"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.profile-picture {
    border: 3px solid #e2e8f0;
    object-fit: cover;
    transition: transform 0.2s;
}
.profile-picture:hover {
    transform: scale(1.05);
}
.card {
    border: none;
    border-radius: 8px;
    transition: box-shadow 0.2s;
}
.card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.is-invalid {
    border-color: #dc3545;
}
.is-valid {
    border-color: #28a745;
}
.error {
    display: none;
    font-size: 0.8rem;
    margin-top: 0.25rem;
}
@media (max-width: 767.98px) {
    .card-body {
        padding: 1rem;
    }
    .profile-picture {
        width: 120px;
        height: 120px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // Profile Picture Form Submission
    $('#profilePictureForm').on('submit', function (e) {
        e.preventDefault();
        let $form = $(this);
        let $fileInput = $('#profile-picture');
        let $errorSpan = $('#profile-pictureError');
        $errorSpan.hide();

        console.log('Submitting profile picture form...');

        if (!$fileInput[0].files.length) {
            $errorSpan.text('Please select an image file.').show();
            $fileInput.addClass('is-invalid');
            return;
        }

        let file = $fileInput[0].files[0];
        if (file.size > 500 * 1024) {
            $errorSpan.text('File size must be less than 500KB.').show();
            $fileInput.addClass('is-invalid');
            return;
        }
        if (!file.type.match('image/(jpeg|png|jpg)')) {
            $errorSpan.text('Only JPEG, PNG, or JPG files are allowed').show();
            $fileInput.addClass('is-invalid');
            return;
        }

        let formData = new FormData();
        formData.append('profile_picture', file);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: '{{ route('employee.profile.picture.update') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                console.log('Sending profile picture AJAX request...');
            },
            success: function (response) {
                console.log('Profile picture response:', response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile picture updated successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('.profile-picture').attr('src', response.profile_picture);
                        $form[0].reset();
                        $fileInput.removeClass('is-invalid').addClass('is-valid');
                    });
                }
            },
            error: function (xhr) {
                console.error('Profile picture error:', xhr.responseJSON);
                let errorMsg = xhr.responseJSON?.message || xhr.responseJSON?.errors?.profile_picture?.[0] || 'Failed to upload picture.';
                $errorSpan.text(errorMsg).show();
                $fileInput.addClass('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Edit Profile Form Submission
    $('#editProfileForm').on('submit', function (e) {
        e.preventDefault();
        let $form = $(this);
        let isValid = true;

        console.log('Submitting edit profile form...');

        $form.find('input, textarea').each(function () {
            if (!validateField(this)) {
                isValid = false;
            }
        });

        if (isValid) {
            let formData = $form.serialize();
            console.log('Form data:', formData);

            $.ajax({
                url: '{{ route('employee.profile.update') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    console.log('Sending edit profile AJAX request...');
                },
                success: function (response) {
                    console.log('Edit profile response:', response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#editProfileModal').modal('hide');
                            location.reload();
                        });
                    }
                },
                error: function (xhr) {
                    console.error('Edit profile error:', xhr.responseJSON);
                    let errors = xhr.responseJSON?.errors || {};
                    let generalError = xhr.responseJSON?.message || 'An error occurred.';
                    $.each(errors, function (key, value) {
                        let fieldId = 'edit' + key.charAt(0).toUpperCase() + key.slice(1);
                        $('#' + key + 'Error').text(value[0]).show();
                        $('#' + fieldId).addClass('is-invalid');
                    });
                    if (!Object.keys(errors).length) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: generalError,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        } else {
            console.log('Client-side validation failed.');
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fix the errors in the form.',
                timer: 3000,
                showConfirmButton: false
            });
        }
    });

    // Password Change Form Submission
    $('#passwordForm').on('submit', function (e) {
        e.preventDefault();
        let $form = $(this);
        let isValid = true;

        console.log('Submitting password form...');

        $form.find('input').each(function () {
            if (!validateField(this)) {
                isValid = false;
            }
        });

        if (isValid) {
            $.ajax({
                url: '{{ route('employee.password.update') }}',
                type: 'POST',
                data: $form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    console.log('Sending password change AJAX request...');
                },
                success: function (response) {
                    console.log('Password change response:', response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#passwordModal').modal('hide');
                            $form[0].reset();
                            $form.find('input').removeClass('is-invalid is-valid');
                        });
                    }
                },
                error: function (xhr) {
                    console.error('Password change error:', xhr.responseJSON);
                    let errors = xhr.responseJSON?.errors || { message: [xhr.responseJSON?.message || 'An error occurred.'] };
                    $.each(errors, function (key, value) {
                        $('#' + key + 'Error').text(value[0]).show();
                        $('#' + key).addClass('is-invalid');
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errors.message ? errors.message[0] : 'Failed to change password.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });

    // Real-time Validation
    function validateField(input) {
        let $input = $(input);
        let $errorSpan = $input.next('.error');
        $errorSpan.hide();
        $input.removeClass('is-invalid is-valid');
        let value = $input.val().trim();
        let validations = $input.data('validation') ? $input.data('validation').split(' ') : [];

        for (let validation of validations) {
            let [rule, param] = validation.split(':');
            switch (rule) {
                case 'required':
                    if (!value) {
                        $errorSpan.text('This field is required').show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'numeric':
                    if (value && !/^\d+$/.test(value)) {
                        $errorSpan.text('Only numbers are allowed').show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'digits':
                    if (value && value.length !== parseInt(param)) {
                        $errorSpan.text(`Must be exactly ${param} digits`).show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'max':
                    if (value && value.length > parseInt(param)) {
                        $errorSpan.text(`Maximum length is ${param} characters`).show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'min':
                    if (value && value.length < parseInt(param)) {
                        $errorSpan.text(`Minimum length is ${param} characters`).show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'different':
                    if (value && value === $('#' + param).val()) {
                        $errorSpan.text('New password must be different from current password').show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'matches':
                    if (value && value !== $('#' + param).val()) {
                        $errorSpan.text('Passwords do not match').show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
                case 'file':
                    if (input.files.length > 0) {
                        let file = input.files[0];
                        if (param === 'filesize' && file.size > 500 * 1024) {
                            $errorSpan.text('File size must be less than 500KB').show();
                            $input.addClass('is-invalid');
                            return false;
                        }
                        if (!file.type.match('image/(jpeg|png|jpg)')) {
                            $errorSpan.text('Only JPEG, PNG, or JPG files are allowed').show();
                            $input.addClass('is-invalid');
                            return false;
                        }
                    }
                    break;
                case 'string':
                    if (value && !/^[a-zA-Z0-9\s.,-]*$/.test(value)) {
                        $errorSpan.text('Only letters, numbers, spaces, and basic punctuation are allowed').show();
                        $input.addClass('is-invalid');
                        return false;
                    }
                    break;
            }
        }
        $input.addClass('is-valid');
        return true;
    }

    $('input, textarea').on('input change', function () {
        validateField(this);
    });
});
</script>
@endpush
@endsection
