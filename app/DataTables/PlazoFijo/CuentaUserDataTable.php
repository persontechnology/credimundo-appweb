<?php

namespace App\DataTables\PlazoFijo;

use App\Models\CuentaUser;
use App\Models\TipoCuenta;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CuentaUserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($cu){
            return view('creditos.cuentauser-action',['cu'=>$cu])->render();
        })
        ->addColumn('valor_disponible', function($cu){
            return $cu->valor_disponible;
        })
        ->addColumn('user_identificacion', function($cu){
            return $cu->user->identificacion;
        })
        ->editColumn('tipo_cuenta_id',function($cu){
            return $cu->tipoCuenta->nombre;
        })
        ->editColumn('user_id',function($cu){
            return $cu->user->apellidos_nombres;
        })
        ->filterColumn('user_id',function($query, $keyword){
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
            });            
        })  
        ->filterColumn('user_identificacion', function($query, $keyword) {
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
            });
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CuentaUser $model): QueryBuilder
    {
        $tipoCuenta=TipoCuenta::where('codigo','AHO/PRO')->first();
        return $model->newQuery()->where('estado','ACTIVO')->where('tipo_cuenta_id',$tipoCuenta->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
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
                  ->searchable(false)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('user_identificacion')->title('Identificación'),
            Column::make('numero_cuenta')->title('# Cuenta'),      
            Column::make('user_id')->title('Apellidos & Nombres'),
            Column::make('tipo_cuenta_id')->title('Tipo'),
            Column::computed('valor_disponible'),
            Column::make('estado'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
