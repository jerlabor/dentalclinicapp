<?php

namespace Database\Factories;

use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Physician;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hospitalized = $this->faker->boolean();
        $isTakingMedication = $this->faker->boolean();
        $allergic = $this->faker->boolean();

        return [
            'is_care_of_physician' => $this->faker->boolean(),
            'hospitalized' => $hospitalized,
            'hospitalized_reason' => $hospitalized ? $this->faker->sentence() : null,
            'is_taking_medication' => $isTakingMedication,
            'medications' => $isTakingMedication ? $this->faker->sentence() : null,
            'allergic' => $allergic,
            'allergy_details' => $allergic ? $this->faker->sentence() : null,
            'smoke' => $this->faker->boolean(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (MedicalHistory $medicalHistory) {
            //
        })->afterCreating(function (MedicalHistory $medicalHistory) {
             $medicalHistory->is_care_of_physician && Physician::factory(1)->create(['medical_history_id' => $medicalHistory->id]);

        });
    }
}
