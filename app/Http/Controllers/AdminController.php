<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medecin;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord de l'administrateur
     */
    public function index()
    {
        $stats = [
            'total_patients' => Patient::count(),
            'total_medecins' => Medecin::count(),
            'total_rendezvous' => RendezVous::count(),
            'rdv_aujourdhui' => RendezVous::whereDate('date', today())->count(),
        ];

        // On récupère les 10 derniers rendez-vous pour le tableau d'activité récente
        $rendezvous = RendezVous::with(['patient', 'medecin'])
            ->orderBy('date', 'desc')
            ->orderBy('heure', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'rendezvous'));
    }

    /**
     * Affiche tous les rendez-vous pour l'administrateur
     */
    public function allRendezVous()
    {
        $rendezvous = RendezVous::with(['patient', 'medecin'])
                        ->orderBy('date', 'desc')
                        ->orderBy('heure', 'desc')
                        ->get();

        return view('admin.rendezvous', compact('rendezvous'));
    }
}
