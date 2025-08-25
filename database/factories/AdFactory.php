<?php

namespace Database\Factories;

use App\Models\AdPrice;
use App\Models\District;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage; // <-- 1. IMPORT STORAGE FACADE

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

        // --- START: Image Handling Logic ---

        // 2. Define your source images
        $sourceImages = [
            'property1.png', 'property2.png', 'property3.png',
            'property4.png', 'property5.png', 'property6.png', 'property7.png'
        ];

        $uploadedImagePaths = [];

        // 3. Ensure the destination directory exists in storage/app/public/ads/images
        Storage::disk('public')->makeDirectory('ads/images');

        // 4. Loop through each source image, copy it to storage with a unique name
        foreach ($sourceImages as $imageName) {
            $sourcePath = public_path('images/' . $imageName);

            // Make sure the source file actually exists before trying to copy it
            if (file_exists($sourcePath)) {
                $newFileName = uniqid() . '-' . $imageName;
                
                // Copy the file from public/images to storage/app/public/ads/images
                Storage::disk('public')->put(
                    'ads/images/' . $newFileName,
                    file_get_contents($sourcePath)
                );

                // Store the new relative path for the database
                $uploadedImagePaths[] = 'ads/images/' . $newFileName;
            }
        }
        
        // 5. Shuffle the array to make the "thumbnail" (the first image) random
        shuffle($uploadedImagePaths);

        // --- END: Image Handling Logic ---


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
            'title' => 'فيلا للبيع في حي ' . $this->faker->words(2, true),
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
            'images' => $uploadedImagePaths, 
            'video_path' => null,
            'features' => [],
        ];
    }
}