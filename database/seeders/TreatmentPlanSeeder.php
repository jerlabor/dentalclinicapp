<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\TreatmentPlan;
use Illuminate\Database\Seeder;

class TreatmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TreatmentPlan::factory()->count(20)->create();
    }
}
