<?php

namespace Database\Seeders;

use App\Models\MedicalHistory;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Patient::factory(50)->hasMedicalHistories(1)->create();
    }
}
