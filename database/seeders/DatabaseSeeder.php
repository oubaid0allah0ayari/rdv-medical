<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création du compte Administrateur par défaut
        User::updateOrCreate(
            ['email' => 'admin@rdv-medical.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Mot de passe: password
                'role' => 'admin',
            ]
        );

        // Optionnel : Création d'un patient de test
        $patientUser = User::updateOrCreate(
            ['email' => 'patient@rdv-medical.test'],
            [
                'name' => 'Jean Dupont',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ]
        );

        // Si le patient n'a pas encore de profil, on lui en crée un
        if (!$patientUser->patient) {
            $patientUser->patient()->create([
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'telephone' => '0601020304',
                'date_naissance' => '1990-01-01',
            ]);
        }
    }
}
