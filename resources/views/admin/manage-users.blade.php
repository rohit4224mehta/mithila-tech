@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Manage Users</h1>
            <div class="card">
                <div class="card-header">User List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Static example row -->
                            <tr>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td>Employee</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-success mt-3">Add New User</a>
                </div>
            </div>
        </div>
    </div>
@endsection
