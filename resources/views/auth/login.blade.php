@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-blue-600 to-purple-600 bg-[url('href={{ asset('images/stardust.png') }}')] py-8 px-4">
        <div class="w-full max-w-md transform transition-all duration-500 hover:scale-105">
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden animate__animated animate__fadeIn">
                <div class="bg-gradient-to-r from-indigo-800 to-blue-600 text-white text-center py-8">
                    <h1 class="text-3xl md:text-4xl font-bold tracking-tight animate__animated animate__slideInDown">Welcome back to Volera</h1>
                    <p class="text-sm md:text-base mt-2 opacity-80 animate__animated animate__slideInUp">Access your IT management dashboard - Today is Wednesday, July 23, 2025, 06:50 PM IST</p>
                </div>
                <div class="p-8">
                    <h2 class="text-2xl md:text-3xl font-semibold text-center text-indigo-900 mb-6 animate__animated animate__zoomIn">Sign In</h2>
                    <form class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                   class="mt-1 w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password"
                                   class="mt-1 w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                        </div>
                        <button type="button" id="loginButton"
                                class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-semibold rounded-lg shadow-md hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:-translate-y-1 animate__animated animate__pulse animate__infinite animate__slower">
                            Sign In
                        </button>
                        <p class="text-center text-sm text-gray-600 mt-4">
                            Don’t have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-200 underline underline-offset-4">Register here</a>
                        </p>
                    </form>
                </div>
                <div class="text-center py-4 bg-gray-50/50">
                    <p class="text-xs text-gray-500">© {{ date('Y') }} Volera Technologies. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

body {
    font-family: 'Inter', sans-serif;
}

.min-h-screen {
    min-height: 100vh;
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

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #f9fafb inset !important;
    box-shadow: 0 0 0 1000px #f9fafb inset !important;
    -webkit-text-fill-color: #111827 !important;
}

input:focus {
    outline: none;
}

.shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.shadow-lg {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

@media (max-width: 767px) {
    h1 { font-size: 2rem; }
    h2 { font-size: 1.5rem; }
    .p-8 { padding: 1rem; }
    .py-8 { padding-top: 1rem; padding-bottom: 1rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = '{{ route('about') }}';
    });
});
</script>

<!-- Include Bootstrap Icons -->
