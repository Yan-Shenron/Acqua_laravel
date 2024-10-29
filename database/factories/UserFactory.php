<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'firstname' => $this->faker->firstname(),
            'phone1' => $this->faker->PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'number' => rand(1,99),
            'address' => $this->faker->streetName(),
            'postcode' => $this->faker->postcode(),
            'city' => $this->faker->cityPrefix(),
            'country' => $this->faker->country(),
            'company' => Str::random(10),
            'website' => Str::random(10).'.com',
            'maintenance' => rand(0,1),
            'remember_token' => Str::random(10),
            'role_id'=> rand(1,5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
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
