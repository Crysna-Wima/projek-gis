<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>PadInsight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets-user/img/favicon-icon.png")}}">

    <!-- DataTables -->
    <link href="{{asset("assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/jquery-ui.css")}}" />

    <!-- Responsive datatable examples -->
    <link href="{{asset("assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />

    <link href='{{asset("assets/libs/sweetalert2/sweetalert2.min.css")}}' rel='stylesheet' type='text/css'/>

    <!-- Bootstrap Css -->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset("assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset("assets/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/css/select2.min.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/css/select2-bootstrap-5-theme.min.css")}}" type="text/css"/>
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="{{asset("assets/css/select2-bootstrap-5-theme.rtl.min.css")}}" type="text/css"/>
    <link href="{{asset("assets/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{ asset("assets/libs/select2/css/select2.min.css") }}" rel="stylesheet" /> --}}
    <link href="{{asset("assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/libs/spectrum-colorpicker2/spectrum.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/libs/%40chenfengyuan/datepicker/datepicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/libs/toastr/build/toastr_custom.css")}}">
    <link rel="stylesheet" href="{{ asset("assets/css/fixedColumn.dataTables.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/fixedColumns.dataTables.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/rowGroup.dataTables.min.css") }}">


    <!-- Plugins css -->
    <link href="{{ asset("assets/libs/dropzone/min/dropzone.min.css") }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <script src="{{asset("assets/libs/toastr/build/toastr_custom_min.js")}}"></script>
    <script src="{{asset("assets/libs/toastr/build/toastr_custom.js")}}"></script>
    <script src="{{ asset("assets/js/d3.v4.min.js") }}"></script>
    <style>
        /* .select2-container {
        width: 100% !important;
      } */
      #time_sidebar {
        font-family: 'Chakra Petch', sans-serif;
      }
      .loading-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px; /* Adjust the font size as needed */
            color: #777; /* Change the color as needed */
            background-color: #fff; /* Background color of the loading rectangle */
            border: 1px solid #ddd; /* Border style */
            border-radius: 4px; /* Border radius */
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); /* Box shadow for a subtle shadow effect */
            width: 150px; /* Adjust the width as needed */
            height: 30px; /* Adjust the height as needed */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2; /* Set a high z-index value to bring the loading spinner to the front */
        }

        .loading-spinner i {
            margin-right: 5px; /* Adjust the spacing between the spinner and text */
            font-size: 12px; /* Adjust the font size as needed */
        }

        #loading-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px; /* Adjust the height of the loading bar */
            background-color: #007bff; /* Loading bar color */
            z-index: 9999; /* Set a high z-index to ensure it's on top of other content */
            transition: width 0.3s ease-in-out; /* Animation duration and easing */
        }

        .time-sidebar {
            transition: font-size 0.3s ease-in-out;
        }

        .time-sidebar-small {
            font-size: 12px;
        }
        
        .time-sidebar-small #date_dashboard {
            font-size: 0.7rem !important;
        }

        .time-sidebar-small #time_dashboard {
            font-size: 1.3rem !important;
        }
    </style>

    @yield('css')

</head>

