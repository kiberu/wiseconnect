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
            $table->integer('client_id')->unsigned();
            $table->integer('principle');
            $table->integer('duration');
            $table->integer('grace_period');
            $table->integer('interest_rate');
            $table->integer('penalty');
            $table->string('status');
            $table->integer('business_type_id')->unsigned();
            $table->string('business_location');
            $table->string('payment_day');
            $table->integer('partial_amount');
            $table->integer('application_fee');
            $table->integer('insurance_fee');
            $table->date('initial_start');
            $table->timestamps();
        });

        Schema::table('loans', function (Blueprint $table) {
          $table->foreign('loan_type_id')->references('id')->on('loan_types');
          $table->foreign('client_id')->references('id')->on('clients');
          $table->foreign('business_type_id')->references('id')->on('business_types');
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
