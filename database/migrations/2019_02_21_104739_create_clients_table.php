<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'clients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('sex');
                $table->date('date_of_birth');
                $table->string('next_of_kin');
                $table->string('phone_number');
                $table->integer('user_id')->unsigned();
                $table->string('NIN');
                $table->string('residential_address');
                $table->softDeletes();
                $table->timestamps();
            }
        );

        Schema::table(
            'clients', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
            }
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
