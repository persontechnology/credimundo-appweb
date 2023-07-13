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
        Schema::create('tipo_creditos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('nombre')->unique();
            $table->decimal('tasa_efectiva_anual',7,2)->unique();
            $table->decimal('tasa_nominal',7,2);
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->enum('tipo',['CREDITO','PLAZO FIJO']);
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
        Schema::dropIfExists('tipo_creditos');
    }
};
