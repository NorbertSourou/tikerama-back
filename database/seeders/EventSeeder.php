<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\OrderIntent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des événements
       Event::insert(
            [
                [
                'event_category' => 'Concert-Spectacle',
                'event_title' => 'Concert de musique',
                'event_description' => 'Un concert de musique classique avec un orchestre symphonique',
                'event_date' => '2024-09-15 15:00:00',
                'event_image' => 'https://example.com/concert.jpg',
                'event_city' => 'Abidjan',
                'event_address' => 'Salle Pleyel',
                'event_status' => 'upcoming'
            ],
                [
                    'event_category' => 'Festival',
                    'event_title' => 'Festival de musique',
                    'event_description' => 'Un festival de musique électronique avec des DJ internationaux',
                    'event_date' => '2024-09-20 18:00:00',
                    'event_image' => 'https://example.com/festival.jpg',
                    'event_city' => 'Abidjan',
                    'event_address' => 'Parc des expositions',
                    'event_status' => 'upcoming'
                ],
                [
                    'event_category' => 'Autre',
                    'event_title' => 'Pièce de théâtre',
                    'event_description' => 'Une pièce de théâtre classique',
                    'event_date' => '2024-09-25 20:00:00',
                    'event_image' => 'https://example.com/theatre.jpg',
                    'event_city' => 'Abidjan',
                    'event_address' => 'Théâtre de la ville',
                    'event_status' => 'upcoming'
                ],

            ]
        );



    }
}
