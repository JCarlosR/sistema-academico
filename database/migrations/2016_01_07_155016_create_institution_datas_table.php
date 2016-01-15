<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('catchword');
            $table->string('logo');
            $table->string('resolution');
            $table->string('address');
            $table->string('phone');
            $table->string('cellphone');
            $table->string('email');

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
        Schema::drop('institution_datas');
    }
}
