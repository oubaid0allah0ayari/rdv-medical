<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'date',
        'heure',
        'motif',
        'message_patient',
        'reponse_medecin',
        'statut',
    ];

    /**
     * Le RDV appartient à un Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Le RDV appartient à un Médecin
     */
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}
