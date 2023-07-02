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
        Schema::create('plazo_fijos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('numero')->unique();
            $table->decimal('monto',19,2);
            $table->decimal('solca')->default(0);
            
            $table->decimal('neto_recibir');
            $table->date('dia_pago')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('tasa_efectiva_anual',7,2)->nullable();
            $table->decimal('tasa_nominal',7,2)->nullable();
            $table->integer('numero_cuotas')->nullable();
            $table->string('plazo');
            $table->decimal('pago_mensual',19,2);
            $table->decimal('pago_total',19,2);
            $table->decimal('interes_total',19,2);
            $table->enum('estado',['INGRESADO','APROBADO','REPROBADO','ENTREGADO','PAGADO','PRECANCELADO','VENCIDO']);
            $table->enum('tipo_pago',['Unico','Mensual']);

            
            $table->date('fecha_ingresado')->nullable();
            $table->date('fecha_aprobado')->nullable();
            $table->date('fecha_reprobado')->nullable();
            $table->date('fecha_entregado')->nullable();
            $table->date('fecha_pagado')->nullable();
            $table->date('fecha_precancelado')->nullable();
            $table->date('fecha_vencido')->nullable();

            $table->string('detalle')->nullable();
            $table->string('actividad')->nullable();
            $table->foreignId('tipo_credito_id')->constrained('tipo_creditos');
            $table->foreignId('cuenta_user_id')->constrained('cuenta_users');
            $table->foreignId('credito_id')->nullable()->constrained('creditos');
            $table->bigInteger('creado_x');
            $table->bigInteger('actualizado_x')->nullable();
            $table->unique(['cuenta_user_id','credito_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plazo_fijos');
    }
};
