<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metronic panel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="{{asset('')}}tailwind/output.css">
        @vite(['resources/css/app.css'])

    </head>
    <body class="antialiased">

        <div id="app" >

        </div>

        @vite(['resources/js/app.js'])
    </body>
</html>
