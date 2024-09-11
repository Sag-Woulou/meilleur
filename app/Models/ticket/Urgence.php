<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urgence extends Model
{
    use HasFactory;

    protected $table = 'urgence';

    protected $primaryKey = 'UrgenceId';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'UrgenceId',
        'NiveauUrgence',
    ];

    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'UrgenceId', 'UrgenceId');
    }
}
