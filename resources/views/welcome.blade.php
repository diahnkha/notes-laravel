<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite('resources/css/app.css')
        @livewireStyles
        <script src="./alpine/alpine.js"></script>

    </head>
    <body class="antialiased">
        <livewire:navbar />
        <livewire:dashboard />


          @livewireScripts
    </body>
</html>
