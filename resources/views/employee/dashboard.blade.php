@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-900 text-white fixed h-full shadow-lg transition-transform duration-300 ease-in-out">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Volera Dashboard</h2>
                <nav>
                    <a href="{{ route('employee.dashboard') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Dashboard</a>
                    <a href="{{ route('employee.tasks.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Tasks</a>
                    <a href="{{ route('employee.attendance.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Attendance</a>
                    <a href="{{ route('employee.projects.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Projects</a>
                    <a href="{{ route('employee.leaves.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Leave Requests</a>
                    <a href="{{ route('employee.performance.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Performance</a>
                    <a  class="block py-2 px-4 text-gray-300 hover:bg-indigo-800 rounded transition">Logout</a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-6">
            <!-- Header with Profile -->
            <header class="bg-white shadow-md rounded-lg p-4 mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-indigo-600">Employee Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Online</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="https://via.placeholder.com/40?text=Profile" alt="Profile" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-sm font-medium text-gray-700">John Doe</p>
                            <p class="text-xs text-gray-500">Employee ID: E123</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Employee Profile Section -->
            <section class="mb-6 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-indigo-600 mb-4">Employee Profile</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600"><strong>Name:</strong> John Doe</p>
                        <p class="text-gray-600"><strong>Email:</strong> john.doe@volera.com</p>
                        <p class="text-gray-600"><strong>Department:</strong> IT Development</p>
                    </div>
                    <div>
                        <p class="text-gray-600"><strong>Position:</strong> Senior Developer</p>
                        <p class="text-gray-600"><strong>Join Date:</strong> January 15, 2023</p>
                        <p class="text-gray-600"><strong>Location:</strong> Bangalore, India</p>
                    </div>
                </div>
            </section>

            <!-- Dashboard Content with Background Image -->
            <section class="relative bg-cover bg-center mb-6" style="background-image: url('https://via.placeholder.com/1920x400?text=Dashboard+Content');">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 to-blue-600/80"></div>
                <div class="relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                        <!-- Project Updates -->
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-indigo-600 mb-4">Project Updates</h2>
                            <p class="text-gray-600">Cloud Module: 80% Complete</p>
                            <p class="text-gray-600">Bug Fix Sprint: In Progress</p>
                        </div>

                        <!-- Leave Requests -->
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-indigo-600 mb-4">Leave Requests</h2>
                            <p class="text-gray-600">Pending: 1 (July 25-26)</p>
                            <p class="text-gray-600">Approved: 2</p>
                        </div>

                        <!-- Performance Metrics -->
                        <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-indigo-600 mb-4">Performance Metrics</h2>
                            <p class="text-gray-600">Rating: 4.5/5</p>
                            <p class="text-gray-600">Last Review: June 2025</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Company News Feed -->
            <section class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold text-indigo-600 mb-4">Company News</h2>
                <ul class="list-disc pl-5 text-gray-600">
                    <li>New office opening in London - July 2025</li>
                    <li>Annual Tech Summit scheduled for August 2025</li>
                </ul>
            </section>

            <!-- Quick Actions -->
            <section class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-indigo-600 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('employee.tasks.index') }}" class="btn btn-primary inline-block px-6 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300 text-center">
                        Manage Tasks
                    </a>
                    <a href="{{ route('employee.attendance.index') }}" class="btn btn-primary inline-block px-6 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300 text-center">
                        Check Attendance
                    </a>
                    <a href="{{ route('employee.projects.index') }}" class="btn btn-primary inline-block px-6 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300 text-center">
                        View Projects
                    </a>
                </div>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="py-4 text-center bg-gray-900 text-white mt-auto">
        <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 11:59 PM IST</p>
    </footer>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

body {
    font-family: 'Poppins', sans-serif;
}

.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradientAnimation 15s ease infinite;
}

@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.btn-primary {
    background: linear-gradient(90deg, #1e3a8a, #3b82f6);
    border: none;
    font-weight: 600;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.btn-primary:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

@media (max-width: 767px) {
    .flex { flex-direction: column; }
    aside { width: 100%; position: relative; }
    main { margin-left: 0; padding: 1rem; }
    h1 { font-size: 1.5rem; }
    .grid { grid-template-columns: 1fr; }
}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
