<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'groups', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('landmark');
                $table->string('payment_day');
                $table->integer('user_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();
            }
        );

        Schema::table(
            'groups', function (Blueprint $table) {
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
        Schema::dropIfExists('groups');
    }
}
