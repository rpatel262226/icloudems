<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
           .navbar-brand {
                position: absolute;
                right: 0;
            }
            .navbar-brand > img {
                height: auto;
                width: 50%;
                float: right;
            }
            img {
                height: auto;
                width: 10%;
            }
            .progress{
                background-color: white;
            }
            .bg-light {
                background-color: white!important
            }
            button {
                margin-left: 2px;
            }
            .input-group {
                border: 1px solid gray;
                margin-bottom: 10px;
            }

        </style>
    </head>
    <body >
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4">
        <a class="navbar-brand ml-auto" href="#"><a class="navbar-brand" href="#"><img class="wpda-builder-logo" src="https://www.icloudems.com/wp-content/uploads/2020/06/cloudems-logo.png" alt="" title="cloudems-logo"></a></a>
    </nav>
    <div class="container mt-5">        
        @yield('content')
    
    </div>    
    </body>

</html>
