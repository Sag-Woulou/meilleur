<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Définir une relation avec le modèle Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
