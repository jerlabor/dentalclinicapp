<?php

namespace Database\Factories;

use App\Models\Patient;
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
            'patient_id' => Patient::all()->random(),
            'status_id' => 2,
            'treatment' => $this->faker->sentence(),
            'total_fee' => $this->faker->randomFloat(2,20000,50000),
            'created_at' => $this->faker->dateTime()
        ];
    }
}
