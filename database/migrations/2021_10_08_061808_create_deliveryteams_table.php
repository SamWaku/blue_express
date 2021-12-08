<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryteams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->string('INumber');
            $table->string('Address');
            $table->string('Phone');
            $table->string('Email');
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
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
        Schema::dropIfExists('deliveryteams');
    }
}
