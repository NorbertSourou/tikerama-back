<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = [
        'event_category', 'event_title', 'event_description', 'event_date',
        'event_image', 'event_city', 'event_address', 'event_status'
    ];

    public function ticketTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketType::class, 'ticket_type_event_id');
    }


}
