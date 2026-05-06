<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\RendezVous;

class StoreRendezVousRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Seuls les patients (ou les admins) peuvent prendre des rendez-vous. 
        // On permet à tout le monde connecté pour l'instant, le middleware gérera le reste.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'motif' => 'required|string|max:255',
            'message_patient' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Après la validation de base, on ajoute une règle métier personnalisée 
     * pour empêcher les chevauchements de créneaux.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Récupérer le médecin pour vérifier ses horaires
            $medecin = \App\Models\Medecin::find($this->medecin_id);
            if ($medecin && $this->heure) {
                $heureDemandee = \Carbon\Carbon::parse($this->heure)->format('H:i:s');
                if ($heureDemandee < $medecin->heure_debut || $heureDemandee > $medecin->heure_fin) {
                    $validator->errors()->add('heure', "Cette heure est en dehors des horaires de travail du médecin (de " . \Carbon\Carbon::parse($medecin->heure_debut)->format('H:i') . " à " . \Carbon\Carbon::parse($medecin->heure_fin)->format('H:i') . ").");
                }
            }

            // Vérifier s'il y a déjà un RDV à la même date et heure pour ce médecin
            $rdvExistant = RendezVous::where('medecin_id', $this->medecin_id)
                ->where('date', $this->date)
                ->where('heure', $this->heure)
                ->whereIn('statut', ['planifié', 'confirmé']) // Ne compte pas les annulés
                ->exists();

            if ($rdvExistant) {
                $validator->errors()->add('heure', 'Le médecin a déjà un rendez-vous à ce créneau.');
            }
        });
    }
}
