@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Attendance</h1>
            <div class="card">
                <div class="card-header">Mark Attendance</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-success btn-lg w-100">Check In</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger btn-lg w-100">Check Out</button>
                        </div>
                    </div>
                    <h5 class="mt-4">Attendance History</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Static example row -->
                            <tr>
                                <td>2025-07-22</td>
                                <td>09:00 AM</td>
                                <td>05:00 PM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
