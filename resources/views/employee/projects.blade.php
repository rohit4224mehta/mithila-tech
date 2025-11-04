@extends('layouts.employee_app')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-12">
        <div class="container text-center">
            <h1 class="text-4xl md:text-5xl fw-bold mb-4 animate__animated animate__fadeInDown text-shadow-lg">My Assigned Projects</h1>
            <p class="text-lg md:text-xl text-gray-300 mb-6">Track your IT projects assigned by admin as of <strong>{{ date('h:i A T, l, F d, Y') }}</strong></p>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="py-16 bg-gray-50">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl fw-bold text-gray-900 mb-4">Active Projects</h2>
                <p class="text-gray-600">Showcasing your assigned IT innovations in AI, software, and more.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse (auth()->user()->projects as $project)
                    <div class="card bg-white shadow-md hover:shadow-xl transition-all duration-300 rounded-lg p-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <h3 class="text-xl fw-semibold text-blue-600 mb-2">{{ $project->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $project->description ?? 'No description available' }}</p>
                        <div class="mb-4">
                            <span class="inline-block {{ $project->status === 'completed' ? 'bg-red-100 text-red-800' : ($project->status === 'in_progress' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }} text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                        <h4 class="text-md fw-semibold text-gray-800 mb-2">Team:</h4>
                        <ul class="text-gray-600 list-disc list-inside">
                            @foreach ($project->users as $member)
                                <li>{{ $member->name }} {{ $member->id == auth()->id() ? '(You)' : '' }} {{ $project->users->count() > 1 && $member->pivot->role ? "({$member->pivot->role})" : '' }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('employee.projects.show', $project->id) }}" class="mt-4 inline-block btn btn-info btn-sm rounded-pill text-white hover:bg-blue-700 transition-colors duration-300">
                            <i class="bi bi-eye me-2"></i> View Details
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">No projects assigned yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Project Submission Section -->
    <section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl fw-bold mb-6 animate__animated animate__fadeIn">Submit Your Work</h2>
                <p class="text-lg md:text-xl text-gray-300 mb-8">Upload UI/UX designs and project reports for admin review.</p>
            </div>
            <form action="{{ route('employee.projects.submit', auth()->id()) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg text-gray-900 animate__animated animate__fadeInUp">
                @csrf
                <div class="mb-4">
                    <label for="project_id" class="block text-sm font-medium text-gray-700">Select Project</label>
                    <select id="project_id" name="project_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Choose a project</option>
                        @foreach (auth()->user()->projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="uiux_design" class="block text-sm font-medium text-gray-700">UI/UX Design (PDF/Image)</label>
                    <input type="file" id="uiux_design" name="uiux_design" accept=".pdf,.jpg,.png" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="report" class="block text-sm font-medium text-gray-700">Project Report (PDF)</label>
                    <input type="file" id="report" name="report" accept=".pdf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="w-full btn btn-success rounded-pill py-2 text-white hover:bg-green-700 transition-colors duration-300">
                    <i class="bi bi-upload me-2"></i> Submit
                </button>
            </form>
        </div>
    </section>

    <style>
        .text-shadow-lg {
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
        }

        .animate__animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .animate__fadeInDown {
            animation-name: fadeInDown;
        }

        .animate__fadeInUp {
            animation-name: fadeInUp;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card:hover {
            transform: translateY(-8px);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        @media (max-width: 768px) {
            .grid-cols-3 { grid-template-columns: 1fr; }
            .text-4xl { font-size: 2rem; }
            .text-xl { font-size: 1rem; }
            .max-w-xl { max-width: 100%; }
        }
    </style>

    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection