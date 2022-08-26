<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentPlanTransactionFactory extends Factory
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
            'fee' => $this->faker->randomFloat(2,500,5000),
            'created_at' => now()->addDays($this->faker->numberBetween(1,100))
        ];
    }
}
