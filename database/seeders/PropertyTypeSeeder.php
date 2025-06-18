<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run()
    {
        // Get the first user or create a default one
        $user = User::first();
        $createdBy = $user ? $user->id : null;

        $types = [
            [
                'name' => [
                    'en' => 'Apartment',
                    'ar' => 'شقة'
                ],
                'description' => [
                    'en' => 'A self-contained housing unit in a building',
                    'ar' => 'وحدة سكنية مستقلة في مبنى'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Villa',
                    'ar' => 'فيلا'
                ],
                'description' => [
                    'en' => 'A large house, typically one with multiple floors',
                    'ar' => 'منزل كبير، عادة ما يكون متعدد الطوابق'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Townhouse',
                    'ar' => 'بيت متلاصق'
                ],
                'description' => [
                    'en' => 'A house that is one of a row of similar houses',
                    'ar' => 'منزل واحد من صف من المنازل المتشابهة'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Office',
                    'ar' => 'مكتب'
                ],
                'description' => [
                    'en' => 'A room or set of rooms where business is conducted',
                    'ar' => 'غرفة أو مجموعة غرف حيث يتم إجراء الأعمال التجارية'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Shop',
                    'ar' => 'محل'
                ],
                'description' => [
                    'en' => 'A building or part of a building where goods are sold',
                    'ar' => 'مبنى أو جزء من مبنى حيث يتم بيع السلع'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Warehouse',
                    'ar' => 'مستودع'
                ],
                'description' => [
                    'en' => 'A large building for storing goods',
                    'ar' => 'مبنى كبير لتخزين البضائع'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ],
            [
                'name' => [
                    'en' => 'Land',
                    'ar' => 'أرض'
                ],
                'description' => [
                    'en' => 'A plot of land available for development',
                    'ar' => 'قطعة أرض متاحة للتطوير'
                ],
                'is_active' => true,
                'created_by' => $createdBy
            ]
        ];

        foreach ($types as $type) {
            PropertyType::create($type);
        }
    }
} 