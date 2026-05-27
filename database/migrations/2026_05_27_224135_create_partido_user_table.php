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
        Schema::create('partido_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('asistencia', ['voy', 'no_voy', 'tal_vez'])->nullable();
            $table->boolean('pagado')->default(false);
            $table->integer('goles')->default(0);
            $table->integer('asistencias')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partido_user');
    }
};