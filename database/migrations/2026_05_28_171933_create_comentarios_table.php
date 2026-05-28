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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            // Vinculamos con el partido. Si el partido se borra, sus comentarios también (cascade)
            $table->foreignId('partido_id')->constrained()->onDelete('cascade');
            // Vinculamos con el usuario que escribe
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // El texto del mensaje
            $table->text('mensaje');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};