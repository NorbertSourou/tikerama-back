<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Récupère la liste des événements en cours avec pagination.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
//        $perPage = $request->input('per_page', 15);
//        $page = $request->input('page', 1);
//
//        // Utilisation du cache pour améliorer les performances
//        $cacheKey = "events_page_{$page}_perPage_{$perPage}";
//        $events = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($perPage) {
//            return Event::where('event_status', 'upcoming')
//                ->orderBy('event_date')
//                ->paginate($perPage);
//        });


        $events = Event::where('event_status', 'upcoming')
            ->orderBy('event_date')
            ->paginate($request->input('per_page', 15));
        return response()->json($events);
    }



    /**
     * Récupère les détails d'un événement spécifique.
     *
     * @param  $eventId
     * @return JsonResponse
     */
    public function show($eventId): JsonResponse
    {
        $event = Event::findOrFail($eventId);
        return response()->json($event);
    }
}
