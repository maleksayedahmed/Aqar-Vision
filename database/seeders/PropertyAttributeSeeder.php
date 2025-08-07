<?php

namespace Database\Seeders;

use App\Models\PropertyAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name' => ['en' => 'Internet', 'ar' => 'إنترنت'], 'type' => 'boolean'],
            ['name' => ['en' => 'Central AC', 'ar' => 'تكييف مركزي'], 'type' => 'boolean'],
            ['name' => ['en' => 'Parking', 'ar' => 'مواقف سيارات'], 'type' => 'boolean'],
            ['name' => ['en' => 'Pool', 'ar' => 'مسبح'], 'type' => 'boolean'],
            ['name' => ['en' => 'Elevator', 'ar' => 'مصعد'], 'type' => 'boolean'],
            ['name' => ['en' => 'Equipped Kitchen', 'ar' => 'مطبخ مجهز'], 'type' => 'boolean'],
            ['name' => ['en' => 'Security', 'ar' => 'أمن'], 'type' => 'boolean'],
            ['name' => ['en' => 'Garden', 'ar' => 'حديقة'], 'type' => 'boolean'],
            ['name' => ['en' => 'Age', 'ar' => 'عمر العقار'], 'type' => 'number'],
            ['name' => ['en' => 'Floor Number', 'ar' => 'رقم الدور'], 'type' => 'number'],
            ['name' => ['en' => 'Bathrooms', 'ar' => 'دورات المياة'], 'type' => 'number'],
            ['name' => ['en' => 'Rooms', 'ar' => 'عدد الغرف'], 'type' => 'number'],
            ['name' => ['en' => 'Finishing Status', 'ar' => 'حالة التشطيب'], 'type' => 'text'],
            ['name' => ['en' => 'Direction', 'ar' => 'جهة العقار'], 'type' => 'text'],
        ];

        foreach ($attributes as $attribute) {
            PropertyAttribute::create($attribute);
        }
    }
}