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
        Schema::create('tipo_transaccions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->enum('tipo',['SUMAR','RESTAR']);
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->string('descripcion')->nullable();
            $table->bigInteger('creado_x')->nullable();
            $table->bigInteger('actualizado_x')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_transaccions');
    }
};
