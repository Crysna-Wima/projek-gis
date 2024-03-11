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

        #dt_permission_filter {
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
                                <h4 class="font-size-15 text-white col-6 m-1"><i class="fas fa-user-shield mx-3"></i>Permission</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4 font-size-12">Daftar Permission</h4>
                            @can('permission-C')
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-sm mx-2 btn-tambah-permission float-end mb-2">
                                            <i class="fas fa-plus mx-2"></i> Tambah Permission
                                        </button>
                                    </div>
                                </div>
                            @endcan
                            <table id="dt_permission" class="table table-bordered table-striped t_per test"
                           style="width: 3030px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-type="select" data-name="permission_name">Permission Name</th>
                                        <th data-name="guard_name">Guard Name</th>
                                        <th data-type="select" data-name="action_id">Action ID</th>
                                        <th class="filterhead">Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td data-type="select" data-name="permission_name"></td>
                                        <th data-name="guard_name"></td>
                                        <th data-type="select" data-name="action_id"></td>
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
                <div class="modal fade" id="modal-tambah-permission" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title-modal">Tambah Permission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-4">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Menu
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_menu_tambah" name="menu" id="menu">
                                            <option value="0">--Pilih Menu--</option>
                                            @foreach ($menu as $mn)
                                                <option value="{{ $mn["id"] }}">
                                                    {{ $mn['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Guard Name<strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name='guard_name' value=""
                                            id="guard_name" placeholder="web" value="web" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Permission
                                        <strong><code>*</code></strong></label>
                                    <div class="col-sm-8">
                                        <label class="checkbox mx-3 align-middle">
                                            <input type="checkbox" value="C" checked name="action[]">
                                            <span></span>Create
                                        </label>
                                        <label class="checkbox mx-3 align-middle">
                                            <input type="checkbox" value="R" checked name="action[]">
                                            <span></span>Read
                                        </label>
                                        <label class="checkbox mx-3 align-middle">
                                            <input type="checkbox" value="U" checked name="action[]">
                                            <span></span>Update
                                        </label>
                                        <label class="checkbox mx-3 align-middle">
                                            <input type="checkbox" value="D" checked name="action[]">
                                            <span></span>Delete
                                        </label>
                                        <label class="checkbox mx-3 align-middle">
                                            <input type="checkbox" value="A" checked name="action[]">
                                            <span></span>Approve
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @can('permission-C')
                                    <button type="button" id="btn-simpan-permission" class="btn btn-primary btn-simpan-permission"><i
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

            @can('permission-R')
            $('#dt_permission').DataTable().clear().destroy();
            var table = $("#dt_permission").DataTable({
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

                    $('#dt_permission').DataTable().columns.adjust()
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

                            if (iName == 'action_id') {
                                options += '<option value="">Semua</option>';
                                options += '<option value="C">C</option>';
                                options += '<option value="R">R</option>';
                                options += '<option value="U">U</option>';
                                options += '<option value="D">D</option>';
                                options += '<option value="A">A</option>';
                            } 
                            
                            if (iName == 'permission_name') {
                                options += '<option value="">Semua</option>';
                                @foreach ($menu as $mn)
                                    options += '<option value="{{ $mn["id"] }}">{{ $mn['name'] }}</option>';
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
                    url: '/permissionsetting/list',
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
                        width: '300px',
                        data: 'name',
                        name: 'name',
                    },
                    {
                        width: '300px',
                        data: 'guard_name',
                        name: 'guard_name',
                        className: 'text-center',
                    },
                    {
                        width: '200px',
                        data: 'action_id',
                        name: 'action_id',
                        className: 'text-center',
                    },
                    {
                        width: '150px',
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
                        template: function (row) {  
                                return "<center>"+
                                    @can('permission-D')
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
                dropdownParent: $('#dt_permission'),
            });

            @endcan


            @can('permission-C')

            $('.select2_menu_tambah').select2({
                width: '100%',
                dropdownParent: $('#modal-tambah-permission'),
            });
            
            $(document).on("click", ".btn-tambah-permission", function() {
                $("#modal-tambah-permission").modal("show");
                $('#menu').val('').trigger('change');
                $('#guard_name').val('web');
                $('input[name="action[]"]').prop('checked', false);
            });

            $(document).on("click", "#btn-simpan-permission", function() {
                var isValid = true;

                $('.input-permission').each(function() {
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


                var form = new FormData();
                var menu = $('#menu').val();
                var action = [];
                $('input[name="action[]"]:checked').each(function() {
                    action.push(this.value);
                });
                form.append('menu', menu);
                form.append('action', action);

                $.ajax({
                    url: '/permissionsetting',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: form,  // Remove 'processData' and 'contentType' options
                    contentType: false,  // Set contentType to false
                    processData: false,  // Set processData to false
                    beforeSend: function() {
                        $('.btn-simpan-permission').attr('disabled', 'disabled');
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
                        $('.btn-simpan-permission').removeAttr('disabled', 'disabled');
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#modal-tambah-permission").modal("hide");
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
                        $('.btn-simpan-permission').removeAttr('disabled', 'disabled');
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
            $('#modal-tambah-permission').on('hidden.bs.modal', function(e) {
                $('#menu').val('').trigger('change');
                $('input[name="action[]"]').prop('checked', false);
                $('#guard_name').val('web');
                // remove invalid class
                $('.input-menu').each(function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().find('.invalid-feedback').remove();
                });
            });

            @endcan

            @can('permission-D')

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
                            url: '/permissionsetting/destroy/' + id,
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
