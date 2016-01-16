<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_years', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->date('start');
            $table->date('end');

            // Each schoolYear uses a particular course_handbook
            $table->integer('course_handbook_id')->unsigned();
            $table->foreign('course_handbook_id')->references('id')->on('course_handbooks');

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
        Schema::drop('school_years');
    }
}
