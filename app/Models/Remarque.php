<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarque extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'contenu',
    ];

    /**
     * La remarque concerne un patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Le médecin qui a écrit la remarque
     */
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}
