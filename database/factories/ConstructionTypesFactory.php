<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConstructionTypesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'construction_type' => 'Repair & Improvement of Campus Infirmary Phase - 2',
        //     'user_id' => 9,
        // ];

        return [
            'construction_type' => Str::random(25),
            'user_id' => random_int(5, 9),
            'status' => 1,
        ];
    }
}
