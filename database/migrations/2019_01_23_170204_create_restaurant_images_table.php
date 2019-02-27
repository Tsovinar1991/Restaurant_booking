<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_images', function (Blueprint $table) {
            $table->increments('id');
           //$table->integer('restaurant_id')->unsigned();
            $table->integer('restaurant_id')->default(1)->nullable();
            $table->string('title');
            $table->string('name');
            $table->timestamps();
//           $table->foreign('restaurant_id')->references('id')->on('restaurants');
            });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_images');
    }
}
