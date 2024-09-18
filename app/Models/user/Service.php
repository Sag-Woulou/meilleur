<?php

namespace App\Models\user;

use App\Models\BelongsToMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Import du trait SoftDeletes

/**
 * @method static paginate(int $int)
 * @method static findOrFail(mixed $input)
 */
class Service extends Model
{
    use HasFactory, SoftDeletes; // Utilisation du trait SoftDeletes

    protected $fillable = ['nom', 'description'];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'service_user','service_id','user_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'service_id', 'id');
    }
}
