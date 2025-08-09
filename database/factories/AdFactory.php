<?php

namespace Database\Factories;

use App\Models\AdPrice;
use App\Models\District;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get all available IDs once to be efficient
        $userIds = User::pluck('id');
        $propertyTypeIds = PropertyType::whereNull('parent_id')->pluck('id');
        $districtIds = District::pluck('id');
        $adPriceIds = AdPrice::pluck('id');

        return [
            // Foreign Keys
            'user_id' => $userIds->random(),
            'ad_price_id' => $adPriceIds->random(),
            'property_type_id' => $propertyTypeIds->random(),
            'district_id' => $districtIds->random(),

            // Ad Status
            'status' => $this->faker->randomElement(['pending', 'active', 'rejected']),
            'expires_at' => now()->addDays(30),

            // Property Details
            'title' => 'إعلان عقار مميز: ' . $this->faker->words(3, true),
            'description' => $this->faker->paragraph(4),
            'listing_purpose' => $this->faker->randomElement(['sale', 'rent']),
            'total_price' => $this->faker->numberBetween(250000, 4000000),
            'area_sq_meters' => $this->faker->numberBetween(150, 800),
            'age_years' => $this->faker->numberBetween(0, 20),
            'rooms' => $this->faker->numberBetween(2, 7),
            'bathrooms' => $this->faker->numberBetween(2, 5),
            'floor_number' => $this->faker->numberBetween(0, 10),
            'finishing_status' => $this->faker->randomElement(['جديد', 'مستخدم', 'تم تجديده']),
            'facade' => $this->faker->randomElement(['شمال', 'جنوب', 'شرق', 'غرب']),

            // Location Details
            'province' => $this->faker->city(),
            'street_name' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(24.5, 24.8),
            'longitude' => $this->faker->longitude(46.5, 46.8),

            // Additional Details
            'property_usage' => 'سكني',
            'plan_number' => $this->faker->bothify('#####'),
            'is_mortgaged' => $this->faker->boolean(),
            'furniture_status' => $this->faker->randomElement(['مفروش', 'غير مفروش', 'مفروش جزئياً']),
            'building_status' => 'جاهز',
            'building_number' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode(),

            // Media Paths (as JSON arrays)
            'images' => [],
            'video_path' => null,
            'features' => [],
        ];
    }
}