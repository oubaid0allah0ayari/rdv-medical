<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class EspaceMedecinController extends Controller
{
    /**
     * Affiche l'agenda du médecin (ses rendez-vous)
     */
    public function index()
    {
        $medecin = Medecin::where('user_id', auth()->id())->firstOrFail();
        
        $rendezvous = RendezVous::with('patient')
            ->where('medecin_id', $medecin->id)
            ->orderBy('date', 'asc')
            ->orderBy('heure', 'asc')
            ->get();

        return view('medecin.dashboard', compact('medecin', 'rendezvous'));
    }

    /**
     * Affiche le formulaire pour modifier ses horaires
     */
    public function horaires()
    {
        $medecin = Medecin::where('user_id', auth()->id())->firstOrFail();
        return view('medecin.horaires', compact('medecin'));
    }

    /**
     * Met à jour les horaires du médecin
     */
    public function updateHoraires(Request $request)
    {
        $request->validate([
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ], [
            'heure_fin.after' => 'L\'heure de fin doit être strictement après l\'heure de début.',
        ]);

        $medecin = Medecin::where('user_id', auth()->id())->firstOrFail();
        $medecin->update([
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        return redirect()->route('medecin.dashboard')->with('success', 'Vos horaires de travail ont été mis à jour avec succès.');
    }

    /**
     * Affiche la fiche (Dossier Médical) d'un patient
     */
    public function dossierPatient($id)
    {
        $medecin = Medecin::where('user_id', auth()->id())->firstOrFail();
        $patient = Patient::findOrFail($id);

        // Vérifier que le médecin a bien un rendez-vous (passé ou futur) avec ce patient pour des raisons de confidentialité
        $aRDV = RendezVous::where('medecin_id', $medecin->id)->where('patient_id', $patient->id)->exists();
        if (!$aRDV) {
            abort(403, "Vous n'avez pas l'autorisation d'accéder au dossier de ce patient.");
        }

        return view('medecin.patient_dossier', compact('patient'));
    }

    /**
     * Met à jour le dossier médical partagé du patient
     */
    public function updateDossier(Request $request, $id)
    {
        $request->validate([
            'dossier_medical' => 'nullable|string',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update([
            'dossier_medical' => $request->dossier_medical,
        ]);

        return redirect()->route('medecin.patient', $patient->id)->with('success', 'Dossier patient mis à jour.');
    }

    /**
     * Le médecin répond au message d'un patient sur un RDV spécifique
     */
    public function repondreRdv(Request $request, $id)
    {
        $request->validate([
            'reponse_medecin' => 'required|string',
            'statut' => 'required|string|in:planifié,confirmé,annulé,terminé',
        ]);

        $rdv = RendezVous::findOrFail($id);
        $medecin = Medecin::where('user_id', auth()->id())->firstOrFail();

        if ($rdv->medecin_id !== $medecin->id) {
            abort(403);
        }

        $rdv->update([
            'reponse_medecin' => $request->reponse_medecin,
            'statut' => $request->statut,
        ]);

        return redirect()->route('medecin.dashboard')->with('success', 'Réponse envoyée au patient et statut mis à jour.');
    }
}
