<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_grade', function (Blueprint $table) {
            $table->increments('id');

            // This assignment belongs to a handbook
            $table->integer('course_handbook_id')->unsigned();
            $table->foreign('course_handbook_id')->references('id')->on('course_handbooks');

            // Associated tables

            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');

            $table->integer('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id')->on('grades');

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
        Schema::drop('course_grade');
    }
}
