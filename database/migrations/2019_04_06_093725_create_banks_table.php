<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'banks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('amount');
                $table->string('type');
                $table->string('banked_by');
                $table->string('transaction_id');
                $table->integer('user_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();
            }
        );

        Schema::table(
            'banks', function (Blueprint $table) {
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
        Schema::dropIfExists('banks');
    }
}
