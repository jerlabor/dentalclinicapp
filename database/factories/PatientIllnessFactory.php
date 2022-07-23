<?php

namespace Database\Factories;

use App\Models\Illness;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientIllnessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'illness_id' => Illness::where('illness_group',1)->get()->random()->id,
            'illness_details' => $this->faker->sentence()
        ];
    }
}
