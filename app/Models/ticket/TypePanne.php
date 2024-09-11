<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePanne extends Model
{
    use HasFactory;

    protected $table = 'typePanne';

    protected $primaryKey = 'TypePanneId';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'TypePanneId',
        'typePanne',
    ];

    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'typePanneId', 'TypePanneId');
    }
}
