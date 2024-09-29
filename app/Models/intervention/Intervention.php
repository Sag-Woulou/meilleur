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
        return $this->belongsToMany(Article::class, 'intervention_article', 'InterventionId', 'ArtId');
    }

}
