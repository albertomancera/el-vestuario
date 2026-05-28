<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Solo creamos la columna 'posicion' si NO existe previamente
            if (!Schema::hasColumn('users', 'posicion')) {
                $table->string('posicion')->nullable()->after('email');
            }
            
            // Solo creamos la columna 'foto' si NO existe previamente
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['posicion', 'foto']);
        });
    }
};