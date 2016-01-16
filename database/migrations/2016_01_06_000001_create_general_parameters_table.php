<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_parameters', function (Blueprint $table) {
            $table->increments('id');

            $table->float('registration_fee');
            $table->float('monthly_payment');

            $table->string('coin_name');
            $table->string('coin_symbol');

            $table->smallInteger('periods_per_year');
            $table->smallInteger('units_per_period');

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
        Schema::drop('general_parameters');
    }
}
