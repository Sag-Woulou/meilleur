<?php

namespace App\Models\intervention;

use Illuminate\Database\Eloquent\Model;

class InterventionStatut extends Model
{
    // Nom de la table dans la base de données
    protected $table = 'interventionStatut';

    // Définir la clé primaire si ce n'est pas `id`
    protected $primaryKey = 'InterventionStatutId';

    // Désactiver les timestamps automatiques (created_at, updated_at)
    public $timestamps = false;

    // Définir les colonnes modifiables
    protected $fillable = ['Statut'];

    // Relation avec Intervention
    public function interventions(){
        return $this->hasMany(Intervention::class , 'InterventionStatutId');
    }

}
