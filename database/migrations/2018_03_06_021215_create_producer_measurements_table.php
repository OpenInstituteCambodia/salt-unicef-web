<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducerMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producer_measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facility_id')->nullable();
            $table->dateTime('date_of_data')->comment('date of measurement');
            $table->dateTime('date_reported')->default(\DB::raw('CURRENT_TIMESTAMP'))->comment('date of record is inserted)');
            $table->integer('quantity_salt_processed')->comment('Quantity of salt processed in that day (Kg.)');
            $table->integer('quantity_potassium_iodate')->comment('Quantity of potassium iodate used in that day (Kg.)');
            $table->integer('stock_potassium')->comment('Stock of potassium at the end of that day (Kg.)');
            $table->integer('measurement_1');
            $table->integer('measurement_2')->nullable()->default(NULL);
            $table->integer('measurement_3')->nullable()->default(NULL);
            $table->integer('measurement_4')->nullable()->default(NULL);
            $table->integer('measurement_5')->nullable()->default(NULL);
            $table->integer('measurement_6')->nullable()->default(NULL);
            $table->integer('measurement_7')->nullable()->default(NULL);
            $table->integer('measurement_8')->nullable()->default(NULL);
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
        Schema::dropIfExists('producer_measurements');
    }
}
