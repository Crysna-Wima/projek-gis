<?php

namespace App\DataTables\WEBSETTING;

use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('DT_RowIndex', function ($data) {
                return '';
            })
            ->addColumn('foto', function ($data) {
                $defaultImage = '/assets/images/users/avatar-1.jpg';
                $imageSrc = $data->foto ? '/assets/images/user/' . $data->foto : $defaultImage;
            
                return '<img src="' . $imageSrc . '" class="img-fluid rounded-circle" width="50px">';
            })
            ->addColumn('username', function ($data) {
                return $data->username;
            })
            ->addColumn('firstname', function ($data) {
                return $data->first_name;
            })
            ->addColumn('lastname', function ($data) {
                return $data->last_name;
            })
            ->addColumn('email', function ($data) {
                return '<a href="mailto:'.$data->email.'">'.$data->email.'</a>';
            })
            ->addColumn('roles', function ($data) {
                return $data->getRoleNames()[0];
            })

            ->addColumn('action', function ($data){
                $edit = "<button type='button' class='btn btn-outline-warning btn-sm btn-edit m-1' title='Edit' data-toggle='tooltip' data-id='".$data->id."'><i class='fas fa-pen'></i></button>";
                $delete = "<button type='button' class='btn btn-outline-danger btn-sm btn-delete m-1' title='Delete' data-toggle='tooltip' data-id='".$data->id."'><i class='fas fa-trash-alt'></i></button>";
                $resetPassword = "<button type='button' class='btn btn-outline-info btn-sm btn-reset-password m-1' title='Reset Password' data-toggle='tooltip' data-id='".$data->id."'><i class='fas fa-key'></i></button>";
                $impersonate = "<button type='button' class='btn btn-outline-success btn-sm btn-impersonate m-1' title='Impersonate' data-toggle='tooltip' data-id='".$data->id."'><i class='fas fa-user-secret'></i></button>";
                $action = '';
                if (Gate::check('usersetting-U')) {
                    $action .= $edit;
                    $action .= $resetPassword;
                    $action .= $impersonate;
                }

                if (Gate::check('usersetting-D')) {
                    $action .= $delete;
                }

                return $action;
            })
            ->rawColumns(['foto', 'username', 'firstname', 'lastname', 'email', 'roles', 'action']);
    }
    
    
    
    

    public function html()
    {
        return $this->builder()
            ->addTableClass('table table-bordered align-middle dt-responsive  nowrap w-100')
            ->setTableId('dt_user')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->lengthMenu([
                [ 10, 25, 50, 100 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows' ]
            ])
            ->buttons([
                'pageLength',
                [
                    'text' => '<span class="icon-copy mr-1"></span> COPY',
                    'className' => 'btn btn-secondary buttons-copy buttons-html5'
                ],
                [
                    'extend' => 'excel',
                    'text' => '<span class="icon-file-excel mr-1"></span> EXCEL',
                    'className' => 'btn btn-secondary buttons-copy buttons-html5'
                ],
                [
                    'extend' => 'pdf',
                    'text' => '<span class="icon-file-pdf mr-1"></span> PDF',
                    'className' => 'btn-sm btn btn-primary btn btn-secondary buttons-copy buttons-html5'
                ],
                [
                    'text' => '<span class="icon-printer mr-1"></span> PRINT',
                    'className' => 'btn btn-secondary buttons-copy buttons-html5'
                ],
                [
                    'text' => '<span class="icon-sync mr-1"></span> RELOAD',
                    'className' => 'btn btn-secondary buttons-copy buttons-html5 btn-warning',
                    'action' => 'function(e, dt, node, config) {
                        table.ajax.reload();
                        table.columns.adjust().draw();
                    }'
                ]
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false)->exportable(false),
            Column::computed('foto')->title('Foto')->orderable(false)->searchable(false)->exportable(false),
            Column::computed('username')->title('Username'),
            Column::computed('firstname')->title('First Name'),
            Column::computed('lastname')->title('Last Name'),
            Column::computed('email')->title('Email'),
            Column::computed('roles')->title('Role'),
            Column::computed('action')->title('Action')->orderable(false)->searchable(false)->exportable(false),
        ];
    }
}
