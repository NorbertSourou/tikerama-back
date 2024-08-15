<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Récupère la liste des types de tickets pour un événement donné.
     *
     * @param $eventId
     * @return JsonResponse
     */

    public function index($eventId): JsonResponse
    {
        $ticketTypes = TicketType::where('ticket_type_event_id', $eventId)->get();
        return response()->json($ticketTypes);
    }
}
