<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\AdPrice;
use App\Models\Agent;
use App\Models\City;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get prerequisites once to be efficient
        $adPrice = AdPrice::first();
        $cities = City::pluck('id');

        $agencies = Agency::all();

        // Check for prerequisites to avoid errors
        if (!$adPrice || $cities->isEmpty() || $agencies->isEmpty()) {
            $this->command->error('Prerequisites missing! Please ensure AdPriceSeeder, CitySeeder and AgencySeeder have been run.');
            return;
        }

        // Create 10 users and configure them as agents with ads
        User::factory()
            ->count(10)
            ->withAgentRole() // This state assigns the 'agent' role
            ->create()
            ->each(function (User $agentUser, $index) use ($adPrice, $cities, $agencies) {
                
                // Explicitly create the Agent record for the new User
                Agent::create([
                    'user_id' => $agentUser->id,
                    'full_name' => $agentUser->name,
                    'email' => $agentUser->email,
                    'city_id' => $cities->random(), // Assign a random city
                    'agent_type_id' => 1, // Assumes agent_type with ID 1 exists
                    'created_by' => $agentUser->id, // The user created themselves in this context
                    'agency_id' => $agencies[$index % $agencies->count()]->id,
                ]);

                // For each agent, create a random number of ads
                Ad::factory()
                    ->count(rand(2, 5))
                    ->create([
                        'user_id' => $agentUser->id,
                        'ad_price_id' => $adPrice->id,
                        'status' => 'active', // Make the seeded ads active
                    ]);
            });
            
        $this->command->info('Successfully seeded 10 agents with locations and multiple ads each.');
    }
}