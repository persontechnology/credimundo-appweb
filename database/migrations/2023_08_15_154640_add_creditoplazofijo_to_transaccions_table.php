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
        Schema::table('transaccions', function (Blueprint $table) {
            $table->foreignId('tabla_credito_id')->nullable()->constrained('tabla_creditos');
            $table->foreignId('tabla_plazo_fijo_id')->nullable()->constrained('tabla_plazo_fijos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaccions', function (Blueprint $table) {
            $table->dropColumn(['tabla_credito_id', 'tabla_plazo_fijo_id']);
        });
    }
};
