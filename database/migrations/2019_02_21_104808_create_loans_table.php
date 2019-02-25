<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_type_id')->unsigned();
            $table->integer('duration');
            $table->integer('client_id')->unsigned();
            $table->integer('principle');
            $table->integer('interest_rate');
            $table->string('interval');
            $table->integer('penalty');
            $table->string('penalty_value');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('loans', function (Blueprint $table) {
          $table->foreign('loan_type_id')->references('id')->on('loan_types');
          $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
