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
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Dashboard</h3>
                                </div>
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