<?php

namespace Database\Seeders;

use App\Models\TipoCuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCuenta::firstOrCreate(
            ['nombre'=>'AHORRO A LA VISTA'],
            [
                'codigo' =>'AHO/VIS', 
                'valor_apertura' =>20, 
                'valor_debito'=>15,
                'estado'=>'ACTIVO',
            ]
        );

        TipoCuenta::firstOrCreate(
            ['nombre' => 'CUENTA INFANTIL'],
            [
                'codigo' =>'CUE/INF', 
                'valor_apertura' =>3, 
                'valor_debito'=>2,
                'estado'=>'ACTIVO'
            ]
        );

        TipoCuenta::firstOrCreate(
            ['nombre' => 'AHORRO PROGRAMADO'],
            [
                'codigo' =>'AHO/PRO', 
                'valor_apertura' =>0, 
                'valor_debito'=>0,
                'estado'=>'ACTIVO'
            ]
        );
    }
}
