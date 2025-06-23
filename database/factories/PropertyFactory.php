<?php

namespace Database\Factories;

use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'city' => $this->faker->city(),
            'neighborhood' => $this->faker->streetName(),
            'street_width' => $this->faker->numberBetween(10, 40),
            'facade' => $this->faker->randomElement(['North', 'South', 'East', 'West']),
            'area_sq_meters' => $this->faker->numberBetween(100, 1000),
            'purpose_id' => PropertyPurpose::inRandomOrder()->first()->id,
            'total_price' => $this->faker->numberBetween(100000, 2000000),
            'property_type_id' => PropertyType::inRandomOrder()->first()->id,
            'age_years' => $this->faker->numberBetween(0, 50),
            'listing_purpose' => $this->faker->randomElement(['sale', 'rent']),
            'contact_number' => $this->faker->phoneNumber(),
            'status' => 'available',
            'list_date' => now(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
