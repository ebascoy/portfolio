<!DOCTYPE html>
<html>
<head>

    <title> @yield('title') </title>
    <!-- Material design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">

    <!-- Bootstrap material design -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap-material-design.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/ripples.min.css') !!}">

    <!--App CSS-->
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
</head>
<body>

@include('layouts.navbar');
@yield('content');

<script src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>

<script src="{!! asset('js/ripples.min.js') !!}"></script>
<script src="{!! asset('js/material.min.js') !!}"></script>
<script>
    $(document).ready(function() {
        // This command is used to initialize some elements and make them work properly
        $.material.init();
    });
</script>
@yield('other_scripts');
</body>
</html>