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
        Schema::create('cuenta_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('numero')->unique();
            $table->string('numero_cuenta')->unique();
            $table->decimal('valor_apertura',19,2);
            $table->decimal('valor_debito',19,2);
            $table->decimal('valor_disponible',19,2);
            $table->enum('estado',['CREADO','ACTIVO','INACTIVO']);
            $table->string('descripcion')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('tipo_cuenta_id')->constrained('tipo_cuentas');
            $table->unique(['user_id','tipo_cuenta_id']);
            

            $table->bigInteger('creado_x');
            $table->bigInteger('actualizado_x')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_users');
    }
};
