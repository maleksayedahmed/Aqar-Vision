<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view properties',
            'create properties',
            'edit properties',
            'delete properties',
            'manage agencies',
            'manage users',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
            $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

            $agentRole = Role::firstOrCreate(['name' => 'agent', 'guard_name' => 'web']);
        $agentRole->givePermissionTo([
            'view properties',
            'create properties',
            'edit properties',
        ]);

        // Agency role: can manage its properties and agencies
            $agencyRole = Role::firstOrCreate(['name' => 'agency', 'guard_name' => 'web']);
            $agencyRole->givePermissionTo([
                'view properties',
                'create properties',
                'edit properties',
                'manage agencies',
            ]);

            $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $userRole->givePermissionTo([
            'view properties',
        ]);
    }
} 