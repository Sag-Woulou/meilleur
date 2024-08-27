<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import du trait SoftDeletes

/**
 * @method static paginate(int $int)
 */
class Service extends Model
{
    use HasFactory, SoftDeletes; // Utilisation du trait SoftDeletes

    protected $fillable = ['nom', 'description'];
}
