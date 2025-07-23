@extends('../layouts.app')

@section('content')
    <div class="row min-vh-100 py-5" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-transparent text-white text-center py-4" style="background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(5px);">
                    <h1 class="mb-0">Welcome to Volera</h1>
                    <p class="small">Log in to access your IT management dashboard</p>
                </div>
                <div class="card-body p-5">
                    <h2 class="text-center mb-4 text-primary">Login</h2>
                    <div class="form-container">
                        <form>
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label text-dark fw-bold">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="example@volera.com" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label text-dark fw-bold">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" value="password123" readonly>
                            </div>
                            <button type="button" class="btn btn-primary w-100 py-2" id="loginButton">Login</button>
                            <p class="text-center mt-3 text-muted">Don’t have an account? <a href="{{ route('register') }}" class="text-primary">Register here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .min-vh-100 {
        min-height: 100vh;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header, .card-footer {
        border: none;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #ced4da;
        padding: 0.75rem;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
    }

    .btn-primary {
        background: linear-gradient(90deg, #1e3a8a, #3b82f6);
        border: none;
        font-weight: 600;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .form-container {
        padding: 1rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 10px;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .text-primary {
        color: #3b82f6 !important;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .text-primary:hover {
        color: #1e3a8a !important;
    }

    @media (max-width: 767px) {
        .col-md-6 {
            padding: 1rem;
        }
        .card {
            margin: 1rem;
        }
    }
</style>

<script>
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = '{{ route('employee.dashboard') }}';
    });
</script>
