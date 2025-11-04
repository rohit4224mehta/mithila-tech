
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4 text-primary">My Projects</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($projects->isEmpty())
                <div class="text-center text-muted py-4">
                    <p>No projects found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Deadline</th>
                                <th>Progress</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>
                                        <span class="badge @switch($project->status)
                                            @case('pending') bg-secondary
                                            @case('in_progress') bg-info
                                            @case('under_review') bg-warning
                                            @case('completed') bg-success
                                            @case('planning') bg-primary
                                            @default bg-secondary
                                        @endswitch">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $project->start_date->format('M d, Y') }}</td>
                                    <td>{{ $project->deadline->format('M d, Y') }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $project->progress }}%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('client.projects.show', $project->id) }}" class="btn btn-sm btn-info">View Details</a>
                                        <a href="{{ route('client.feedback') }}?project_id={{ $project->id }}" class="btn btn-sm btn-secondary">Submit Feedback</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $projects->links() }}
                </div>
            @endif

            <div class="mt-4 text-end">
                <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 0.75rem;
    }
    .table thead th {
        background-color: #f8f9fa;
    }
    .badge {
        text-transform: capitalize;
    }
    .progress {
        margin-bottom: 0;
    }
    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
        }
        .card-body {
            padding: 1rem;
        }
    }
</style>
@endpush
