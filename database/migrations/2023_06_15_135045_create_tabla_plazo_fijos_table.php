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
        Schema::create('tabla_plazo_fijos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero_pago');
            $table->date('fecha_pago');
            $table->decimal('pago_mensual',19,2);
            $table->decimal('interes',19,2);
            $table->decimal('total_de_pago',19,2);
            $table->decimal('saldo_capital',19,2);
            $table->decimal('total',19,2);
            $table->enum('estado',['PENDIENTE','PAGADO','ATRASADO','PRECANCELADO']);
            $table->foreignId('plazo_fijo_id')->constrained('plazo_fijos');
            $table->bigInteger('creado_x');
            $table->bigInteger('actualizado_x')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_plazo_fijos');
    }
};
