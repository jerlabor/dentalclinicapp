<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->boolean('is_care_of_physician');
            $table->boolean('hospitalized');
            $table->longText('hospitalized_reason')->nullable();
            $table->boolean('is_taking_medication');
            $table->longText('medications')->nullable();
            $table->boolean('allergic');
            $table->longText('allergy_details')->nullable();
            $table->boolean('smoke');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
