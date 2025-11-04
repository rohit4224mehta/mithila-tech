@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-gray-900 to-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="relative max-w-md w-full space-y-8 bg-gray-800/90 p-6 sm:p-8 rounded-2xl shadow-2xl border border-blue-700/50 backdrop-blur-sm transform transition-all duration-300 hover:shadow-blue-500/20">
        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-20 h-20 bg-blue-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-200"></div>

        <div class="text-center z-10">
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-3 animate__animated animate__fadeInDown">
                Welcome Back
            </h2>
            <p class="text-sm text-gray-300 mb-4">
                Log in to Mithila Tech at <strong>{{ now()->setTimezone('Asia/Kolkata')->format('h:i A T, l, F d, Y') }}</strong>
            </p>
        </div>
        @if (session('status'))
            <div class="text-sm text-green-400 text-center p-2 bg-green-500/10 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        @if (session('success'))
            <div class="text-sm text-green-400 text-center p-2 bg-green-500/10 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-6 z-10" data-aos="zoom-in" data-aos-duration="1000">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Email Address</label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 @error('email') border-red-500 @enderror"
                           placeholder="Enter your email">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-envelope"></i></span>
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200 mb-1">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 @error('password') border-red-500 @enderror"
                           placeholder="Enter your password">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-lock"></i></span>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-400 focus:ring-blue-500 border-gray-600 rounded bg-gray-700">
                    <label for="remember" class="ml-2 block text-sm text-gray-200">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200">
                        Forgot password?
                    </a>
                </div>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center items-center py-2 px-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105">
                    <span>Log In</span>
                    <span class="ml-2"><i class="fas fa-sign-in-alt"></i></span>
                </button>
            </div>
            <div class="text-center">
                <a href="{{ route('register') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200">
                    Don’t have an account? Register
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
