<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireTicket extends Model
{
    use HasFactory;

    protected $table = 'commentaireTickets';

    protected $primaryKey = 'CommentaireTicketId';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'CommentaireTicketId',
        'TicketId',
        'CreationDatetime',
        'StatutTicketId',
        'Description',
        'AgentName',
    ];

    public $timestamps = false;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'TicketId', 'TicketId');
    }

    public function statutTicket()
    {
        return $this->belongsTo(StatutTicket::class, 'StatutTicketId', 'StatutTicketId');
    }
}
