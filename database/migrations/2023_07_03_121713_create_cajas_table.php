<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('valor_apertura',19,2);
            $table->decimal('valor_cierre',19,2)->nullable();
            $table->decimal('total',19,2);
            $table->string('detalle_apertura')->nullable();
            $table->string('detalle_cierre')->nullable();
            $table->enum('estado',['APERTURADO','CERRADO']);
            $table->date('fecha');
            // $table->foreignId('transaccion_id')->nullable()->constrained('transaccions');
            // $table->enum('tipo',['SUMAR','RESTAR']);
            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
