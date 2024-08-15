<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticket_id';
    protected $guarded = [];
    public $timestamps = false;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'ticket_event_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'ticket_order_id');
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'ticket_ticket_type_id');
    }

    protected $fillable = [
        'ticket_event_id', 'ticket_email', 'ticket_phone', 'ticket_price',
        'ticket_order_id', 'ticket_key', 'ticket_ticket_type_id', 'ticket_status'
    ];
}
