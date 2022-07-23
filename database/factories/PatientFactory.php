<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'suffix' => $this->faker->suffix(),
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->numberBetween(0, 1),
            'marital_status_id' => $this->faker->numberBetween(1,4),
            'height' => $this->faker->randomFloat(2,80,150),
            'weight' => $this->faker->randomFloat(2,40,200),
            'occupation' => $this->faker->jobTitle(),
            'telephone' => $this->faker->tollFreePhoneNumber(),
            'mobile_no' => $this->faker->phoneNumber(),
            'spouse' => $this->faker->name(),
            'remarks' => $this->faker->sentence()
        ];
    }
}
