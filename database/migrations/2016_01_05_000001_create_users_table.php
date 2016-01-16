<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            // User data
            $table->string('email')->unique();
            $table->string('password', 60);

            // Personal information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identity_card');
            $table->enum('gender', ['Hombre', 'Mujer']);
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable(); // extension of the file
            $table->string('remark')->nullable();

            // Contact data
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
