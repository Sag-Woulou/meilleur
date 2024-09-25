<?php

namespace App\Models\intervention;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Le nom de la table dans la base de données
    protected $table = 'Articles'; // Assurez-vous que le nom de la table est correct

    // Les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'ArtLibelle',
        'ArtUniteMesure',
        'ArtPrixUnitaire',
        'Quantite'
    ];

    // Désactiver les timestamps si la table n'en a pas
    public $timestamps = false;

    // Indiquer la clé primaire si ce n'est pas 'id'
    protected $primaryKey = 'ArtId';

    // Relation avec Intervention (plusieurs articles peuvent être associés à plusieurs interventions)
    public function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'ArticleIntervention', 'ArtId', 'InterventionId');
    }
}
