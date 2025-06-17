<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyPurpose;

class PropertyPurposeSeeder extends Seeder
{
    public function run(): void
    {
        $purposes = [
            [
                'name' => [
                    'ar' => 'سكني',
                    'en' => 'Residential'
                ],
                'description' => [
                    'ar' => 'عقار مخصص للسكن',
                    'en' => 'Property designated for residential use'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'تجاري',
                    'en' => 'Commercial'
                ],
                'description' => [
                    'ar' => 'عقار مخصص للاستخدام التجاري',
                    'en' => 'Property designated for commercial use'
                ],
                'is_active' => true
            ]
        ];

        foreach ($purposes as $purpose) {
            PropertyPurpose::create($purpose);
        }
    }
} 