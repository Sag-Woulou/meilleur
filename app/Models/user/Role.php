<?php

namespace App\Models\user;

use App\Models\user\Permission;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static paginate(int $int)
 * @method static create(mixed $validatedData)
 * @method static where(string $string, false $false)
 * @property mixed $id
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'role_id', 'id');
    }
    /**
     * Définir une relation avec le modèle Permission.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
