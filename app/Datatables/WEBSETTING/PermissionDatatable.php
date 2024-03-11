<?php

namespace App\DataTables\WEBSETTING;

use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
{

    public function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('DT_RowIndex', function ($data) {
                return '';
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('guard_name', function ($data) {
                return "<h5><span class='badge bg-success'>".$data->guard_name."</span></h5>";
            })
            ->addColumn('action_id', function ($data) {
                return $data->action_id;
            })
            ->addColumn('action', function ($data){
                $delete = "<button type='button' class='btn btn-outline-danger btn-sm btn-delete m-1' title='Delete' data-toggle='tooltip' data-id='" . $data->id . "'><i class='fas fa-trash-alt'></i></button>";
                $action = '';
                if (Gate::check('permission-D')) {
                    $action .= $delete;
                }
                return $action;
            })
            ->rawColumns(['name', 'guard_name', 'action_id', 'action']);
        }
    
    
    
    

    public function html()
    {
        return $this->builder()
            ->addTableClass('table table-bordered align-middle dt-responsive  nowrap w-100')
            ->setTableId('dt_menu')
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
            Column::make('name')->title('Permission Name'),
            Column::make('guard_name')->title('Guard Name'),
            Column::make('action_id')->title('Action ID'),
            Column::computed('action')->title('Action')->orderable(false)->searchable(false)->exportable(false),
        ];
    }
}
