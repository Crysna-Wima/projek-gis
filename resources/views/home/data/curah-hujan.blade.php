@extends('home.data.index')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}' rel='stylesheet' type='text/css' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .bg-yellow {
            background-color: yellow;
        }

        .bg-biru-muda {
            background-color: rgb(0, 255, 229);
        }

        .bg-biru {
            background-color: rgb(0, 110, 255);
        }

        .bg-biru-tua {
            background-color: blue;
        }
    </style>
@endsection
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="banner_content text-center">
                            <h2>Data Curah Hujan</h2>
                            <div class="page_link">
                                <a href="index.html">Beranda</a>
                                <a href="courses.html">Data</a>
                                <a href="course-details.html">Data Curah Hujan</a>
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
                    <div class="main_image pl-5 ml-3">
                        <img class="img-fluid" src="{{ asset('assets-user/img/courses/prakiraan-cuaca.png') }}"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-4 right-contents">
                    <h4>Data Curah Hujan per - {{ $bulan_now }}, {{ $tahun_now }}</h4>
                    <hr>
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Rata-Rata Intensitas Hujan</p>
                                <span class="or">{{ $intensitas_hujan }} mm</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Intensitas Hujan Tertinggi</p>
                                <span class="or">{{ $curah_hujan_tertinggi }} mm</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Intensitas Hujan Terendah</p>
                                <span class="or">{{ $curah_hujan_terendah }} mm</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Total Kab/Kota</p>
                                <span class="or">{{ $jumlah_kota }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content_wrapper">
                <h4 class="title">PETA PERSEBARAN INTENSITAS HUJAN WILAYAH PROVINSI JAWA TIMUR</h4>
                <div class="content">
                    <p>Data berikut merupakan data intensitas hujan di wilayah provinsi Jawa Timur:</p>
                    <ul>
                        <li>Data yang diambil adalah akumulasi data setiap kecamatan di kab/kota yang masuk di sistem hingga
                            sekarang</li>
                        <li>Seluruh data yang ada berdasarkan hasil inputan terakhir</li>
                        <li>Data intensitas hujan dapat berubah menyesuaikan inputan data terakhir</li>
                        <li>Klik bagian peta untuk melihat detail informasi</li>
                    </ul>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-xl">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Mapping Curah Hujan</h4>
                                    {{-- button reload --}}
                                    <div class="row mb-4">
                                        <div class="col-sm-3 row">
                                            <div class="col-sm-4">
                                                <label for="inputPassword" class="col-form-label">Tahun</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="position-relative" id="datepicker5">
                                                    <input type="text" class="form-control" data-provide="datepicker"
                                                        data-date-container='#datepicker5' data-date-autoclose="true"
                                                        data-date-format="yyyy" data-date-min-view-mode="years"
                                                        id="tahun_map" name="tahun_map" value="{{ $tahun_now }}"
                                                        placeholder="e.g: 2024">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 row">
                                            <div class="col-sm-4">
                                                <label for="inputPassword" class="col-form-label">Bulan</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" name='bulan_map' id="bulan_map">
                                                    <option value="">Pilih Bulan</option>
                                                    <option value="1" {{ $bulan_now == 'Januari' ? 'selected' : '' }}>
                                                        Januari
                                                    </option>
                                                    <option value="2" {{ $bulan_now == 'Februari' ? 'selected' : '' }}>
                                                        Februari
                                                    </option>
                                                    <option value="3" {{ $bulan_now == 'Maret' ? 'selected' : '' }}>
                                                        Maret
                                                    </option>
                                                    <option value="4" {{ $bulan_now == 'April' ? 'selected' : '' }}>
                                                        April
                                                    </option>
                                                    <option value="5" {{ $bulan_now == 'Mei' ? 'selected' : '' }}>Mei
                                                    </option>
                                                    <option value="6" {{ $bulan_now == 'Juni' ? 'selected' : '' }}>
                                                        Juni
                                                    </option>
                                                    <option value="7" {{ $bulan_now == 'Juli' ? 'selected' : '' }}>
                                                        Juli
                                                    </option>
                                                    <option value="8" {{ $bulan_now == 'Agustus' ? 'selected' : '' }}>
                                                        Agustus
                                                    </option>
                                                    <option value="9"
                                                        {{ $bulan_now == 'September' ? 'selected' : '' }}>September
                                                    </option>
                                                    <option value="10" {{ $bulan_now == 'Oktober' ? 'selected' : '' }}>
                                                        Oktober
                                                    </option>
                                                    <option value="11"
                                                        {{ $bulan_now == 'November' ? 'selected' : '' }}>November
                                                    </option>
                                                    <option value="12"
                                                        {{ $bulan_now == 'Desember' ? 'selected' : '' }}>Desember
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-sm" id="search_map"><i
                                                    class="fas fa-search mx-2"></i>Search</button>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                            <button type="button" class="btn btn-warning btn-sm text-white"
                                                id="btn_reload_map">
                                                <i class="bx bx-revision mx-2"></i>
                                                Reload
                                            </button>
                                        </div>
                                    </div>
                                    {{-- legend warna untuk map --}}
                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-yellow" style="width: 20px; height: 20px;"></div>
                                                        <span class="mx-2">Rendah</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-biru-muda" style="width: 20px; height: 20px;">
                                                        </div>
                                                        <span class="mx-2">Normal</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-biru" style="width: 20px; height: 20px;"></div>
                                                        <span class="mx-2">Sedang</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-biru-tua" style="width: 20px; height: 20px;"></div>
                                                        <span class="mx-2">Tinggi</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="overflow-x: auto">
                                        <div id="map_curah_hujan" style="height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


        <script>
            $(document).ready(function() {
                // Set up the map
                var map = L.map('map_curah_hujan', {
                    center: [-7.250445, 112.768845], // Koordinat Jawa Timur
                    zoom: 8, // Set the initial zoom level
                });

                // Add the tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                var mapData = @json($curah_hujan);
                console.log(mapData);

                mapData.forEach(function(kota) {
                    var curah_hujan = kota.curah_hujan;
                    var color = 'yellow';

                    if (curah_hujan > 200) {
                        color = 'blue';
                    } else if (curah_hujan > 100) {
                        color = 'rgb(0, 110, 255)';
                    } else if (curah_hujan > 50) {
                        color = 'rgb(0, 255, 229)';
                    }

                    L.circle([kota.kota.latitude, kota.kota.longitude], {
                            color: color,
                            fillColor: color,
                            fillOpacity: 0.5,
                            radius: 5000
                        }).addTo(map)
                        .bindPopup(`<b>${kota.kota.name}</b><br>Indeks Curah Hujan: ${curah_hujan} mm`);
                });

                $(document).on("click", "#search_map", function() {
                    var tahun = $('#tahun_map').val();
                    var bulan = $('#bulan_map').val();

                    $.ajax({
                        url: '/master-data/map-curah-hujan',
                        type: 'POST',
                        data: {
                            tahun: tahun,
                            bulan: bulan,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                text: 'Sedang Mengambil Data...',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            Swal.close();
                            if (data.status == 'success') {
                                map.invalidateSize();

                                map.eachLayer(function(layer) {
                                    if (layer instanceof L.Circle) {
                                        map.removeLayer(layer);
                                    }
                                });

                                data.data.forEach(function(kota) {
                                    var curah_hujan = kota.curah_hujan;
                                    var color = 'yellow';

                                    if (curah_hujan > 200) {
                                        color = 'blue';
                                    } else if (curah_hujan > 100) {
                                        color = 'rgb(0, 110, 255)';
                                    } else if (curah_hujan > 50) {
                                        color = 'rgb(0, 255, 229)';
                                    }

                                    L.circle([kota.kota.latitude, kota.kota
                                            .longitude
                                        ], {
                                            color: color,
                                            fillColor: color,
                                            fillOpacity: 0.5,
                                            radius: 5000
                                        }).addTo(map)
                                        .bindPopup(
                                            `<b>${kota.kota.name}</b><br>Indeks Curah Hujan: ${curah_hujan} mm`
                                        );
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

                $(document).on("click", "#btn_reload_map", function() {
                    var tahun = $('#tahun_map').val();
                    var bulan = $('#bulan_map').val();

                    $.ajax({
                        url: '/master-data/map-curah-hujan',
                        type: 'POST',
                        data: {
                            tahun: tahun,
                            bulan: bulan
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                text: 'Sedang Mengambil Data...',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            Swal.close();
                            if (data.status == 'success') {
                                map.eachLayer(function(layer) {
                                    if (layer instanceof L.Circle) {
                                        map.removeLayer(layer);
                                    }
                                });

                                data.data.forEach(function(kota) {
                                    var curah_hujan = kota.curah_hujan;
                                    var color = 'yellow';

                                    if (curah_hujan > 200) {
                                        color = 'blue';
                                    } else if (curah_hujan > 100) {
                                        color = 'rgb(0, 110, 255)';
                                    } else if (curah_hujan > 50) {
                                        color = 'rgb(0, 255, 229)';
                                    }

                                    L.circle([kota.kota.latitude, kota.kota
                                            .longitude
                                        ], {
                                            color: color,
                                            fillColor: color,
                                            fillOpacity: 0.5,
                                            radius: 5000
                                        }).addTo(map)
                                        .bindPopup(
                                            `<b>${kota.kota.name}</b><br>Indeks Curah Hujan: ${curah_hujan} mm`
                                        );
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(data) {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

            });
        </script>
    </section>
    <!--================ End Course Details Area =================-->
@endsection
