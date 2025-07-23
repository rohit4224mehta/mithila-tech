@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Manage Projects</h1>
            <div class="card">
                <div class="card-header">Project List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Client</th>
                                <th>Assigned Employees</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Static example row -->
                            <tr>
                                <td>Website Redesign</td>
                                <td>Client A</td>
                                <td>John Doe, Jane Smith</td>
                                <td>In Progress</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-success mt-3">Create New Project</a>
                </div>
            </div>
        </div>
    </div>
@endsection
