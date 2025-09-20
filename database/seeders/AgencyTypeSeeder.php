<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgencyType;

class AgencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgencyType::create([
            'name' => 'Real Estate Development',
            'description' => 'Companies that buy land and build properties to sell.',
            'is_active' => true,
        ]);

        AgencyType::create([
            'name' => 'Brokerage',
            'description' => 'Firms that employ real estate agents to represent buyers and sellers.',
            'is_active' => true,
        ]);
    }
}
