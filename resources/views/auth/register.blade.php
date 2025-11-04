@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-gray-900 to-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="relative max-w-md w-full space-y-8 bg-gray-800/90 p-6 sm:p-8 rounded-2xl shadow-2xl border border-blue-700/50 backdrop-blur-sm transform transition-all duration-300 hover:shadow-blue-500/20">
        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-20 h-20 bg-blue-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-200"></div>

        <div class="text-center z-10">
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-3 animate__animated animate__fadeInDown">
                Join Mithila Tech
            </h2>
            <p class="text-sm text-gray-300 mb-4">
                Register today at <strong>{{ now()->setTimezone('Asia/Kolkata')->format('h:i A T, l, F d, Y') }}</strong> and unlock the future of technology.
            </p>
        </div>
        @if (session('status'))
            <div class="text-sm text-green-400 text-center p-2 bg-green-500/10 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="space-y-6 z-10" data-aos="zoom-in" data-aos-duration="1000">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-200 mb-1">Full Name</label>
                <div class="relative">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 @error('name') border-red-500 @enderror"
                           placeholder="Enter your full name">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-user"></i></span>
                </div>
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
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
                           placeholder="Create a strong password">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-lock"></i></span>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-200 mb-1">Confirm Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                           placeholder="Confirm your password">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-lock"></i></span>
                </div>
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-200 mb-1">Role</label>
                <div class="relative">
                    <select id="role" name="role" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 appearance-none @error('role') border-red-500 @enderror">
                        <option value="" class="text-gray-400">Select Role</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
                        <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-user-tag"></i></span>
                </div>
                @error('role')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center items-center py-2 px-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105">
                    <span>Register Now</span>
                    <span class="ml-2"><i class="fas fa-rocket"></i></span>
                </button>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200">
                    Already have an account? Log in
                </a>
            </div>
        </form>
    </div>
</div>
@endsection