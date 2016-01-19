<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');

            // Student who will be enrolled
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            // SchoolYear target
            $table->integer('school_year_id')->unsigned();
            $table->foreign('school_year_id')->references('id')->on('school_years');

            // Grade and section
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');

            // Status
            // 0: Pendiente de pago
            // 1: Pago completo
            $table->boolean('status');

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
        Schema::drop('enrollments');
    }
}
