<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LicenseType;

class LicenseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $licenseTypes = [
            [
                'name' => [
                    'ar' => 'رخصة فال',
                    'en' => 'Valuation License'
                ],
                'description' => [
                    'ar' => 'رخصة لتقييم العقارات وتقدير قيمتها',
                    'en' => 'License for property valuation and appraisal'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'رخصة وساطة',
                    'en' => 'Brokerage License'
                ],
                'description' => [
                    'ar' => 'رخصة للوساطة العقارية بين البائع والمشتري',
                    'en' => 'License for real estate brokerage between seller and buyer'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'رخصة تسويق',
                    'en' => 'Marketing License'
                ],
                'description' => [
                    'ar' => 'رخصة لتسويق العقارات وترويجها',
                    'en' => 'License for real estate marketing and promotion'
                ],
                'is_active' => true
            ]
        ];

        foreach ($licenseTypes as $licenseType) {
            LicenseType::create($licenseType);
        }
    }
} 