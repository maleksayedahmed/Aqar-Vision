<?php

namespace Database\Seeders;

use App\Models\PropertyPurpose;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertyPurposeSeeder extends Seeder
{
    public function run()
    {
        // Get the first user or create a default one
        $user = User::first();
        $createdBy = $user ? $user->id : null;

        $purposes = [
            [
                'name' => [
                    'en' => 'Residential',
                    'ar' => 'سكني'
                ],
                'description' => [
                    'en' => 'Properties intended for residential use',
                    'ar' => 'العقارات المخصصة للاستخدام السكني'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Commercial',
                    'ar' => 'تجاري'
                ],
                'description' => [
                    'en' => 'Properties intended for commercial use',
                    'ar' => 'العقارات المخصصة للاستخدام التجاري'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Industrial',
                    'ar' => 'صناعي'
                ],
                'description' => [
                    'en' => 'Properties intended for industrial use',
                    'ar' => 'العقارات المخصصة للاستخدام الصناعي'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Agricultural',
                    'ar' => 'زراعي'
                ],
                'description' => [
                    'en' => 'Properties intended for agricultural use',
                    'ar' => 'العقارات المخصصة للاستخدام الزراعي'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Investment',
                    'ar' => 'استثماري'
                ],
                'description' => [
                    'en' => 'Properties intended for investment purposes',
                    'ar' => 'العقارات المخصصة للأغراض الاستثمارية'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ]
        ];

        foreach ($purposes as $purpose) {
            PropertyPurpose::create($purpose);
        }
    }
} 