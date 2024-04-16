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

    .vertical-center {
        vertical-align: middle !important;
    }
    
    .horizontal-center {
        text-align: center !important;
    }

    .font-weight-bold {
        font-weight: bold !important;
        color: #009E3C !important;
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

    #dt_user_filter {
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
                            <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-user-friends mx-3"></i>User Management</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mb-4 font-size-12">Data User</h4>
                        @can('usersetting-C')
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary btn-sm mx-2 btn-tambah-user float-end mb-2">
                                        <i class="fas fa-plus mx-2"></i> Tambah User
                                    </button>
                                </div>
                            </div>
                        @endcan
                        <table id="dt_user" class="table table-bordered table-striped t_per test"
                       style="width: 3030px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="filterhead">Action</th>
                                    <th class="filterhead">Foto</th>
                                    <th data-type="text" data-name="username">Username</th>
                                    <th data-type="text" data-name="first_name">First Name</th>
                                    <th data-type="text" data-name="last_name">Last Name</th>
                                    <th data-type="text" data-name="email">Email</th>
                                    <th data-type="select" data-name="status">Status</th>
                                    <th data-type="select" data-name="roles">Roles</th>
                                    <th class="filterhead">Action</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="filterhead"></td>
                                    <td class="filterhead"></td>
                                    <td data-type="text" data-name="username"></td>
                                    <td data-type="text" data-name="first_name"></td>
                                    <td data-type="text" data-name="last_name"></td>
                                    <td data-type="text" data-name="email"></td>
                                    <td data-type="select" data-name="status"></td>
                                    <td data-type="select" data-name="roles"></td>
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
            <div class="modal fade" id="modal-tambah-user" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-modal">Tambah User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Username
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-user" name='username'
                                        value="" id="username" placeholder="e.g: crysna">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Firstname<strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-user" name='firstname' value=""
                                        id="firstname" placeholder="e.g: crysna">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Lastname
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-user" name='lastname' value=""
                                        id="lastname" placeholder="e.g: wima">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Email Address
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-user" name='email' value=""
                                        id="email" placeholder="e.g: example@gmail.com">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Roles
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control select2_roles_tambah" name="roles" id="roles">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Foto</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control input-user" name='foto' value=""
                                        id="foto" placeholder="e.g: upload foto">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @can('usersetting-C')
                                <button type="button" id="btn-simpan-user" class="btn btn-primary btn-simpan-user"><i
                                        class="fas fa-save mx-2"></i>Simpan</button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="modal-edit-user" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-modal">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <input type="hidden" class="edit-user" name="id_user" id="id_user" value="">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Username
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control edit-user" name='edit_username'
                                        value="" id="edit_username" placeholder="e.g: crysna">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Firstname<strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control edit-user" name='edit_firstname' value=""
                                        id="edit_firstname" placeholder="e.g: crysna">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Lastname
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control edit-user" name='edit_lastname' value=""
                                        id="edit_lastname" placeholder="e.g: wima">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Email Address
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control edit-user" name='edit_email' value=""
                                        id="edit_email" placeholder="e.g: example@gamil.com">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Roles
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <select class="form-control edit-user" name="edit_roles" id="edit_roles">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Foto</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control edit-user" name='edit_foto' value=""
                                        id="edit_foto" placeholder="e.g: upload foto">
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
                            @can('usersetting-U')
                                <button type="button" id="btn-edit-user" class="btn btn-primary btn-edit-user"><i
                                        class="fas fa-save mx-2"></i>Simpan</button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal reset password --}}
            <div class="modal fade" id="modal-reset-password" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title-modal">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <input type="hidden" class="reset-password" name="id_user_reset_password" id="id_user_reset_password" value="">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Password
                                    <strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control reset-password" name='password'
                                        value="" id="password" placeholder="e.g: password">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Confirm Password<strong><code>*</code></strong></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control reset-password" name='confirm_password' value=""
                                        id="confirm_password" placeholder="e.g: confirm-password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @can('usersetting-U')
                                <button type="button" id="btn-reset-password" class="btn btn-primary btn-edit-user"><i
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

            @can('usersetting-R')

            $('#dt_user').DataTable().clear().destroy();
            var table = $("#dt_user").DataTable({
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

                    $('#dt_user').DataTable().columns.adjust()
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

                            if (iName == 'roles') {
                                options += '<option value="">Semua</option>';
                                @foreach ($roles as $role)
                                    options += '<option value="{{ $role->name }}">{{ $role->name }}</option>';
                                @endforeach
                            }else if (iName == 'status') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="y">Active</option>';
                                options += '<option value="n">Inactive</option>';
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
                    url: '/usersetting/list',
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
                        "className": 'text-center vertical-center horizontal-center'
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center vertical-center horizontal-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('usersetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                    @endcan
                                    @can('usersetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                    {
                        width: '100px',
                        data: 'foto',
                        name: 'foto',
                        searchable: false,
                        template: function (row) {  
                                return "<center><img src='/storage/"+row.foto+"' class='rounded-circle' width='50px' height='50px'></center>";
                        },
                        className: 'text-center vertical-center horizontal-center'
                    },
                    {
                        width: '200px',
                        data: 'username',
                        name: 'username',
                        className: 'text-center vertical-center font-weight-bold'
                    },
                    {
                        width: '200px',
                        data: 'firstname',
                        name: 'firstname',
                        className: 'vertical-center'
                    },
                    {
                        width: '200px',
                        data: 'lastname',
                        name: 'lastname',
                        className: 'vertical-center'
                    },
                    {
                        width: '200px',
                        data: 'email',
                        name: 'email',
                        className: 'vertical-center'
                    },
                    {
                        width: '100px',
                        data: 'status',
                        name: 'status',
                        className: 'text-center vertical-center horizontal-center',
                        render: function(data) {
                            if (data === 'y') {
                                return '<h5><span class="badge bg-success">Active</span></h5>';
                            } else {
                                return '<h5><span class="badge bg-danger">Inactive</span></h5>';
                            }
                        },
                    },
                    {
                        width: '100px',
                        data: 'roles',
                        name: 'roles',
                        className: 'text-center vertical-center horizontal-center'
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center vertical-center horizontal-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('usersetting-U')
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-edit' title='Edit' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-pen'></i></button>  "+
                                        "<button type='button' class='btn btn-outline-warning btn-sm tooltips btn-reset-password' title='Reset Password' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-key'></i></button>  "+
                                    @endcan
                                    @can('usersetting-D')
                                        "<button type='button' class='btn btn-outline-danger btn-sm tooltips btn-delete' title='Delete' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-trash-alt'></i></button> "+
                                    @endcan
                                    @can('usersetting-A')
                                        "<button type='button' class='btn btn-outline-info btn-sm tooltips btn-impersonate' title='Impersonate' data-bs-toggle='tooltip' data-bs-placement='top' data-id="+row.id+"><i class='fas fa-user-secret'></i></button> "+
                                    @endcan
                                    "</center>";
                        },
                    },
                ],
                rowGroup: {
                    dataSrc: 'roles'
                }
            })
            $('.dt-buttons').addClass('mb-2');

            $('.select2_search').select2({
                width: '100%',
                dropdownParent: $('#dt_user'),
            });

            @endcan


            @can('usersetting-C')

            $('.select2_roles_tambah').select2({
                width: '100%',
                dropdownParent: $('#modal-tambah-user'),
            });
            
            $(document).on("click", ".btn-tambah-user", function() {
                $("#modal-tambah-user").modal("show");
                $('#username').val('');
                $('#firstname').val('');
                $('#lastname').val('');
                $('#email').val('');
                $('#roles').val('1').trigger('change');
                $('#foto').val('');
            });

            $(document).on("click", "#btn-simpan-user", function() {
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

                var formData = new FormData();
                formData.append('username', $('#username').val());
                formData.append('firstname', $('#firstname').val());
                formData.append('lastname', $('#lastname').val());
                formData.append('email', $('#email').val());
                formData.append('roles', $('#roles').val());
                formData.append('foto', $('#foto')[0].files[0]);

                $.ajax({
                    url: '/usersetting',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.btn-simpan-user').attr('disabled', 'disabled');
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
                        $('.btn-simpan-user').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-tambah-user").modal("hide");
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
                        $('.btn-simpan-user').removeAttr('disabled', 'disabled');
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
            $('#modal-tambah-user').on('hidden.bs.modal', function(e) {
                $('#username').val('');
                $('#firstname').val('');
                $('#lastname').val('');
                $('#email').val('');
                $('#roles').val('1').trigger('change');
                $('#foto').val('');
                // remove invalid class
                $('.input-user').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            @endcan

            @can('usersetting-U')

            $('.select2_roles_edit').select2({
                width: '100%',
                dropdownParent: $('#modal-edit-roles'),
            });

            $(document).on("click", ".btn-edit", function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/usersetting/' + id,
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
                            $("#modal-edit-user").modal("show");
                            $('#id_user').val(data.data.id);
                            $('#edit_username').val(data.data.username);
                            $('#edit_firstname').val(data.data.first_name);
                            $('#edit_lastname').val(data.data.last_name);
                            $('#edit_email').val(data.data.email);
                            $('#edit_roles').val(data.data.roles).trigger('change');
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

            $('#modal-edit-user').on('hidden.bs.modal', function(e) {
                $('#id_user').val('');
                $('#edit_username').val('');
                $('#edit_firstname').val('');
                $('#edit_lastname').val('');
                $('#edit_email').val('');
                $('#edit_roles').val('1').trigger('change');
                $('#edit_foto').val('');
                // remove invalid class
                $('.edit-user').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            $(document).on("click", "#btn-edit-user", function() {
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

                var id = $('#id_user').val();
                if ($('#edit_status').hasClass('active')) {
                    var status = 'y';
                } else {
                    var status = 'n';
                }
                var formData = new FormData();
                formData.append('username', $('#edit_username').val());
                formData.append('firstname', $('#edit_firstname').val());
                formData.append('lastname', $('#edit_lastname').val());
                formData.append('email', $('#edit_email').val());
                formData.append('roles', $('#edit_roles').val());
                formData.append('foto', $('#edit_foto')[0].files[0]);
                formData.append('status', status);

                $.ajax({
                    url: '/usersetting/' + id,
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.btn-edit-user').attr('disabled', 'disabled');
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
                        $('.btn-edit-user').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-edit-user").modal("hide");
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
                        $('.btn-edit-user').removeAttr('disabled', 'disabled');
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


            $(document).on("click", ".btn-reset-password", function() {
                $('#password').val('');
                $('#confirm_password').val('');
                $("#modal-reset-password").modal("show");
                $('#id_user_reset_password').val($(this).data('id'));
            });

            $(document).on("click", '#btn-reset-password', function() {
                var isValid = true;

                $('.reset-password').each(function() {
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

                if (!isValid){
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Mohon Lengkapi Data',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();
                if (password != confirm_password){
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Password tidak sama',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                var id = $('#id_user_reset_password').val();
                var formData = new FormData();
                formData.append('password', $('#password').val());
                formData.append('confirm_password', $('#confirm_password').val());

                $.ajax({
                    url: '/usersetting/resetpassword/' + id,
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.btn-reset-password').attr('disabled', 'disabled');
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
                        $('.btn-reset-password').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-reset-password").modal("hide");
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
                        $('.btn-reset-password').removeAttr('disabled', 'disabled');
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

            @can('usersetting-U')
                $(document).on('click','.btn-impersonate', function() {
                    $.ajax({
                        type: 'GET',
                        url: '/usersetting/simulate/'+$(this).data('id'),
                    }).done(function (res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.replace('<?= URL::to('/login');?>');
                        }
                    })
                })
            @endcan

            @can('usersetting-D')

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
                            url: '/usersetting/destroy/' + id,
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