<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Artist;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create regular users
        User::factory(10)->create();

        // Create categories
        $categories = [
            ['name' => 'Music', 'slug' => 'music', 'description' => 'Music concerts and festivals'],
            ['name' => 'Festival', 'slug' => 'festival', 'description' => 'Multi-day festivals featuring various artists'],
            ['name' => 'Jazz', 'slug' => 'jazz', 'description' => 'Jazz concerts and performances'],
            ['name' => 'Rock', 'slug' => 'rock', 'description' => 'Rock music concerts'],
            ['name' => 'Pop', 'slug' => 'pop', 'description' => 'Pop music concerts'],
            ['name' => 'Classical', 'slug' => 'classical', 'description' => 'Classical music performances'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create artists
        $artists = [
            [
                'name' => 'Hellorative',
                'slug' => 'hellorative',
                'bio' => 'Hellorative is a popular Indonesian indie band known for their unique sound and energetic performances.',
                'featured' => true,
            ],
            [
                'name' => 'Noah & DJ Princess',
                'slug' => 'noah-dj-princess',
                'bio' => 'Noah is one of Indonesia\'s most beloved rock bands, performing with DJ Princess for a unique collaboration.',
                'featured' => true,
            ],
            [
                'name' => 'Konser DJ Nymph',
                'slug' => 'konser-dj-nymph',
                'bio' => 'DJ Nymph is a rising star in the electronic music scene with a dedicated following across Indonesia.',
                'featured' => true,
            ],
            [
                'name' => 'Bernadya',
                'slug' => 'bernadya',
                'bio' => 'Bernadya is a talented solo artist known for her soulful voice and emotional performances.',
                'featured' => true,
            ],
            [
                'name' => 'Sound\'s Fest',
                'slug' => 'sounds-fest',
                'bio' => 'Sound\'s Fest is a collective of artists bringing diverse musical styles to one stage.',
                'featured' => false,
            ],
        ];

        foreach ($artists as $artist) {
            Artist::create($artist);
        }

        // Create events
        $events = [
            [
                'title' => 'Hellorative Live in Concert',
                'slug' => 'hellorative-live',
                'description' => 'Experience the energy and excitement of Hellorative\'s latest tour. This concert promises to be an unforgettable night of music and entertainment for fans of all ages.',
                'date' => now()->addDays(15),
                'time' => '19:00',
                'location' => 'Jakarta',
                'venue' => 'Senayan Stadium',
                'organizer' => 'Konserin Events',
                'featured' => true,
                'status' => 'upcoming',
            ],
            [
                'title' => 'Noah & DJ Princess Collaboration',
                'slug' => 'noah-dj-princess-collab',
                'description' => 'A unique collaboration between rock band Noah and DJ Princess, bringing together the best of both worlds for an unforgettable musical experience.',
                'date' => now()->addDays(30),
                'time' => '20:00',
                'location' => 'Bandung',
                'venue' => 'Bandung Convention Center',
                'organizer' => 'Music United',
                'featured' => true,
                'status' => 'upcoming',
            ],
            [
                'title' => 'DJ Nymph Electronic Night',
                'slug' => 'dj-nymph-electronic',
                'description' => 'Dance the night away with DJ Nymph\'s electrifying beats and visuals. This electronic music event will feature the latest hits and classic favorites.',
                'date' => now()->addDays(22),
                'time' => '21:00',
                'location' => 'Jakarta',
                'venue' => 'Colosseum Club',
                'organizer' => 'Electronic Beats',
                'featured' => true,
                'status' => 'upcoming',
            ],
            [
                'title' => 'Bernadya Tur Berjalan',
                'slug' => 'bernadya-tur-berjalan',
                'description' => 'Join Bernadya on her tour as she brings her soulful music to cities across Indonesia. An intimate concert experience you won\'t want to miss.',
                'date' => now()->addDays(45),
                'time' => '19:30',
                'location' => 'Kuala Lumpur',
                'venue' => 'KL Performance Hall',
                'organizer' => 'Melody Productions',
                'featured' => true,
                'status' => 'upcoming',
            ],
            [
                'title' => 'Sound\'s Fest 2025',
                'slug' => 'sounds-fest-2025',
                'description' => 'A multi-day festival featuring a diverse lineup of artists across various genres. Come for the music, stay for the experience.',
                'date' => now()->addDays(60),
                'time' => '12:00',
                'location' => 'Bali',
                'venue' => 'Kuta Beach Resort',
                'organizer' => 'Festival People',
                'featured' => false,
                'status' => 'upcoming',
            ],
        ];

        foreach ($events as $event) {
            $newEvent = Event::create($event);
            
            // Associate event with categories and artists
            $categoryIds = Category::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();
            $newEvent->categories()->attach($categoryIds);
            
            // Find the artist with the same name as the event title, or pick a random one
            $artist = Artist::where('name', 'like', '%' . explode(' ', $event['title'])[0] . '%')->first() 
                    ?? Artist::inRandomOrder()->first();
            
            $newEvent->artists()->attach($artist->id);
            
            // Create tickets for this event
            $ticketTypes = [
                [
                    'name' => 'Regular',
                    'description' => 'Regular admission with standard seating',
                    'price' => rand(100000, 300000),
                    'quantity' => 1000,
                    'available' => 1000,
                ],
                [
                    'name' => 'VIP',
                    'description' => 'VIP admission with premium seating and event merchandise',
                    'price' => rand(500000, 1000000),
                    'quantity' => 200,
                    'available' => 200,
                ],
                [
                    'name' => 'VVIP',
                    'description' => 'VVIP admission with exclusive perks including meet & greet',
                    'price' => rand(1500000, 2500000),
                    'quantity' => 50,
                    'available' => 50,
                ],
            ];
            
            foreach ($ticketTypes as $ticket) {
                $ticket['event_id'] = $newEvent->id;
                Ticket::create($ticket);
            }
        }
    }
}