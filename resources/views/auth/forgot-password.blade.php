@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-gray-900 to-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="relative max-w-md w-full space-y-8 bg-gray-800/90 p-6 sm:p-8 rounded-2xl shadow-2xl border border-blue-700/50 backdrop-blur-sm transform transition-all duration-300 hover:shadow-blue-500/20">
        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-20 h-20 bg-blue-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-200"></div>

        <div class="text-center z-10">
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-3 animate__animated animate__fadeInDown">
                Forgot Password
            </h2>
            <p class="text-sm text-gray-300 mb-4">
                Reset your password with Mithila Tech at <strong>{{ now()->setTimezone('Asia/Kolkata')->format('h:i A T, l, F d, Y') }}</strong>.
            </p>
        </div>

        @if (session('status'))
            <div class="text-sm text-green-400 text-center p-3 bg-green-500/10 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="text-sm text-red-400 text-center p-2 bg-red-500/10 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}" id="forgot-password-form">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Email Address</label>
                <div class="relative">
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 @error('email') border-red-500 @enderror"
                           placeholder="Enter your email address">
                    <span class="absolute right-3 top-2 text-blue-400"><i class="fas fa-envelope"></i></span>
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center items-center py-2 px-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submit-btn">
                    <span id="btn-text">Send OTP</span>
                    <span class="ml-2 hidden" id="btn-loading"><i class="fas fa-spinner fa-spin"></i></span>
                </button>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('forgot-password-form').addEventListener('submit', function () {
        const btn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');
        
        btn.disabled = true;
        btnText.classList.add('hidden');
        btnLoading.classList.remove('hidden');
    });
</script>
@endsection