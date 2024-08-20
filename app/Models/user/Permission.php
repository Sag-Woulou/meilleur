<?php

namespace App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static paginate(int $int)
 * @method static create(mixed $validatedData)
 * @method static where(string $string, false $false)
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'description',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
