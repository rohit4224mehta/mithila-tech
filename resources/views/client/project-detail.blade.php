@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4 text-primary">Project Details: {{ $project->name }}</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Client:</strong> {{ $project->client->name ?? 'Not assigned' }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
                    <p><strong>Start Date:</strong> {{ $project->start_date->format('M d, Y') }}</p>
                    <p><strong>Deadline:</strong> {{ $project->deadline->format('M d, Y') }}</p>
                    <p><strong>Progress:</strong> {{ $project->progress }}%</p>
                    <p><strong>Hours:</strong> {{ $project->hours ?? 0 }} hrs</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Description:</strong></p>
                    <p>{{ $project->description ?? 'No description available' }}</p>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="mt-6">
                <h5 class="text-primary mb-3">Submit Feedback for this Project</h5>
                <form action="{{ route('client.feedback.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Select rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('client.projects') }}" class="btn btn-secondary">Back to Projects</a>
            </div>
        </div>
    </div>
</div>
@endsection