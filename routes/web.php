<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Last updated: Wednesday, July 23, 2025, 11:42 PM IST.
|
*/

// Public Routes
Route::get('/', function () {
    return view('about');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services/application-managed', function () {
    return view('services.application-managed-services');
})->name('services.application-managed');

Route::get('/services/cloud-managed', function () {
    return view('services.cloud-managed-services');
})->name('services.cloud-managed');

Route::get('/services/mysql', function () {
    return view('services.mysql-services');
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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login'); // Display login form
})->name('login');

Route::post('/login', function () {
    // Simulate successful login and redirect to employee dashboard
    return redirect()->route('employee.dashboard');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register'); // Display registration form
})->name('register');

Route::post('/register', function () {
    // Simulate successful registration and redirect to employee dashboard
    return redirect()->route('employee.dashboard');
})->name('register.post');

// Admin Routes
// Remove 'auth' middleware since no database is used; use custom middleware if needed
Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
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
// Remove 'auth' middleware since no database is used; use custom middleware if needed
Route::middleware(['isEmployee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');
    Route::get('/tasks', function () {
        return view('employee.tasks');
    })->name('employee.tasks.index');
    Route::get('/attendance', function () {
        return view('employee.attendance');
    })->name('employee.attendance.index');
    Route::get('/projects', function () {
        return view('employee.projects');
    })->name('employee.projects.index');
    Route::get('/leaves', function () {
        return view('employee.leaves');
    })->name('employee.leaves.index');
    Route::get('/performance', function () {
        return view('employee.performance');
    })->name('employee.performance.index');
});

// Client Routes
// Remove 'auth' middleware since no database is used; use custom middleware if needed
Route::middleware(['isClient'])->prefix('client')->group(function () {
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
