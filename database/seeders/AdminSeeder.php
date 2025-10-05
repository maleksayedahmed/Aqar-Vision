<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $user = User::firstOrCreate(
            // --- Attributes to find the user by ---
            ['email' => 'test@example.com'],

            // --- Attributes to use if creating a new user ---
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // You must provide a password when creating
            ]
        );

        // Assign the 'admin' role to the user
        $user->assignRole('admin');
    }
}
