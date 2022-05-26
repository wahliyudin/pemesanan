<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    @include('layouts.frontend.includes.css')
</head>

<body>
    <!-- Start header -->
    @include('layouts.frontend.includes.header')
    <!-- End header -->

    @yield('content')

    <!-- Start Footer -->
    @include('layouts.frontend.includes.footer')
    <!-- End Footer -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
    @include('layouts.frontend.includes.js')
</body>

</html>
