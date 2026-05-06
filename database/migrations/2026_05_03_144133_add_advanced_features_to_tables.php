<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ajouter le lien Utilisateur au Médecin
        Schema::table('medecins', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
        });

        // 2. Ajouter les messages aux Rendez-vous
        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->text('message_patient')->nullable()->after('motif');
            $table->text('reponse_medecin')->nullable()->after('message_patient');
        });

        // 3. Ajouter le dossier médical partagé au Patient
        Schema::table('patients', function (Blueprint $table) {
            $table->longText('dossier_medical')->nullable()->after('adresse');
        });
    }

    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->dropColumn(['message_patient', 'reponse_medecin']);
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('dossier_medical');
        });
    }
};
