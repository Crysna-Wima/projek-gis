@extends('layouts.app')
@section('content')
    <style>
        #table_list_aplikasi>tbody>tr {
            cursor: pointer;
        }

        #table_list_aplikasi>tbody>tr:hover {
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

        #dt_route_filter {
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
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-route mx-3"></i>Route</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4 font-size-12">Daftar Route</h4>
                            @can('routesetting-C')
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-sm mx-2 btn-tambah-route float-end mb-2">
                                            <i class="fas fa-plus mx-2"></i> Tambah Route
                                        </button>
                                    </div>
                                </div>
                            @endcan
                            <table id="dt_route" class="table table-bordered table-striped t_per test"
                           style="width: 3030px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="filterhead">Action</th>
                                        <th data-type="select" data-name="method">Method</th>
                                        <th data-type="text" data-name="url">URL</th>
                                        <th data-type="text" data-name="route">Route</th>
                                        <th data-type="select" data-name="guard">Guard</th>
                                        <th data-type="select" data-name="type">Type</th>
                                        <th data-type="text" data-name="middleware">Middleware</th>
                                        <th data-type="select" data-name="permission">Permission</th>
                                        <th class="filterhead">Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="filterhead"></td>
                                        <td data-type="select" data-name="method"></td>
                                        <td data-type="text" data-name="url"></td>
                                        <td data-type="text" data-name="route"></td>
                                        <td data-type="select" data-name="guard"></td>
                                        <td data-type="select" data-name="type"></td>
                                        <td data-type="text" data-name="middleware"></td>
                                        <td data-type="select" data-name="permission"></td>
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
                <div class="modal fade" id="modal-tambah-route" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal-tambah">Tambah Route</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Method
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_tambah" name="method" id="method">
                                            @foreach ($method as $item)
                                                <option value="{{ $item["value"] }}">{{ $item["value"] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Type
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_tambah" name="type" id="type">
                                            <option value="data">DATA</option>
                                            <option value="view">VIEW</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Guard
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_tambah" name="guard" id="guard">
                                            <option value="web">WEB</option>
                                            <option value="api">API</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">URL
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-route" name='url' value=""
                                            id="url" placeholder="e.g: /dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Route/Path
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-route" name='route' value=""
                                            id="route" placeholder="e.g: DahsboardController@index">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Middleware</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-route" name='middleware'
                                            value="" id="middleware" placeholder="e.g: lang,authz">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Permission</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_tambah" name="permission" id="permission">
                                            <option value="">Pilih Permission</option>
                                            @foreach ($permission as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('routesetting-C')
                                    <button type="button" id="btn-simpan-route" class="btn btn-primary btn-simpan-route"><i class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modal-edit-route" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal-edit">Edit Route</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <input type="hidden" class="edit-route" name="id_route" id="id_route" value="">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Method
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_edit" name="edit_method" id="edit_method">
                                            @foreach ($method as $item)
                                                <option value="{{ $item["value"] }}">{{ $item["value"] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Type
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_edit" name="edit_type" id="edit_type">
                                            <option value="data">DATA</option>
                                            <option value="view">VIEW</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Guard
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_edit" name="edit_guard" id="edit_guard">
                                            <option value="web">WEB</option>
                                            <option value="api">API</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">URL
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-route" name='edit_url' value=""
                                            id="edit_url" placeholder="e.g: /dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Route/Path
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-route" name='edit_route' value=""
                                            id="edit_route" placeholder="e.g: DahsboardController@index">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Middleware</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-route" name='edit_middleware'
                                            value="" id="edit_middleware" placeholder="e.g: lang,authz">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Permission
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_edit" name="edit_permission" id="edit_permission">
                                            <option value="">Pilih Permission</option>
                                            @foreach ($permission as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('routesetting-U')
                                    <button type="button" id="btn-edit-route" class="btn btn-primary btn-edit-route"><i class="fas fa-save mx-2"></i>Simpan</button>
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

            @can('routesetting-R')

            $('#dt_route').DataTable().clear().destroy();
            var table = $("#dt_route").DataTable({
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

                    $('#dt_menu').DataTable().columns.adjust()
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
                        } else if (data_type == "select"){
                            var input = document.createElement("select");
                            input.className = "form-control select2_search select_table";
                            var options = "";

                            if (iName == 'method') {
                                options += '<option value="">Semua</option>';
                                @foreach ($method as $item)
                                    options += '<option value="{{ $item["value"] }}">{{ $item["value"] }}</option>';
                                @endforeach
                            }
                            else if(iName == 'guard') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="web">WEB</option>';
                                options += '<option value="api">API</option>';
                            } else if (iName == 'type') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="data">DATA</option>';
                                options += '<option value="view">VIEW</option>';
                            } else if (iName == 'permission') {
                                options += '<option value="">Semua</option>';
                                @foreach ($permission as $item)
                                    options += '<option value="{{ $item->name }}">{{ $item->name }}</option>';
                                @endforeach
                            }

                            input.innerHTML = options;
                            $(input).appendTo($(column.header()).empty()).on('keyup change clear', function() {
                                column.search($(this).val(), false, false, true).draw();
                            });

                            $('.select2_search').select2({
                                width: '100%',
                                dropdownParent: $(document.body),
                            });
                        }
                    });
                },
                ajax: {
                    url: '/routesetting/list',
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
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('routesetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('routesetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                    {
                        width: '100px',
                        data: 'method',
                        name: 'method',
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        width: '100px',
                        data: 'url',
                        name: 'url',
                        searchable: false
                    },
                    {
                        width: '100px',
                        data: 'route',
                        name: 'route',
                        searchable: false,
                    },
                    {
                        width: '100px',
                        data: 'guard',
                        name: 'guard',
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        width: '100px',
                        data: 'type',
                        name: 'type',
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        width: '100px',
                        data: 'middleware',
                        name: 'middleware',
                        searchable: false
                    },
                    {
                        width: '100px',
                        data: 'permission',
                        name: 'permission',
                        searchable: false
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('routesetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('routesetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                ],
            })
            $('.dt-buttons').addClass('mb-2');

            $('.select2_search').select2({
                width: '100%',
                dropdownParent: $('#dt_route'),
            });

            @endcan


            @can('routesetting-C')
            
            $('.select2_tambah').select2({
                width: '100%',
                dropdownParent: $('#modal-tambah-route'),
            });

            $(document).on("click", ".btn-tambah-route", function() {
                $("#modal-tambah-route").modal("show");
                $('.select2_method_tambah').val('').trigger('change');
                $('.select2_type_tambah').val('').trigger('change');
                $('.select2_guard_tambah').val('').trigger('change');
                $('.select2_permission_tambah').val('').trigger('change');
                $('.input-route').val('');
            });

            $(document).on("click", "#btn-simpan-route", function() {
                var isValid = true;

                $('.input-route').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
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


                var method = $('#method').val();
                var type = $('#type').val();
                var guard = $('#guard').val();
                var url = $('#url').val();
                var route = $('#route').val();
                var middleware = $('#middleware').val();
                var permission = $('#permission').val();

                $.ajax({
                    url: '/routesetting',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        method: method,
                        type: type,
                        guard: guard,
                        url: url,
                        route: route,
                        middleware: middleware,
                        permission: permission,
                    },
                    beforeSend: function() {
                        $('.btn-simpan-route').attr('disabled', 'disabled');
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
                        $('.btn-simpan-route').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-tambah-route").modal("hide");
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
                        $('.btn-simpan-route').removeAttr('disabled', 'disabled');
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
            $('#modal-tambah-route').on('hidden.bs.modal', function(e) {
                $('#method').val('GET').trigger('change');
                $('#type').val('data').trigger('change');
                $('#guard').val('web').trigger('change');
                $('#url').val('');
                $('#route').val('');
                $('#middleware').val('');
                $('#permission').val('').trigger('change');

                // remove invalid class
                $('.input-route').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            @endcan

            @can('routesetting-U')

            $('.select2_edit').select2({
                width: '100%',
                dropdownParent: $('#modal-edit-route'),
            });

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/routesetting/' + id,
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
                            $("#modal-edit-route").modal("show");
                            $('#id_route').val(data.data.id);
                            $('#edit_method').val(data.data.method);
                            $('#edit_type').val(data.data.type);
                            $('#edit_guard').val(data.data.guard);
                            $('#edit_url').val(data.data.url);
                            $('#edit_permission').val(data.data.permission).trigger('change');
                            $('#edit_route').val(data.data.route);
                            $('#edit_middleware').val(data.data.middleware);
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

            $('#modal-edit-menu').on('hidden.bs.modal', function(e) {
                $('#edit_method').val('GET').trigger('change');
                $('#edit_type').val('data').trigger('change');
                $('#edit_guard').val('web').trigger('change');
                $('#edit_url').val('');
                $('#edit_route').val('');
                $('#edit_middleware').val('');
                $('#edit_permission').val('').trigger('change');

                // remove invalid class
                $('.edit-route').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            $(document).on("click", "#btn-edit-route", function() {
                var isValid = true;

                $('.edit-route').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
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


                var id = $('#id_route').val();
                var method = $('#edit_method').val();
                var type = $('#edit_type').val();
                var guard = $('#edit_guard').val();
                var url = $('#edit_url').val();
                var route = $('#edit_route').val();
                var middleware = $('#edit_middleware').val();
                var permission = $('#edit_permission').val();

                $.ajax({
                    url: '/routesetting/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        method: method,
                        type: type,
                        guard: guard,
                        url: url,
                        route: route,
                        middleware: middleware,
                        permission: permission,
                    },
                    beforeSend: function() {
                        $('.btn-edit-route').attr('disabled', 'disabled');
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
                        $('.btn-edit-route').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-edit-route").modal("hide");
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
                        $('.btn-edit-route').removeAttr('disabled', 'disabled');
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

            @can('routesetting-D')

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
                            url: '/routesetting/' + id,
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
