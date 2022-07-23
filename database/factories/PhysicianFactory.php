<?php

namespace Database\Factories;

use App\Models\MedicalHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'physician_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'months_attended' => $this->faker->numberBetween(1,50),
            'contact_no' => $this->faker->phoneNumber(),
        ];
    }
}
