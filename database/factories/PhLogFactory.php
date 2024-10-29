<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhLogs>
 */
class PhLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phValue' =>rand(5,7),
            'pumpPhPlus' =>rand(0,1),
            'pumpPhMinus' =>rand(0,1),
            'ph_id'=>1
        ];
    }
}
