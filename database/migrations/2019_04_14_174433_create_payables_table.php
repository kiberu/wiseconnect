<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payables', function (Blueprint $table) {
                $table->increments('id');
                $table->string('fullname');
                $table->string('amount');
                $table->string('status');
                $table->string('notes')->nullable();
                $table->integer('user_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();
            }
        );

        Schema::table(
            'payables', function (Blueprint $table) {
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
        Schema::dropIfExists('payables');
    }
}
