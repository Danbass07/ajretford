<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aj Travel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/slate/bootstrap.min.css" integrity="sha384-8iuq0iaMHpnH2vSyvZMSIqQuUnQA7QM+f6srIdlgBrTSEyd//AWNMyEaSF2yPzNQ" crossorigin="anonymous"></head>


        <!-- Styles -->


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .antialiased{
                min-width: 620px;
                max-width: 620px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body class="antialiased">
    <x-header/>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
