<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="{{ asset("assets-user/img/favicon.png") }}" type="image/png" />
    <title>Tentang Kami</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("assets-user/css/bootstrap.css")}}" />
    <link rel="stylesheet" href="{{ asset("assets-user/css/flaticon.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets-user/css/themify-icons.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets-user/vendors/owl-carousel/owl.carousel.min.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets-user/vendors/nice-select/css/nice-select.css") }}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset("assets-user/css/style.css") }}" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    @include('home.partials.navbar')
    
    <!--================ End Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="banner_content text-center">
                <h2>Tentang Kami</h2>
                <div class="page_link">
                  <a href="index.html">Beranda</a>
                  <a href="about-us.html">Tentang Kami</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Start About Area =================-->
    <section class="about_area section_gap">
      <div class="container">
        <div class="row h_blog_item">
          <div class="col-lg-6">
            <div class="h_blog_img">
              <img class="img-fluid" src="{{ asset("assets-user/img/tentang-kami.jpg") }}" alt="" />
            </div>
          </div>
          <div class="col-lg-6 align-items-center">
            <div class="h_blog_text">
              <div class="h_blog_text_inner left right">
                <h4>Selamat datang di website kami</h4>
                <p>
                  PadInsight merupakan website yang menyediakan informasi terkait produktivitas padi khususnya di wilayah provinsi Jawa Timur.
                </p>
                <p>
                  Kami memberikan informasi terkait faktor-faktor yang mempengaruhi kualitas padi seperti: Data Curah Hujan, Kemiringan Tanah, Irigasi, dll sehingga akan membantu masyarakat, petani, maupun pemerintah untuk meningkatkan kualitas padi di Indonesia, Khususnya wilayah Jawa Timur.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End About Area =================-->

    <!--================ Start footer Area  =================-->
    @include('home.layouts.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset("assets-user/js/jquery-3.2.1.min.js") }}"></script>
    <script src="{{ asset("assets-user/js/popper.js") }}"></script>
    <script src="{{ asset("assets-user/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("assets-user/vendors/nice-select/js/jquery.nice-select.min.js") }}"></script>
    <script src="{{ asset("assets-user/vendors/owl-carousel/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("assets-user/js/owl-carousel-thumb.min.js") }}"></script>
    <script src="{{ asset("assets-user/js/jquery.ajaxchimp.min.js") }}"></script>
    <script src="{{ asset("assets-user/js/mail-script.js") }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset("assets-user/js/gmaps.min.js") }}"></script>
    <script src="{{ asset("assets-user/js/theme.js") }}"></script>
  </body>
</html>
