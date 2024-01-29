<!DOCTYPE html>
<html>
<head>
    <title>Islamic Quotes Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color: #185d4e;background-image: url( '{{ asset('mosque.svg') }}' );background-size: cover;background-repeat: no-repeat;background-position: center top;">
<nav class="navbar navbar-expand-lg navbar-white">
    <h2><a class="navbar-brand text-white" href="{{ route('client.index') }}">Mini <span class="text-warning">Yaqs</span></a></h2>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ route('client.home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('client.quote') }}">Quotes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('client.video') }}">Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('client.about') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row mx-3 mt-2 px-3">
        <div class="col-12 pt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <h1 class="text-warning pt-4">Welcome to the heart of inspiration and faith, where Islamic Quotes and Motivational Videos converge to empower your journey.</h1>
                </div>
                <div class="col-4">
                    <img src="{{ asset('profil.png') }}" alt="profil">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <p class="text-white" style="font-size: 18pt">-- Mini Yaqs</p>
                </div>
            </div>
            <div class="row pb-5 d-flex justify-content-center">
                <div class="col-5">
                    <a href="{{ route('client.home') }}" class="btn btn-warning">Explore More</a>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
