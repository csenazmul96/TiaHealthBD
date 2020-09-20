<?php use App\Enumeration\Role; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $meta_description }}">
        <title>{{ $meta_title? $meta_title : 'TiaBD' }}</title>
        <link rel="canonical" href="{{ url()->current() }}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('theme/css/bootstrap.css')}}" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
        <link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css"> 
        <link rel="stylesheet" href="{{asset('theme/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('theme/css/owl.theme.default.css')}}"> 
        <link rel="stylesheet" href="{{asset('theme/css/main.css')}}"> 
        @yield('additionalCSS')  
</head>
    <body> 
        @include('layout.frontShared.header') 
        @yield('content') 
        @include('layout.frontShared.footer')  
        <script src="{{asset('theme/js/vendor/jquery-3.3.1.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="{{asset('theme/js/vendor/bootstrap.js')}}"></script>
        <script src="{{asset('theme/js/owl.carousel.js')}}"></script>
        <script src="{{asset('theme/js/main.js')}}"></script>
        @yield('additionaljs') 
    </body>

</html>

