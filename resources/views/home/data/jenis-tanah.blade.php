@extends('home.data.index')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="banner_content text-center">
              <h2>Data Jenis Tanah</h2>
              <div class="page_link">
                <a href="index.html">Beranda</a>
                <a href="courses.html">Data</a>
                <a href="course-details.html">Data Jenis Tanah</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--================End Home Banner Area =================-->

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image pl-5 ml-5">
                    <img class="img-fluid" src="{{ asset("assets-user/img/courses/jenis-tanah.jpg") }}" alt="">
                </div>
            </div>
            <div class="col-lg-4 right-contents">
                <ul>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p>Jenis Tanah</p>
                            <span class="or">xxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p>Total Kab/Kota</p>
                            <span class="or">114</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content_wrapper">
            <h4 class="title">PETA PERSEBARAN JENIS TANAH TANAH WILAYAH PROVINSI JAWA TIMUR</h4>
            <div class="content">
                <p>Data berikut merupakan data jenis tanah di wilayah provinsi Jawa Timur:</p>
                <ul>
                    <li>Data yang diambil adalah akumulasi data setiap kecamatan di kab/kota yang masuk di sistem hingga sekarang</li>
                    <li>Seluruh data yang ada berdasarkan hasil inputan terakhir</li>
                    <li>Data jenis tanah dapat berubah menyesuaikan inputan data terakhir</li>
                    <li>Klik bagian peta untuk melihat detail informasi</li>
                </ul>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15830.120608175665!2d112.79862269999998!3d-7.29417355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1715063942633!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            {{-- <h4 class="title">Eligibility</h4>
            <div class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                <br>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea
                commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum. Lorem ipsum dolor sit
                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim
                ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute
                irure dolor in reprehenderit in voluptate velit esse cillum.
            </div> --}}
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->
@endsection