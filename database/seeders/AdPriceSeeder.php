<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdPrice;

class AdPriceSeeder extends Seeder
{
    public function run(): void
    {
        // Clear the table first to avoid duplicates when re-seeding
        AdPrice::query()->delete();

        $prices = [
            [
                'name' => ['ar' => 'إعلان عادي', 'en' => 'Regular Ad'],
                'price' => 50.00,
                'duration_days' => 30,
                'type' => 'regular',
                'description' => ['ar' => 'إعلان عادي لمدة 30 يوم', 'en' => 'Regular ad for 30 days'],
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile('ad-price-icons', new \Illuminate\Http\File(public_path('images/normal ad.png'))),
                'is_active' => true
            ],
            [
                'name' => ['ar' => 'إعلان مميز', 'en' => 'Featured Ad'],
                'price' => 100.00,
                'duration_days' => 30,
                'type' => 'featured',
                'description' => ['ar' => 'إعلان مميز لمدة 30 يوم مع ظهور في الصفحة الرئيسية', 'en' => 'Featured ad for 30 days with homepage visibility'],
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile('ad-price-icons', new \Illuminate\Http\File(public_path('images/second ad.png'))),
                'is_active' => true
            ],
            [
                'name' => ['ar' => 'إعلان استثنائي', 'en' => 'Premium Ad'], // Changed name for clarity
                'price' => 200.00,
                'duration_days' => 30,
                'type' => 'premium',
                'description' => ['ar' => 'إعلان استثنائي لمدة 30 يوم مع ظهور في الصفحة الرئيسية وترتيب أول', 'en' => 'Premium ad for 30 days with homepage visibility and top ranking'],
                'icon_path' => public_path('images/diamond ad.png'), // Icon for premium ad
                'is_active' => true
            ]
        ];

        foreach ($prices as $price) {
            AdPrice::create($price);
        }
    }
}