<?php

namespace App\DataTables;

use App\Models\Caja;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CajaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($caja){
                return view('caja.action',['caja'=>$caja])->render();
            })
            ->editColumn('estado',function($caja){
                if($caja->estado){
                    return '<strong class="bg-success">'.$caja->estado.'</strong>';
                }else{
                    return $caja->estado;
                }
            })
            ->rawColumns(['action','estado'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Caja $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('credito-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('estado'),
            Column::make('fecha'),
            Column::make('valor_apertura'),
            Column::make('valor_cierre'),
            Column::make('total'),
            Column::make('detalle_apertura'),
            Column::make('detalle_cierre'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Caja_' . date('YmdHis');
    }
}
