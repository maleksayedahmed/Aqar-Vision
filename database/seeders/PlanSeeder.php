<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::create([
            'name' => ['en' => 'Agent - Basic', 'ar' => 'وكيل - أساسي'],
            'target_type' => 'agent',
            'price_monthly' => 29.99,
            'ads_regular' => 10,
            'ads_featured' => 2,
            'ads_premium' => 0,
            'ads_map' => 1,
            'description' => ['en' => 'Perfect for individual agents starting out.', 'ar' => 'مثالية للوكلاء الأفراد المبتدئين.'],
        ]);

        Plan::create([
            'name' => ['en' => 'Agent - Pro', 'ar' => 'وكيل - محترف'],
            'target_type' => 'agent',
            'price_monthly' => 59.99,
            'ads_regular' => 50,
            'ads_featured' => 10,
            'ads_premium' => 2,
            'ads_map' => 5,
            'description' => ['en' => 'For professional agents who need more listings.', 'ar' => 'للوكلاء المحترفين الذين يحتاجون إلى المزيد من الإعلانات.'],
        ]);

        Plan::create([
            'name' => ['en' => 'Agency - Standard', 'ar' => 'وكالة - قياسية'],
            'target_type' => 'agency',
            'price_monthly' => 199.99,
            'ads_regular' => 200,
            'ads_featured' => 50,
            'ads_premium' => 10,
            'ads_map' => 20,
            'agent_seats' => 5,
            'description' => ['en' => 'Best for small to medium-sized agencies.', 'ar' => 'الأفضل للوكالات الصغيرة والمتوسطة الحجم.'],
        ]);
    }
}
