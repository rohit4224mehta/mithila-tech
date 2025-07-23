<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services/application', function () {
    return view('services.application');
})->name('services.application');

Route::get('/services/cloud', function () {
    return view('services.cloud');
})->name('services.cloud');

Route::get('/services/mysql', function () {
    return view('services.mysql');
})->name('services.mysql');

Route::get('/solutions', function () {
    return view('solutions');
})->name('solutions');

Route::get('/media', function () {
    return view('media');
})->name('media');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/careers', function () {
    return view('careers');
})->name('careers');

Route::get('/global', function () {
    return view('global');
})->name('global');

// Authentication Routes (Static)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.manage-users');
    })->name('admin.users.index');

    Route::get('/projects', function () {
        return view('admin.manage-projects');
    })->name('admin.projects.index');
});

// Employee Routes
Route::middleware(['auth', 'isEmployee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');

    Route::get('/tasks', function () {
        return view('employee.tasks');
    })->name('employee.tasks.index');

    Route::get('/attendance', function () {
        return view('employee.attendance');
    })->name('employee.attendance.index');
});

// Client Routes
Route::middleware(['auth', 'isClient'])->prefix('client')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    Route::get('/projects', function () {
        return view('client.projects');
    })->name('client.projects.index');

    Route::get('/feedback', function () {
        return view('client.feedback');
    })->name('client.feedback.index');
});
