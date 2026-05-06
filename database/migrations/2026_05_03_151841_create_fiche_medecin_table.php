<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiche_medecin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiche_id')->constrained('fiches')->cascadeOnDelete();
            // Le médecin avec qui on partage la fiche
            $table->foreignId('medecin_id')->constrained('medecins')->cascadeOnDelete();
            $table->timestamps();
            
            // On ne peut pas partager la même fiche deux fois au même médecin
            $table->unique(['fiche_id', 'medecin_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiche_medecin');
    }
};
