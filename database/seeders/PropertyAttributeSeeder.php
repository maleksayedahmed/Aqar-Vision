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
        // It's good practice to clear the table before seeding to prevent duplicates.
        PropertyAttribute::query()->delete();

        $attributes = [
            // ============================
            // Boolean (Checkbox) Attributes
            // ============================
            ['name' => ['en' => 'Internet', 'ar' => 'إنترنت'], 'type' => 'boolean'],
            ['name' => ['en' => 'Central AC', 'ar' => 'تكييف مركزي'], 'type' => 'boolean'],
            ['name' => ['en' => 'Parking', 'ar' => 'مواقف سيارات'], 'type' => 'boolean'],
            ['name' => ['en' => 'Pool', 'ar' => 'مسبح'], 'type' => 'boolean'],
            ['name' => ['en' => 'Elevator', 'ar' => 'مصعد'], 'type' => 'boolean'],
            ['name' => ['en' => 'Equipped Kitchen', 'ar' => 'مطبخ مجهز'], 'type' => 'boolean'],
            ['name' => ['en' => 'Security', 'ar' => 'أمن'], 'type' => 'boolean'],
            ['name' => ['en' => 'Garden', 'ar' => 'حديقة'], 'type' => 'boolean'],

            // ============================
            // Dropdown Attributes
            // ============================
            [
                'name' => ['en' => 'Finishing Status', 'ar' => 'حالة التشطيب'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => 'Fully Finished', 'ar' => 'تشطيب كامل'],
                    ['en' => 'Semi Finished', 'ar' => 'نصف تشطيب'],
                    ['en' => 'Without Finishing', 'ar' => 'بدون تشطيب'],
                    ['en' => 'Deluxe', 'ar' => 'فاخر'],
                ]
            ],
            [
                'name' => ['en' => 'Direction', 'ar' => 'جهة العقار'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => 'North', 'ar' => 'شمال'],
                    ['en' => 'South', 'ar' => 'جنوب'],
                    ['en' => 'East', 'ar' => 'شرق'],
                    ['en' => 'West', 'ar' => 'غرب'],
                    ['en' => 'Northeast', 'ar' => 'شمال شرق'],
                    ['en' => 'Northwest', 'ar' => 'شمال غرب'],
                    ['en' => 'Southeast', 'ar' => 'جنوب شرق'],
                    ['en' => 'Southwest', 'ar' => 'جنوب غرب'],
                ]
            ],
            [
                'name' => ['en' => 'Property Age', 'ar' => 'عمر العقار'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => 'New', 'ar' => 'جديد'],
                    ['en' => 'Less than a year', 'ar' => 'أقل من سنة'],
                    ['en' => '1 Year', 'ar' => 'سنة'],
                    ['en' => '2 Years', 'ar' => 'سنتان'],
                    ['en' => '3 Years', 'ar' => '3 سنوات'],
                    ['en' => '4 Years', 'ar' => '4 سنوات'],
                    ['en' => '5 Years', 'ar' => '5 سنوات'],
                    ['en' => 'More than 5 years', 'ar' => 'أكثر من 5 سنوات'],
                ]
            ],
            [
                'name' => ['en' => 'Floor Number', 'ar' => 'رقم الدور'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => 'Ground Floor', 'ar' => 'الدور الأرضي'],
                    ['en' => 'First Floor', 'ar' => 'الدور الأول'],
                    ['en' => 'Second Floor', 'ar' => 'الدور الثاني'],
                    ['en' => 'Third Floor', 'ar' => 'الدور الثالث'],
                    ['en' => 'Fourth Floor', 'ar' => 'الدور الرابع'],
                    ['en' => 'Fifth Floor or higher', 'ar' => 'الدور الخامس أو أعلى'],
                    ['en' => 'Rooftop', 'ar' => 'السطح'],
                ]
            ],
            [
                'name' => ['en' => 'Rooms', 'ar' => 'عدد الغرف'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => '1', 'ar' => '1'],
                    ['en' => '2', 'ar' => '2'],
                    ['en' => '3', 'ar' => '3'],
                    ['en' => '4', 'ar' => '4'],
                    ['en' => '5', 'ar' => '5'],
                    ['en' => 'More than 5', 'ar' => 'أكثر من 5'],
                ]
            ],
            [
                'name' => ['en' => 'Bathrooms', 'ar' => 'دورات المياه'],
                'type' => 'dropdown',
                'choices' => [
                    ['en' => '1', 'ar' => '1'],
                    ['en' => '2', 'ar' => '2'],
                    ['en' => '3', 'ar' => '3'],
                    ['en' => '4', 'ar' => '4'],
                    ['en' => 'More than 4', 'ar' => 'أكثر من 4'],
                ]
            ],
        ];

        foreach ($attributes as $attributeData) {
            PropertyAttribute::create($attributeData);
        }
    }
}