<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('installment_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('amount')->unsigned();
                $table->integer('current_balance');
                $table->softDeletes();
                $table->timestamps();

            }
        );

        Schema::table(
            'payments', function (Blueprint $table) {
                $table->foreign('installment_id')->references('id')->on('installments');
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
        Schema::dropIfExists('payments');
    }
}
