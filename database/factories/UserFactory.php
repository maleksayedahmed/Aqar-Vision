<?php

namespace Database\Factories;

use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_active' => true, // Make sure seeded users are active
            'phone' => fake()->unique()->e164PhoneNumber(), // Use a more realistic phone number format
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the model factory.
     * NEW METHOD: Assigns the 'user' role by default after creating a user.
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Assign the default 'user' role if no other role has been assigned.
            if ($user->roles->isEmpty()) {
                $user->assignRole('user');
            }
        });
    }

    /**
     * NEW STATE: A state to easily create a user with the 'agent' role.
     */
    public function withAgentRole(): Factory
    {
        return $this->afterCreating(function (User $user) {
            // Find the agent role, create it if it doesn't exist for safety.
            $agentRole = Role::firstOrCreate(['name' => 'agent', 'guard_name' => 'web']);
            $user->syncRoles($agentRole); // syncRoles is safer than assignRole here
        });
    }
}