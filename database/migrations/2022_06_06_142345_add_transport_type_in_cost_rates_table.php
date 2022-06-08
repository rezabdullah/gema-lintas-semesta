<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransportTypeInCostRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_rates', function (Blueprint $table) {
            $table->string('transport_type')->default('DARAT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_rates', function (Blueprint $table) {
            $table->dropColumn('transport_type');
        });
    }
}
