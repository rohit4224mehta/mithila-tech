@extends('layouts.employee_app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Notifications</h2>
        <form action="{{ route('employee.notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Mark All as Read</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($notifications->count())
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center {{ $notification->read_at ? 'bg-light' : 'bg-white fw-bold' }}">
                    <div>
                        <span>{{ $notification->data['message'] ?? 'No message' }}</span><br>
                        <small class="text-muted">{{ $notification->created_at->format('d M Y, h:i A') }}</small>
                    </div>
                    <div>
                        @if(!$notification->read_at)
                        <form action="{{ route('employee.notifications.markRead', $notification->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Mark Read</button>
                        </form>
                        @endif
                        @if(isset($notification->data['link']))
                        <a href="{{ $notification->data['link'] }}" class="btn btn-sm btn-info ms-2">View</a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center text-muted mt-5">No notifications found.</p>
    @endif
</div>
@endsection
