<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name');
            $table->string('lastname');       
            $table->integer('document')->unique();
            $table->date('birth_date');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();            
            $table->string('photo')->nullable();
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('branch_id')->nullable();
            $table->integer('state');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
