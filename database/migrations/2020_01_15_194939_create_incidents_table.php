<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('region');
            $table->bigInteger('year');
            $table->string('month');
            $table->integer('number_of_death')->default(0);
            $table->integer('minimum_estimated_number_of_missing')->default(0);
            $table->integer('total_dead_and_missing')->default(0);
            $table->integer('number_of_survivors')->default(0);
            $table->string('cause_of_death');
            $table->string('location_description');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('incidents');
    }
}
