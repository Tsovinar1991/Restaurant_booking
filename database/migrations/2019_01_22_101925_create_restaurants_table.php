<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();;
            $table->string('name');
            $table->string('type');
            $table->longText('description');
            $table->string('avatar');
            $table->string('address');
            $table->string('tel');
            $table->string('email');
            $table->string('open_hour')->default('09:00')->nullable();
            $table->string('close_hour')->default('23:00')->nullable();
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
        Schema::dropIfExists('restaurants');
    }
}
