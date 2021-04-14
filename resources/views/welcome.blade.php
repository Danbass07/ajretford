<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/slate/bootstrap.min.css" integrity="sha384-8iuq0iaMHpnH2vSyvZMSIqQuUnQA7QM+f6srIdlgBrTSEyd//AWNMyEaSF2yPzNQ" crossorigin="anonymous"></head>


        <!-- Styles -->


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">


            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
