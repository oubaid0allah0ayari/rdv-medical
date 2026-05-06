<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Remarque;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    /**
     * Affiche le dossier unique du patient
     */
    public function index($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        
        // On récupère toutes les remarques triées par les plus récentes
        $remarques = Remarque::with('medecin')
            ->where('patient_id', $patientId)
            ->latest()
            ->get();

        return view('medecin.dossier.index', compact('patient', 'remarques'));
    }

    /**
     * Met à jour les constantes médicales du patient (Poids, taille, allergies...)
     */
    public function updateInfos(Request $request, $patientId)
    {
        $request->validate([
            'taille' => 'nullable|integer|min:30|max:250',
            'poids' => 'nullable|numeric|min:2|max:300',
            'maladies_chroniques' => 'nullable|string',
            'allergies' => 'nullable|string',
            'dossier_medical' => 'nullable|string', // Pour les notes globales optionnelles
        ]);

        $patient = Patient::findOrFail($patientId);
        $patient->update($request->only(['taille', 'poids', 'maladies_chroniques', 'allergies', 'dossier_medical']));

        return redirect()->back()->with('success', 'Les informations du patient ont été mises à jour.');
    }

    /**
     * Ajoute une nouvelle remarque dans l'historique du dossier
     */
    public function storeRemarque(Request $request, $patientId)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Remarque::create([
            'patient_id' => $patientId,
            'medecin_id' => auth()->user()->medecin->id,
            'contenu' => $request->contenu,
        ]);

        return redirect()->back()->with('success', 'Votre remarque a bien été ajoutée au dossier.');
    }
}
