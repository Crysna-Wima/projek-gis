<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>PadInsight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets-user/img/favicon-icon.png")}}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{asset("assets/libs/owl.carousel/assets/owl.carousel.min.css")}}">

    <link rel="stylesheet" href="{{asset("assets/libs/owl.carousel/assets/owl.theme.default.min.css")}}">

    <!-- Bootstrap Css -->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset("assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset("assets/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    @if(session()->has('message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ session()->get('message_success') }}</strong>
      </div>
@endif
@if(session()->has('message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ session()->get('message_error') }}</strong>
      </div>
@endif
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xl-9">
                <div class="auth-full-bg p-3">
                    <div class="w-100">
                        <div class="bg-overlay"></div>
                        <div class="d-flex mt-2 flex-column">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 mt-4">
                                    <div class="text-center">
                                        <h4><span class="text-primary" style="font-weight: bold;"></span>Sistem Informasi Geografis Produktivitas Padi</h4>
                                        <div dir="ltr">
                                            <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                <div class="item">
                                                    <div class="py-3">
                                                        <img src="{{asset("assets\images\ilustration/apps.png")}}" style="width: 100%;margin: auto;" alt="">
                                                        <p class="font-size-16 mt-2 mb-4">"PadInsight merupakan aplikasi yang memiliki fungsi untuk memanajemen dan memantau produktivitas padi di wilayah Jawa Timur"</p>
                                                        <div>
                                                            <h4 class="font-size-16 text-primary-cus">Kelompok 1</h4>
                                                            <p class="font-size-14 mb-0">PadInsight </p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="item">
                                                    <div class="py-3">
                                                        <img alt="" src="{{asset("assets-user/img/logo05.png")}}" style="width: 70%;margin: auto" class="mt-1">
                                                        <p class="font-size-16 mt-4 mb-4">"Aplikasi PadInsight dibangun untuk meningkatkan efisiensi dan efektivitas produktivitas padi di wilayah Jawa Timur"</p>

                                                        <div>
                                                            <h4 class="font-size-16 text-primary-cus">Kelompok 1</h4>
                                                            <p class="font-size-14 mb-0">PadInsight</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-3">


                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            <div class="my-auto">
                                <a href="#" class="d-block auth-logo">
                                    <h1 class="text-center text-warning" style="font-size: 3rem; font-weight: bold">PadInsight</h1>
                                    <h6 class="text-center text-success">Sistem Informasi Geografis Produktivitas Padi</h6>
                                </a>
                            </div>
                            <div class="my-auto">

                                <div>
                                    <h5 class="text-primary-cus">Selamat Datang !</h5>
                                    <p class="text-muted">Masuk untuk berselancar pada sistem <strong>PadInsight</strong></p>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ url('login/store') }}" method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username"  class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan Username">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kata Sandi</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <button id="submit" class="btn btn-primary waves-effect waves-light align-items-center" type="submit">
                                                <i class="bx bx bx-check-shield bx-burst font-size-16 align-middle"></i>
                                                Masuk</button>
                                            <button id="loading_submit" disabled style="display: none" type="button" class="btn btn-primary waves-effect waves-light">
                                                <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Validasi
                                            </button>
                                            {{-- button back home--}}
                                            <a href="{{url('/')}}" class="btn btn-light waves-effect waves-light align-items-center mt-2 text-success">
                                                <i class="bx bx-arrow-back bx-flashing font-size-16 align-middle"></i>
                                                Kembali
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script><strong>&nbsp;Kelompok 1</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- end container-fluid -->
</div>

<!-- JAVASCRIPT -->
<script src="{{asset("assets/libs/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/libs/metismenu/metisMenu.min.js")}}"></script>
<script src="{{asset("assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{asset("assets/libs/node-waves/waves.min.js")}}"></script>

<!-- owl.carousel js -->
<script src="{{asset("assets/libs/owl.carousel/owl.carousel.min.js")}}"></script>

<!-- auth-2-carousel init -->
<script src="{{asset("assets/js/pages/auth-2-carousel.init.js")}}"></script>

<!-- App js -->
<script src="{{asset("assets/js/app.js")}}"></script>

<script>
    $('#submit').on("click", function () {
        document.getElementById("submit").style.display = "none";
        document.getElementById("loading_submit").style.display = "block";
        // $('#btn_dr_submit').attr('disabled', true);
        // $('#btn_back').attr('disabled', true);
    })
</script>
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/auth-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Sep 2021 02:28:19 GMT -->
</html>