<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">
    <div id="loading-bar"></div>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box" style="background-color: white">
                    <a href="/dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset("assets-user/img/logo4.png")}}" alt="" height="25">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset("assets-user/img/logo4.png")}}" alt="" height="17">
                        </span>
                    </a>
                    <a href="/dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset("assets-user/img/logo4.png")}}" alt="" height="25">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset("assets-user/img/logo4.png")}}" style="width: 20%; display: inline; margin-bottom: 15px">
                            <h1 class="text-center text-warning d-inline p-2 mt-2" style="font-size: 1.5rem; font-weight: bold">PadInsight</h1>
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <div class="dropdown dropdown-mega-menu-lg d-none d-lg-block ms-2">
                    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                        <span key="t-megamenu">Panduan Aplikasi</span>
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-size-14 mt-0" key="t-ui-components">Panduan Aplikasi</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="#" target="_blank" key="t-lightbox">User Manual</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" key="t-lightbox">Formulir BRD</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" key="t-lightbox">Formulir BAST</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <img src="{{asset("assets/images/megamenu-img.png")}}" alt="" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-file bx-burst"></i>
                        <span class="badge bg-danger rounded-pill p-0"><i class="bx bx-cloud-download font-size-13 text-white "></i></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a class="dropdown-item" href="#" target="_blank">
                            <i class="bx bx-file bx-tada bg-primary rounded-circle font-size-16 align-middle me-1 p-1 text-white"></i>
                            <span key="t-profile">User Manual</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-file bx-tada bg-info rounded-circle font-size-16 align-middle me-1 p-1 text-white"></i>
                            <span key="t-profile">Formulir BRD</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-file bx-tada bg-success rounded-circle font-size-16 align-middle me-1 p-1 text-white"></i>
                            <span key="t-profile">Formulir BAST</span>
                        </a>

                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         @if(isset(auth()->user()->foto))
                            <img class="rounded-circle header-profile-user" src="{{asset("assets/images/users/avatar-1.jpg")}}"
                                 alt="Header Avatar">
                        @else
                            <img class="rounded-circle header-profile-user" src="{{ isset(auth()->user()->foto)?asset('assets/images/user/'.auth()->user()->foto):''}}"
                                 alt="Header Avatar" onerror="this.onerror=null;this.src='{{asset("assets/images/users/avatar-1.jpg")}}'">
                         @endif
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{isset(auth()->user()->first_name)?auth()->user()->first_name:''}} {{ isset(auth()->user()->last_name)?auth()->user()->last_name:'' }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">My Profile</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ganti_password"><i class="bx bx-lock-alt font-size-16 align-middle me-1"></i> <span key="t-profile">Ganti Password</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="/logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    @include("layouts.leftbar")
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    @yield("content")
    <div id="{{__('ganti_password')}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ganti Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group mb-4">
                            <label for="input-date1">New Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" id="pass" minlength="8" name="n_pass" class="form-control" placeholder="Masukkan Kata Sandi" aria-label="Password" aria-describedby="password-addon" required>
                                <button class="btn btn-info" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                            </div>

                        </div>
                        <div class="form-group mb-4">
                            <label for="input-date1">Confirm New Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" id="pass_valid" minlength="8" name="c_n_pass" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
                                <button class="btn btn-info" type="button" id="pd1"><i id="icon" class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_back" type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Kembali</button>
                    <button id="btn_simpan" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    <button style="display: none;" disabled type="button" id="submit_loading" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Loading.......
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
@include("layouts.rightbar")
<!-- /Right-bar -->

<!-- Right bar overlay-->
{{--<div class="rightbar-overlay"></div>--}}

<!-- JAVASCRIPT -->
<script type="text/javascript">
    const togglePassword = document.getElementById("pd1");
    const validasi = document.getElementById("pass_valid");
    const icon = document.getElementById("icon");

    $('#pd1').on("click", function () {
        // toggle the type attribute
        const type = validasi.getAttribute("type") === "password" ? "text" : "password";
        if (type === 'text'){
            icon.className = 'mdi mdi-eye-off-outline';
            // mdi-eye-off-outline
        }else {
            icon.className = 'mdi mdi-eye-outline';
        }
        validasi.setAttribute("type", type);

        // toggle the icon
        // this.classList.toggle("bi-eye");
    });

    $("#btn_simpan").on("click", function () {
        var pass = document.getElementById('pass').value;
        var validasi = document.getElementById('pass_valid').value;

        $.ajax({
            method: "POST",
            url : "#",
            data : {
                "n_pass":pass,
                "c_n_pass":validasi,
                "_token": "{{ csrf_token() }}",
            },
            success: function (respon) {
                if (respon.data == true){
                    $("#ganti_password").modal("hide");
                    toastr.success("Berhasil","Password Berhasil Diubah");
                }else {
                    toastr.error("Failed!", "Password Gagal Diubah");
                }
            }
        })
    })
</script>

<script>

    function realtime() {
        var tanggallengkap = new String();
        var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
        namahari = namahari.split(" ");
        var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
        namabulan = namabulan.split(" ");
        var tgl = new Date();
        var hari = tgl.getDay();
        var tanggal = tgl.getDate();
        var bulan = tgl.getMonth();
        var tahun = tgl.getFullYear();
        var s = tgl.getSeconds();
        var m = tgl.getMinutes();
        var h = tgl.getHours();
        tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
        waktu = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2) + " WIB";
        document.getElementById("date_dashboard").innerHTML = tanggallengkap;
        document.getElementById("time_dashboard").innerHTML = waktu;
        setTimeout("realtime()", 1000);
    }
    realtime();

    // JavaScript untuk memantau progres load halaman
    window.addEventListener("load", function () {
        var loadingBar = document.getElementById("loading-bar");
        loadingBar.style.width = "100%"; // Set width to 100% to indicate loading completion
        setTimeout(function () {
            loadingBar.style.display = "none"; // Sembunyikan loading bar
        }, 300); // Sesuaikan penundaan sesuai kebutuhan
    });

    // JavaScript untuk memantau progres load halaman
    var loadingBar = document.getElementById("loading-bar");
    var currentProgress = 0;

    function updateLoadingBar() {
        loadingBar.style.width = currentProgress + "%";
    }

    var interval = setInterval(function () {
        currentProgress += 1;
        updateLoadingBar();
        if (currentProgress >= 100) {
            clearInterval(interval);
            setTimeout(function () {
                loadingBar.style.display = "none"; // Sembunyikan loading bar
            }, 300); // Sesuaikan penundaan sesuai kebutuhan
        }
    }, 10); // Sesuaikan interval sesuai kebutuhan


