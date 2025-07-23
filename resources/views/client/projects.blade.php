@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">My Projects</h1>
            <div class="card">
                <div class="card-header">Project List</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Static example row -->
                            <tr>
                                <td>Website Redesign</td>
                                <td>In Progress</td>
                                <td><a href="#" class="btn btn-sm btn-primary">View Details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
