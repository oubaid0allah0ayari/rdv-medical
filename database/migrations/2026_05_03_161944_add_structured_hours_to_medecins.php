<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropColumn('horaires_disponibles');
            $table->time('heure_debut')->default('08:00');
            $table->time('heure_fin')->default('18:00');
        });
    }

    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->string('horaires_disponibles')->nullable();
            $table->dropColumn(['heure_debut', 'heure_fin']);
        });
    }
};
