<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Mithila Tech IT Company Management System
| Updated: October 12, 2025
|--------------------------------------------------------------------------
*/

/* ============================================================
| PUBLIC ROUTES (No Authentication Required)
|============================================================ */
Route::middleware(['web'])->group(function () {
    // Homepage
    Route::get('/', [WelcomeController::class, 'index'])->name('home');

    // About
    Route::get('/about', [WelcomeController::class, 'about'])->name('about');

    // Contact (Handled by ContactController)
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/submit', [ContactController::class, 'submit'])
        ->middleware('throttle:10,1')
        ->name('contact.submit');

    // Legal Pages
    Route::get('/terms', [WelcomeController::class, 'terms'])->name('terms');
    Route::get('/privacy', [WelcomeController::class, 'privacy'])->name('privacy');
    Route::get('/support', [WelcomeController::class, 'support'])->name('support');

    // Media
    Route::get('/media', [WelcomeController::class, 'media'])->name('media');

    // Careers
    Route::get('/careers', [WelcomeController::class, 'careers'])->name('careers');
    Route::get('/careers/{career:slug}/apply', [WelcomeController::class, 'careerApply'])->name('career.apply');
    Route::post('/careers/{career:slug}/apply', [WelcomeController::class, 'submitCareerApplication'])
        ->middleware('throttle:5,1')
        ->name('career.apply.submit');

    // Solutions
    Route::get('/solutions', [WelcomeController::class, 'solutions'])->name('solutions');
    Route::get('/solutions/{solution:slug}', [WelcomeController::class, 'showSolution'])->name('solution.show');

    // Services
    Route::get('/services', [WelcomeController::class, 'services'])->name('services');
    Route::get('/services/{service:slug}', [WelcomeController::class, 'serviceDetail'])->name('service.detail');

    // Process
    Route::get('/process', [WelcomeController::class, 'processDetail'])->name('process.detail');

    // Global Presence
    Route::get('/global', [WelcomeController::class, 'global'])->name('global');

    // Blog
    Route::get('/blog', [WelcomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{blog:slug}', [WelcomeController::class, 'showBlog'])->name('blog.show');
    Route::get('/blog/category/{category}', [WelcomeController::class, 'showCategory'])->name('blog.category');

    // Newsletter Subscription
    Route::post('/subscribe', [WelcomeController::class, 'subscribe'])
        ->middleware('throttle:10,1')
        ->name('subscribe');

    // Search
    Route::get('/search', [WelcomeController::class, 'search'])->name('search');
});

/* ============================================================
| AUTH ROUTES (Guests Only)
|============================================================ */
Route::middleware(['web', 'guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    // Forgot Password (OTP System)
    Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetOtp'])
        ->middleware('throttle:6,1')
        ->name('password.email');
    Route::get('/password/reset-otp', [AuthController::class, 'showResetPasswordOtpForm'])->name('password.reset.otp');
    Route::post('/password/reset', [AuthController::class, 'resetPasswordWithOtp'])->name('password.update.otp');
});

/* ============================================================
| LOGOUT (Authenticated Users)
|============================================================ */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware(['web', 'auth'])
    ->name('logout');

/* ============================================================
| EMAIL VERIFICATION ROUTES
|============================================================ */
Route::middleware(['web'])->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
});

/* ============================================================
| ADMIN DASHBOARD ROUTES
|============================================================ */
Route::middleware(['web', 'auth', 'role:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/projects', [AdminController::class, 'manageProjects'])->name('admin.projects.index');
    Route::get('/projects/approve', [AdminController::class, 'approveProjects'])->name('admin.projects.approve');
    Route::get('/feedbacks', [AdminController::class, 'reviewFeedbacks'])->name('admin.feedbacks.review');
    Route::get('/leaves', [AdminController::class, 'manageLeaves'])->name('admin.leaves.index');
    Route::put('/leaves/{leave}', [AdminController::class, 'updateLeaveStatus'])->name('admin.leaves.update');
});

