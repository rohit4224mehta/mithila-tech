@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Client Dashboard</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">My Projects</div>
                        <div class="card-body">
                            <p>View details of your assigned projects.</p>
                            <a href="{{ route('client.projects.index') }}" class="btn btn-primary">View Projects</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Feedback</div>
                        <div class="card-body">
                            <p>Submit feedback for projects.</p>
                            <a href="{{ route('client.feedback.index') }}" class="btn btn-primary">Submit Feedback</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
