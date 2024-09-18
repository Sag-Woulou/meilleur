<?php

namespace App\Models\ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'TicketId';
    public $incrementing = false;  // Si vous ne voulez pas que la clé primaire soit auto-incrémentée
    protected $keyType = 'int';    // Type de la clé primaire

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
        'service_id',  // Ajout de cette colonne dans les champs remplissables
    ];

    public $timestamps = false;  // Si vous n'utilisez pas les colonnes created_at et updated_at

    protected $dates = [
        'CreationDatetime',
        'CloseDatetime',
    ];

    // Relations Eloquent

    /**
     * Relation avec le type de panne
     */
    public function typePanne()
    {
        return $this->belongsTo(TypePanne::class, 'typePanneId', 'TypePanneId');
    }

    /**
     * Relation avec l'urgence
     */
    public function urgence()
    {
        return $this->belongsTo(Urgence::class, 'UrgenceId', 'UrgenceId');
    }

    /**
     * Relation avec le statut du ticket
     */
    public function statutTicket()
    {
        return $this->belongsTo(StatutTicket::class, 'StatutTicketId', 'StatutTicketId');
    }

    /**
     * Relation avec les commentaires associés à ce ticket
     */
    public function commentaires()
    {
        return $this->hasMany(CommentaireTicket::class, 'TicketId', 'TicketId');
    }

    /**
     * Relation avec l'abonné lié à ce ticket
     */
    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }

    /**
     * Relation avec le service associé à ce ticket
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
