<?php

namespace App\DataTables\MasterData;

use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CurahHujanDatatable extends DataTable
{
    public function dataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('DT_RowIndex', function ($data) {
                return '';
            })
            ->addColumn('kota', function ($data) {
                return $data->kota->name;
            })
            ->addColumn('tahun', function ($data) {
                return $data->tahun;
            })
            ->addColumn('bulan', function ($data) {
                if ($data->bulan == "1") {
                    return "Januari";
                } else if ($data->bulan == "2") {
                    return "Februari";
                } else if ($data->bulan == "3") {
                    return "Maret";
                } else if ($data->bulan == "4") {
                    return "April";
                } else if ($data->bulan == "5") {
                    return "Mei";
                } else if ($data->bulan == "6") {
                    return "Juni";
                } else if ($data->bulan == "7") {
                    return "Juli";
                } else if ($data->bulan == "8") {
                    return "Agustus";
                } else if ($data->bulan == "9") {
                    return "September";
                } else if ($data->bulan == "10") {
                    return "Oktober";
                } else if ($data->bulan == "11") {
                    return "November";
                } else if ($data->bulan == "12") {
                    return "Desember";
                }
            })
            ->addColumn('curah_hujan', function ($data) {
                return $data->curah_hujan . ' mm';
            })
            ->addColumn('action', function ($data) {
                $edit = "<button type='button' class='btn btn-outline-warning btn-sm btn-edit m-1' title='Edit' data-toggle='tooltip' data-id='" . $data->id . "'><i class='fas fa-pen'></i></button>";
                $delete = "<button type='button' class='btn btn-outline-danger btn-sm btn-delete m-1' title='Delete' data-toggle='tooltip' data-id='" . $data->id . "'><i class='fas fa-trash-alt'></i></button>";
                $action = '';
            
                if (Gate::check('curahhujan-U')) {
                    $action .= $edit;
                }
            
                if (Gate::check('curahhujan-D')) {
                    $action .= $delete;
                }
            
                return $action;
            })
            ->rawColumns(['kota', 'tahun', 'bulan', 'curah_hujan', 'action']);
    }
    
    
    
    

    public function html()
    {
        return $this->builder()
            ->addTableClass('table table-bordered align-middle dt-responsive  nowrap w-100')
            ->setTableId('dt_curah_hujan')
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
            Column::make('kota')->title('Kota'),
            Column::make('tahun')->title('Tahun'),
            Column::make('bulan')->title('Bulan'),
            Column::make('curah_hujan')->title('Curah Hujan'),
            Column::computed('action')->title('Action')->orderable(false)->searchable(false)->exportable(false),
        ];
    }
}
