<?php

namespace Database\Seeders;

use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\PatientIllness;
use App\Models\TreatmentPlan;
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

        DB::table('marital_statuses')
        ->insert([
            ['marital_status' => 'Single'],
            ['marital_status' => 'Married'],
            ['marital_status' => 'Seperated'],
            ['marital_status' => 'Widowed'],
        ]);

        DB::table('illnesses')
            ->insert([
                ["illness_name" => "Angina","illness_group" => 1],
                ["illness_name" => "Stroke","illness_group" => 1],
                ["illness_name" => "High Blood Pressure","illness_group" => 1],
                ["illness_name" => "Rheumatic Fever","illness_group" => 1],
                ["illness_name" => "Diabetes","illness_group" => 1],
                ["illness_name" => "Kidney Problems","illness_group" => 1],
                ["illness_name" => "Hepa A or B","illness_group" => 1],
                ["illness_name" => "Anemia","illness_group" => 1],
                ["illness_name" => "Excessive Bleeding","illness_group" => 1],
                ["illness_name" => "Ulcers","illness_group" => 1],
                ["illness_name" => "Asthma","illness_group" => 1],
                ["illness_name" => "TB","illness_group" => 1],
                ["illness_name" => "Emphysema","illness_group" => 1],
                ["illness_name" => "Rheumatic/Arthritis","illness_group" => 1],
                ["illness_name" => "Epilepsy","illness_group" => 1],
                ["illness_name" => "Malignancy Tumor or Growth","illness_group" => 1],
                ["illness_name" => "HIV","illness_group" => 1],
                ["illness_name" => "Thyroid Problem","illness_group" => 1],
                ["illness_name" => "Back Problems","illness_group" => 1],
                ["illness_name" => "Others","illness_group" => 1],
                ['illness_name' => 'Swollen, painful area in mouth',"illness_group" => 2],
                ['illness_name' => 'Bleeding, swollen',"illness_group" => 2],
                ['illness_name' => 'Prolonged bleeding after extraction',"illness_group" => 2],
                ['illness_name' => 'Dentures,braces or retainers',"illness_group" => 2],
                ['illness_name' => 'Food getting stuck between teeth',"illness_group" => 2],
                ['illness_name' => 'Bad taste or odor in mouth',"illness_group" => 2],
                ['illness_name' => 'Prolonged bleeding when wounded',"illness_group" => 2],
                ['illness_name' => 'Allergic reaction to anesthesia',"illness_group" => 2],
                ['illness_name' => 'Others',"illness_group" => 2],
            ]);

//        User::factory(1)->has(Patient::factory(20)->has(TreatmentPlan::factory(15)))->create();
        User::factory()->create();

    }
}
