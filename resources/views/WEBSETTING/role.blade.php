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

        #dt_role_filter {
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
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-user-cog mx-3"></i>Role</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4 font-size-12">Daftar Role</h4>
                            @can('rolesetting-C')
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-sm mx-2 btn-tambah-role float-end mb-2">
                                            <i class="fas fa-plus mx-2"></i> Tambah Role
                                        </button>
                                    </div>
                                </div>
                            @endcan
                            <table id="dt_role" class="table table-bordered table-striped t_per test"
                           style="width: 3030px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-type="text" data-name="name">Role Name</th>
                                        <th data-type="text" data-name="desc">Description</th>
                                        <th class="filterhead">Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td data-type="text" data-name="name"></td>
                                        <td data-type="text" data-name="desc"></td>
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
                <div class="modal fade" id="modal-tambah-role" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Tambah Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Role
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-role" name='name'
                                            value="" id="name" placeholder="e.g: admin">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Description<strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name='description' value=""
                                            id="description" placeholder="e.g: get all privilage ...">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('rolesetting-C')
                                    <button type="button" id="btn-simpan-role" class="btn btn-primary btn-simpan-role"><i
                                            class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Edit -->
                <div class="modal fade" id="modal-edit-role" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Edit Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <input type="hidden" class="edit-role" name="id_role" id="id_role" value="">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Role
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control edit-role" name='edit_name'
                                            value="" id="edit_name" placeholder="e.g: admin">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Description<strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name='edit_description' value=""
                                            id="edit_description" placeholder="e.g: get all privilage ...">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('rolesetting-U')
                                    <button type="button" id="btn-edit-role" class="btn btn-primary btn-edit-role"><i
                                            class="fas fa-save mx-2"></i>Simpan</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Privilege --}}
                @can('rolesetting-U')
                <div class="modal fade" id="modalaccess" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-l modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Edit privilege</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form role="form" class="form" name="formrole" id="updateroles" enctype="multipart/formdata" method="" style="overflow-y: scroll">
                                <div class="modal-body p-4">
                                    <div class="mb-2">
                                        <div class="form-group row">
                                            @php
                                            $lastMenu = "";
                                            $lastMenuC = "";
                                            $ic = 0;
                                            @endphp
                                            @foreach($permissions as $k=> $permission)
                                            <div class='col-lg-12 inline-checkbox'>
                                            <label class='col-form-label'><b>{{strtoupper($permission->name)}}</b></label><br>
                                                @foreach($permission->permissionMenu as $permis)
                                                <label class="checkbox m-2">
                                                    <input type="checkbox" class="ok{{$permis->name}}"
                                                    data-sidebar="{{substr($permis->name, 0, -2)}}"
                                                    value="{{$permis->name}}" name="permission[]">
                                                    <span></span>{{$permis->action->name}}</label>&nbsp;           
                                                @endforeach
                                                @foreach($permission->menuChilds as $k1=> $mc)
                                                    <div class='col-lg-12 inline-checkbox m-4'>
                                                        <label class='col-form-label'><b>- {{strtoupper($mc->name)}}</b></label><br>
                                                    @foreach($mc->permissionMenu as $permis)
                                                        <label class="checkbox m-2">
                                                            <input type="checkbox" class="ok{{$permis->name}}"
                                                                    data-sidebar="{{substr($permis->name, 0, -2)}}"
                                                                    value="{{$permis->name}}" name="permission[]">
                                                            <span></span>{{$permis->action->name}}</label>&nbsp;
                                                    @endforeach
                                                    </div>
                                                    @php
                                                    if($k1+1==count($permission->menuChilds) && $k+1<count($permissions))
                                                    echo "<hr>";
                                                    @endphp
                                                @endforeach
                                                @php
                                                if(count($permission->menuChilds)==0)
                                                    echo "<hr>";
                                                @endphp   
                                            </div>
                                            
                                            @endforeach 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    @can('rolesetting-U')
                                        <button type="submit" id="saveRole1" data-id="" class="btn btn-primary"><i
                                                class="fas fa-save mx-2"></i>Simpan</button>
                                    @endcan
                                </div>
                            </form>
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
            @can('rolesetting-R')

            $('#dt_role').DataTable().clear().destroy();
            var table = $("#dt_role").DataTable({
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
                        }
                    });
                },
                ajax: {
                    url: '/rolesetting/list',
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
                        data: 'name',
                        name: 'name',
                        className: 'text-center'
                    },
                    {
                        width: '600px',
                        data: 'desc',
                        name: 'desc',
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('rolesetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                        "<button type='button' class='btn btn-outline-info btn-sm tooltips access' title='Edit Privilage' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-user-shield'></i></button>  "+
                                    @endcan
                                    @can('rolesetting-D')
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
                dropdownParent: $('#dt_role'),
            });

            @endcan


            @can('rolesetting-C')
            
            $(document).on("click", ".btn-tambah-role", function() {
                $("#modal-tambah-role").modal("show");
                $('#name').val('');
                $('#description').val('');
            });

            $(document).on("click", "#btn-simpan-role", function() {
                var isValid = true;

                $('.input-role').each(function() {
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


                var name = $('#name').val();
                var description = $('#description').val();

                $.ajax({
                    url: '/rolesetting',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        name: name,
                        description: description,
                    },
                    beforeSend: function() {
                        $('.btn-simpan-role').attr('disabled', 'disabled');
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
                        $('.btn-simpan-role').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-tambah-role").modal("hide");
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
                        $('.btn-simpan-role').removeAttr('disabled', 'disabled');
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
            $('#modal-tambah-role').on('hidden.bs.modal', function(e) {
                $('#name').val('');
                $('#description').val('');

                // remove invalid class
                $('.input-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            @endcan

            @can('rolesetting-U')

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/rolesetting/' + id,
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
                            $("#modal-edit-role").modal("show");
                            $('#id_role').val(data.data.id);
                            $('#edit_name').val(data.data.name);
                            $('#edit_description').val(data.data.description);
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

            $('#modal-edit-role').on('hidden.bs.modal', function(e) {
                $('#id_role').val('');
                $('#edit_name').val();
                $('#edit_description').val();
                // remove invalid class
                $('.edit-role').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            $(document).on("click", "#btn-edit-role", function() {
                var isValid = true;

                $('.edit-role').each(function() {
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


                var id = $('#id_role').val();
                var name = $('#edit_name').val();
                var description = $('#edit_description').val();

                $.ajax({
                    url: '/rolesetting/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        name: name,
                        description: description,
                    },
                    beforeSend: function() {
                        $('.btn-edit-role').attr('disabled', 'disabled');
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
                        $('.btn-edit-role').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-edit-role").modal("hide");
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
                        $('.btn-edit-role').removeAttr('disabled', 'disabled');
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

            $('#modalaccess').on('hidden.bs.modal', function(e) {
                $('#id_role_privilage').val('');
                // unchecked all checkbox
                $('input[name="permission[]"]').each(function() {
                    $(this).prop('checked', false);
                });
                // remove invalid class
                $('.edit-privilage').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            $(document).on("click", ".access", function() {
                event.preventDefault();
                var id = $(this).data('id');
                $('#saveRole1').data("id", id);
                $.ajax({
                    url: '/rolesetting/showpermission/' + id,
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
                            $.each(data.data.data, function (index, value) {
                                $(".ok" + value['name']).prop("checked", true);
                            });
                            $("#role_name").val(data.data.test.name);
                            $("#rolesid").val(data.data.test.id);
                            $('#modalaccess').modal('show');
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

            // change checkbox to unchecked or checked
            $(document).on("click", "input[name='permission[]']", function() {
                var isChecked = $(this).is(':checked');
                if (isChecked) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });

            $("#updateroles").submit(function (event) {
                event.preventDefault();
                var arr = $('#updateroles').serializeArray();
                // select if checked
                var arr = arr.filter(function (obj) {
                    return obj.value != 'on';
                });
                let roleID = $("#saveRole1").data("id");
                var newarray = arr.map(obj => {
                    let newObj = {};
                newObj['rolesid'] = roleID;
                newObj['value'] = obj.value;
                newObj['sidebar'] = $(".ok" + obj.value).data('sidebar');
                newObj['status'] = $(".ok" + obj.value).is(':checked') ? 1 : 0;
                return newObj;
            })
                ;
                console.log(newarray);
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: './rolesetting/' + roleID + '/syncrnpermission', // the url where we want to POST
                    data: {'datas': newarray}, // our data object
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: 'json', // what type of data do we expect back from the server
                    beforeSend: function () {
                        $('#saveRole1').attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i> processing");
                    }
                }).done(function (data) {
                    $('.name').text(''); // Label Error name Role
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#updateroles')[0].reset();
                    $("#modalaccess").modal('hide');
                }).fail(function (data) {
                    $.each(data.responseJSON.message, function (index, value) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: value,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.label' + index).removeClass("sr-only");
                        $('.label' + index).text(value);
                    });
                }).always(function () {
                    $('#saveRole1').attr('disabled', false).html("<i class='fa fa-save'></i> Save");
                });
            });




            @endcan

            @can('rolesetting-D')

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
                            url: '/rolesetting/' + id,
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
