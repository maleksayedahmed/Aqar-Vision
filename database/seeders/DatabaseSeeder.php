<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        $this->call([
            RoleAndPermissionSeeder::class,
            adminseeder::class,
            AgentTypeSeeder::class,
            LicenseTypeSeeder::class,
            PropertyPurposeSeeder::class,
            PropertyTypeSeeder::class,
            AdPriceSeeder::class,
            PlanSeeder::class,
            PropertySeeder::class,
            SubscriptionSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            PropertyAttributeSeeder::class,
            AgencyTypeSeeder::class,
            AgencySeeder::class,
            AgentSeeder::class,
        ]);

    }
}
