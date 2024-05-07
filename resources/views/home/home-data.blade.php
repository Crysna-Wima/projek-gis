@extends('home.layouts.main')

@section('data')
@parent
<section class="feature_area section_gap_top">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="main_title">
                <h2 class="mb-3">Awesome Feature</h2>
                <p>
                    Replenish man have thing gathering lights yielding shall you
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
                        One make creepeth, man bearing theira firmament won't great
                        heaven
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
                        One make creepeth, man bearing theira firmament won't great
                        heaven
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
@endsection
