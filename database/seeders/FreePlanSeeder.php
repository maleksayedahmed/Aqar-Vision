<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class FreePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => ['en' => 'Free Plan', 'ar' => 'خطة مجانية'],
            'target_type' => 'user',
            'price_monthly' => 0,
            'ads_regular' => 1,
            'ads_featured' => 0,
            'ads_premium' => 0,
            'ads_map' => 0,
            'agent_seats' => 0,
            'description' => ['en' => 'Free plan for new users', 'ar' => 'خطة مجانية للمستخدمين الجدد'],
        ]);
    }
}
