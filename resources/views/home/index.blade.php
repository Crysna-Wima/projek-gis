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
    <title>PadInsight</title>
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
    <header class="header_area">
      <div class="main_menu">
        <div class="search_input" id="search_input_box">
          <div class="container">
            <form class="d-flex justify-content-between" method="" action="">
              <input
                type="text"
                class="form-control"
                id="search_input"
                placeholder="Search Here"
              />
              <button type="submit" class="btn"></button>
              <span
                class="ti-close"
                id="close_search"
                title="Close Search"
              ></span>
            </form>
          </div>
        </div>
  
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.html"
              ><img src="{{ asset("assets-user/img/logo.png") }}" width="163" height="38"
            /></a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/tentang-kami">Tentang Kami</a>
                </li>
                <li class="nav-item submenu dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Data</a
                  >
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="/data/curah-hujan">Data Curah Hujan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/data/irigasi"
                        >Data Irigasi</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/data/jenis-tanah">Data Jenis Tanah</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/data/kemiringan">Data Kemiringan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/data/panen">Data Panen</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/data/kab-kota">Data Kab/Kota</a>
                      </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/kontak">Kontak Kami</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link search" id="search">
                    <i class="ti-search"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
      <div class="banner_inner">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="banner_content text-center">
                  <p class="text-uppercase">
                    Mengoptimalkan Hasil Pertanian
                  </p>
                  <h2 class="text-uppercase mt-4 mb-5">
                    Satu Klik Saja
                  </h2>
                  <div>
                    <a href="#" class="primary-btn ml-sm-3 ml-0">Get Started</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-5">
                  <div class="main_title">
                      <h2 class="mb-3">Data Produktivitas</h2>
                      <p>
                          Informasi terkait jumlah beberapa data produktivitas
                      </p>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-4 col-md-6">
                  <div class="single_feature">
                      <div class="icon"><img src="{{ asset("assets-user/img/features/f5.png") }}" alt="" width="48px"
                              height="48px" /></div>
                      <div class="desc">
                          <h4 class="mt-3 mb-2">Data Kabupaten/Kota</h4>
                          <p>
                            Sumber data ini akan memberikan informasi tentang jumlah kabupaten/kota di provinsi Jawa Timur
                          </p>
                      </div>
                  </div>
              </div>
      
              <div class="col-lg-4 col-md-6">
                  <div class="single_feature">
                      <div class="icon"><img src="{{ asset("assets-user/img/features/f4.png") }}" alt="" width="48px"
                              height="48px" /></div>
                      <div class="desc">
                          <h4 class="mt-3 mb-2">Data Panen</h4>
                          <p>
                            Sumber data ini akan memberikan informasi tentang jumlah panen di provinsi Jawa Timur
                          </p>
                      </div>
                  </div>
              </div>
      
              <div class="col-lg-4 col-md-6">
                  <div class="single_feature">
                      <div class="icon"><span class="flaticon-earth"></span></div>
                      <div class="desc">
                          <h4 class="mt-3 mb-2">Global Certification</h4>
                          <p>
                              One make creepeth, man bearing theira firmament won't great
                              heaven
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </section>
    <!--================ End Feature Area =================-->

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
