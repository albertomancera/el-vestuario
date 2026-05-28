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
        Schema::table('partidos', function (Blueprint $table) {
            $table->integer('goles_equipo')->nullable(); // Nuestros goles
            $table->integer('goles_rival')->nullable();  // Goles del contrincante
            $table->boolean('cronica_cerrada')->default(false); // Indica si el partido ya terminó
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partidos', function (Blueprint $table) {
            $table->dropColumn(['goles_equipo', 'goles_rival', 'cronica_cerrada']);
        });
    }
};