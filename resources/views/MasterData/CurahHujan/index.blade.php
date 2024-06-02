@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        #map {
            height: 400px
        }
    </style>
@endsection


@section('content')
    <style>
        #dt_curah_hujan>tbody>tr {
            cursor: pointer;
        }

        #dt_curah_hujan>tbody>tr:hover {
            background-color: #00000030;
        }

        .scroller {
            height: 1px;
        }

        .scroll-wrapper1 {
            border: none;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .scroll-wrapper2 {
            overflow-x: auto;
        }

        .scroller2 {
            height: 1px;
        }

        .scroll-wrapper3 {
            border: none;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .scroll-wrapper4 {
            overflow-x: auto;
        }

        .scroller3 {
            height: 1px;
        }

        .scroll-wrapper5 {
            border: none;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .scroll-wrapper6 {
            overflow-x: auto;
        }

        table.dataTable {
            clear: both;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
            max-width: none !important;
            border-collapse: separate !important;
            /* width: 3000px !important; */
        }

        .table {
            /* width: 3000px !important; */
        }

        table.dataTable>thead>tr>th {
            text-align: center;
        }

        /* .sticky-left {
                             position:-webkit-sticky;position:sticky;top:0px;left:0px;opacity: 1;background: rgb(255,255,255);
                         }
                         th.sticky-left {
                             z-index:9;
                         } */
        .dtfh-floatingparenthead {
            top: 70px !important;
            overflow-x: auto !important;
            display: block !important;
            height: max-content !important;
            background-color: white !important;
        }

        .dt-buttons {
            /* float: right; */
        }

        #dt_curah_hujan_filter {
            display: none !important;
        }

        .sorting_asc:after {
            content: '' !important;
        }

        .sorting_asc:before {
            content: '' !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .is-invalid~.select2-container .select2-selection {
            border-color: #dc3545 !important;
        }


        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #f46a6a;
        }

        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle:before {
            content: "Inactive";
            left: -6rem;
        }

        .btn-toggle:after {
            content: "Active";
            right: -5rem;
            opacity: 0.5;
        }

        .btn-toggle>.handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.active>.handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }

        .btn-toggle.active:before {
            opacity: 0.5;
        }

        .btn-toggle.active:after {
            opacity: 1;
        }

        .btn-toggle.active {
            background-color: #009E3C;
        }

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

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header p-2 bg-info shadow">
                            <div class="row">
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-cloud-rain mx-3"></i>Curah Hujan
                                </h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist" id="tab_curah_hujan">
                                <li class="nav-item waves-effect waves-light" id="daftar_curah_hujan">
                                    <a class="nav-link tab_cur active" data-bs-toggle="tab" href="#tab_daftar_curah_hujan"
                                        role="tab" data-state="1">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i> <span
                                                class="badge bg-danger rounded-pill"></span></span>
                                        <span class="d-none d-sm-block">Daftar Curah Hujan</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light" id="mapping_curah_hujan">
                                    <a class="nav-link tab_cur" data-bs-toggle="tab" href="#tab_mapping_curah_hujan"
                                        role="tab" data-state="2">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i> <span
                                                class="badge bg-danger rounded-pill"></span></span>
                                        <span class="d-none d-sm-block">Mapping</span>
                                    </a>
                                </li>
                            </ul>

                            {{-- tab panel  --}}
                            <div class="tab-content p-3 text-muted">
                                {{-- tab_daftar_curah_hujan --}}
                                <div class="tab-pane fade show active" id="tab_daftar_curah_hujan" role="tabpanel">
                                    <h4 class="card-title mb-4 font-size-12">Daftar Curah Hujan</h4>
                                    @can('curahhujan-C')
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6">
                                                <button
                                                    class="btn btn-primary btn-sm mx-2 btn-tambah-curah_hujan float-end mb-2">
                                                    <i class="fas fa-plus mx-2"></i> Tambah Curah Hujan
                                                </button>
                                            </div>
                                        </div>
                                    @endcan

                                    <table id="dt_curah_hujan" class="table table-bordered table-striped t_cur test"
                                        style="width: 3030px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th data-type="select" data-name="kota">Kabupaten/Kota</th>
                                                <th data-type="year" data-name="tahun">Tahun</th>
                                                <th data-type="select" data-name="bulan">Bulan</th>
                                                <th data-type="number" data-name="curah_hujan">Curah Hujan</th>
                                                <th class="filterhead">Action</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <th data-type="select" data-name="kota"></th>
                                                <th data-type="year" data-name="tahun"></th>
                                                <th data-type="select" data-name="bulan"></th>
                                                <th data-type="number" data-name="curah_hujan"></th>
                                                <td class="filterhead"></td>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>


                                {{-- tab_mapping --}}
                                <div class="tab-pane fade" id="tab_mapping_curah_hujan" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-xl">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Mapping Curah Hujan</h4>
                                                    {{-- button reload --}}
                                                    <div class="row mb-4">
                                                        <div class="col-sm-3 row">
                                                            <div class="col-sm-4">
                                                                <label for="inputPassword"
                                                                    class="col-form-label">Tahun</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="position-relative" id="datepicker5">
                                                                    <input type="text" class="form-control"
                                                                        data-provide="datepicker"
                                                                        data-date-container='#datepicker5'
                                                                        data-date-autoclose="true" data-date-format="yyyy"
                                                                        data-date-min-view-mode="years" id="tahun_map"
                                                                        name="tahun_map" value="{{ $tahun_now }}"
                                                                        placeholder="e.g: 2024">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 row">
                                                            <div class="col-sm-4">
                                                                <label for="inputPassword"
                                                                    class="col-form-label">Bulan</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name='bulan_map'
                                                                    id="bulan_map">
                                                                    <option value="">Pilih Bulan</option>
                                                                    <option value="1"
                                                                        {{ $bulan_now == 1 ? 'selected' : '' }}>Januari
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $bulan_now == 2 ? 'selected' : '' }}>Februari
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $bulan_now == 3 ? 'selected' : '' }}>Maret
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $bulan_now == 4 ? 'selected' : '' }}>April
                                                                    </option>
                                                                    <option value="5"
                                                                        {{ $bulan_now == 5 ? 'selected' : '' }}>Mei</option>
                                                                    <option value="6"
                                                                        {{ $bulan_now == 6 ? 'selected' : '' }}>Juni
                                                                    </option>
                                                                    <option value="7"
                                                                        {{ $bulan_now == 7 ? 'selected' : '' }}>Juli
                                                                    </option>
                                                                    <option value="8"
                                                                        {{ $bulan_now == 8 ? 'selected' : '' }}>Agustus
                                                                    </option>
                                                                    <option value="9"
                                                                        {{ $bulan_now == 9 ? 'selected' : '' }}>September
                                                                    </option>
                                                                    <option value="10"
                                                                        {{ $bulan_now == 10 ? 'selected' : '' }}>Oktober
                                                                    </option>
                                                                    <option value="11"
                                                                        {{ $bulan_now == 11 ? 'selected' : '' }}>November
                                                                    </option>
                                                                    <option value="12"
                                                                        {{ $bulan_now == 12 ? 'selected' : '' }}>Desember
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                id="search_map"><i
                                                                    class="fas fa-search mx-2"></i>Search</button>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button type="button"
                                                                class="btn btn-warning btn-sm float-end"
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
                                                                        <div class="bg-yellow"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Rendah</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-biru-muda"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Normal</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-biru"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Sedang</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-biru-tua"
                                                                            style="width: 20px; height: 20px;"></div>
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
                    </div>
                    <!-- end card -->
                </div>
            </div>


            <!-- Modal Tambah -->
            <div class="modal fade" id="modal-tambah-curah_hujan" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-modal">Tambah Curah Hujan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Kota / Kabupaten
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control input-curah_hujan select2_kota" name='kota'
                                        id="kota">
                                        <option value="">Pilih kota / Kabupaten</option>
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Tahun
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <div class="position-relative" id="datepicker5">
                                        <input type="text" class="form-control input-curah_hujan"
                                            data-provide="datepicker" data-date-container='#datepicker5'
                                            data-date-autoclose="true" data-date-format="yyyy"
                                            data-date-min-view-mode="years" id="tahun" name="tahun"
                                            value="{{ date('Y') }}" placeholder="e.g: 2024">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Bulan
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control input-curah_hujan select2_bulan" name='bulan'
                                        id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Curah Hujan (mm)
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-curah_hujan" name='curah_hujan'
                                        value="" id="curah_hujan" placeholder="e.g: 100">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('curahhujan-C')
                                    <button type="button" id="btn-simpan-curah_hujan"
                                        class="btn btn-primary btn-simpan-curah_hujan"><i
                                            class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="modal-edit-curah_hujan" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-modal">Edit Curah Hujan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <input type="hidden" class="edit-curah_hujan" name="id_curah_hujan" id="id_curah_hujan"
                                value="">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Kota / Kabupaten
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control edit-curah_hujan select2_edit_kota" name='edit_kota'
                                        id="edit_kota">
                                        <option value="">Pilih Kota / Kabupaten</option>
                                        @foreach ($kota as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Tahun
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <div class="position-relative" id="datepicker5">
                                        <input type="text" class="form-control edit-curah_hujan"
                                            data-provide="datepicker" data-date-container='#datepicker5'
                                            data-date-autoclose="true" data-date-format="yyyy"
                                            data-date-min-view-mode="years" id="edit_tahun" name="edit_tahun"
                                            value="{{ date('Y') }}" placeholder="e.g: 2024">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Bulan
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control edit-curah_hujan select2_edit_bulan" name='edit_bulan'
                                        id="edit_bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Curah Hujan (mm)
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control edit-curah_hujan" name='edit_curah_hujan'
                                        value="" id="edit_curah_hujan" placeholder="e.g: 100">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @can('curahhujan-U')
                                <button type="button" id="btn-edit-curah_hujan"
                                    class="btn btn-primary btn-edit-curah_hujan"><i
                                        class="fas fa-save mx-2"></i>Simpan</button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    </div>
@endsection

@section('js')
    <!-- fontawesome icons init -->
    <script src="{{ asset('assets/js/pages/fontawesome.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // change state tab
            $(document).on("click", ".tab_cur", function() {
                var curr_state = $(this).data('state');
                if (curr_state == 1) {
                    $(document).ready(function() {
                        if ($('#dt_curah_hujan').length) {
                            table.ajax.reload();
                            table.columns.adjust().draw();
                        } else {
                            location.reload();
                        }
                    })
                } else if (curr_state == 2) {
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
                }
            });

            @can('curahhujan-R')

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


                $('#dt_curah_hujan').DataTable().clear().destroy();
                var table = $("#dt_curah_hujan").DataTable({
                    scrollX: true,
                    orderCellsTop: false,
                    pageLength: 10,
                    ordering: false,
                    searching: true,
                    deferRender: true,
                    processing: true,
                    scrollCollapse: true,
                    responsive: false,
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#page-topbar').height()
                    },
                    serverSide: true,
                    dom: 'Bfrtip',
                    language: {
                        processing: '<div class="loading-spinner"><i class="fas fa-spinner fa-spin fa-3x fa-fw"></i> Loading...</div>',
                    },
                    buttons: [{
                            "extend": "pageLength",
                            "className": "btn btn-secondary buttons-copy buttons-html5"
                        },
                        {
                            "extend": "copy",
                            "text": "<span class=\"icon-copy mr-1\"></span> COPY",
                            "className": "btn btn-secondary buttons-copy buttons-html5"
                        },

                        {
                            "extend": "excel",
                            "text": "<span class=\"icon-file-excel mr-1\"></span> EXCEL",
                            "className": "btn btn-secondary buttons-copy buttons-html5",
                        },
                        {
                            "extend": "pdf",
                            "text": "<span class=\"icon-file-pdf mr-1\"></span> PDF",
                            "className": "btn-sm btn btn-primarybtn btn-secondary buttons-copy buttons-html5"
                        },
                        {
                            "extend": "print",
                            "text": "<span class=\"icon-printer mr-1\"></span> PRINT",
                            "className": "btn btn-secondary buttons-copy buttons-html5"
                        },
                        {
                            "text": "<span class=\"icon-sync mr-1\"></span> RELOAD",
                            "className": "btn btn-secondary buttons-copy buttons-html5 btn-warning",
                            "action": function(e, dt, node, config) {
                                table.ajax.reload();
                                table.columns.adjust().draw();
                            }
                        }
                    ],
                    initComplete: function() {

                        $("#data_test").on('scroll', function() {
                            // console.log('data');
                        });

                        $('.dataTables_scrollHead').css('overflow', 'auto');
                        $('.dataTables_scrollHead').on('scroll', function() {
                            // console.log('data')
                            $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                        });

                        $(document).on('scroll', function() {
                            $('.dtfh-floatingparenthead').on('scroll', function() {
                                // console.log('data')
                                $('.dataTables_scrollBody').scrollLeft($(this)
                                    .scrollLeft());
                            });
                        })

                        $('#dt_curah_hujan').DataTable().columns.adjust()
                        this.api().columns().every(function(index) {
                            var data_type = this.header().getAttribute('data-type');
                            var iName = this.header().getAttribute('data-name');
                            var column = this


                            if (data_type == "text") {
                                var input = document.createElement("input");
                                input.className = "form-control"
                                $(input).appendTo($(column.header()).empty())
                                    .on('keyup change clear', function() {
                                        column.search($(this).val(), false, false, true)
                                            .draw();
                                    });
                            } else if (data_type == "select") {
                                var input = document.createElement("select");
                                input.className = "form-control select2_search select_table";
                                var options = "";

                                if (iName == "kota") {
                                    options += "<option value=''>Semua</option>";
                                    @foreach ($kota as $item)
                                        options +=
                                            "<option value='{{ $item->id }}'>{{ $item->name }}</option>";
                                    @endforeach
                                } else if (iName == "bulan") {
                                    options += "<option value=''>Semua</option>";
                                    options += "<option value='1'>Januari</option>";
                                    options += "<option value='2'>Februari</option>";
                                    options += "<option value='3'>Maret</option>";
                                    options += "<option value='4'>April</option>";
                                    options += "<option value='5'>Mei</option>";
                                    options += "<option value='6'>Juni</option>";
                                    options += "<option value='7'>Juli</option>";
                                    options += "<option value='8'>Agustus</option>";
                                    options += "<option value='9'>September</option>";
                                    options += "<option value='10'>Oktober</option>";
                                    options += "<option value='11'>November</option>";
                                    options += "<option value='12'>Desember</option>";
                                }

                                input.innerHTML = options
                                $(input).appendTo($(column.header()).empty())
                                    .on('keyup change clear', function() {
                                        column.search($(this).val(), false, false, true)
                                            .draw();
                                    });

                                $('.select2_search').select2({
                                    width: '100%',
                                    dropdownParent: $(document.body),
                                });

                            } else if (data_type == "number") {
                                var input = document.createElement("input");
                                input.className = "form-control"
                                input.setAttribute('type', 'number');
                                input.setAttribute('min', '0');
                                input.setAttribute('max', '12');
                                $(input).appendTo($(column.header()).empty())
                                    .on('keyup change clear', function() {
                                        column.search($(this).val(), false, false, true)
                                            .draw();
                                    });
                            } else if (data_type == "year") {
                                year = new Date().getFullYear();
                                var input = document.createElement("input");
                                input.className = "form-control"
                                input.setAttribute('type', 'number');
                                input.setAttribute('min', '1900');
                                input.setAttribute('max', year);
                                $(input).appendTo($(column.header()).empty())
                                    .on('keyup change clear', function() {
                                        column.search($(this).val(), false, false, true)
                                            .draw();
                                    });
                            }
                        });
                    },
                    ajax: {
                        url: '/master-data/curah-hujan/list',
                        complete: function() {
                            $('.dtfh-floatingparenthead').on('scroll', function() {
                                //    console.log('ssss');
                                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                            });
                        },
                    },
                    columns: [{
                            "data": null,
                            "sortable": false,
                            "searchable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                            "width": '20px',
                            "className": 'text-center'
                        },
                        {
                            width: '200px',
                            data: 'kota',
                            name: 'kota',
                            className: 'text-center'
                        },
                        {
                            width: '200px',
                            data: 'tahun',
                            name: 'tahun',
                            className: 'text-center'
                        },
                        {
                            width: '100px',
                            data: 'bulan',
                            name: 'bulan',
                            className: 'text-center'
                        },
                        {
                            width: '300px',
                            data: 'curah_hujan',
                            name: 'curah_hujan',
                            className: 'text-center',
                            template: function(row) {
                                return row.curah_hujan + ' mm';
                            },
                        },
                        {
                            width: '150px',
                            data: 'action',
                            name: 'action',
                            className: 'text-center',
                            searchable: false,
                            template: function(row) {
                                return "<center>" +
                                    @can('curahhujan-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id=" +
                                        row.id + "><i class='fas fa-pen'></i></button>  " +
                                    @endcan
                                @can('curahhujan-D')
                                    "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id=" +
                                    row.id + "><i class='fas fa-trash-alt'></i></button> " +
                                @endcan
                                "</center>";
                            },
                        },
                    ],
                })
                $('.dt-buttons').addClass('mb-2');
            @endcan


            @can('curahhujan-C')

                $('.select2_kota').select2({
                    width: '100%',
                    placeholder: "Pilih kota / Kabupaten",
                    allowClear: true,
                    dropdownParent: $('#modal-tambah-curah_hujan')
                });

                $('.select2_bulan').select2({
                    width: '100%',
                    placeholder: "Pilih Bulan",
                    allowClear: true,
                    dropdownParent: $('#modal-tambah-curah_hujan')
                });

                $(document).on("click", ".btn-tambah-curah_hujan", function() {
                    $("#modal-tambah-curah_hujan").modal("show");
                    $('#kota').val('').trigger('change');
                    $('#tahun').val('');
                    $('#bulan').val('').trigger('change');
                    $('#curah_hujan').val('');
                });

                $(document).on("click", "#btn-simpan-curah_hujan", function() {
                    var isValid = true;

                    $('.input-curah_hujan').each(function() {
                        $(this).removeClass('is-invalid');
                        $(this).parent().find('.invalid-feedback').remove();
                        if ($(this).attr('type') == 'text') {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '') {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi</div>');
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        } else if ($(this).is('number')) {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '' || inputValue <= 0) {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi dan lebih dari 0</div>'
                                );
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        } else if ($(this).is('select')) {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '') {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi</div>');
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        }
                    });


                    if (!isValid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Mohon Lengkapi Data',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return false;
                    }


                    var kota = $('#kota').val();
                    var tahun = $('#tahun').val();
                    var bulan = $('#bulan').val();
                    var curah_hujan = $('#curah_hujan').val();

                    $.ajax({
                        url: '/master-data/curah-hujan',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            kota: kota,
                            tahun: tahun,
                            bulan: bulan,
                            curah_hujan: curah_hujan,
                        },
                        beforeSend: function() {
                            $('.btn-simpan-curah_hujan').attr('disabled', 'disabled');
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                text: 'Sedang Menyimpan...',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            Swal.close();
                            $('.btn-simpan-curah_hujan').removeAttr('disabled', 'disabled');
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#modal-tambah-curah_hujan").modal("hide");
                                table.ajax.reload();
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
                            $('.btn-simpan-curah_hujan').removeAttr('disabled', 'disabled');
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

                // on modal close
                $('#modal-tambah-curah_hujan').on('hidden.bs.modal', function(e) {
                    $('#kota').val('').trigger('change');
                    $('#tahun').val('');
                    $('#bulan').val('');
                    $('#curah_hujan').val('');

                    // remove invalid class
                    $('.input-curah_hujan').each(function() {
                        $(this).removeClass('is-invalid');
                        $(this).parent().find('.invalid-feedback').remove();
                    });
                });
            @endcan

            @can('curahhujan-U')

                $('.select2_edit_kota').select2({
                    width: '100%',
                    placeholder: "Pilih Kota / Kabupaten",
                    allowClear: true,
                    dropdownParent: $('#modal-edit-curah_hujan')
                });

                $('.select2_edit_bulan').select2({
                    width: '100%',
                    placeholder: "Pilih Bulan",
                    allowClear: true,
                    dropdownParent: $('#modal-edit-curah_hujan')
                });

                $(document).on("click", ".btn-edit", function() {
                    var id = $(this).data('id');
                    $.ajax({
                        url: '/master-data/curah-hujan/' + id,
                        type: 'GET',
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
                                $("#modal-edit-curah_hujan").modal("show");
                                console.log(data.data.id);
                                $('#id_curah_hujan').val(data.data.id);
                                $('#edit_kota').val(data.data.id_kota).trigger('change');
                                $('#edit_tahun').val(data.data.tahun);
                                $('#edit_bulan').val(data.data.bulan).trigger('change');
                                $('#edit_curah_hujan').val(data.data.curah_hujan);
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

                $('#modal-edit-curah_hujan').on('hidden.bs.modal', function(e) {
                    $('#id_curah_hujan').val('');
                    $('#edit_kota').val('').trigger('change');
                    $('#edit_tahun').val('');
                    $('#edit_bulan').val('').trigger('change');
                    $('#edit_curah_hujan').val('');
                    // remove invalid class
                    $('.edit-curah_hujan').each(function() {
                        $(this).removeClass('is-invalid');
                        $(this).parent().find('.invalid-feedback').remove();
                    });
                });

                $(document).on("click", "#btn-edit-curah_hujan", function() {
                    var isValid = true;

                    $('.edit-curah_hujan').each(function() {
                        $(this).removeClass('is-invalid');
                        $(this).parent().find('.invalid-feedback').remove();
                        if ($(this).attr('type') == 'text') {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '') {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi</div>');
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        } else if ($(this).is('number')) {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '' || inputValue <= 0) {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi dan lebih dari 0</div>'
                                );
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        } else if ($(this).is('select')) {
                            var inputValue = $(this).val().trim();
                            if (inputValue === '') {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                $(this).parent().append(
                                    '<div class="invalid-feedback">Harus diisi</div>');
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).parent().find('.invalid-feedback').remove();
                            }
                        }
                    });


                    if (!isValid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Mohon Lengkapi Data',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return false;
                    }


                    var id = $('#id_curah_hujan').val();
                    var kota = $('#edit_kota').val();
                    var tahun = $('#edit_tahun').val();
                    var bulan = $('#edit_bulan').val();
                    var curah_hujan = $('#edit_curah_hujan').val();

                    $.ajax({
                        url: '/master-data/curah-hujan/' + id,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            kota: kota,
                            tahun: tahun,
                            bulan: bulan,
                            curah_hujan: curah_hujan,
                        },
                        beforeSend: function() {
                            $('.btn-edit-curah_hujan').attr('disabled', 'disabled');
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                text: 'Sedang Menyimpan...',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            Swal.close();
                            $('.btn-edit-curah_hujan').removeAttr('disabled', 'disabled');
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#modal-edit-curah_hujan").modal("hide");
                                table.ajax.reload();
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
                            $('.btn-edit-curah_hujan').removeAttr('disabled', 'disabled');
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
            @endcan

            @can('curahhujan-D')

                $(document).on("click", ".btn-delete", function() {
                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/master-data/curah-hujan/destroy/' + id,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                },
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Tunggu',
                                        text: 'Sedang Menyimpan...',
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
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: data.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        table.ajax.reload();
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
                        }
                    })
                });
            @endcan
        });
    </script>
@endsection
