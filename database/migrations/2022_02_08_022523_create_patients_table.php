<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birth_date');
            $table->longText('address');
            $table->boolean('gender');
            $table->unsignedTinyInteger('marital_status_id');
            $table->decimal('height');
            $table->decimal('weight');
            $table->string('occupation');
            $table->string('telephone')->nullable();
            $table->string('mobile_no');
            $table->string('spouse')->nullable();
            $table->longText('remarks');
            $table->timestamps();
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
