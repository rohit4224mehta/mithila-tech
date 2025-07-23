@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Admin Dashboard</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">User Management</div>
                        <div class="card-body">
                            <p>Manage all users (Admins, Employees, Clients).</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Project Management</div>
                        <div class="card-body">
                            <p>Create and assign projects to employees.</p>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Go to Projects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
