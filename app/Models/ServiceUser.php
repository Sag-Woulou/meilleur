<?php

namespace App\Models;

use App\Models\user\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $id)
 */
class ServiceUser extends Model
{
    use HasFactory;

    protected $table = 'service_user';
    protected $fillable = ['user_id', 'service_id'];
    public $timestamps = false;



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
