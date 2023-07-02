<?php

namespace App\DataTables;

use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransaccionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($t){
            return view('transacciones.action',['t'=>$t])->render();
        })
        
        ->addColumn('identificacion_user',function($t){
            return $t->cuentaUser->user->identificacion;
        })
        ->addColumn('apellidos_nombres_user',function($t){
            return $t->cuentaUser->user->apellidos_nombres;
        })
        ->filterColumn('apellidos_nombres_user',function($query, $keyword){
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
                });            
            });            
        })
        ->filterColumn('identificacion_user',function($query, $keyword){
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                });            
            });            
        })
        ->editColumn('tipo_transaccion_id',function($t){
            return $t->tipoTransaccion->nombre;
        })
        ->editColumn('cuenta_user_id',function($t){
            return $t->cuentaUser->numero_cuenta;
        })
        ->filterColumn('cuenta_user_id', function($query, $keyword) {
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereRaw("numero_cuenta like ?", ["%{$keyword}%"]);
            });
        })
        ->editColumn('created_at',function($t){
            return $t->created_at;
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaccion $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaccion-table')
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
            Column::make('tipo_transaccion_id')->searchable(false)->title('Transacción'),
            Column::make('valor')->searchable(false)->title('Valor'),
            Column::make('valor_disponible')->searchable(false)->title('Disponible'),
            Column::make('cuenta_user_id')->title('N° cuenta'),
            Column::make('identificacion_user')->title('Identificación'),
            Column::make('apellidos_nombres_user')->title('Apellidos & Nombres'),
            Column::make('numero')->title('N° documento'),
            Column::make('created_at')->title('Fecha'),
            Column::make('estado'), 
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaccion_' . date('YmdHis');
    }
}
