<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volera - IT Company Management System</title>
    <head>
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-icons.min.css') }}">
    <link href="{{ asset('css/animate.min.css') }}">

        <link href="{{ asset('css/bootstrap.min.css') }}">
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}">
            <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>







</head>
<style>

@import 'bootstrap/dist/css/bootstrap.min.css';
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

    </style>
<body>
    <!-- Navigation -->
    @include('layouts.header')

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->

@include('layouts.footer')

</body>
</html>
