@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Tasks</h1>
            <div class="card">
                <div class="card-header">Task List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Static example row -->
                            <tr>
                                <td>Design Homepage</td>
                                <td>Website Redesign</td>
                                <td>2025-08-01</td>
                                <td>In Progress</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Update Status</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
