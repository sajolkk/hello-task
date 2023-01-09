<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hello Task</title>
        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-dark">
        <div class="container ">
            <div class="row">
                <div class="col-md-12 mt-3 col-md-12 mt-5 py-5 text-center">
                    <h1 >Welcome to hello task</h1>
                    @if (Route::has('login'))                     
                            @auth
                                <a href="{{ url('/home') }}" class=" btn btn-primary ">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class=" btn btn-primary ">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary ">Registration</a>
                                @endif
                            @endauth
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
