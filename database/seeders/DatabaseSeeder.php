<?php

namespace Database\Seeders;

use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\PatientIllness;
use App\Models\TreatmentPlan;
use App\Models\TreatmentPlanTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(1)
            ->has(Patient::factory(50))
//                ->has(TreatmentPlan::factory(15)->hasTransactions(10)))
            ->create();

    }
}
