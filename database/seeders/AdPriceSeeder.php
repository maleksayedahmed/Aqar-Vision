<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdPrice;

class AdPriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [
            [
                'name' => [
                    'ar' => 'إعلان عادي',
                    'en' => 'Regular Ad'
                ],
                'price' => 50.00,
                'duration_days' => 30,
                'type' => 'regular',
                'description' => [
                    'ar' => 'إعلان عادي لمدة 30 يوم',
                    'en' => 'Regular ad for 30 days'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'إعلان مميز',
                    'en' => 'Featured Ad'
                ],
                'price' => 100.00,
                'duration_days' => 30,
                'type' => 'featured',
                'description' => [
                    'ar' => 'إعلان مميز لمدة 30 يوم مع ظهور في الصفحة الرئيسية',
                    'en' => 'Featured ad for 30 days with homepage visibility'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'إعلان مميز جداً',
                    'en' => 'Premium Ad'
                ],
                'price' => 200.00,
                'duration_days' => 30,
                'type' => 'premium',
                'description' => [
                    'ar' => 'إعلان مميز جداً لمدة 30 يوم مع ظهور في الصفحة الرئيسية وترتيب أول',
                    'en' => 'Premium ad for 30 days with homepage visibility and top ranking'
                ],
                'is_active' => true
            ]
        ];

        foreach ($prices as $price) {
            AdPrice::create($price);
        }
    }
} 