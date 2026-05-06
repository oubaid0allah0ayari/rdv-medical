<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            // L'auteur de la fiche
            $table->foreignId('medecin_id')->constrained()->cascadeOnDelete();
            
            $table->string('titre');
            $table->longText('contenu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
