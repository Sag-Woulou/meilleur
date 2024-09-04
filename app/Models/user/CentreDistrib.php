<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CentreDistrib extends Model
{
    use HasFactory;

    protected $table = 'Centre_distrib';
    protected $fillable = [
        'CENTRE_DISTRIBUTION',
        'EXPL_DEPANNAGE',
        'LIBELLE_EXPL_DEPANNAGE',
        'DIST_LIBELLE'
    ];

    public $timestamps = false;



    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'centre_user', 'centre_distrib_id', 'user_id');
    }

}
