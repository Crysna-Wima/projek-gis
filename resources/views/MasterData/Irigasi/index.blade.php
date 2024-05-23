@extends('layouts.app')
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
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-seedling mx-3"></i>Irigasi</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4 font-size-12">Daftar Irigasi</h4>
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
                                        <th data-type="number" data-name="jenis_irigasi">Jenis Irigasi</th>
                                        <th data-type="number" data-name="luas">Luas</th>
                                        <th class="filterhead">Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th data-type="select" data-name="kota"></th>
                                        <th data-type="year" data-name="tahun"></th>
                                        <th data-type="number" data-name="jenis_irigasi"></th>
                                        <th data-type="number" data-name="luas"></th>
                                        <td class="filterhead"></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- end card body -->
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
                                        <select class="form-control input-irigasi select2_kota" name='kota' id="kota">
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
                                            <input type="text" class="form-control input-irigasi" data-provide="datepicker" data-date-container='#datepicker5' data-date-autoclose="true"
                                                data-date-format="yyyy" data-date-min-view-mode="years" id="tahun" name="tahun" value="{{ date('Y') }}" placeholder="e.g: 2024">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Irigasi
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control input-irigasi" name='jenis_irigasi' value=""
                                            id="jenis_irigasi" placeholder="e.g: 1">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Luas (Ha)
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control input-irgasi" name='luas'
                                            value="" id="luas" placeholder="e.g: 884" step="0.1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('irigasi-C')
                                    <button type="button" id="btn-simpan-irigasi" class="btn btn-primary btn-simpan-irigasi"><i
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
                                <input type="hidden" class="edit-irigasi" name="id_irigasi" id="id_irigasi" value="">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Kota/Kabupaten
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control edit-irigasi select2_edit_kota" name='edit_kota' id="edit_kota">
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
                                            <input type="text" class="form-control edit-irigasi" data-provide="datepicker" data-date-container='#datepicker5' data-date-autoclose="true"
                                                data-date-format="yyyy" data-date-min-view-mode="years" id="edit_tahun" name="edit_tahun" value="{{ date('Y') }}" placeholder="e.g: 2024">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Irigasi
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control edit-irigasi" name='edit_jenis_irigasi' value=""
                                            id="edit_jenis_irigasi" placeholder="e.g: 1">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('irigasi-U')
                                    <button type="button" id="btn-edit-irigasi" class="btn btn-primary btn-edit-irigasi"><i
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

            @can('irigasi-R')

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
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }else if (data_type == "select") {
                            var input = document.createElement("select");
                            input.className = "form-control select2_search select_table";
                            var options = "";

                            if (iName == "kota") {
                                options += "<option value=''>Semua</option>";
                                @foreach ($kota as $item)
                                    options += "<option value='{{ $item->id }}'>{{ $item->name }}</option>";
                                @endforeach
                            }

                            input.innerHTML = options
                            $(input).appendTo($(column.header()).empty())
                                .on('keyup change clear', function() {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            
                            $('.select2_search').select2({
                                width: '100%',
                                dropdownParent: $(document.body),
                            });

                        }else if (data_type == "number") {
                            var input = document.createElement("input");
                            input.className = "form-control"
                            input.setAttribute('type', 'number');
                            input.setAttribute('min', '0');
                            input.setAttribute('max', '12');
                            $(input).appendTo($(column.header()).empty())
                                .on('keyup change clear', function() {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }else if (data_type == "year") {
                            year = new Date().getFullYear();
                            var input = document.createElement("input");
                            input.className = "form-control"
                            input.setAttribute('type', 'number');
                            input.setAttribute('min', '1900');
                            input.setAttribute('max', year);
                            $(input).appendTo($(column.header()).empty())
                                .on('keyup change clear', function() {
                                    column.search($(this).val(), false, false, true).draw();
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
                        data: 'jenis_irigasi',
                        name: 'jenis_irigasi',
                        className: 'text-center'
                    },
                    {
                        width: '300px',
                        data: 'luas',
                        name: 'luas',
                        className: 'text-center',
                        template: function (row) {  
                            return row.luas + ' Ha';
                        },
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('irigasi-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('irigasi-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
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
            
            $(document).on("click", ".btn-tambah-irigasi", function() {
                $("#modal-tambah-irigasi").modal("show");
                $('#kota').val('').trigger('change');
                $('#tahun').val('');
                $('#jenis_irigasi').val('');
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
                    }else if ($(this).is('number')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue === '' || inputValue <= 0) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            $(this).parent().append(
                                '<div class="invalid-feedback">Harus diisi dan lebih dari 0</div>');
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
                var jenis_irigasi = $('#jenis_irigasi').val();
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
                        jenis_irigasi: jenis_irigasi,
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
                $('#jenis_irigasi').val('');
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
                            $('#edit_jenis_irigasi').val(data.data.jenis_irigasi);
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
                $('#edit_jenis_irigasi').val('');
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
                    }else if ($(this).is('number')) {
                        var inputValue = $(this).val().trim();
                        if (inputValue === '' || inputValue <= 0) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            $(this).parent().append(
                                '<div class="invalid-feedback">Harus diisi dan lebih dari 0</div>');
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
                var jenis_irigasi = $('#edit_jenis_irigasi').val();
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
                        jenis_irigasi: jenis_irigasi,
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
