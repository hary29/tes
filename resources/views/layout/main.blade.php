<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('tittle')</title>

        <link rel="icon" href="{{ url('/resources/img/logo1.png') }}" type="image/x-icon"/>

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script src="{{ asset('resources/js/jquery-3.5.1.min.js') }}"></script>

        <link href="{{ asset('resources/css/style-landing.css') }}" rel="stylesheet">

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <!-- <div class="container"> -->
            @include('layout/menu')
            @yield('container')
        <!-- </div> -->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <footer>
            <p>Created By: Timpatungansedekah.com<br>
            <a href="mailto:admin@timpatungansedekah.com">admin@timpatungansedekah.com</a></p>
            <div class="text-center center-block">
                <a href="https://www.facebook.com" target="_blank"><i id="social-fb" class="fa fa-facebook fa-3x social"></i></a>
	            <a href="https://twitter.com" target="_blank"><i id="social-tw" class="fa fa-twitter fa-3x social"></i></a>
	            <a href="https://instagram.com" target="_blank"><i id="social-ig" class="fa fa-instagram fa-3x social"></i></a>
	            <a href="mailto:bootsnipp@gmail.com" target="_blank"><i id="social-em" class="fa fa-envelope fa-3x social"></i></a>
            </div>
        </footer>
    </body>
</html>
