<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producer_id');
            $table->tinyInteger('at_producer_site')->comment('1:Yes;0:No');
            $table->string('location')->comment("[string] Location of monitoring, if not at producer's site");
            $table->string('Coord_X');
            $table->string('Coord_Y');
            $table->string('Latitude');
            $table->string('Longitude');
            $table->integer('measurement');
            $table->tinyInteger('warning')->comment('0:No action;1:Warning given to producer');
            $table->dateTime('date_of_visit')->comment('date of measurement');
            $table->dateTime('date_of_follow_up')->comment('date of follow up visit');
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
        Schema::dropIfExists('monitors');
    }
}
