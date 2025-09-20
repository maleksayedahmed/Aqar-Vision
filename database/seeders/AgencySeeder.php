<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agency;
use App\Models\AgencyType;
use App\Models\User;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencyType1 = AgencyType::first();
        $agencyType2 = AgencyType::skip(1)->first();

        $user1 = User::factory()->create([
            'name' => 'Modern Real Estate',
            'email' => 'agency1@example.com',
        ]);

        Agency::create([
            'user_id' => $user1->id,
            'agency_name' => 'Modern Real Estate',
            'agency_type_id' => $agencyType1->id,
            'phone_number' => '123456789',
            'email' => $user1->email,
        ]);

        $user2 = User::factory()->create([
            'name' => 'Future Properties',
            'email' => 'agency2@example.com',
        ]);

        Agency::create([
            'user_id' => $user2->id,
            'agency_name' => 'Future Properties',
            'agency_type_id' => $agencyType2->id,
            'phone_number' => '987654321',
            'email' => $user2->email,
        ]);
    }
}
