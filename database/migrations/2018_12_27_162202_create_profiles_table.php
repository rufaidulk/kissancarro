<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();//since increment id in user table is unsigned
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->string('street');
            $table->string('city');
            $table->string('district');
            $table->string('zipcode');
            $table->string('landmark');
            $table->string('address_type');
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
        Schema::dropIfExists('profiles');
    }
}
