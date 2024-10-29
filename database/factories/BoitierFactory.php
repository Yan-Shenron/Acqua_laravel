<?php

namespace Database\Factories;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BoitierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'noSerie' =>rand(1,1000),
            'dateActivation' => $this->faker->dateTime(),
            'firstConnect' =>$this->faker->dateTime(),
            'lastUpdate' => $this->faker->dateTime(),
            'lastMoved' =>$this->faker->dateTime(),
            'ConnectionTimeLimit' =>rand(1,4),
            'versionSoftware' =>rand(1,3),
            'language' =>rand(1,4),
            'comment' =>$this->faker->text(),
            'state' =>rand(0,1),
            'isOpen' =>rand(0,1),
            'phModule' =>rand(0,1),
            'hasGsm' =>rand(0,1),
            'modeBoost' =>rand(0,1),
            'address' => $this->faker->streetName(),
            'postcode' => $this->faker->postcode(),
            'city' => $this->faker->cityPrefix(),
            'country' => $this->faker->country(),
            // 'user_id' => 1,

        ];
    }
}
