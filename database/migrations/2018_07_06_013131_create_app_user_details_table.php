<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_details', function (Blueprint $table) {
            $table->Integer('user_id')->unsigned();
            $table->Foreign('user_id')->references('id')->on('app_users');
            $table->Integer('age');
            $table->String('gender');
            $table->Integer('weight');
            $table->Integer('weight_goal');
            $table->String('home_gym_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_user_details');
    }
}
