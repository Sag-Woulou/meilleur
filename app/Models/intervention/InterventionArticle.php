<?php

namespace App\Models\intervention;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionArticle extends Model
{
    use HasFactory;

    // Définir la table associée si le nom n'est pas pluriel
    protected $table = 'intervention_article';

    // Si les noms des colonnes de clé primaire et étrangère sont différents de la convention
    protected $primaryKey = 'id'; // Définit la clé primaire si elle est différente
    public $incrementing = true; // Indique si la clé primaire est auto-incrémentée
    protected $keyType = 'int'; // Type de la clé primaire

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'InterventionsInterventionId',
        'ArtId',
        'nombreArticles',
    ];

    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