</script>
<script>
    function handleSidebarToggle() {
        var timeSidebar = document.getElementById('time_sidebar');
        var dateDashboard = document.getElementById('date_dashboard');
        var sidebarMenu = document.getElementsByTagName('body')[0];

        // Periksa apakah kelas 'vertical-collpsed' aktif pada elemen sidebar-menu-btn
        var isSidebarCollapsed = sidebarMenu.classList.contains('vertical-collpsed');


        // Sesuaikan ukuran font berdasarkan kondisi sidebar terbuka atau tertutup
        if (isSidebarCollapsed) {
            timeSidebar.classList.add('time-sidebar-small');
            timeSidebar.classList.remove('menu-title');
            timeSidebar.classList.add('p-2');
            dateDashboard.classList.add('mb-2');
        } else {
            timeSidebar.classList.remove('time-sidebar-small');
            timeSidebar.classList.add('menu-title');
            timeSidebar.classList.remove('p-2');
            dateDashboard.classList.remove('mb-2');
        }
    }

    // Panggil fungsi saat tombol sidebar diklik untuk mengecil
    document.getElementById('vertical-menu-btn').addEventListener('click', function() {
        // beri jeda sebentar sebelum memanggil fungsi
        setTimeout(handleSidebarToggle, 100);
    });
</script>
<script src="{{asset("assets/libs/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/js/jquery-ui.min.js")}}" ></script>
<script src="{{asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/libs/metismenu/metisMenu.min.js")}}"></script>
<script src="{{asset("assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
<script src="{{asset("assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js")}}"></script>
<script src="{{asset("assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{asset("assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{asset("assets/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/js/theter.min.js")}}"></script>

<!-- Required datatable js -->
<script src="{{asset("assets/libs/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
{{-- <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/fixedHeader.bootstrap4.min.js"></script> --}}
<script src="{{asset("assets/libs/datatables.net-bs4/js/dataTables.cellEdit.js")}}"></script>
<script src="{{asset("assets/js/dataTables.fixedColumns.min.js")}}"></script>
<script src="{{asset("assets/js/dataTables.rowGroup.min.js")}}"></script>


<!-- Buttons examples -->
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
<script src="{{asset("assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/libs/jszip/jszip.min.js")}}"></script>
<script src="{{asset("assets/libs/pdfmake/build/pdfmake.min.js")}}"></script>
<script src="{{asset("assets/libs/pdfmake/build/vfs_fonts.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-buttons/js/buttons.colVis.min.js")}}"></script>

<!-- Responsive examples -->
<script src="{{asset("assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js")}}"></script>

<!-- Datatable init js -->
<script src="{{asset("assets/js/pages/datatables.init.js")}}"></script>

<!-- Sweet Alerts js -->
<script src="{{asset("assets/libs/sweetalert2/sweetalert2.min.js")}}"></script>
<script src="{{asset('assets/js/pages/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/js/pages/jquery.doubleScroll.js')}}"></script>
<script src="{{asset('assets/js/datatableRowGroup.js')}}"></script>
<script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
@yield("js")
<!-- App js -->
<script src="{{asset("assets/js/app.js")}}"></script>
{{-- <script>
    $("div.data_test").on('scroll', function () {
        console.log('data');
    });
</script> --}}
</body>
</html>