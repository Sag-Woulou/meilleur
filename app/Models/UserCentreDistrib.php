<?php

namespace App\Models;

use App\Models\user\User;
use App\Models\user\CentreDistrib;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static create(mixed $validatedData)
 * @method static where(string $string, int $userId)
 */
class UserCentreDistrib extends Pivot
{
    protected $table = 'centre_user';

    protected $fillable = ['user_id', 'centre_distrib_id'];

    public $timestamps = true;

    /**
     * Définir une relation avec le modèle User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Définir une relation avec le modèle CentreDistrib.
     */
    public function centreDistribs(): BelongsTo
    {
        return $this->belongsTo(CentreDistrib::class, 'centre_distrib_id');
    }
}
