<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            // --- Attributes to find the user by ---
            ['email' => 'test@example.com'],

            // --- Attributes to use if creating a new user ---
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // You must provide a password when creating
            ]
        );

        $this->call([
            AgentTypeSeeder::class,
            LicenseTypeSeeder::class,
            PropertyPurposeSeeder::class,
            PropertyTypeSeeder::class,
            AdPriceSeeder::class,
            RoleAndPermissionSeeder::class,
            planSeeder::class,
            PropertySeeder::class,
            SubscriptionSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            PropertyAttributeSeeder::class,
        ]);
    }
}
