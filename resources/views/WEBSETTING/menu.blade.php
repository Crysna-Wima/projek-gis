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

        #dt_menu_filter {
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
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-layer-group mx-3"></i>Menu</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4 font-size-12">Daftar Menu</h4>
                            @can('menusetting-C')
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-sm mx-2 btn-tambah-menu float-end mb-2">
                                            <i class="fas fa-plus mx-2"></i> Tambah Menu
                                        </button>
                                    </div>
                                </div>
                            @endcan
                            <table id="dt_menu" class="table table-bordered table-striped t_per test"
                           style="width: 3030px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="filterhead">Action</th>
                                        <th data-type="select" data-name="parent">Parent</th>
                                        <th>Icon</th>
                                        <th data-type="text" data-name="menu_name">Menu Name</th>
                                        <th data-type="text" data-name="url">URL</th>
                                        <th data-type="text" data-name="type">Type</th>
                                        <th data-type="text" data-name="permission">Permission</th>
                                        <th data-type="select" data-name="status">Status</th>
                                        <th class="filterhead">Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="filterhead"></td>
                                        <td data-type="select" data-name="parent"></td>
                                        <td></td>
                                        <td data-type="text" data-name="menu_name"></td>
                                        <td data-type="text" data-name="url"></td>
                                        <td data-type="text" data-name="type"></td>
                                        <td data-type="text" data-name="permission"></td>
                                        <td data-type="select" data-name="status"></td>
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
                <div class="modal fade" id="modal-tambah-menu" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Tambah Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Menu
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-menu" name='menu_name'
                                            value="" id="menu_name" placeholder="e.g: Dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Icon (Font
                                        awesome)<strong><code>*</code></strong></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control input-menu" name='icon' value=""
                                            id="icon" placeholder="e.g: fa fa-list">
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" class="form-control btn btn-primary" id="list_menu_icon"><i
                                                class="fas fa-search mx-2"></i>Lihat list</a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">URL
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-menu" name='url' value=""
                                            id="url" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Type
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-menu" name='type' value=""
                                            id="type" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Permission
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-menu" name='permission'
                                            value="" id="permission" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Parent
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_parent_tambah" name="parent" id="parent">
                                            <option value="0">Parent</option>
                                            @foreach ($parent as $item)
                                                <option value="{{ $item->id }}" data-icon="{{ $item->icon }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Priority</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control input-menu" name='priority'
                                            value="" id="priority">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('menusetting-C')
                                    <button type="button" id="btn-simpan-menu" class="btn btn-primary btn-simpan-menu"><i
                                            class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Edit -->
                <div class="modal fade" id="modal-edit-menu" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Edit Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <input type="hidden" class="edit-menu" name="id_menu" id="id_menu" value="">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Menu
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-menu" name='edit_menu_name'
                                            value="" id="edit_menu_name" placeholder="e.g: Dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Icon (Font
                                        awesome)<strong><code>*</code></strong></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control edit-menu" name='edit_icon'
                                            value="" id="edit_icon" placeholder="e.g: fa fa-list">
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" class="form-control btn btn-primary" id="list_menu_icon"><i
                                                class="fas fa-search mx-2"></i>Lihat list</a>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">URL
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-menu" name='edit_url'
                                            value="" id="edit_url" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Type
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-menu" name='edit_type'
                                            value="" id="edit_type" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Permission
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-menu" name='edit_permission'
                                            value="" id="edit_permission" placeholder="e.g: dashboard">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Parent
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_parent_edit" name="edit_parent" id="edit_parent">
                                            <option value="0">Parent</option>
                                            @foreach ($parent as $item)
                                                <option value="{{ $item->id }}" data-icon="{{ $item->icon }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Priority</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control edit-menu" name='edit_priority'
                                            value="" id="edit_priority">
                                    </div>
                                </div>
                                <div class="mb-3 row align-items-center">
                                    <label class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <button type="button" class="btn btn-toggle" id="edit_status"
                                            data-toggle="button" aria-pressed="false" autocomplete="off">
                                            <div class="handle"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('menusetting-U')
                                    <button type="button" id="btn-edit-menu" class="btn btn-primary btn-edit-menu"><i
                                            class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                @can('menusetting-U', 'menusetting-C')
                <!-- Modal List Icon -->
                <div class="modal fade" id="modal-list-menu-icon" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">List Menu Icon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Solid</h4>
                                                <div class="row icon-demo-content" id="solid">
                                                </div>
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Regular</h4>
                                                <div class="row icon-demo-content" id="regular">
                                                </div>
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Brands</h4>
                                                <div class="row icon-demo-content" id="brand">
                                                </div>
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
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

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                var icon = $(state.element).data('icon');
                if (icon) {
                    return $('<span><i class="' + icon + ' mx-2"></i> ' + state.text + '</span>');
                }

                return state.text;
            }

            @can('menusetting-R')

            $('#dt_menu').DataTable().clear().destroy();
            var table = $("#dt_menu").DataTable({
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

                            if (iName == 'status') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="y">Active</option>';
                                options += '<option value="n">Inactive';
                            } else if (iName == 'parent') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="0">Parent</option>';
                                @foreach ($parent as $item)
                                    options += '<option value="{{ $item->id }}" data-icon="{{ $item->icon }}">{{ $item->name }}</option>';
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
                        }
                    });
                },
                ajax: {
                    url: '/menusetting/list',
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
                                    @can('menusetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('menusetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                    {
                        width: '100px',
                        data: 'parent_id',
                        name: 'parent_id',
                        searchable: false
                    },
                    {
                        width: '50px',
                        data: 'icon',
                        name: 'icon',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        width: '200px',
                        data: 'name',
                        name: 'name'
                    },
                    {
                        width: '200px',
                        data: 'url',
                        name: 'url'
                    },
                    {
                        width: '100px',
                        data: 'type',
                        name: 'type'
                    },
                    {
                        width: '100px',
                        data: 'permission',
                        name: 'permission'
                    },
                    {
                        width: '100px',
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('menusetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('menusetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                ],
                rowGroup: {
                    dataSrc: 'parent_id'
                }
            })
            $('.dt-buttons').addClass('mb-2');

            $('.select2_search').select2({
                width: '100%',
                dropdownParent: $('#dt_menu'),
                templateResult: formatState,
            });

            @endcan


            @can('menusetting-C')

            $('.select2_parent_tambah').select2({
                width: '100%',
                dropdownParent: $('#modal-tambah-menu'),
                templateResult: formatState,
            });
            
            $(document).on("click", ".btn-tambah-menu", function() {
                $("#modal-tambah-menu").modal("show");
                $('#menu_name').val('');
                $('#icon').val('');
                $('#type').val('');
                $('#permission').val('');
                $('#parent').val('');
                $('#priority').val(0);
                $('#url').val('');
            });

            $(document).on("click", "#list_menu_icon", function() {
                $("#modal-list-menu-icon").modal("show");
            });

            $(document).on("click", "#btn-simpan-menu", function() {
                var isValid = true;

                $('.input-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                    if ($(this).attr('type') == 'number') {
                        var priorityInput = $('#priority'); // Define priorityInput here
                        var priorityValue = parseInt(priorityInput.val()
                            .trim()); // Use trim() directly
                        console.log(priorityValue);
                        if (isNaN(priorityValue) || priorityValue < 0) {
                            isValid = false;
                            priorityInput.addClass('is-invalid');
                            priorityInput.parent().append(
                                '<div class="invalid-feedback">Harus diisi dengan angka tidak negatif</div>'
                            );
                        } else {
                            priorityInput.removeClass('is-invalid');
                            priorityInput.parent().find('.invalid-feedback').remove();
                        }
                    } else {
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


                var name = $('#menu_name').val();
                var permission = $('#permission').val();
                var url = $('#url').val();
                var order_no = $('#priority').val();
                var icon = $('#icon').val();
                var parent_id = $('#parent').val();
                var type = $('#type').val();

                $.ajax({
                    url: '/menusetting',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        name: name,
                        permission: permission,
                        url: url,
                        order_no: order_no,
                        icon: icon,
                        parent_id: parent_id,
                        type: type,
                    },
                    beforeSend: function() {
                        $('.btn-simpan-menu').attr('disabled', 'disabled');
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
                        $('.btn-simpan-menu').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-tambah-menu").modal("hide");
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
                        $('.btn-simpan-menu').removeAttr('disabled', 'disabled');
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
            $('#modal-tambah-menu').on('hidden.bs.modal', function(e) {
                $('#menu_name').val('');
                $('#icon').val('');
                $('#type').val('');
                $('#permission').val('');
                $('#parent').val('');
                $('#priority').val(0);
                $('#url').val('');
                // remove invalid class
                $('.input-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            @endcan

            @can('menusetting-U')

            $('.select2_parent_edit').select2({
                width: '100%',
                dropdownParent: $('#modal-edit-menu'),
                templateResult: formatState,
            });

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/menusetting/' + id,
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
                            $("#modal-edit-menu").modal("show");
                            $('#id_menu').val(data.data.id);
                            $('#edit_menu_name').val(data.data.name);
                            $('#edit_icon').val(data.data.icon);
                            $('#edit_type').val(data.data.type);
                            $('#edit_permission').val(data.data.permission);
                            $('#edit_parent').val(data.data.parent_id).trigger('change');
                            $('#edit_priority').val(data.data.order_no);
                            $('#edit_url').val(data.data.url);
                            // Set status for the toggle button
                            if (data.data.status === 'y') {
                                $('#edit_status').addClass('active');
                            } else {
                                $('#edit_status').removeClass('active');
                            }
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

            $(document).on("click", "#list_menu_icon", function() {
                $("#modal-list-menu-icon").modal("show");
            });

            $('#modal-edit-menu').on('hidden.bs.modal', function(e) {
                $('#id_menu').val('');
                $('#edit_menu_name').val('');
                $('#edit_icon').val('');
                $('#edit_type').val('');
                $('#edit_permission').val('');
                $('#edit_parent').val('').trigger('change');
                $('#edit_priority').val('');
                $('#edit_url').val('');
                // remove invalid class
                $('.edit-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            $(document).on("click", "#btn-edit-menu", function() {
                var isValid = true;

                $('.edit-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                    if ($(this).attr('type') == 'number') {
                        var priorityInput = $('#edit_priority'); // Define priorityInput here
                        var priorityValue = parseInt(priorityInput.val()
                            .trim()); // Use trim() directly
                        console.log(priorityValue);
                        if (isNaN(priorityValue) || priorityValue < 0) {
                            isValid = false;
                            priorityInput.addClass('is-invalid');
                            priorityInput.parent().append(
                                '<div class="invalid-feedback">Harus diisi dengan angka tidak negatif</div>'
                            );
                        } else {
                            priorityInput.removeClass('is-invalid');
                            priorityInput.parent().find('.invalid-feedback').remove();
                        }
                    } else {
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


                var id = $('#id_menu').val();
                var name = $('#edit_menu_name').val();
                var permission = $('#edit_permission').val();
                var url = $('#edit_url').val();
                var order_no = $('#edit_priority').val();
                var icon = $('#edit_icon').val();
                var parent_id = $('#edit_parent').val();
                var type = $('#edit_type').val();
                if ($('#edit_status').hasClass('active')) {
                    var status = 'y';
                } else {
                    var status = 'n';
                }

                $.ajax({
                    url: '/menusetting/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        name: name,
                        permission: permission,
                        url: url,
                        order_no: order_no,
                        icon: icon,
                        parent_id: parent_id,
                        type: type,
                        status: status,
                    },
                    beforeSend: function() {
                        $('.btn-edit-menu').attr('disabled', 'disabled');
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
                        $('.btn-edit-menu').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-edit-menu").modal("hide");
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
                        $('.btn-edit-menu').removeAttr('disabled', 'disabled');
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

            @can('menusetting-D')

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
                            url: '/menusetting/' + id,
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
