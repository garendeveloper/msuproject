<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $username = fake()->name(); 

        return [
            'department_id' => 3,
            'designated_id' => random_int(2, 6),
            'name' => $username,
            'username' => $username,
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('jobrequestor'), // password
            'remember_token' => Str::random(10),
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
