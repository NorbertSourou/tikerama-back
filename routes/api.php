<?php

use App\Mail\AccessTokenMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderIntentController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;

Route::prefix('v1')->group(function () {

    Route::post('/tokens/create', function (Request $request) {
        $user = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'enterprise' => $request->input('enterprise'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'address' => $request->input('address')
        ]);

        $token = $user->createToken("api-token");
        $credentials = [
            'email' => $user->email,
            'name' => $user->name . ' ' . $user->surname,
            'token' => $token->plainTextToken
        ];

        Mail::to($user->email)->send(new AccessTokenMail($credentials));

        return ['access_token' => $token->plainTextToken];
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('events', [EventController::class, 'index']);
        Route::get('events/{eventId}/ticket-types', [TicketTypeController::class, 'index']);
        Route::post('order-intents', [OrderIntentController::class, 'store']);
        Route::post('order-intents/{id}/confirm', [OrderIntentController::class, 'confirm']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{orderId}/tickets', [OrderController::class, 'downloadTickets']);

    });

});
