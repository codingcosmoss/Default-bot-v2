<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pharma Plus</title>

        <link rel="shortcut icon" href="{{asset("")}}Photos/company-logo.png">
        <!-- Bootstrap Css -->
        <link href="{{asset("")}}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset("")}}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset("")}}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App js -->
        <script src="{{asset("")}}assets/js/plugin.js"></script>
        @vite('resources/css/app.css')

    </head>
    <body class="antialiased" data-sidebar="dark" id="body">

        <div id="app" >

        </div>

        @vite(['resources/js/app.js'])

        <!-- JAVASCRIPT -->
        <script src="{{asset("")}}assets/libs/jquery/jquery.min.js"></script>
        <script src="{{asset("")}}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset("")}}assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{asset("")}}assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{asset("")}}assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="{{asset("")}}assets/libs/apexcharts/apexcharts.min.js"></script>
        <!-- dashboard init -->
        <script src="{{asset("")}}assets/js/pages/dashboard.init.js"></script>


        <!-- App js -->
        <script src="{{asset("")}}assets/js/app.js"></script>
    </body>
</html>

