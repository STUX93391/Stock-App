<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stock Managment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">


    </head>
    <body style="background-color:#f1f0f0">
        <div class="px-4 py-5">
            <header >
                <h1 class="text-danger"><strong>Stock Managment App</strong>
                    <div class="float-right">
                        @if (Route::has('login'))
                            <div class="">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-dark">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-dark">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </h1>
            </header>

            <div class="container py-5">
                <div class="shadow card col-sm-5" style="background-color:#dddddd">
                    <div class="card-body">
                       <header class="">
                           <h5>Tired of maintaining the stock ?</h5>
                           <p class=""><i>&nbsp &nbsp Let's manage the stock on a click.</i></p>
                           <p class="">To make your work effective and yourself relaxed </p>
                           <p class="">add your business here.</p>
                       </header>
                    </div>
                </div>
            </div>

            <footer class="mt-5 text-secondary bg-dark">
                <div class="container">
                <h3 ><i>Contact</i></h3>
                    <ul class="">
                        <li class=""><h5 class="">email: _________</h5></li>
                        <li class=""><h5 class="">Fax: _________</h5></li>
                        <li class=""><h5 class="">Phone #: _________</h5></li>
                    </ul>

                </div>
            </footer>
        </div>

    </body>
</html>
