@extends('layouts.employee_app')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark" style="color: #2c3e50;">Settings</h1>
                    <p class="text-muted lead">Manage your account and chat preferences</p>
                </div>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="card shadow-lg rounded-3 mb-5">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold text-dark" style="color: #2c3e50;">Account Settings</h5>
                <hr class="my-4">
                <div class="row g-3">
                    <!-- Notification Settings -->
                    <div class="col-12 col-md-6">
                        <h6 class="fw-semibold text-primary">Notification Preferences</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="emailNotifications" {{ auth()->user()->settings['email_notifications'] ?? false ? 'checked' : '' }}>
                            <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="pushNotifications" {{ auth()->user()->settings['push_notifications'] ?? false ? 'checked' : '' }}>
                            <label class="form-check-label" for="pushNotifications">Push Notifications</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="smsNotifications" {{ auth()->user()->settings['sms_notifications'] ?? false ? 'checked' : '' }}>
                            <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                        </div>
                        <span id="notificationError" class="error text-danger"></span>
                    </div>

                    <!-- Theme Selection -->
                    <div class="col-12 col-md-6">
                        <h6 class="fw-semibold text-primary">Theme</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="theme" id="lightTheme" value="light" {{ (auth()->user()->settings['theme'] ?? 'light') === 'light' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lightTheme">Light Theme</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="theme" id="darkTheme" value="dark" {{ (auth()->user()->settings['theme'] ?? 'light') === 'dark' ? 'checked' : '' }}>
                            <label class="form-check-label" for="darkTheme">Dark Theme</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="theme" id="systemTheme" value="system" {{ (auth()->user()->settings['theme'] ?? 'light') === 'system' ? 'checked' : '' }}>
                            <label class="form-check-label" for="systemTheme">System Default</label>
                        </div>
                        <span id="themeError" class="error text-danger"></span>
                    </div>

                    <!-- Language Selection -->
                    <div class="col-12">
                        <h6 class="fw-semibold text-primary">Language</h6>
                        <select class="form-select" id="language" style="max-width: 300px;">
                            <option value="en" {{ (auth()->user()->settings['language'] ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                            <option value="hi" {{ (auth()->user()->settings['language'] ?? 'en') === 'hi' ? 'selected' : '' }}>Hindi</option>
                            <option value="es" {{ (auth()->user()->settings['language'] ?? 'en') === 'es' ? 'selected' : '' }}>Spanish</option>
                        </select>
                        <span id="languageError" class="error text-danger"></span>
                    </div>

                    <!-- Chat Settings -->
                    <div class="col-12 mt-4">
                        <h6 class="fw-semibold text-primary">Chat Preferences</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="chatNotifications" {{ auth()->user()->settings['chat_notifications'] ?? false ? 'checked' : '' }}>
                            <label class="form-check-label" for="chatNotifications">Enable Chat Notifications</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chatOnlineStatus" {{ auth()->user()->settings['chat_online_status'] ?? false ? 'checked' : '' }}>
                            <label class="form-check-label" for="chatOnlineStatus">Show Online Status</label>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-end">
                    <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#saveSettingsModal">
                        Save Settings
                    </button>
                </div>
            </div>
        </div>

        <!-- Save Settings Confirmation Modal -->
        <div class="modal fade" id="saveSettingsModal" tabindex="-1" aria-labelledby="saveSettingsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-white shadow-lg rounded-3">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="saveSettingsModalLabel">Confirm Settings</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p>Are you sure you want to save these settings?</p>
                        <form id="saveSettingsForm">
                            @csrf
                            <input type="hidden" id="emailNotificationsHidden" name="email_notifications">
                            <input type="hidden" id="pushNotificationsHidden" name="push_notifications">
                            <input type="hidden" id="smsNotificationsHidden" name="sms_notifications">
                            <input type="hidden" id="themeHidden" name="theme">
                            <input type="hidden" id="languageHidden" name="language">
                            <input type="hidden" id="chatNotificationsHidden" name="chat_notifications">
                            <input type="hidden" id="chatOnlineStatusHidden" name="chat_online_status">
                        </form>
                        <span id="generalError" class="error text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="saveSettingsForm" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
        color: #dc3545;
    }
    @media (max-width: 768px) {
        .row > * {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .card-body {
            padding: 1rem;
        }
        .form-select {
            max-width: 100%;
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
    // Populate hidden fields on modal show
    $('#saveSettingsModal').on('show.bs.modal', function () {
        $('#emailNotificationsHidden').val($('#emailNotifications').is(':checked') ? '1' : '0');
        $('#pushNotificationsHidden').val($('#pushNotifications').is(':checked') ? '1' : '0');
        $('#smsNotificationsHidden').val($('#smsNotifications').is(':checked') ? '1' : '0');
        $('#themeHidden').val($('input[name="theme"]:checked').val() || '{{ auth()->user()->settings['theme'] ?? 'light' }}');
        $('#languageHidden').val($('#language').val() || '{{ auth()->user()->settings['language'] ?? 'en' }}');
        $('#chatNotificationsHidden').val($('#chatNotifications').is(':checked') ? '1' : '0');
        $('#chatOnlineStatusHidden').val($('#chatOnlineStatus').is(':checked') ? '1' : '0');
    });

    // Save Settings Form Submission
    $('#saveSettingsForm').on('submit', function (e) {
        e.preventDefault();
        let isValid = true;
        let $form = $(this);
        let errors = {};

        // Basic validation
        let emailNotif = $('#emailNotificationsHidden').val() === '1';
        let pushNotif = $('#pushNotificationsHidden').val() === '1';
        let smsNotif = $('#smsNotificationsHidden').val() === '1';
        let theme = $('#themeHidden').val();
        let language = $('#languageHidden').val();
        let chatNotif = $('#chatNotificationsHidden').val() === '1';
        let chatOnline = $('#chatOnlineStatusHidden').val() === '1';

        if (!emailNotif && !pushNotif && !smsNotif) {
            errors.notification = 'At least one notification type must be enabled.';
            isValid = false;
        }
        if (!theme || !['light', 'dark', 'system'].includes(theme)) {
            errors.theme = 'Please select a valid theme.';
            isValid = false;
        }
        if (!language || !['en', 'hi', 'es'].includes(language)) {
            errors.language = 'Please select a valid language.';
            isValid = false;
        }

        // Clear and display errors
        $('.error').text('').hide();
        $.each(errors, function (fieldId, message) {
            $('#' + fieldId + 'Error').text(message).show();
        });

        if (isValid) {
            $.ajax({
                url: '{{ route('employee.settings.update') }}',
                type: 'POST',
                data: $form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log('AJAX Error:', status, error);
                    let response = xhr.responseJSON;
                    if (response && response.errors) {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + 'Error').text(value[0]).show();
                        });
                    } else if (response && response.message) {
                        $('#generalError').text(response.message).show();
                    } else {
                        $('#generalError').text('An unexpected error occurred. Please try again.').show();
                    }
                }
            });
        }
    });

    // Update hidden fields on change
    $('#emailNotifications, #pushNotifications, #smsNotifications, #chatNotifications, #chatOnlineStatus').on('change', function () {
        $('#saveSettingsModal').modal('show'); // Trigger modal to update hidden fields
        $('#emailNotificationsHidden').val($('#emailNotifications').is(':checked') ? '1' : '0');
        $('#pushNotificationsHidden').val($('#pushNotifications').is(':checked') ? '1' : '0');
        $('#smsNotificationsHidden').val($('#smsNotifications').is(':checked') ? '1' : '0');
        $('#chatNotificationsHidden').val($('#chatNotifications').is(':checked') ? '1' : '0');
        $('#chatOnlineStatusHidden').val($('#chatOnlineStatus').is(':checked') ? '1' : '0');
    });

    $('input[name="theme"]').on('change', function () {
        $('#saveSettingsModal').modal('show'); // Trigger modal to update hidden fields
        $('#themeHidden').val($(this).val());
    });

    $('#language').on('change', function () {
        $('#saveSettingsModal').modal('show'); // Trigger modal to update hidden fields
        $('#languageHidden').val($(this).val());
    });

    // Clear errors on input change
    $('#emailNotifications, #pushNotifications, #smsNotifications, input[name="theme"], #language, #chatNotifications, #chatOnlineStatus').on('change', function () {
        $('.error').text('').hide();
    });
});
</script>
@endpush