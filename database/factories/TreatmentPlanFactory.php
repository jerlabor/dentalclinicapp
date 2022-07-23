<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'treatment_process' => $this->faker->text(),
            'fee' => $this->faker->randomFloat(2,10,10000),
            'balance' => $this->faker->randomFloat(2,10,10000),
            'created_at' => $this->faker->dateTime()
        ];
    }
}
