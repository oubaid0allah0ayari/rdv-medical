<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Medecin;
use App\Models\Patient;
use App\Http\Requests\StoreRendezVousRequest;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $patient = $user->patient;

        // Auto-création du profil patient s'il n'existe pas encore
        if (!$patient) {
            $parts = explode(' ', $user->name, 2);
            $patient = Patient::create([
                'user_id' => $user->id,
                'nom' => $parts[0],
                'prenom' => $parts[1] ?? '',
                'telephone' => 'Non renseigné',
            ]);
        }

        $rendezvous = RendezVous::with('medecin')
                        ->where('patient_id', $patient->id)
                        ->orderBy('date', 'asc')
                        ->orderBy('heure', 'asc')
                        ->get();

        return view('rendezvous.index', compact('rendezvous'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On récupère tous les médecins pour le select
        $medecins = Medecin::all();
        return view('rendezvous.create', compact('medecins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRendezVousRequest $request)
    {
        $user = auth()->user();
        $patient = $user->patient;

        // Auto-création du profil patient s'il n'existe pas encore
        if (!$patient) {
            // On sépare le nom en "Nom" et "Prénom" basiquement
            $parts = explode(' ', $user->name, 2);
            $nom = $parts[0];
            $prenom = $parts[1] ?? '';

            $patient = Patient::create([
                'user_id' => $user->id,
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => 'Non renseigné',
            ]);
        }

        // Si on arrive ici, la validation et la vérification de chevauchement (dans la FormRequest) sont passées
        RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'heure' => $request->heure,
            'motif' => $request->motif,
            'message_patient' => $request->message_patient,
            'statut' => 'planifié',
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Votre rendez-vous a été pris avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RendezVous $rendezVous)
    {
        // Optionnel pour l'instant
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rendezvous = RendezVous::findOrFail($id);
        
        // Sécurité : on vérifie que le RDV appartient bien au patient
        if ($rendezvous->patient_id !== auth()->user()->patient->id) {
            abort(403);
        }

        $medecins = Medecin::all();
        return view('rendezvous.edit', compact('rendezvous', 'medecins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRendezVousRequest $request, $id)
    {
        $rendezvous = RendezVous::findOrFail($id);

        if ($rendezvous->patient_id !== auth()->user()->patient->id) {
            abort(403);
        }

        $rendezvous->update([
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'heure' => $request->heure,
            'motif' => $request->motif,
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rendezvous = RendezVous::findOrFail($id);

        if ($rendezvous->patient_id !== auth()->user()->patient->id) {
            abort(403);
        }

        $rendezvous->delete();

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous annulé.');
    }
}
