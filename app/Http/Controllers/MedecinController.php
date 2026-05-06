<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medecins = Medecin::all();
        return view('medecins.index', compact('medecins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medecins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            // On vérifie que l'email est unique pour les médecins ET les utilisateurs
            'email' => 'required|email|unique:medecins,email|unique:users,email',
        ]);

        // 1. Générer un mot de passe aléatoire (10 caractères)
        $password = \Illuminate\Support\Str::random(10);

        // 2. Créer l'utilisateur "Médecin"
        $user = \App\Models\User::create([
            'name' => 'Dr. ' . $validated['nom'] . ' ' . $validated['prenom'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role' => 'medecin',
        ]);

        // 3. Créer la fiche Médecin reliée à l'utilisateur
        Medecin::create(array_merge($validated, [
            'user_id' => $user->id,
            'horaires_disponibles' => "Non définis", // Valeur par défaut
        ]));

        // On retourne à l'index avec un message TRÈS visible contenant le mot de passe
        return redirect()->route('medecins.index')->with('success', 
            "Médecin ajouté avec succès ! Voici ses identifiants de connexion : \n" .
            "Email : {$validated['email']} \n" .
            "Mot de passe provisoire : {$password} \n" .
            "Veuillez lui transmettre ces informations."
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Medecin $medecin)
    {
        // Optionnel
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medecin $medecin)
    {
        return view('medecins.edit', compact('medecin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medecin $medecin)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|unique:medecins,email,' . $medecin->id,
        ]);

        $medecin->update($validated);

        return redirect()->route('medecins.index')->with('success', 'Médecin mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medecin $medecin)
    {
        $medecin->delete();
        return redirect()->route('medecins.index')->with('success', 'Médecin supprimé.');
    }
}
