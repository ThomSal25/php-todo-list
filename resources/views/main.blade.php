<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Custom Login Registration</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="resources\css\app.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
           
        </style>
        
        

    </head>
    <body class="antialiased">
        <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand mr-auto" href="#">Laravel Custom Login Registration</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-colapse" id="navbarNav">
                    <ul class="navbar-nav"> 
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">                        
                            <a class="nav-link" href="{{route('registration')}}">Registration</a>                            
                        </li>

                        @else
                        <li class="nav-item">                        
                            <a class="nav-link" href="{{logout}}">Logout</a>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">        
            @yield('content')
        </div>
    </body>