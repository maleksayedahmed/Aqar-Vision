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
            [
                'name' => ['en' => 'Internet', 'ar' => 'إنترنت'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Internet Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Central AC', 'ar' => 'تكييف مركزي'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Central Air Conditioning Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Parking', 'ar' => 'مواقف سيارات'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Parking Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Pool', 'ar' => 'مسبح'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Swimming Pool Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Elevator', 'ar' => 'مصعد'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Elevator Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Equipped Kitchen', 'ar' => 'مطبخ مجهز'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Equipped Kitchen Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Security', 'ar' => 'أمن'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Security Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Garden', 'ar' => 'حديقة'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/Garden Icon.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Gas Meter', 'ar' => 'عداد غاز'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/fire.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Electricity Meter', 'ar' => 'عداد كهربا'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/elect.svg'))
                ),
            ],
            [
                'name' => ['en' => 'Water Meter', 'ar' => 'عداد مياه'],
                'type' => 'boolean',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/water-pump.svg'))
                ),
            ],

            // ============================
            // Dropdown Attributes
            // ============================
            [
                'name' => ['en' => 'Finishing Status', 'ar' => 'حالة التشطيب'],
                'type' => 'dropdown',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/finishing.svg'))
                ),
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
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/direction.svg'))
                ),  
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
                'name' => ['en' => 'Rooms', 'ar' => 'عدد الغرف'],
                'type' => 'dropdown',
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/room.svg'))
                ),  
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
                'icon_path' => \Illuminate\Support\Facades\Storage::disk('public')->putFile(
                    'property-attribute-icons',
                    new \Illuminate\Http\File(public_path('images/bathroom.svg'))
                ),  
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