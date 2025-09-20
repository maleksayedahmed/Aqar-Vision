<?php

namespace Database\Factories;

use App\Models\AdPrice;
use App\Models\District;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\PropertyAttribute;
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


        // --- START: Features / Attributes Generation ---
        $features = [];

        // Load attributes from the database
        $booleanAttributes = PropertyAttribute::where('type', 'boolean')->get();
        $dropdownAttributes = PropertyAttribute::where('type', '!=', 'boolean')->get();

        // Build slugs for boolean attributes and pick a random subset
        $boolSlugs = $booleanAttributes->map(function ($attr) {
            $label = method_exists($attr, 'getTranslation') ? $attr->getTranslation('name', 'en') : ($attr->name['en'] ?? ($attr->name ?? ''));
            return str_replace(' ', '_', strtolower($label));
        })->toArray();

        if (!empty($boolSlugs)) {
            $pickCount = rand(0, count($boolSlugs));
            $picked = $this->faker->randomElements($boolSlugs, $pickCount);
            foreach ($picked as $slug) {
                $features[$slug] = 1; // checked
            }
        }

        // For dropdown attributes, assign a random valid choice (use the English value stored in choices)
        foreach ($dropdownAttributes as $attr) {
            $label = method_exists($attr, 'getTranslation') ? $attr->getTranslation('name', 'en') : ($attr->name['en'] ?? ($attr->name ?? ''));
            $slug = str_replace(' ', '_', strtolower($label));
            $choices = is_array($attr->choices) ? $attr->choices : (is_string($attr->choices) ? json_decode($attr->choices, true) : null);
            if (is_array($choices) && count($choices) > 0) {
                $choice = $this->faker->randomElement($choices);
                // Prefer the 'en' value, otherwise take the first available value
                $value = $choice['en'] ?? (reset($choice) ?: null);
                if ($value !== null) $features[$slug] = $value;
            }
        }

        // --- END: Features / Attributes Generation ---


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
        
            // Location Details
            'province' => $this->faker->city(),
            'street_name' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(24.5, 24.8),
            'longitude' => $this->faker->longitude(46.5, 46.8),

            // Media Paths (as JSON arrays)
            'images' => $uploadedImagePaths,
            'video_path' => null,
            'features' => $features,
        ];
    }
}