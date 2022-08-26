<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_statuses')
            ->insert([
                ['marital_status' => 'Single'],
                ['marital_status' => 'Married'],
                ['marital_status' => 'Separated'],
                ['marital_status' => 'Widowed'],
            ]);
    }
}
