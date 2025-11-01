@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section with Background Image -->
        <section class="py-20 text-center relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x600?text=Attendance+Hero');">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 via-blue-600/70 to-purple-600/80"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 animate__animated animate__fadeInDown">My Attendance System</h1>
                <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeInUp">
                    Manage and track your daily attendance with ease.
                </p>
            </div>
        </section>

        <!-- Attendance Form Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Attendance+Form');">
            <div class="absolute inset-0 bg-white/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-8 animate__animated animate__zoomIn">Mark Your Attendance</h2>
                <form class="max-w-lg mx-auto bg-indigo-50 p-6 rounded-xl shadow-md">
                    <div class="mb-4">
                        <label for="attendance-date" class="block text-gray-700">Date</label>
                        <input type="date" id="attendance-date" name="attendance-date" class="w-full p-2 border rounded" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700">Status</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="present" class="form-radio text-indigo-600" checked>
                                <span class="ml-2 text-gray-700">Present</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="absent" class="form-radio text-red-600">
                                <span class="ml-2 text-gray-700">Absent</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded hover:bg-indigo-700 transition">Submit Attendance</button>
                </form>
                <p class="text-center text-gray-600 mt-4">* This is a static demo. Submission is simulated.</p>
            </div>
        </section>

        <!-- Attendance Summary Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Attendance+Summary');">
            <div class="absolute inset-0 bg-gray-100/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8 animate__animated animate__fadeIn">Attendance Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                    <div class="p-6 bg-white rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-indigo-600">Total Days</h3>
                        <p class="text-2xl text-gray-800">22</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-indigo-600">Present Days</h3>
                        <p class="text-2xl text-gray-800">20</p>
                    </div>
                    <div class="p-6 bg-white rounded-xl shadow-md">
                        <h3 class="text-xl font-semibold text-indigo-600">Absent Days</h3>
                        <p class="text-2xl text-gray-800">2</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Attendance Record Section with Background Image -->
        <section class="py-16 relative bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400?text=Attendance+Record');">
            <div class="absolute inset-0 bg-white/90 backdrop-blur-md"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-8 animate__animated animate__zoomIn">Attendance Record</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left bg-indigo-50 rounded-xl shadow-md">
                        <thead>
                            <tr class="bg-indigo-100">
                                <th class="p-4 text-gray-700">Date</th>
                                <th class="p-4 text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-4">July 1, 2025</td>
                                <td class="p-4 text-green-600">Present</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">July 10, 2025</td>
                                <td class="p-4 text-red-600">Absent</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">July 15, 2025</td>
                                <td class="p-4 text-green-600">Present</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">July 20, 2025</td>
                                <td class="p-4 text-green-600">Present</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-4">July 23, 2025</td>
                                <td class="p-4 text-green-600">Present</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Back to Dashboard Section -->
        <section class="py-20 text-center bg-gradient-to-br from-indigo-900 to-blue-600">
            <div class="container mx-auto px-4">
                <a href="{{ route('employee.dashboard') }}" class="btn btn-primary inline-block px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                    Back to Dashboard
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-6 text-center bg-gray-900 text-white">
            <p class="text-lg">Welcome to Volera Technologies! Today is Wednesday, July 23, 2025, 11:47 PM IST</p>
        </footer>
    </div>
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
    h1 { font-size: 2rem; }
    .container { padding: 1rem; }
    table { display: block; overflow-x: auto; }
    .grid { grid-template-columns: 1fr; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Simulate form submission (static demo)
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Attendance submitted successfully! (Demo Mode)');
    });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
