<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutTicket extends Model
{
    use HasFactory;

    protected $table = 'statutTicket';
    protected $primaryKey = 'StatutTicketId';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'StatutTicketId',
        'statutTicket',
    ];

    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'StatutTicketId', 'StatutTicketId');
    }

    public function commentaireTickets()
    {
        return $this->hasMany(CommentaireTicket::class, 'StatutTicketId', 'StatutTicketId');
    }
}
