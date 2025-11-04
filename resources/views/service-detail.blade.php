@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4">{{ $service->name ?? 'Service Details' }}</h1>
        <p class="lead text-muted mb-5">{{ $service->short_description ?? 'Service description here.' }}</p>
        <div class="row">
            <div class="col-md-8">
                <h3>Details</h3>
                <p>{{ $service->description ?? 'Detailed description of the service.' }}</p>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Contact Us</h4>
                        <p>Interested in this service? Get in touch!</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
