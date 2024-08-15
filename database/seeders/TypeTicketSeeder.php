<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un type de ticket
        $typeTicket = TicketType::insert(
            [
                [
                    'ticket_type_event_id' => 1,
                    'ticket_type_name' => 'Ticket standard',
                    'ticket_type_price' => 10000,
                    'ticket_type_quantity' => 100,
                    'ticket_type_real_quantity' => 100,
                    'ticket_type_total_quantity' => 100,
                    'ticket_type_description' => 'Un ticket standard pour assister au concert'
                ],
                [
                    'ticket_type_event_id' => 1,
                    'ticket_type_name' => 'Ticket VIP',
                    'ticket_type_price' => 20000,
                    'ticket_type_quantity' => 50,
                    'ticket_type_real_quantity' => 50,
                    'ticket_type_total_quantity' => 50,
                    'ticket_type_description' => 'Un ticket VIP pour assister au concert'
                ],
                [
                    'ticket_type_event_id' => 2,
                    'ticket_type_name' => 'Ticket standard',
                    'ticket_type_price' => 15000,
                    'ticket_type_quantity' => 200,
                    'ticket_type_real_quantity' => 200,
                    'ticket_type_total_quantity' => 200,
                    'ticket_type_description' => 'Un ticket standard pour assister au festival'
                ],
                [
                    'ticket_type_event_id' => 2,
                    'ticket_type_name' => 'Ticket VIP',
                    'ticket_type_price' => 30000,
                    'ticket_type_quantity' => 100,
                    'ticket_type_real_quantity' => 100,
                    'ticket_type_total_quantity' => 100,
                    'ticket_type_description' => 'Un ticket VIP pour assister au festival'
                ],
                [
                    'ticket_type_event_id' => 3,
                    'ticket_type_name' => 'Ticket standard',
                    'ticket_type_price' => 5000,
                    'ticket_type_quantity' => 150,
                    'ticket_type_real_quantity' => 150,
                    'ticket_type_total_quantity' => 150,
                    'ticket_type_description' => 'Un ticket standard pour assister à la pièce de théâtre'
                ],
                [
                    'ticket_type_event_id' => 3,
                    'ticket_type_name' => 'Ticket VIP',
                    'ticket_type_price' => 10000,
                    'ticket_type_quantity' => 75,
                    'ticket_type_real_quantity' => 75,
                    'ticket_type_total_quantity' => 75,
                    'ticket_type_description' => 'Un ticket VIP pour assister à la pièce de théâtre'
                ],
            ]);
    }
}
