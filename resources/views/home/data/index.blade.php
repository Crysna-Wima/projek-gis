<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="{{ asset("assets-user/img/favicon-icon.png") }}" type="image/png" />
    <title>Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("assets-user/css/bootstrap.css")}}" />
    <link rel="stylesheet" href="{{ asset("assets-user/css/flaticon.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets-user/css/themify-icons.css") }}" />
    {{-- <link rel="stylesheet" href="{{ asset("assets-user/vendors/owl-carousel/owl.carousel.min.css") }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets-user/vendors/nice-select/css/nice-select.css") }}" /> --}}
    @yield('css')
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset("assets-user/css/style.css") }}" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    @include('home.partials.navbar')
    <!--================ End Header Menu Area =================-->

    @yield('content')

    <!--================ Start footer Area  =================-->
    @include('home.layouts.footer')
          <!--================ End footer Area  =================-->
      
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="{{ asset("assets-user/js/jquery-3.2.1.min.js") }}"></script>
          <script src="{{ asset("assets-user/js/popper.js") }}"></script>
          <script src="{{ asset("assets-user/js/bootstrap.min.js") }}"></script>
          {{-- <script src="{{ asset("assets-user/vendors/nice-select/js/jquery.nice-select.min.js") }}"></script> --}}
          {{-- <script src="{{ asset("assets-user/vendors/owl-carousel/owl.carousel.min.js") }}"></script> --}}
          {{-- <script src="{{ asset("assets-user/js/owl-carousel-thumb.min.js") }}"></script> --}}
          <script src="{{ asset("assets-user/js/jquery.ajaxchimp.min.js") }}"></script>
          <script src="{{ asset("assets-user/js/mail-script.js") }}"></script>
          <!--gmaps Js-->
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
          <script src="{{ asset("assets-user/js/gmaps.min.js") }}"></script>
          {{-- <script src="{{ asset("assets-user/js/theme.js") }}"></script> --}}
        </body>
      </html>