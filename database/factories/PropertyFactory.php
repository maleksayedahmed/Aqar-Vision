<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Property;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get all available district IDs once to be efficient
        $districtIds = District::pluck('id');
        $userIds = User::pluck('id');
        $propertyTypeIds = PropertyType::pluck('id');
        $purposeIds = PropertyPurpose::pluck('id');

        return [
            'title' => 'فيلا مميزة في ' . $this->faker->streetName(), // More realistic title
            'description' => $this->faker->paragraph(5),
            
            // Assign a random, existing district_id
            'district_id' => $districtIds->isEmpty() ? null : $districtIds->random(),

            'street_width' => $this->faker->numberBetween(10, 40),
            'facade' => $this->faker->randomElement(['شمال', 'جنوب', 'شرق', 'غرب']),
            'area_sq_meters' => $this->faker->numberBetween(200, 1200),
            'purpose_id' => $purposeIds->isEmpty() ? null : $purposeIds->random(),
            'total_price' => $this->faker->numberBetween(500000, 5000000),
            'property_type_id' => $propertyTypeIds->isEmpty() ? null : $propertyTypeIds->random(),
            'age_years' => $this->faker->numberBetween(0, 30),
            
            // CORRECTED: Use values that match the ENUM in the migration
            'listing_purpose' => $this->faker->randomElement(['sale', 'rent']), 
            
            'contact_number' => $this->faker->e164PhoneNumber(),
            'status' => 'available',
            'list_date' => now(),
            'user_id' => $userIds->isEmpty() ? null : $userIds->random(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Property $property) {
            // After creating the property, download a random image and attach it.
            try {
                // Use an external service to get a random house image
                $imageUrl = 'https://picsum.photos/800/600?random=' . rand(1, 1000);
                
                // Add the image to the 'images' media collection using Spatie MediaLibrary
                $property->addMediaFromUrl($imageUrl)
                         ->toMediaCollection('images');
            } catch (\Exception $e) {
                // If the image download fails, just log it and continue.
                // This prevents the seeder from crashing if the image service is down.
                info('Could not attach image to property ID ' . $property->id . ': ' . $e->getMessage());
            }
        });
    }
}