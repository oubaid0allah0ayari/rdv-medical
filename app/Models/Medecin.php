<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $table = 'medecins';

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'specialite',
        'telephone',
        'email',
        'heure_debut',
        'heure_fin',
    ];

    /**
     * Un Médecin est un Utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un Médecin a plusieurs rendez-vous
     */
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    /**
     * Remarques créées par ce médecin
     */
    public function remarques()
    {
        return $this->hasMany(Remarque::class);
    }
}
