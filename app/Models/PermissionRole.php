<?php

namespace App\Models;

use App\Models\user\Permission;
use App\Models\user\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static create(mixed $validatedData)
 * @method static where(string $string, int $roleId)
 */
class PermissionRole extends Pivot
{
    protected $table = 'permission_role';

    // Les champs que vous souhaitez pouvoir remplir via des assignations massives
    protected $fillable = ['permission_id', 'role_id'];

    // Si vous souhaitez désactiver les timestamps
    public $timestamps = true;

    /**
     * Définir une relation avec le modèle Permission.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Définir une relation avec le modèle Role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
