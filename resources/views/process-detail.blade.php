
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4">{{ $process->title ?? 'Our Process' }}</h1>
        <p class="lead text-muted mb-5">{{ $process->lead_description ?? 'A streamlined process to deliver results.' }}</p>
        <div class="row">
            <div class="col-md-8">
                <h3>Our Methodology</h3>
                @forelse ($process->steps ?? [] as $step)
                    <div class="mb-4">
                        <h4>{{ $loop->index + 1 }}. {{ $step->title ?? 'Step Title' }}</h4>
                        <p>{{ $step->description ?? 'Step description here.' }}</p>
                    </div>
                @empty
                    <p class="text-muted">No process steps available.</p>
                @endforelse
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Contact Us</h4>
                        <p>Want to learn more about our process? Reach out!</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

