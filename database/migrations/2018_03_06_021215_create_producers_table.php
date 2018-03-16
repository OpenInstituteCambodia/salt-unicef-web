<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
           $table->increments('id');
            $table->string('facility_id');
            $table->dateTime('date_of_data');
            $table->dateTime('date_reported');
            $table->integer('quantity_salt_processed')->comment('Quantity of salt processed in that day (Kg.)');
            $table->integer('quantity_potassium_iodate')->comment('Quantity of potassium iodate used in that day (Kg.)');
            $table->integer('stock_potassium')->comment('Stock of potassium at the end of that day (Kg.)');
            $table->integer('measurement_1');
            $table->integer('measurement_2');
            $table->integer('measurement_3');
            $table->integer('measurement_4');
            $table->integer('measurement_5');
            $table->integer('measurement_6');
            $table->integer('measurement_7');
            $table->integer('measurement_8');
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
        Schema::dropIfExists('producers');
    }
}
