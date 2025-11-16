<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => ['en' => 'Agent - Basic', 'ar' => 'وكيل - أساسي']],
            [
                'target_type' => 'agent',
                'price_monthly' => 29.99,
                'monthly_price' => 29.99,
                'yearly_price' => 299.99,
                'ads_regular' => 10,
                'ads_featured' => 2,
                'ads_premium' => 0,
                'ads_map' => 1,
                'description' => ['en' => 'Perfect for individual agents starting out.', 'ar' => 'مثالية للوكلاء الأفراد المبتدئين.'],
                'features' => ['10 Regular Ads', '2 Featured Ads', 'On Map'],
            ]
        );

        Plan::updateOrCreate(
            ['name' => ['en' => 'Agent - Pro', 'ar' => 'وكيل - محترف']],
            [
                'target_type' => 'agent',
                'price_monthly' => 59.99,
                'monthly_price' => 59.99,
                'yearly_price' => 599.99,
                'ads_regular' => 50,
                'ads_featured' => 10,
                'ads_premium' => 2,
                'ads_map' => 5,
                'description' => ['en' => 'For professional agents who need more listings.', 'ar' => 'للوكلاء المحترفين الذين يحتاجون إلى المزيد من الإعلانات.'],
                'features' => ['50 Regular Ads', '10 Featured Ads', '2 Premium Ads', '5 Ads on Map'],
            ]
        );

        Plan::updateOrCreate(
            ['name' => ['en' => 'Agency - Standard', 'ar' => 'وكالة - قياسية']],
            [
                'target_type' => 'agency',
                'price_monthly' => 199.99,
                'monthly_price' => 199.99,
                'yearly_price' => 1999.99,
                'ads_regular' => 200,
                'ads_featured' => 50,
                'ads_premium' => 10,
                'ads_map' => 20,
                'agent_seats' => 5,
                'description' => ['en' => 'Best for small to medium-sized agencies.', 'ar' => 'الأفضل للوكالات الصغيرة والمتوسطة الحجم.'],
                'features' => ['200 Regular Ads', '50 Featured Ads', '10 Premium Ads', '20 Ads on Map', '5 Agent Seats'],
            ]
        );
    }
}
