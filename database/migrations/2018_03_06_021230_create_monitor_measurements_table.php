<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monitor_id')->nullable();
            $table->integer('facility_id')->nullable();
            $table->tinyInteger('at_producer_site')->comment('1:Yes;0:No')->default(0);
            $table->string('location')->nullable()->comment("[string] Location of monitoring, if not at producer's site");
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('measurement')->nullable();
            $table->tinyInteger('warning')->nullable()->comment('0:No action;1:Warning given to producer');
            $table->dateTime('date_of_visit')->comment('date of measurement');
            $table->dateTime('date_of_follow_up')->nullable()->comment('date of follow up visit');
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
        Schema::dropIfExists('monitor_measurements');
    }
}
