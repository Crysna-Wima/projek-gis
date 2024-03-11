@extends("layouts.app")
@section("content")
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="col-6 py-1 d-none" style="display: flex;justify-content: flex-end;">
                    <h6 class="pull-right font-size-5 text-white " id="date_dashboard"></h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <h6 class="pull-right font-size-5 text-white " id="time_dashboard"></h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h3>Selamat Datang, {{isset(auth()->user()->first_name)?auth()->user()->first_name:''}} {{ isset(auth()->user()->last_name)?auth()->user()->last_name:'' }}</h3>
                                </div>
                                <div class="col-4" style="display: flex;justify-content: flex-end;">
                                    <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#transactionModal">Hubungi Kami</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Menunggu Persetujuan</p>
                                                    <h4 class="mb-0">13</h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="bx bx-copy-alt font-size-24"></i>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Disetujui</p>
                                                    <h4 class="mb-0">12</h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center ">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                        <i class="bx bx-archive-in font-size-24"></i>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Ditolak</p>
                                                    <h4 class="mb-0">11</h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                        <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-wrap">
                                    <h4 class="card-title mb-4">Formulir Pengajuan</h4>
                                    <div class="ms-auto">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">Tahunan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Transaction Modal -->



        @include("layouts.footer")
    </div>
@endsection
@section("js")
    <!-- apexcharts -->
    <script src="{{asset("assets/libs/apexcharts/apexcharts.min.js")}}"></script>

    <!-- dashboard init -->
    <script src="{{asset("assets/js/pages/dashboard.init.js")}}"></script>
@endsection