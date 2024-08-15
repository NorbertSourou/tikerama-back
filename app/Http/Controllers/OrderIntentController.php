<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderIntent;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderIntentController extends Controller
{
    /**
     * Crée une nouvelle intention de commande.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        //'order_intent_price' => 'required|numeric',
        $validatedData = $request->validate([
            'order_intent_type' => 'required|string',
            'user_email' => 'required|email',
            'user_phone' => 'required|string',
            'ticket_type_id' => 'required|exists:ticket_types,ticket_type_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticketType = TicketType::findOrFail($validatedData['ticket_type_id']);
        if ($ticketType->ticket_type_quantity < $validatedData['quantity']) {
            return response()->json(['error' => 'Pas assez de tickets disponibles'], 400);
        }

        $orderIntent = OrderIntent::create([
            'order_intent_price' => $validatedData['quantity'] * $ticketType->ticket_type_price,
            'order_intent_type' => $validatedData['order_intent_type'],
            'user_email' => $validatedData['user_email'],
            'user_phone' => $validatedData['user_phone'],
            'expiration_date' => now()->addMinutes(15),
        ]);

        $ticketType->ticket_type_quantity -= $validatedData['quantity'];
        $ticketType->save();

        return response()->json($orderIntent, 201);
    }

    /**
     * Confirme une intention de commande.
     *
     * @param  $id
     * @param Request $request
     * @return JsonResponse
     */
    public function confirm($id, Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'ticket_type_id' => 'required|exists:ticket_types,ticket_type_id',
        ]);

        $orderIntent = OrderIntent::findOrFail($id);
        $ticketType = TicketType::findOrFail($validatedData['ticket_type_id']);


        if ($orderIntent->expiration_date < now()) {
            // ramener les tickets dans le stock
            $ticketType->ticket_type_quantity += $validatedData['quantity'];
            // supprimer l'intention de commande
            $orderIntent->delete();
            $ticketType->save();

            return response()->json(['error' => 'L\'intention de commande a expiré'], 400);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'order_number' => uniqid(),
                'order_event_id' => $ticketType->event->event_id,
                'order_price' => $orderIntent->order_intent_price,
                'order_type' => $orderIntent->order_intent_type,
                'order_payment' => 'MTN Mobile Money',
                'order_info' => 'Commande confirmée',
                'user_id' => Auth::id()
            ]);

            for ($i = 0; $i < $validatedData['quantity']; $i++) {
                Ticket::create([
                    'ticket_event_id' => $order->event->event_id,
                    'ticket_email' => $orderIntent->user_email,
                    'ticket_phone' => $orderIntent->user_phone,
                    'ticket_price' => $ticketType->ticket_type_price,
                    'ticket_order_id' => $order->order_id,
                    'ticket_key' => uniqid(),
                    'ticket_ticket_type_id' => $ticketType->ticket_type_id,
                    'ticket_status' => 'active',
                ]);
            }

            $ticketType->ticket_type_real_quantity -= $validatedData['quantity'];
            $ticketType->save();

            //  $orderIntent->delete();
            DB::commit();

            $ticketUrl = url("/api/orders/{$order->order_id}/tickets");
            return response()->json(['message' => 'Commande confirmée', 'tickets_url' => $ticketUrl]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erreur lors de la confirmation de la commande',
            ], 500);
        }
    }
}
