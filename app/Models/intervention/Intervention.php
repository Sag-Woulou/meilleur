<?php

namespace App\Models\intervention;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $table = 'intervention'; // Nom de la table
    protected $primaryKey = 'InterventionId'; // Clé primaire
    public $timestamps = false; // Désactiver les timestamps si non utilisés

    protected $fillable = [
        'TicketId',
        'CreationDatetime',
        'CloseDatetime',
        'Description',
        'user_id',
        'PanneReelsTypePanneId',
        'ArtId',
        'nombreArticles', // Ajout de la colonne nombreArticles
        'InterventionStatutId', // Inclure InterventionStatutId pour la relation un-à-un
    ];

    // Relation avec Article (plusieurs articles)
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'ArticleIntervention', 'InterventionId', 'ArtId');
    }

    // Relation avec InterventionStatut (un seul statut)
    public function statut()
    {
        return $this->belongsTo(InterventionStatut::class, 'InterventionStatutId'); // Relation un-à-un
    }

    // Relation avec TypePanneReel (plusieurs types de panne)
    public function typePanneReels()
    {
        return $this->belongsToMany(TypePanneReel::class, 'InterventionTypePanneReel', 'InterventionId', 'TypePanneId');
    }
}
