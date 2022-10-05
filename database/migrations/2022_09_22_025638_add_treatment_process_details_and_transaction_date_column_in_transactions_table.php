<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTreatmentProcessDetailsAndTransactionDateColumnInTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatment_plan_transactions', function (Blueprint $table) {
            $table->longText('details')->nullable()->after('treatment_process');
            $table->timestamp('transaction_date')->default(now())->after('fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatment_plan_transactions', function (Blueprint $table) {
            $table->dropColumn('details');
            $table->dropColumn('transaction_date');
        });
    }
}
