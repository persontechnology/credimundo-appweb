<?php

namespace App\DataTables;

use App\Models\Credito;
use App\Models\PlazoFijo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CreditoDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($c){
            return view('creditos.action',['c'=>$c])->render();
        })
        ->editColumn('tipo_credito_id',function($c){
            return $c->tipoCredito->nombre;
        })
        ->editColumn('dia_pago',function($c){
            return Carbon::parse($c->dia_pago)->format('d');
        })
        
        ->editColumn('cuenta_user_id',function($c){
            return $c->cuentaUser->numero_cuenta;
        })
        ->filterColumn('cuenta_user_id', function($query, $keyword) {
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereRaw("numero_cuenta like ?", ["%{$keyword}%"]);
            });
        })
        ->editColumn('apellidos_nombres',function($c){
            return $c->cuentaUser->user->apellidos_nombres;
        })
        ->filterColumn('apellidos_nombres', function($query, $keyword) {
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
                });
            });
        })
        ->editColumn('identificacion',function($c){
            return $c->cuentaUser->user->identificacion;
        })
        ->filterColumn('identificacion', function($query, $keyword) {
            $query->whereHas('cuentaUser', function($query) use ($keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                });
            });
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Credito $model): QueryBuilder
    {
        return $model->newQuery()->latest();
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
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('numero')->title('N° crédito'),
            Column::make('cuenta_user_id')->title('Cuenta usuario'),
            Column::make('identificacion')->title('Identificación'),
            Column::make('apellidos_nombres')->title('Apellidos & Nombres'),
            Column::make('monto')->title('Monto')->searchable(false),
            Column::make('neto_recibir')->title('Neto a Recibir')->searchable(false),
            Column::make('dia_pago')->title('Día de pago')->searchable(false),
            Column::make('tipo_credito_id')->title('Tipo de crédito')->searchable(false),
            Column::make('fecha_vencimiento')->title('Fecha de vencimiento')->searchable(false),
            Column::make('tasa_efectiva_anual')->title('TEA')->searchable(false),
            Column::make('plazo')->title('Plazo')->searchable(false),
            Column::make('pago_mensual')->title('Pago mensual')->searchable(false),
            Column::make('pago_total')->title('Pago total')->searchable(false),
            Column::make('interes_total')->title('Interes total')->searchable(false),
            Column::make('estado')->title('Estado')->searchable(false),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Credito_' . date('YmdHis');
    }
}
