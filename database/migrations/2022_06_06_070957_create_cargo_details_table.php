<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_details', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_id')->index();
            $table->integer('user_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->string('delivery_status');
            $table->text('description');
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
        Schema::dropIfExists('cargo_details');
    }
}
