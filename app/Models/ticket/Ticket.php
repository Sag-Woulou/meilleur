<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'TicketId';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'TicketId',
        'typeTicketId',
        'typePanneId',
        'Exploitation',
        'Section',
        'Lot',
        'Parcelle',
        'Rang',
        'ExploitationDepannage',
        'CentreDistribution',
        'UrgenceId',
        'Description',
        'CreationDatetime',
        'CloseDatetime',
        'ContactProfileId',
        'CallId',
        'NumeroAppelant',
        'NumPorte',
        'Rue',
        'Quartier',
        'IndicationPrecise',
        'NumeroContact1',
        'NumeroContact2',
    ];

    public $timestamps = false;

    protected $dates = [
        'CreationDatetime',
        'CloseDatetime',
    ];

    // Dans le modèle Ticket
    public function typePanne()
    {
        return $this->belongsTo(TypePanne::class, 'typePanneId', 'TypePanneId');
    }

    public function urgence()
    {
        return $this->belongsTo(Urgence::class, 'UrgenceId', 'UrgenceId');
    }

    public function statutTicket()
    {
        return $this->belongsTo(StatutTicket::class, 'StatutTicketId', 'StatutTicketId');
    }

    public function commentaires()
    {
        return $this->hasMany(CommentaireTicket::class, 'TicketId', 'TicketId');
    }

    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }

}
