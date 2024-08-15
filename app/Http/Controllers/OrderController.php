<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

        $orders = Order::where('user_id', Auth::id())
            ->orderBy('order_created_on', 'desc')
            ->paginate($request->input('per_page', 10));
        return response()->json($orders);
    }

    public function downloadTickets($orderId)
    {

    }
}
