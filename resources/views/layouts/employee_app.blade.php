
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MithilaTech Employee Panel - {{ auth()->user()->name ?? 'Dashboard' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --light-color: #f8fafc;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            margin: 0;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #3498db;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        #main-content {
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease-in-out;
            background: #ffffff;
            border-radius: 8px 0 0 0;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.05);
            flex: 1 0 auto;
            padding: 20px;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 900;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .dropdown-menu {
            min-width: 10rem;
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: #333;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f0f4f8;
            color: var(--primary-color);
        }

        .user-info img {
            transition: transform 0.3s ease;
            background: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border-radius: 50%;
        }

        .user-info img:hover {
            transform: scale(1.1);
        }

        .chat-icon, .notification-icon {
            cursor: pointer;
            transition: color 0.3s ease;
            font-size: 1.5rem;
        }

        .chat-icon:hover, .notification-icon:hover {
            color: #3498db !important;
        }

        #chatModal .modal-content, #passwordModal .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #chatModal .modal-header, #passwordModal .modal-header {
            background: var(--primary-color);
            color: #ecf0f1;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        #chatModal .modal-body, #passwordModal .modal-body {
            max-height: 400px;
            overflow-y: auto;
            background: #f9f9f9;
            padding: 15px;
        }

        .chat-message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            max-width: 70%;
        }

        .chat-message.sent {
            background: #3498db;
            color: #ffffff;
            margin-left: 30%;
            text-align: right;
        }

        .chat-message.received {
            background: #ecf0f1;
            color: #333;
            margin-right: 30%;
        }

        .notification-item {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .footer {
            background: var(--primary-color);
            color: #ecf0f1;
            padding: 20px 0;
            text-align: center;
            flex-shrink: 0;
            width: 100%;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 240px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            #main-content {
                margin-left: 0;
                padding: 10px;
            }
            .navbar-brand {
                font-size: 1.2rem;
            }
            .navbar {
                padding: 10px;
                flex-wrap: wrap;
            }
            .navbar form {
                margin-top: 10px;
                width: 100%;
            }
            #chatModal .modal-dialog, #passwordModal .modal-dialog {
                margin: 10px;
                max-width: 90%;
            }
            .footer {
                padding: 15px 0;
            }
            .dropdown-menu {
                min-width: 8rem;
            }
            .chat-message, .notification-item {
                max-width: 90%;
            }
            .user-info img {
                width: 30px;
                height: 30px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }
            #main-content {
                margin-left: 220px;
            }
            .navbar-brand {
                font-size: 1.3rem;
            }
            .chat-message, .notification-item {
                max-width: 80%;
            }
        }

        .content-wrapper {
            min-height: calc(100vh - 120px);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar shadow-lg" id="sidebar">
        <div class="p-4 border-bottom border-secondary">
            <h2 class="fs-5 fw-bold text-white-50">MithilaTech Dashboard</h2>
        </div>
        <nav class="nav flex-column">
            <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('employee.tasks.index') }}" class="nav-link {{ request()->routeIs('employee.tasks.index') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-list-task me-2"></i> Tasks
            </a>
            <a href="{{ route('employee.attendance.index') }}" class="nav-link {{ request()->routeIs('employee.attendance.index') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-calendar-check me-2"></i> Attendance
            </a>
            <a href="{{ route('employee.projects.index') }}" class="nav-link {{ request()->routeIs('employee.projects.index') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-kanban me-2"></i> Projects
            </a>
            <a href="{{ route('employee.leaves.index') }}" class="nav-link {{ request()->routeIs('employee.leaves.index') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-door-open me-2"></i> Leave Requests
            </a>
            <a href="{{ route('employee.performance.index') }}" class="nav-link {{ request()->routeIs('employee.performance.index') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-graph-up me-2"></i> Performance
            </a>
            <a href="{{ route('employee.profile') }}" class="nav-link {{ request()->routeIs('employee.profile') ? 'active' : '' }} d-flex align-items-center py-3">
                <i class="bi bi-person me-2"></i> My Profile
            </a>
            <a href="#" class="nav-link mt-4 d-flex align-items-center py-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-primary me-3 d-md-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <span class="navbar-brand mb-0 h4 fw-bold">MithilaTech Employee Panel</span>
            </div>

            <form class="d-flex align-items-center" role="search">
                <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="button" id="searchButton">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <div class="d-flex align-items-center">
                <div class="position-relative">
                    <i class="bi bi-bell fs-4 me-3 text-secondary notification-icon" id="notificationIcon" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount" style="display: none;">0</span>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationIcon">
    <li>
        <a href="{{ route('employee.notifications') }}" class="dropdown-item d-flex justify-content-between align-items-center">
            <span>View All Notifications</span>
            <span class="badge bg-primary">{{ auth()->user()->unreadNotifications()->count() }}</span>
        </a>
    </li>
</ul>

                </div>
                <i class="bi bi-chat fs-4 me-3 text-secondary chat-icon" data-bs-toggle="modal" data-bs-target="#chatModal"></i>
            </div>

            <!-- User Info with Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center user-info" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-3 text-muted fw-semibold">{{ auth()->user()->name ?? 'Guest' }}</span>
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://via.placeholder.com/40' }}"
                         alt="User" class="rounded-circle" width="36" height="36">
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('employee.profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('employee.settings') }}">Settings</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- Chat Modal -->
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chatModalLabel">Chat with Team</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="closeChatModal"></button>
                    </div>
                    <div class="modal-body p-3" id="chatBody">
                        <div class="chat-container" id="chatContainer">
                            <!-- Messages will be loaded via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <select class="form-select me-2" id="chatReceiver" name="receiver_id">
                            <option value="">Select a recipient</option>
                            @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <textarea class="form-control mb-2" id="chatMessage" placeholder="Type your message..." rows="2"></textarea>
                        <button class="btn btn-primary" id="sendMessage">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Change Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="closePasswordModal"></button>
                    </div>
                    <div class="modal-body p-3">
                        <form id="changePasswordForm">
                            @csrf
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="current_password" data-validation="required">
                                <span id="currentPasswordError" class="error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password" data-validation="required min:8">
                                <span id="newPasswordError" class="error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordConfirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="newPasswordConfirmation" name="new_password_confirmation" data-validation="required matches:newPassword">
                                <span id="newPasswordConfirmationError" class="error text-danger"></span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-2">&copy; {{ date('Y') }} MithilaTech. All rights reserved.</p>
            <div>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Support</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            const sidebar = $('#sidebar');
            const sidebarToggle = $('#sidebarToggle');
            const chatModal = $('#chatModal');
            const chatContainer = $('#chatContainer');
            const chatMessage = $('#chatMessage');
            const sendMessage = $('#sendMessage');
            const closeChatModal = $('#closeChatModal');
            const chatBody = $('#chatBody');
            const notificationIcon = $('#notificationIcon');
            const notificationCount = $('#notificationCount');
            const notificationDropdown = $('#notificationDropdown');
            const passwordModal = $('#passwordModal');
            const changePasswordForm = $('#changePasswordForm');
            const closePasswordModal = $('#closePasswordModal');
            const searchInput = $('#searchInput');
            const searchButton = $('#searchButton');

            // Sidebar Toggle
            sidebarToggle.on('click', function () {
                sidebar.toggleClass('active');
            });

            $(document).on('click', function (e) {
                if (window.innerWidth <= 768 && !sidebar.get(0).contains(e.target) && !sidebarToggle.get(0).contains(e.target)) {
                    sidebar.removeClass('active');
                }
            });

            // Search Functionality
            searchButton.on('click', function () {
                const query = searchInput.val().trim();
                if (query) {
                    window.location.href = `{{ url('search') }}?q=${encodeURIComponent(query)}`;
                }
            });

            // Chat System
            let lastMessageId = 0;

            function fetchNewMessages() {
                $.ajax({
                    url: '{{ route('employee.chat.fetch') }}',
                    type: 'GET',
                    data: { last_id: lastMessageId, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success && response.messages.length > 0) {
                            response.messages.forEach(message => {
                                const isSent = message.sender_id == {{ auth()->id() }};
                                const newMessage = `
                                    <div class="chat-message ${isSent ? 'sent' : 'received'}">
                                        <strong>${message.sender.name ?? 'Unknown'}:</strong> ${message.content}
                                        <small class="text-muted">${new Date(message.created_at).toLocaleTimeString()}</small>
                                    </div>
                                `;
                                chatContainer.append(newMessage);
                                lastMessageId = Math.max(lastMessageId, message.id);
                            });
                            chatBody.scrollTop(chatBody[0].scrollHeight);
                        }
                    },
                    error: function (xhr) {
                        console.error('Error fetching messages:', xhr.responseJSON?.message || 'Unknown error');
                    }
                });
            }

            chatModal.on('shown.bs.modal', function () {
                chatContainer.empty(); // Clear existing messages
                fetchNewMessages();
                chatBody.scrollTop(chatBody[0].scrollHeight);
            });

            sendMessage.on('click', function () {
                const message = chatMessage.val().trim();
                const receiverId = $('#chatReceiver').val();
                if (!message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Message cannot be empty',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
                if (!receiverId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a recipient',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
                $.ajax({
                    url: '{{ route('employee.chat.send') }}',
                    type: 'POST',
                    data: {
                        message: message,
                        receiver_id: receiverId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            const newMessage = `
                                <div class="chat-message sent">
                                    <strong>You:</strong> ${message}
                                    <small class="text-muted">${new Date().toLocaleTimeString()}</small>
                                </div>
                            `;
                            chatContainer.append(newMessage);
                            chatMessage.val('');
                            chatBody.scrollTop(chatBody[0].scrollHeight);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to send message',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'An error occurred',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            chatMessage.on('keypress', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage.click();
                }
            });

            closeChatModal.on('click', function () {
                chatModal.modal('hide');
            });

            // Notification System
            let lastNotificationId = {{ auth()->user()->unreadNotifications()->max('id') ?? 0 }};

            function fetchNewNotifications() {
                $.ajax({
                    url: '{{ route('employee.notifications.fetch') }}',
                    type: 'GET',
                    data: { last_id: lastNotificationId, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success && response.notifications.length > 0) {
                            let count = 0;
                            notificationDropdown.empty();
                            response.notifications.forEach(notification => {
                                if (notification.id > lastNotificationId) {
                                    count++;
                                }
                                const newNotification = `
                                    <li class="notification-item">
                                        <a href="${notification.data?.link ?? '#'}" class="text-decoration-none text-dark">
                                            ${notification.data?.message ?? 'No message'}
                                            <small class="text-muted">${new Date(notification.created_at).toLocaleTimeString()}</small>
                                        </a>
                                    </li>
                                `;
                                notificationDropdown.append(newNotification);
                                lastNotificationId = Math.max(lastNotificationId, notification.id);
                            });
                            notificationCount.text(count);
                            notificationCount.css('display', count > 0 ? 'block' : 'none');
                        }
                    },
                    error: function (xhr) {
                        console.error('Error fetching notifications:', xhr.responseJSON?.message || 'Unknown error');
                    }
                });
            }

            setInterval(fetchNewNotifications, 5000);
            notificationIcon.on('click', fetchNewNotifications);

            // Password Change
            function validatePasswordField(input) {
                const $input = $(input);
                const $errorSpan = $input.next('.error');
                $errorSpan.hide();
                const value = $input.val().trim();
                const validations = $input.data('validation') ? $input.data('validation').split(' ') : [];
                let isValid = true;

                $input.removeClass('is-invalid is-valid');

                for (let validation of validations) {
                    let [rule, param] = validation.split(':');
                    switch (rule) {
                        case 'required':
                            if (!value) {
                                $errorSpan.text('This field is required').show();
                                $input.addClass('is-invalid');
                                isValid = false;
                            }
                            break;
                        case 'min':
                            if (value && value.length < parseInt(param)) {
                                $errorSpan.text(`Minimum length is ${param} characters`).show();
                                $input.addClass('is-invalid');
                                isValid = false;
                            }
                            break;
                        case 'matches':
                            if (value && value !== $(`#${param}`).val()) {
                                $errorSpan.text('Passwords do not match').show();
                                $input.addClass('is-invalid');
                                isValid = false;
                            }
                            break;
                    }
                }
                if (isValid) $input.addClass('is-valid');
                return isValid;
            }

            changePasswordForm.on('submit', function (e) {
                e.preventDefault();
                let isValid = true;
                const inputs = this.querySelectorAll('input');

                inputs.each(function () {
                    if (!validatePasswordField(this)) isValid = false;
                });

                if (isValid) {
                    const data = {
                        current_password: $('#currentPassword').val(),
                        new_password: $('#newPassword').val(),
                        new_password_confirmation: $('#newPasswordConfirmation').val(),
                        _token: '{{ csrf_token() }}'
                    };

                    $.ajax({
                        url: '{{ route('employee.password.update') }}',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    passwordModal.modal('hide');
                                    changePasswordForm[0].reset();
                                    $('.error').hide();
                                    inputs.removeClass('is-invalid is-valid');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.errors?.current_password?.[0] || response.message || 'Failed to change password',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function (xhr) {
                            const errors = xhr.responseJSON?.errors || {};
                            $.each(errors, function (key, value) {
                                $(`#${key.replace('_', '')}Error`).text(value[0]).show();
                                $(`#${key.replace('_confirmation', 'Confirmation')}`).addClass('is-invalid');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON?.message || 'An error occurred',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fix the errors in the form',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });

            changePasswordForm.find('input').on('input', function () {
                validatePasswordField(this);
            });

            closePasswordModal.on('click', function () {
                passwordModal.modal('hide');
                changePasswordForm[0].reset();
                $('.error').hide();
                changePasswordForm.find('input').removeClass('is-invalid is-valid');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
