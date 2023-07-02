<?php

namespace Database\Seeders;

use App\Models\TipoTransaccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'DEPOSITO EN EFECTIVO'],
            [
                'codigo'=>'DEP/EFE',
                'tipo'=>'SUMAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'RETIRO EN EFECTIVO'],
            [
                'codigo'=>'RET/EFE',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );

        TipoTransaccion::firstOrCreate(
            ['nombre'=>'DEPOSITO EN CHEQUE'],
            [
                'codigo'=>'DEP/CHEQ',
                'tipo'=>'SUMAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'RETIRO EN CHEQUE'],
            [
                'codigo'=>'RET/CHEQ',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );

        TipoTransaccion::firstOrCreate(
            ['nombre'=>'DEPOSITO CERTIFICADO PLAZO FIJO'],
            [
                'codigo'=>'DEP/CPF',
                'tipo'=>'SUMAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'RETIRO CERTIFICADO PLAZO FIJO'],
            [
                'codigo'=>'RET/CPF',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );

        TipoTransaccion::firstOrCreate(
            ['nombre'=>'ABONO DE CREDITO OTORGADO'],
            [
                'codigo'=>'ABON/CREO',
                'tipo'=>'SUMAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'PAGO DE CREDITO'],
            [
                'codigo'=>'PAG/CRE',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'COMISION POR TRANSFERENCIA A OTRAS INSTITUCIONES'],
            [
                'codigo'=>'COM/TOI',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );
        TipoTransaccion::firstOrCreate(
            ['nombre'=>'APERTURA DE CUENTA'],
            [
                'codigo'=>'APE/CUE',
                'tipo'=>'RESTAR',
                'estado'=>'ACTIVO',
            ]
        );

        
    }
}
