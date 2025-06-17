<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentType;

class AgentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $agentTypes = [
            [
                'name' => [
                    'ar' => 'مسوق',
                    'en' => 'Marketer'
                ],
                'description' => [
                    'ar' => 'مسوق عقاري متخصص في تسويق العقارات',
                    'en' => 'Real estate marketer specialized in property marketing'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'وسيط',
                    'en' => 'Broker'
                ],
                'description' => [
                    'ar' => 'وسيط عقاري يربط بين البائع والمشتري',
                    'en' => 'Real estate broker connecting sellers and buyers'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'مالك',
                    'en' => 'Owner'
                ],
                'description' => [
                    'ar' => 'مالك عقار يريد عرضه للبيع أو التأجير',
                    'en' => 'Property owner looking to sell or rent their property'
                ],
                'is_active' => true
            ],
            [
                'name' => [
                    'ar' => 'وكيل',
                    'en' => 'Agent'
                ],
                'description' => [
                    'ar' => 'وكيل عقاري معتمد ومرخص',
                    'en' => 'Licensed and certified real estate agent'
                ],
                'is_active' => true
            ]
        ];

        foreach ($agentTypes as $agentType) {
            AgentType::create($agentType);
        }
    }
} 