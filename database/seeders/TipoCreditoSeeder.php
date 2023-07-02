<?php

namespace Database\Seeders;

use App\Models\TipoCredito;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCreditoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCredito::firstOrCreate(
            ['nombre'=>'MICROCREDITO'],
            [
                'tasa_efectiva_anual'=>'20', //PARA CREDITOS
                'tasa_nominal'=>'16',
                'estado'=>'ACTIVO',
            ]
        );
        TipoCredito::firstOrCreate(
            ['nombre'=>'CONSUMO'],
            [
                'tasa_efectiva_anual'=>'16', //PARA CREDITOS
                'tasa_nominal'=>'15.60',
                'estado'=>'ACTIVO',
            ]
        );
        TipoCredito::firstOrCreate(
            ['nombre'=>'EMERGENTE'],
            [
                'tasa_efectiva_anual'=>'30', //PARA CREDITOS
                'tasa_nominal'=>'28',
                'estado'=>'ACTIVO',
            ]
        );
        TipoCredito::firstOrCreate(
            ['nombre'=>'CERTIFICADO PLAZO FIJO'],
            [
                'tasa_efectiva_anual'=>'6.5', //PARA CREDITOS
                'tasa_nominal'=>'6',
                'estado'=>'ACTIVO',
                'descripcion'=>'APLICA PARA PLAZOS FIJOS'
            ]
        );
    }
}
