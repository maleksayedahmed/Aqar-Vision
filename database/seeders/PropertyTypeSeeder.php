<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => [
                    'ar' => 'فيلا',
                    'en' => 'Villa'
                ],
                'description' => [
                    'ar' => 'منزل مستقل مع حديقة',
                    'en' => 'Independent house with garden'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'شقة',
                    'en' => 'Apartment'
                ],
                'description' => [
                    'ar' => 'وحدة سكنية في مبنى متعدد الطوابق',
                    'en' => 'Residential unit in a multi-story building'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'أرض',
                    'en' => 'Land'
                ],
                'description' => [
                    'ar' => 'قطعة أرض فارغة',
                    'en' => 'Empty land plot'
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
            ],
            [
                'name' => [
                    'ar' => 'صناعي',
                    'en' => 'Industrial'
                ],
                'description' => [
                    'ar' => 'عقار مخصص للاستخدام الصناعي',
                    'en' => 'Property designated for industrial use'
                ],
                'is_active' => true
            ]
        ];

        foreach ($types as $type) {
            PropertyType::create($type);
        }
    }
} 