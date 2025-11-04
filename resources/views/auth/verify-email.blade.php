@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verify your email</h2>
    <p>We have sent a verification link to your email address. Please click that link to activate your account.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        {{-- allow guest resend by entering email --}}
        <div>
            <label for="email">Email (if link didn't arrive)</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com">
        </div>
        <button type="submit">Resend verification link</button>
    </form>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div>
            @foreach($errors->all() as $err) <p>{{ $err }}</p> @endforeach
        </div>
    @endif
</div>
@endsection
