<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('partner_id')->unsigned();
            $table->integer('cost_rate_id')->unsigned();
            $table->text('package_description');
            $table->integer('quantity');
            $table->double('weight');
            $table->double('price');
            $table->double('total_price');
            $table->text('sender_address');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->text('recipient_address');
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
        Schema::dropIfExists('cargos');
    }
}
