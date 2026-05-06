<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'dossier_medical',
        'poids',
        'taille',
        'maladies_chroniques',
        'allergies',
    ];

    /**
     * Un Utilisateur a un seul profil Patient
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un patient a plusieurs rendez-vous
     */
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    /**
     * Un patient a un historique de remarques médicales
     */
    public function remarques()
    {
        return $this->hasMany(Remarque::class);
    }
}