/* ============================================================
| EMPLOYEE DASHBOARD ROUTES
|============================================================ */
Route::middleware(['web', 'auth', 'role:employee', 'verified'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/tasks', [EmployeeController::class, 'tasks'])->name('employee.tasks.index');
    Route::get('/tasks/{task}/edit', [EmployeeController::class, 'editTask'])->name('employee.tasks.edit');
    Route::post('/tasks', [EmployeeController::class, 'storeTask'])->name('employee.tasks.store');
    Route::put('/tasks/{task}', [EmployeeController::class, 'updateTask'])->name('employee.tasks.update');
    Route::delete('/tasks/{task}', [EmployeeController::class, 'destroyTask'])->name('employee.tasks.destroy');
    Route::get('/attendance', [EmployeeController::class, 'attendance'])->name('employee.attendance.index');
    Route::post('/attendance/clock-in', [EmployeeController::class, 'clockIn'])->name('employee.attendance.clock-in');
    Route::post('/attendance/clock-out', [EmployeeController::class, 'clockOut'])->name('employee.attendance.clock-out');
    Route::get('/projects', [EmployeeController::class, 'projects'])->name('employee.projects.index');
    Route::get('/projects/{project}', [EmployeeController::class, 'showProject'])->name('employee.projects.show');
    Route::post('/employee/projects/submit', [EmployeeController::class, 'submitProject'])->name('employee.projects.submit');

    Route::get('/leaves', [EmployeeController::class, 'leaves'])->name('employee.leaves.index');
    Route::post('/leaves', [EmployeeController::class, 'storeLeave'])->name('employee.leaves.store');
    Route::get('/leaves/{leave}/edit', [EmployeeController::class, 'editLeave'])->name('employee.leaves.edit');

    Route::put('/leaves/{leave}', [EmployeeController::class, 'updateLeave'])->name('employee.leaves.update');
    Route::delete('/leaves/{leave}', [EmployeeController::class, 'destroyLeave'])->name('employee.leaves.destroy');
    Route::get('/performance', [EmployeeController::class, 'performance'])->name('employee.performance.index');
    Route::get('/performance/reviews', [EmployeeController::class, 'performanceReviews'])->name('employee.performance.reviews');
    Route::get('/settings', [EmployeeController::class, 'settings'])->name('employee.settings');
    Route::post('/settings/update', [EmployeeController::class, 'updateSettings'])->name('employee.settings.update');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
    Route::post('/profile/update', [EmployeeController::class, 'updateProfile'])->name('employee.profile.update');
    Route::post('/profile/picture/update', [EmployeeController::class, 'updateProfilePicture'])->name('employee.profile.picture.update');
    Route::post('/password/update', [EmployeeController::class, 'updatePassword'])->name('employee.password.update');
    Route::post('/chat/send', [EmployeeController::class, 'sendChat'])->name('employee.chat.send');
    Route::get('/chat/fetch', [EmployeeController::class, 'fetchChatMessages'])->name('employee.chat.fetch');
    Route::get('/employee/notifications', [EmployeeController::class, 'notifications'])->name('employee.notifications');
Route::post('/employee/notifications/mark-read/{id}', [EmployeeController::class, 'markNotificationRead'])->name('employee.notifications.markRead');
Route::post('/employee/notifications/mark-all-read', [EmployeeController::class, 'markAllNotificationsRead'])->name('employee.notifications.markAllRead');
Route::get('/employee/notifications/fetch', [EmployeeController::class, 'fetchNotifications'])->name('employee.notifications.fetch');



});

/* ============================================================
| CLIENT DASHBOARD ROUTES
|============================================================ */
Route::middleware(['web', 'auth', 'role:client', 'verified'])->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/profile', [ClientController::class, 'profile'])->name('client.profile');
    Route::get('/profile/edit', [ClientController::class, 'editProfile'])->name('client.profile.edit');
    Route::post('/profile/update', [ClientController::class, 'updateProfile'])->name('client.profile.update');
    Route::post('/profile/picture/update', [ClientController::class, 'updateProfilePicture'])->name('client.profile.picture.update');

    Route::get('/password/edit', [ClientController::class, 'editPassword'])->name('client.password.edit');
    Route::post('/password/update', [ClientController::class, 'updatePassword'])->name('client.password.update');

    // Projects
    Route::get('/projects', [ClientController::class, 'projects'])->name('client.projects');
    Route::get('/projects/{project}', [ClientController::class, 'projectDetail'])->name('client.projects.show');

    // Feedback
    Route::get('/feedback', [ClientController::class, 'feedback'])->name('client.feedback');
    Route::post('/feedback', [ClientController::class, 'submitFeedback'])->name('client.feedback.submit');

    // Contact Form (Client access too)
    Route::post('/contact/submit', [ContactController::class, 'submit'])->name('client.contact.submit');
});

/* ============================================================
| FALLBACK ROUTE (404 Handling)
|============================================================ */
Route::fallback(function () {
    return view('errors.404', ['message' => 'Page not found.']);
})->name('fallback');

/* ============================================================
| ROUTE MODEL BINDING
|============================================================ */
Route::model('career', \App\Models\Career::class);
Route::model('solution', \App\Models\Solution::class);
Route::model('service', \App\Models\Service::class);
Route::model('blog', \App\Models\Blog::class);
Route::model('leave', \App\Models\Leave::class);
Route::model('task', \App\Models\Task::class);
Route::model('project', \App\Models\Project::class);
