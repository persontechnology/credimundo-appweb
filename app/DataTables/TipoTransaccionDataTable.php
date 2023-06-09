<?php

namespace App\DataTables;

use App\Models\TipoTransaccion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TipoTransaccionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($tt){
                return view('tipo-transacciones.action',['tt'=>$tt])->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TipoTransaccion $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('tipotransaccion-table')
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
            Column::make('codigo')->title('Código'),
            Column::make('nombre'),
            Column::make('tipo'),
            Column::make('estado'),
            Column::make('descripcion')->title('Descripción'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TipoTransaccion_' . date('YmdHis');
    }
}
