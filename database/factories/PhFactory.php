<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ph>
 */
class PhFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'noSerie' =>rand(1,1000),
            'dateActivation' => $this->faker->dateTime(),
            'firstConnect' =>$this->faker->dateTime(),
            'versionSoftware' =>rand(1,3),
            'limitSupp' =>rand(1,4),
            'limitInf' =>rand(1,4),
            'volumeTotal' =>rand(100,200),
            'deltaPh' =>rand(10,12),
            'volumeSolution' =>rand(5,10),
            'volumeInstruction' =>rand(5,10),
            'comment'=>'blablabla',
            'state'=>1,
            'boitier_id' => 1,
        ];
    }
}
