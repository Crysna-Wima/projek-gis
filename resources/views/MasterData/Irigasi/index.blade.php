@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        #map {
            height: 400px
        }

        .bg-green {
            background-color: #009E3C
        }

        .bg-red {
            background-color: #dc3545
        }

        .bg-yellow {
            background-color: yellow
        }

        .bg-orange {
            background-color: orange
        }

        .bg-blue {
            background-color: blue
        }

        .bg-violet {
            background-color: violet
        }

        .bg-brown {
            background-color: brown
        }

        .bg-beige {
            background-color: beige
        }

        .bg-blueviolet {
            background-color: blueviolet
        }

        .bg-purple {
            background-color: purple
        }

        .bg-peru {
            background-color: peru
        }
    </style>
@endsection

@section('content')
    <style>
        #dt_irigasi>tbody>tr {
            cursor: pointer;
        }

        #dt_irigasi>tbody>tr:hover {
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

        #dt_irigasi_filter {
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
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->

                {{-- <div class="page-title-box d-sm-flex align-items-center justify-content-flex-end">
                    <h5 class="mb-sm-0 pull-right">p</h5>
                </div> --}}
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header p-2 bg-info shadow">
                            <div class="row">
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-utensil-spoon mx-3"></i>Irigasi
                                </h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist" id="tab_irigasi">
                                <li class="nav-item waves-effect waves-light" id="daftar_irigasi">
                                    <a class="nav-link tab_irig active" data-bs-toggle="tab" href="#tab_daftar_irigasi"
                                        role="tab" data-state="1">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i> <span
                                                class="badge bg-danger rounded-pill"></span></span>
                                        <span class="d-none d-sm-block">Daftar Irigasi</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light" id="mapping_irigasi">
                                    <a class="nav-link tab_irig" data-bs-toggle="tab" href="#tab_mapping_irigasi"
                                        role="tab" data-state="2">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i> <span
                                                class="badge bg-danger rounded-pill"></span></span>
                                        <span class="d-none d-sm-block">Mapping</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- tab panel  --}}
                            <div class="tab-content p-3 text-muted">
                                {{-- tab_daftar_produktifitas --}}
                                <div class="tab-pane fade show active" id="tab_daftar_irigasi" role="tabpanel">
                                    <h4 class="card-title mb-4 font-size-12 mt-2">Daftar Irigasi</h4>
                                    @can('irigasi-C')
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary btn-sm mx-2 btn-tambah-irigasi float-end mb-2">
                                                    <i class="fas fa-plus mx-2"></i> Tambah Irigasi
                                                </button>
                                            </div>
                                        </div>
                                    @endcan
                                    <table id="dt_irigasi" class="table table-bordered table-striped t_per test"
                                        style="width: 3030px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th data-type="select" data-name="kota">Kabupaten/kota</th>
                                                <th data-type="year" data-name="tahun">Tahun</th>
                                                <th data-type="select" data-name="id_jenis_irigasi">Jenis Irigasi</th>
                                                <th data-type="number" data-name="luas">Luas</th>
                                                <th class="filterhead">Action</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <th data-type="select" data-name="kota"></th>
                                                <th data-type="year" data-name="tahun"></th>
                                                <th data-type="select" data-name="id_jenis_irigasi"></th>
                                                <th data-type="number" data-name="luas"></th>
                                                <td class="filterhead"></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="tab_mapping_irigasi" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-xl">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Mapping Irigasi</h4>
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
                                                                <label for="inputPassword" class="col-form-label">Jenis
                                                                    Irigasi</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" name='jenis_irigasi_map'
                                                                    id="jenis_irigasi_map">
                                                                    <option value="">Semua Jenis Irigasi</option>
                                                                    @foreach ($id_jenis_irigasi as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
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
                                                                        <div class="bg-green"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Wilayah Sungai</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-red"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Daerah Aliran Sungai</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-yellow"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Sungai</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-orange"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Danau</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-blue"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Embung</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-violet"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Bendungan</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-brown"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Bendung</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-beige"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Waduk</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-blueviolet"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Tampungan Air Lainnya</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-purple"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Pantai</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bg-peru"
                                                                            style="width: 20px; height: 20px;"></div>
                                                                        <span class="mx-2">Tadah Hujan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="overflow-x: auto">
                                                        <div id="map" style="height: 500px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end card-->
                                        </div>
                                        <div style="overflow-x: auto">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>

                        <!-- end card -->
                    </div>

                    <!-- Modal Tambah -->
                    <div class="modal fade" id="modal-tambah-irigasi" data-bs-backdrop="static" data-bs-keyboard="false"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title-modal">Tambah Irigasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body p-4">
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Kota/Kabupaten
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-irigasi select2_kota" name='kota'
                                                id="kota">
                                                <option value="">Pilih Kota/Kabupaten</option>
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
                                                <input type="text" class="form-control input-irigasi"
                                                    data-provide="datepicker" data-date-container='#datepicker5'
                                                    data-date-autoclose="true" data-date-format="yyyy"
                                                    data-date-min-view-mode="years" id="tahun" name="tahun"
                                                    value="{{ date('Y') }}" placeholder="e.g: 2024">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Irigasi
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <select class="form-control input-irigasi select2_id_jenis_irigasi"
                                                name='id_jenis_irigasi' id="id_jenis_irigasi">
                                                <option value="">Pilih Jenis Irigasi</option>
                                                @foreach ($id_jenis_irigasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Luas (Ha)
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control input-irigasi" name='luas'
                                                value="" id="luas" placeholder="e.g: 884" step="0.1">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    @can('irigasi-C')
                                        <button type="button" id="btn-simpan-irigasi"
                                            class="btn btn-primary btn-simpan-irigasi"><i
                                                class="fas fa-save mx-2"></i>Simpan</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Edit -->
                    <div class="modal fade" id="modal-edit-irigasi" data-bs-backdrop="static" data-bs-keyboard="false"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title-modal">Edit Irigasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body p-4">
                                    <input type="hidden" class="edit-irigasi" name="id_irigasi" id="id_irigasi"
                                        value="">
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Kota/Kabupaten
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <select class="form-control edit-irigasi select2_edit_kota" name='edit_kota'
                                                id="edit_kota">
                                                <option value="">Pilih Kota/Kabupaten</option>
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
                                                <input type="text" class="form-control edit-irigasi"
                                                    data-provide="datepicker" data-date-container='#datepicker5'
                                                    data-date-autoclose="true" data-date-format="yyyy"
                                                    data-date-min-view-mode="years" id="edit_tahun" name="edit_tahun"
                                                    value="{{ date('Y') }}" placeholder="e.g: 2024">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Irigasi
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <select class="form-control edit-irigasi select2_edit_id_jenis_irigasi"
                                                name='edit_id_jenis_irigasi' id="edit_id_jenis_irigasi">
                                                <option value="">Semua Jenis</option>
                                                @foreach ($id_jenis_irigasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Luas (Ha)
                                            <strong><code>*</code></strong></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control edit-irigasi" name='edit_luas'
                                                value="" id="edit_luas" placeholder="e.g: 884" step="0.1">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    @can('irigasi-U')
                                        <button type="button" id="btn-edit-irigasi"
                                            class="btn btn-primary btn-edit-irigasi"><i
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
                $(document).on("click", ".tab_irig", function() {
                    var curr_state = $(this).data('state');
                    if (curr_state == 1) {
                        $(document).ready(function() {
                            if ($('#dt_irigasi').length) {
                                table.ajax.reload();
                                table.columns.adjust().draw();
                            } else {
                                location.reload();
                            }
                        })
                    } else if (curr_state == 2) {
                        console.log('tab 2');
                        var tahun = $('#tahun_map').val();
                        var jenis_irigasi = $('#jenis_irigasi_map').val();

                        $.ajax({
                            url: '/master-data/map-irigasi',
                            type: 'POST',
                            data: {
                                tahun: tahun,
                                jenis_irigasi: jenis_irigasi
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
                                        var id_jenis_irigasi = kota.id_jenis_irigasi;
                                        var jenisIrigasi = kota.jenis_irigasi.name;
                                        var luasIrigasi = kota.luas;
                                        var color = 'green';

                                        if (id_jenis_irigasi == "2   ") color = 'red';
                                        else if (id_jenis_irigasi == "3   ") color = 'yellow';
                                        else if (id_jenis_irigasi == "4   ") color = 'orange';
                                        else if (id_jenis_irigasi == "5   ") color = 'blue';
                                        else if (id_jenis_irigasi == "6   ") color = 'violet';
                                        else if (id_jenis_irigasi == "7   ") color = 'brown';
                                        else if (id_jenis_irigasi == "8   ") color = 'beige';
                                        else if (id_jenis_irigasi == "9   ") color = 'blueviolet';
                                        else if (id_jenis_irigasi == "10  ") color = 'purple';
                                        else if (id_jenis_irigasi == "11  ") color = 'peru';

                                        L.circle([kota.kota.latitude, kota.kota
                                                .longitude
                                            ], {
                                                color: color,
                                                fillColor: color,
                                                fillOpacity: 0.5,
                                                radius: 5000
                                            }).addTo(map)
                                            .bindPopup(
                                                `<b>${kota.kota.name}</b><br>Jenis Irigasi: ${jenisIrigasi}<br>Luas: ${luasIrigasi} Ha`
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

                @can('irigasi-R')
                    // Set up the map
                    var map = L.map('map', {
                        center: [-7.250445, 112.768845], // Koordinat Jawa Timur
                        zoom: 8, // Set the initial zoom level
                    });

                    // Add the tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    var mapData = @json($irigasi);
                    console.log(mapData);

                    mapData.forEach(function(kota) {
                        var id_jenis_irigasi = kota.id_jenis_irigasi;
                                        var jenisIrigasi = kota.jenis_irigasi.name;
                                        var luasIrigasi = kota.luas;
                                        var color = 'green';

                                        if (id_jenis_irigasi == "2   ") color = 'red';
                                        else if (id_jenis_irigasi == "3   ") color = 'yellow';
                                        else if (id_jenis_irigasi == "4   ") color = 'orange';
                                        else if (id_jenis_irigasi == "5   ") color = 'blue';
                                        else if (id_jenis_irigasi == "6   ") color = 'violet';
                                        else if (id_jenis_irigasi == "7   ") color = 'brown';
                                        else if (id_jenis_irigasi == "8   ") color = 'beige';
                                        else if (id_jenis_irigasi == "9   ") color = 'blueviolet';
                                        else if (id_jenis_irigasi == "10  ") color = 'purple';
                                        else if (id_jenis_irigasi == "11  ") color = 'peru';

                        L.circle([kota.kota.latitude, kota.kota
                                .longitude
                            ], {
                                color: color,
                                fillColor: color,
                                fillOpacity: 0.5,
                                radius: 5000
                            }).addTo(map)
                            .bindPopup(
                                `<b>${kota.kota.name}</b><br>Jenis Irigasi: ${jenisIrigasi}<br>Luas: ${luasIrigasi} Ha`
                            );
                    });

                    $(document).on("click", "#search_map", function() {
                        var tahun = $('#tahun_map').val();
                        var jenis_irigasi = $('#jenis_irigasi_map').val();

                        $.ajax({
                            url: '/master-data/map-irigasi',
                            type: 'POST',
                            data: {
                                tahun: tahun,
                                jenis_irigasi: jenis_irigasi
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
                                        var id_jenis_irigasi = kota.id_jenis_irigasi;
                                        var jenisIrigasi = kota.jenis_irigasi.name;
                                        var luasIrigasi = kota.luas;
                                        var color = 'green';

                                        if (id_jenis_irigasi == "2   ") color = 'red';
                                        else if (id_jenis_irigasi == "3   ") color = 'yellow';
                                        else if (id_jenis_irigasi == "4   ") color = 'orange';
                                        else if (id_jenis_irigasi == "5   ") color = 'blue';
                                        else if (id_jenis_irigasi == "6   ") color = 'violet';
                                        else if (id_jenis_irigasi == "7   ") color = 'brown';
                                        else if (id_jenis_irigasi == "8   ") color = 'beige';
                                        else if (id_jenis_irigasi == "9   ") color = 'blueviolet';
                                        else if (id_jenis_irigasi == "10  ") color = 'purple';
                                        else if (id_jenis_irigasi == "11  ") color = 'peru';

                                        L.circle([kota.kota.latitude, kota.kota
                                                .longitude
                                            ], {
                                                color: color,
                                                fillColor: color,
                                                fillOpacity: 0.5,
                                                radius: 5000
                                            }).addTo(map)
                                            .bindPopup(
                                                `<b>${kota.kota.name}</b><br>Jenis Irigasi: ${jenisIrigasi}<br>Luas: ${luasIrigasi} Ha`
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
                        var jenis_irigasi = $('#jenis_irigasi_map').val();

                        $.ajax({
                            url: '/master-data/map-irigasi',
                            type: 'POST',
                            data: {
                                tahun: tahun,
                                jenis_irigasi: jenis_irigasi
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
                                        var id_jenis_irigasi = kota.id_jenis_irigasi;
                                        var jenisIrigasi = kota.jenis_irigasi.name;
                                        var luasIrigasi = kota.luas;
                                        var color = 'green';

                                        if (id_jenis_irigasi == "2   ") color = 'red';
                                        else if (id_jenis_irigasi == "3   ") color = 'yellow';
                                        else if (id_jenis_irigasi == "4   ") color = 'orange';
                                        else if (id_jenis_irigasi == "5   ") color = 'blue';
                                        else if (id_jenis_irigasi == "6   ") color = 'violet';
                                        else if (id_jenis_irigasi == "7   ") color = 'brown';
                                        else if (id_jenis_irigasi == "8   ") color = 'beige';
                                        else if (id_jenis_irigasi == "9   ") color = 'blueviolet';
                                        else if (id_jenis_irigasi == "10  ") color = 'purple';
                                        else if (id_jenis_irigasi == "11  ") color = 'peru';

                                        L.circle([kota.kota.latitude, kota.kota
                                                .longitude
                                            ], {
                                                color: color,
                                                fillColor: color,
                                                fillOpacity: 0.5,
                                                radius: 5000
                                            }).addTo(map)
                                            .bindPopup(
                                                `<b>${kota.kota.name}</b><br>Jenis Irigasi: ${jenisIrigasi}<br>Luas: ${luasIrigasi} Ha`
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
                    $('#dt_irigasi').DataTable().clear().destroy();
                    var table = $("#dt_irigasi").DataTable({
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

                            $('#dt_role').DataTable().columns.adjust()
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
                                    } else if (iName == "id_jenis_irigasi") {
                                        options += "<option value=''>Semua</option>";
                                        @foreach ($id_jenis_irigasi as $item)
                                            options +=
                                                "<option value='{{ $item->id }}'>{{ $item->name }}</option>";
                                        @endforeach
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
                            url: '/master-data/irigasi/list',
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
                                data: 'id_jenis_irigasi',
                                name: 'id_jenis_irigasi',
                                className: 'text-center'
                            },
                            {
                                width: '300px',
                                data: 'luas',
                                name: 'luas',
                                className: 'text-center',
                                template: function(row) {
                                    return row.luas + ' Ha';
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
                                        @can('irigasi-U')
                                            "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id=" +
                                            row.id + "><i class='fas fa-pen'></i></button>  " +
                                        @endcan
                                    @can('irigasi-D')
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


                @can('irigasi-C')

                    $('.select2_kota').select2({
                        width: '100%',
                        placeholder: "Pilih kota / Kabupaten",
                        allowClear: true,
                        dropdownParent: $('#modal-tambah-irigasi')
                    });
                    $('.select2_id_jenis_irigasi').select2({
                        width: '100%',
                        placeholder: "Pilih Jenis Irigasi",
                        allowClear: true,
                        dropdownParent: $('#modal-tambah-irigasi')
                    });

                    $(document).on("click", ".btn-tambah-irigasi", function() {
                        $("#modal-tambah-irigasi").modal("show");
                        $('#kota').val('').trigger('change');
                        $('#tahun').val('');
                        $('#id_jenis_irigasi').val('').trigger('change');
                        $('#luas').val('');
                    });

                    $(document).on("click", "#btn-simpan-irigasi", function() {
                        var isValid = true;

                        $('.input-irigasi').each(function() {
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
                        var id_jenis_irigasi = $('#id_jenis_irigasi').val();
                        var luas = $('#luas').val();

                        $.ajax({
                            url: '/master-data/irigasi',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                kota: kota,
                                tahun: tahun,
                                id_jenis_irigasi: id_jenis_irigasi,
                                luas: luas,
                            },
                            beforeSend: function() {
                                $('.btn-simpan-irigasi').attr('disabled', 'disabled');
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
                                $('.btn-simpan-irigasi').removeAttr('disabled', 'disabled');
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $("#modal-tambah-irigasi").modal("hide");
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
                                $('.btn-simpan-irigasi').removeAttr('disabled', 'disabled');
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
                    $('#modal-tambah-irigasi').on('hidden.bs.modal', function(e) {
                        $('#kota').val('').trigger('change');
                        $('#tahun').val('');
                        $('#id_jenis_irigasi').val('').trigger('change');
                        $('#luas').val('');

                        // remove invalid class
                        $('.input-irigasi').each(function() {
                            $(this).removeClass('is-invalid');
                            $(this).parent().find('.invalid-feedback').remove();
                        });
                    });
                @endcan

                @can('irigasi-U')

                    $('.select2_edit_kota').select2({
                        width: '100%',
                        placeholder: "Pilih Kota / Kabupaten",
                        allowClear: true,
                        dropdownParent: $('#modal-edit-irigasi')
                    });
                    $('.select2_edit_id_jenis_irigasi').select2({
                        width: '100%',
                        placeholder: "Pilih Jenis Irigasi",
                        allowClear: true,
                        dropdownParent: $('#modal-edit-irigasi')
                    });

                    $(document).on("click", ".btn-edit", function() {
                        var id = $(this).data('id');
                        $.ajax({
                            url: '/master-data/irigasi/' + id,
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
                                    $("#modal-edit-irigasi").modal("show");
                                    console.log(data.data.id);
                                    $('#id_irigasi').val(data.data.id);
                                    $('#edit_kota').val(data.data.id_kota).trigger('change');
                                    $('#edit_tahun').val(data.data.tahun);
                                    $('#edit_id_jenis_irigasi').val(data.data.id_jenis_irigasi)
                                        .trigger('change');
                                    $('#edit_luas').val(data.data.luas);
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

                    $('#modal-edit-irigasi').on('hidden.bs.modal', function(e) {
                        $('#id_irigasi').val('');
                        $('#edit_kota').val('').trigger('change');
                        $('#edit_tahun').val('');
                        $('#edit_id_jenis_irigasi').val('').trigger('change');
                        $('#edit_luas').val('');
                        // remove invalid class
                        $('.edit-irigasi').each(function() {
                            $(this).removeClass('is-invalid');
                            $(this).parent().find('.invalid-feedback').remove();
                        });
                    });

                    $(document).on("click", "#btn-edit-irigasi", function() {
                        var isValid = true;

                        $('.edit-irigasi').each(function() {
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


                        var id = $('#id_irigasi').val();
                        var kota = $('#edit_kota').val();
                        var tahun = $('#edit_tahun').val();
                        var id_jenis_irigasi = $('#edit_id_jenis_irigasi').val();
                        var luas = $('#edit_luas').val();

                        $.ajax({
                            url: '/master-data/irigasi/' + id,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                kota: kota,
                                tahun: tahun,
                                id_jenis_irigasi: id_jenis_irigasi,
                                luas: luas,
                            },
                            beforeSend: function() {
                                $('.btn-edit-irigasi').attr('disabled', 'disabled');
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
                                $('.btn-edit-irigasi').removeAttr('disabled', 'disabled');
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $("#modal-edit-irigasi").modal("hide");
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
                                $('.btn-edit-irigasi').removeAttr('disabled', 'disabled');
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

                @can('irigasi-D')

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
                                    url: '/master-data/irigasi/destroy/' + id,
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
