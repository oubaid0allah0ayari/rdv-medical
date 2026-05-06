<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Supprimer l'ancien système complexe
        Schema::dropIfExists('fiche_medecin');
        Schema::dropIfExists('fiches');

        // 2. Ajouter les infos de santé directes au Patient
        Schema::table('patients', function (Blueprint $table) {
            $table->decimal('poids', 5, 2)->nullable()->after('dossier_medical'); // Ex: 75.50
            $table->integer('taille')->nullable()->after('poids'); // Ex: 180 (en cm)
            $table->text('maladies_chroniques')->nullable()->after('taille');
            $table->text('allergies')->nullable()->after('maladies_chroniques');
        });

        // 3. Créer la table des Remarques (le journal du dossier)
        Schema::create('remarques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medecin_id')->constrained()->cascadeOnDelete();
            $table->text('contenu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remarques');
        
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['poids', 'taille', 'maladies_chroniques', 'allergies']);
        });
    }
};
