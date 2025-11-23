<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $restaurantData = [
            [
                'name' => 'Sunset Diner',
                'email' => 'sunset@example.com',
                'phone' => '+63 900 111 2222',
                'address' => '12 Bayview Road, Manila',
                'cuisine_type' => 'Filipino',
                'delivery_fee' => 30,
                'avg_prep_time' => 25,
                'status' => 'open',
            ],
            [
                'name' => 'Pasta Piazza',
                'email' => 'hello@pastapiazza.com',
                'phone' => '+63 910 333 4444',
                'address' => '45 Roma Street, Makati',
                'cuisine_type' => 'Italian',
                'delivery_fee' => 50,
                'avg_prep_time' => 35,
                'status' => 'open',
            ],
            [
                'name' => 'Sushi Express',
                'email' => 'rolls@sushiexpress.ph',
                'phone' => '+63 927 555 6666',
                'address' => '88 Sakura Lane, BGC',
                'cuisine_type' => 'Japanese',
                'delivery_fee' => 70,
                'avg_prep_time' => 30,
                'status' => 'paused',
            ],
            [
                'name' => 'Green Bowl',
                'email' => 'hi@greenbowl.ph',
                'phone' => '+63 912 777 8888',
                'address' => '21 Wellness Ave, Quezon City',
                'cuisine_type' => 'Vegan',
                'delivery_fee' => 25,
                'avg_prep_time' => 20,
                'status' => 'open',
            ],
            [
                'name' => 'Midnight Grill',
                'email' => 'info@midnightgrill.com',
                'phone' => '+63 918 999 0000',
                'address' => '7 Night Market, Pasig',
                'cuisine_type' => 'BBQ',
                'delivery_fee' => 40,
                'avg_prep_time' => 45,
                'status' => 'closed',
            ],
        ];

        $restaurants = collect($restaurantData)->map(fn ($data) => Restaurant::create($data));

        $menuItems = [
            [
                'name' => 'Garlic Butter Shrimp',
                'description' => 'Juicy shrimp sautéed in garlic-butter sauce.',
                'price' => 320,
                'restaurant_index' => 0,
            ],
            [
                'name' => 'Carbonara Supreme',
                'description' => 'Creamy pasta with double-smoked bacon.',
                'price' => 280,
                'restaurant_index' => 1,
            ],
            [
                'name' => 'Rainbow Sushi Set',
                'description' => 'Assorted nigiri and maki selection.',
                'price' => 450,
                'restaurant_index' => 2,
            ],
            [
                'name' => 'Power Greens Bowl',
                'description' => 'Kale, quinoa, roasted veggies, tahini dressing.',
                'price' => 260,
                'restaurant_index' => 3,
            ],
            [
                'name' => 'Smoky Ribs',
                'description' => 'Slow-cooked ribs with signature glaze.',
                'price' => 390,
                'restaurant_index' => 4,
            ],
            [
                'name' => 'Classic Tapsilog',
                'description' => 'Breakfast favorite with garlic rice & egg.',
                'price' => 180,
                'restaurant_index' => 0,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'restaurant_id' => $restaurants[$item['restaurant_index']]->id ?? null,
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'is_available' => true,
            ]);
        }
    }
}
