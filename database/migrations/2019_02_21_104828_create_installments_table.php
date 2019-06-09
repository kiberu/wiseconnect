<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'installments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('loan_id')->unsigned();
                $table->string('expected_amount');
                $table->date('due_date');
                $table->string('status')->default('pending');
                $table->integer('balance');
                $table->softDeletes();
                $table->timestamps();
            }
        );

        Schema::table(
            'installments', function (Blueprint $table) {
                $table->foreign('loan_id')->references('id')->on('loans');
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
        Schema::dropIfExists('installments');
    }
}
