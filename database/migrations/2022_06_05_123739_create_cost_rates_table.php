<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id')->nullable();
            $table->string('sender_sub_district');
            $table->string('sender_city');
            $table->string('sender_province');
            $table->string('destination_sub_district');
            $table->string('destination_city');
            $table->string('destination_province');
            $table->double('weight');
            $table->string('ctg_type')->nullable();
            $table->double('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_rates');
    }
}
