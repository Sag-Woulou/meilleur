<?php

namespace App\Models\ticket;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
    use HasFactory;

    protected $table = 'abonnes';

    public $timestamps = false;

    protected $fillable = [
        'Exploitation',
        'Section',
        'Lot',
        'Parcelle',
        'Rang',
        'Police',
        'Cle',
        'Quartier',
        'Nom',
        'Prenom',
        'Email',
        'Tel',
        'NumeroCompteur',
        'EtatClient',
        'DateAbonnement',
        'DateEtat',
        'TypeCompteur',
        'TypeAbonne',
        'CompteurPrepaye',
        'src',
        'cd',
        'agcom',
        'version_sts'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
