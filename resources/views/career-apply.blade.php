@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-900 via-gray-900 to-black text-white py-20 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-4 animate__animated animate__fadeInDown">
                    Apply for {{ $career->title }}
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 mb-6 animate__animated animate__fadeIn animate__delay-1s">
                    Join our team and shape the future of IT at Mithila Tech.
                </p>
            </div>
        </div>
    </section>

    <!-- Application Form -->
    <section class="py-16 bg-white relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-lg mx-auto bg-gray-50 p-8 rounded-lg shadow-md">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg text-center">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('career.apply.submit', $career->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="resume" class="block text-gray-700 font-semibold mb-2">Upload Resume (PDF)</label>
                        <input type="file" name="resume" id="resume" accept=".pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="cover_letter" class="block text-gray-700 font-semibold mb-2">Cover Letter (Optional)</label>
                        <textarea name="cover_letter" id="cover_letter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="5"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all duration-300">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>
@endsection