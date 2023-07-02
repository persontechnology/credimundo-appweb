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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('numero');
            $table->decimal('valor',19,2);
            $table->decimal('valor_disponible',19,2)->default(0);
            $table->enum('estado',['OK','ANULADO']);
            $table->string('descripcion_estado')->nullable();
            $table->string('detalle')->nullable();
            $table->foreignId('cuenta_user_id')->constrained('cuenta_users');
            $table->foreignId('tipo_transaccion_id')->constrained('tipo_transaccions');
            $table->string('identificacion_otra_persona')->nullable();
            $table->string('nombre_otra_persona')->nullable();
            $table->string('quien_realiza_transaccion');
            $table->string('numero_libreta');
            $table->bigInteger('creado_x');
            $table->bigInteger('actualizado_x')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
