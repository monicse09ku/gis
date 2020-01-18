<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrivals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('year');
            $table->string('iso3');
            $table->string('country');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('country_from');
            $table->string('country_from_latitude');
            $table->string('country_from_longitude');
            $table->bigInteger('value');
            $table->string('percentage');
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
        Schema::dropIfExists('arrivals');
    }
}
