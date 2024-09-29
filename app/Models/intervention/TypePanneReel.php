<?php

namespace App\Models\intervention;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePanneReel extends Model
{
    use HasFactory;

    // Le nom de la table dans la base de données
    protected $table = 'typePanneReel';

    // Les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'TypePanneId',
        'TypePanne'
    ];

    // Désactiver les timestamps si la table n'en a pas
    public $timestamps = false;

    // Indiquer la clé primaire
    protected $primaryKey = 'TypePanneId';

    // Relation avec Intervention
    public function panne(){
        return $this->belongsTo(Intervention::class, 'TypePanneId');
    }

}
